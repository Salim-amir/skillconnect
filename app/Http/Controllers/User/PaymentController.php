<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    /**
     * Konfigurasi Midtrans dari config/midtrans.php
     */
    public static function setupMidtransConfig()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);
        Config::$isSanitized = config('midtrans.is_sanitized', true);
        Config::$is3ds = config('midtrans.is_3ds', true);
    }

    /**
     * Request Snap Token untuk pembayaran dana proyek oleh Creator
     */
    public function initiate(Request $request, $projectId)
    {
        $project = Project::with(['creator'])->findOrFail($projectId);

        // Hanya creator pemilik proyek atau admin yang boleh melakukan pembayaran
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (!$isCreator) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya creator pemilik proyek yang dapat melakukan pembayaran dana proyek.',
            ], 403);
        }

        // Cek apakah proyek sudah pernah dibayar (lunas)
        $isAlreadyPaid = Transaction::where('project_id', $project->id)
            ->where('status_pembayaran', 'lunas')
            ->exists();

        if ($isAlreadyPaid) {
            return response()->json([
                'success' => false,
                'message' => 'Proyek ini sudah didanai (pembayaran telah lunas).',
                'is_paid' => true,
            ]);
        }

        $grossAmount = (int) $project->budget;
        if ($grossAmount < 1000) {
            return response()->json([
                'success' => false,
                'message' => 'Nominal budget proyek tidak valid.',
            ], 422);
        }

        // Buat Order ID unik: SC-PRJ{id}-{timestamp}
        $orderId = 'SC-PRJ' . $project->id . '-' . time();

        $this->setupMidtransConfig();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email'      => Auth::user()->email,
            ],
            'item_details' => [
                [
                    'id'       => 'PRJ-' . $project->id,
                    'price'    => $grossAmount,
                    'quantity' => 1,
                    'name'     => substr($project->judul_project, 0, 50),
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan catatan transaksi pending ke database
            Transaction::create([
                'project_id'        => $project->id,
                'user_id'           => Auth::id(),
                'jumlah_fee'        => $grossAmount,
                'order_id'          => $orderId,
                'snap_token'        => $snapToken,
                'status_pembayaran' => 'pending',
            ]);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $orderId,
                'gross_amount' => $grossAmount,
                'project_title' => $project->judul_project,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat sesi pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Webhook Handler dari Midtrans (HTTP Notification)
     * Otomatis dipanggil oleh Midtrans saat pembayaran selesai / gagal / expired
     */
    public function webhook(Request $request)
    {
        $payload = $request->all();

        $orderId       = $payload['order_id'] ?? null;
        $statusCode    = $payload['status_code'] ?? null;
        $grossAmount   = $payload['gross_amount'] ?? null;
        $signatureKey  = $payload['signature_key'] ?? null;
        $transStatus   = $payload['transaction_status'] ?? null;
        $fraudStatus   = $payload['fraud_status'] ?? null;

        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            return response()->json(['message' => 'Data notifikasi tidak lengkap.'], 400);
        }

        // Verifikasi Signature Key SHA512
        $serverKey = config('midtrans.server_key');
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $expectedSignature) {
            Log::warning("Midtrans Webhook: Signature Key tidak valid untuk order_id: {$orderId}");
            return response()->json(['message' => 'Invalid signature key.'], 403);
        }

        $transaction = Transaction::where('order_id', $orderId)->first();
        if (!$transaction) {
            Log::warning("Midtrans Webhook: Transaksi dengan order_id {$orderId} tidak ditemukan.");
            return response()->json(['message' => 'Transaksi tidak ditemukan.'], 404);
        }

        // Penanganan Status Transaksi
        if ($transStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $this->markAsPaid($transaction);
            }
        } elseif ($transStatus === 'settlement') {
            $this->markAsPaid($transaction);
        } elseif ($transStatus === 'pending') {
            $transaction->update(['status_pembayaran' => 'pending']);
        } elseif (in_array($transStatus, ['deny', 'expire', 'cancel'])) {
            $transaction->update(['status_pembayaran' => 'batal']);
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Helper: Tandai transaksi lunas dan perbarui status proyek
     */
    public function markAsPaid(Transaction $transaction)
    {
        $transaction->update(['status_pembayaran' => 'lunas']);

        $project = $transaction->project;
        if ($project && $project->status_project === 'Mencari Tim') {
            $project->update(['status_project' => 'Berjalan']);
        }

        // Batalkan transaksi pending lainnya pada proyek yang sama agar tidak menumpuk
        Transaction::where('project_id', $transaction->project_id)
            ->where('id', '!=', $transaction->id)
            ->where('status_pembayaran', 'pending')
            ->update(['status_pembayaran' => 'batal']);

        Log::info("Midtrans: Transaksi {$transaction->order_id} berhasil lunas (dana escrow tersimpan).");
    }

    /**
     * Sinkronisasi status pembayaran langsung dengan Midtrans Core API (Client callback / Fallback)
     */
    public function syncStatus(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        // Hanya creator pemilik proyek atau admin
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (!$isCreator) {
            return response()->json([
                'success' => false,
                'message' => 'Hanya creator pemilik proyek yang dapat memverifikasi pembayaran.',
            ], 403);
        }

        $orderId = $request->input('order_id');
        $result = $request->input('result', []);

        // Cari transaksi berdasarkan order_id atau transaksi pending/terbaru
        $transaction = null;
        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();
        }
        if (!$transaction) {
            $transaction = Transaction::where('project_id', $project->id)
                ->where('status_pembayaran', '!=', 'batal')
                ->latest()
                ->first();
        }

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        if ($transaction->status_pembayaran === 'lunas') {
            return response()->json([
                'success' => true,
                'is_paid' => true,
                'message' => 'Pembayaran telah terverifikasi lunas (Dana Escrow Aman).',
            ]);
        }

        $isPaid = false;

        // 1. Cek langsung ke API Midtrans jika order_id tersedia
        if ($transaction->order_id) {
            try {
                self::setupMidtransConfig();
                $midtransStatus = \Midtrans\Transaction::status($transaction->order_id);
                $transStatus = is_object($midtransStatus) ? ($midtransStatus->transaction_status ?? null) : ($midtransStatus['transaction_status'] ?? null);
                $fraudStatus = is_object($midtransStatus) ? ($midtransStatus->fraud_status ?? null) : ($midtransStatus['fraud_status'] ?? null);

                if ($transStatus === 'settlement' || ($transStatus === 'capture' && $fraudStatus === 'accept')) {
                    $isPaid = true;
                }
            } catch (\Exception $e) {
                Log::info('Midtrans direct status check notice: ' . $e->getMessage());
            }
        }

        // 2. Fallback: Verifikasi dari callback payload Snap.js client-side
        if (!$isPaid && !empty($result)) {
            $snapStatus = $result['transaction_status'] ?? null;
            $snapCode   = (string) ($result['status_code'] ?? '');
            if ($snapStatus === 'settlement' || $snapStatus === 'capture' || $snapCode === '200') {
                $isPaid = true;
            }
        }

        if ($isPaid) {
            $this->markAsPaid($transaction);
            return response()->json([
                'success' => true,
                'is_paid' => true,
                'message' => 'Pembayaran berhasil! Dana proyek Rp ' . number_format($project->budget, 0, ',', '.') . ' kini tersimpan aman di Rekening Bersama SkillConnect.',
            ]);
        }

        return response()->json([
            'success' => true,
            'is_paid' => false,
            'message' => 'Pembayaran masih menunggu penyelesaian di simulator / bank.',
        ]);
    }

    /**
     * Helper background sync saat halaman proyek dimuat
     */
    public static function checkAndSyncProjectPayment($projectId)
    {
        $pendingTrans = Transaction::where('project_id', $projectId)
            ->where('status_pembayaran', 'pending')
            ->latest()
            ->first();

        if ($pendingTrans && $pendingTrans->order_id) {
            try {
                self::setupMidtransConfig();
                $midtransStatus = \Midtrans\Transaction::status($pendingTrans->order_id);
                $transStatus = is_object($midtransStatus) ? ($midtransStatus->transaction_status ?? null) : ($midtransStatus['transaction_status'] ?? null);
                $fraudStatus = is_object($midtransStatus) ? ($midtransStatus->fraud_status ?? null) : ($midtransStatus['fraud_status'] ?? null);

                if ($transStatus === 'settlement' || ($transStatus === 'capture' && $fraudStatus === 'accept')) {
                    $pendingTrans->update(['status_pembayaran' => 'lunas']);
                    $project = $pendingTrans->project;
                    if ($project && $project->status_project === 'Mencari Tim') {
                        $project->update(['status_project' => 'Berjalan']);
                    }
                    Transaction::where('project_id', $projectId)
                        ->where('id', '!=', $pendingTrans->id)
                        ->where('status_pembayaran', 'pending')
                        ->update(['status_pembayaran' => 'batal']);
                }
            } catch (\Throwable $e) {
                // Abaikan jika offline atau koneksi timeout
            }
        }
    }

    /**
     * Cek status pembayaran proyek (untuk frontend polling / update)
     */
    public function checkStatus($projectId)
    {
        $isPaid = Transaction::where('project_id', $projectId)
            ->where('status_pembayaran', 'lunas')
            ->exists();

        return response()->json([
            'is_paid' => $isPaid,
        ]);
    }
}
