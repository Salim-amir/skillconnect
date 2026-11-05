<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct(protected MidtransService $midtransService) {}

    /**
     * Simulasi inisiasi Down Payment Midtrans Snap
     */
    public function simulateDownPayment(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $user = Auth::user();

        $amount = (float) $request->input('amount', $project->budget * 0.3);

        $transaction = $this->midtransService->createDownPaymentSnapToken($project, $user, $amount);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'order_id' => $transaction->order_id,
                'snap_token' => $transaction->snap_token,
            ], 200);
        }

        return redirect()->back()->with('snap_token', $transaction->snap_token);
    }

    /**
     * Pencairan fee termin setelah task selesai
     */
    public function processInstallmentPayout(Request $request, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $amount = (float) $request->input('amount', 500000);
        $transaction = $this->midtransService->processTaskInstallmentPayout($task, $amount);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'transaction' => $transaction,
            ], 200);
        }

        return redirect()->back()->with('success', 'Fee termin berhasil dicairkan.');
    }

    /**
     * Webhook notifikasi Midtrans
     */
    public function handleWebhook(Request $request)
    {
        $transaction = $this->midtransService->handleWebhook($request->all());

        if (! $transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => 'success',
            'order_id' => $transaction->order_id,
            'status_pembayaran' => $transaction->status_pembayaran,
        ], 200);
    }
}
