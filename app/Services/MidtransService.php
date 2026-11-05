<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;

class MidtransService
{
    /**
     * Simulasi pembuatan Snap Token untuk Down Payment proyek
     */
    public function createDownPaymentSnapToken(Project $project, User $user, float $amount): Transaction
    {
        $orderId = 'DP-'.$project->id.'-'.time();
        $snapToken = 'SNAP-'.Str::random(24);

        return Transaction::create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'jumlah_fee' => $amount,
            'order_id' => $orderId,
            'snap_token' => $snapToken,
            'status_pembayaran' => 'pending',
        ]);
    }

    /**
     * Memproses pencairan fee termin setelah task berstatus Selesai (Done)
     */
    public function processTaskInstallmentPayout(Task $task, float $amount): Transaction
    {
        $orderId = 'PAYOUT-TASK-'.$task->id.'-'.time();

        return Transaction::create([
            'project_id' => $task->project_id,
            'user_id' => $task->user_id,
            'jumlah_fee' => $amount,
            'order_id' => $orderId,
            'snap_token' => null,
            'status_pembayaran' => 'lunas',
        ]);
    }

    /**
     * Handle Webhook Notifikasi dari Midtrans
     */
    public function handleWebhook(array $payload): ?Transaction
    {
        $orderId = $payload['order_id'] ?? null;
        $status = $payload['transaction_status'] ?? null;

        if (! $orderId) {
            return null;
        }

        $transaction = Transaction::where('order_id', $orderId)->first();

        if (! $transaction) {
            return null;
        }

        if (in_array($status, ['capture', 'settlement'])) {
            $transaction->update(['status_pembayaran' => 'lunas']);
        } elseif (in_array($status, ['cancel', 'deny', 'expire'])) {
            // Penanganan pembatalan tanpa mengubah atau merusak status tagihan aktif
            // Transaksi invoice tetap ada dan integritasnya terjaga
        }

        return $transaction;
    }

    /**
     * Verifikasi akumulasi alokasi fee terhadap batas budget proyek
     */
    public function verifyTotalFeeAllocation(Project $project, float $newAllocation): bool
    {
        $existingTotalFee = Transaction::where('project_id', $project->id)
            ->where('status_pembayaran', 'lunas')
            ->sum('jumlah_fee');

        return ($existingTotalFee + $newAllocation) <= $project->budget;
    }
}
