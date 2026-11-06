<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FeeAndPaymentIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected MidtransService $service;

    protected User $creator;

    protected User $member;

    protected Project $project;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new MidtransService;

        $this->creator = User::create([
            'name' => 'Creator Fee',
            'email' => 'fee_c@example.com',
            'password' => Hash::make('password123'),
            'role' => 'creator',
        ]);

        $this->member = User::create([
            'name' => 'Member Fee',
            'email' => 'fee_m@example.com',
            'password' => Hash::make('password123'),
            'role' => 'member',
        ]);

        $this->project = Project::create([
            'creator_id' => $this->creator->id,
            'judul_project' => 'Proyek Midtrans Payment',
            'deskripsi' => 'Pengujian modul pembayaran DP dan fee termin Midtrans.',
            'kategori' => 'Web Development',
            'budget' => 5000000,
            'status_project' => 'Tim Terbentuk',
        ]);
    }

    /**
     * MOD-FEE-UT01: test_project_creator_can_simulate_down_payment_via_midtrans_snap
     * Sistem backend berhasil terhubung ke API Midtrans Sandbox dan mengembalikan token Snap DP saat tim proyek lengkap.
     */
    public function test_project_creator_can_simulate_down_payment_via_midtrans_snap(): void
    {
        $dpAmount = $this->project->budget * 0.3; // 30% Down Payment
        $transaction = $this->service->createDownPaymentSnapToken($this->project, $this->creator, $dpAmount);

        $this->assertNotNull($transaction->snap_token);
        $this->assertStringStartsWith('SNAP-', $transaction->snap_token);
        $this->assertEquals('pending', $transaction->status_pembayaran);
        $this->assertEquals($dpAmount, $transaction->jumlah_fee);

        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'project_id' => $this->project->id,
            'status_pembayaran' => 'pending',
        ]);
    }

    /**
     * MOD-FEE-UT02: test_creator_can_process_task_installment_fee_payout_after_task_done
     * Creator berhasil memicu dan memproses pencairan fee termin setelah tugas anggota berstatus Selesai (Done).
     */
    public function test_creator_can_process_task_installment_fee_payout_after_task_done(): void
    {
        $task = Task::create([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'nama_task' => 'Modul Integrasi Payment Gateway',
            'deadline' => now()->addDays(2),
            'status_task' => 'Selesai',
        ]);

        $payoutAmount = 1500000;
        $transaction = $this->service->processTaskInstallmentPayout($task, $payoutAmount);

        $this->assertEquals('lunas', $transaction->status_pembayaran);
        $this->assertEquals($payoutAmount, $transaction->jumlah_fee);
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'status_pembayaran' => 'lunas',
        ]);
    }

    /**
     * MOD-FEE-UT03: test_laravel_backend_updates_transaction_status_via_midtrans_webhook
     * Backend Laravel sukses menerima payload webhook Midtrans dan memperbarui status transaksi menjadi lunas secara otomatis.
     */
    public function test_laravel_backend_updates_transaction_status_via_midtrans_webhook(): void
    {
        $transaction = Transaction::create([
            'project_id' => $this->project->id,
            'user_id' => $this->creator->id,
            'jumlah_fee' => 1500000,
            'order_id' => 'DP-WEBHOOK-TEST-001',
            'snap_token' => 'SNAP-TOKEN-001',
            'status_pembayaran' => 'pending',
        ]);

        $webhookPayload = [
            'order_id' => 'DP-WEBHOOK-TEST-001',
            'transaction_status' => 'settlement',
            'status_code' => '200',
            'gross_amount' => '1500000.00',
        ];

        $response = $this->postJson('/api/midtrans/webhook', $webhookPayload);

        $response->assertStatus(200);
        $transaction->refresh();
        $this->assertEquals('lunas', $transaction->status_pembayaran);
    }

    /**
     * MOD-FEE-UT04: test_fee_amount_is_displayed_privately_in_member_dashboard
     * Nominal fee/pemasukan tampil dengan aman pada box ringkasan privat dasbor member serta disembunyikan dari riwayat publik.
     */
    public function test_fee_amount_is_displayed_privately_in_member_dashboard(): void
    {
        DB::table('project_member')->insert([
            'project_id' => $this->project->id,
            'user_id' => $this->member->id,
            'peran' => 'Lead Engineer',
            'nominal_fee' => 2500000,
            'status_keanggotaan' => 'Diterima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Akses privat ke halaman riwayat / dompet member
        $response = $this->actingAs($this->member)->get('/proyek/riwayat');

        $response->assertStatus(200);
        $response->assertViewHas('totalEarnedFee', 2500000);

        // Akses detail publik proyek tidak boleh menampilkan total pendapatan pribadi
        $publicResponse = $this->get('/proyek/'.$this->project->id);
        $publicResponse->assertStatus(200);
        $publicResponse->assertViewMissing('totalEarnedFee');
    }

    /**
     * MOD-FEE-UT05: test_system_handles_midtrans_payment_cancellation_without_changing_invoice
     * Sistem menangani pembatalan pembayaran pada popup Midtrans Snap tanpa mengubah atau merusak status tagihan aktif.
     */
    public function test_system_handles_midtrans_payment_cancellation_without_changing_invoice(): void
    {
        $transaction = Transaction::create([
            'project_id' => $this->project->id,
            'user_id' => $this->creator->id,
            'jumlah_fee' => 1500000,
            'order_id' => 'DP-CANCEL-TEST-002',
            'snap_token' => 'SNAP-TOKEN-002',
            'status_pembayaran' => 'pending',
        ]);

        $cancelPayload = [
            'order_id' => 'DP-CANCEL-TEST-002',
            'transaction_status' => 'cancel',
        ];

        $response = $this->postJson('/api/midtrans/webhook', $cancelPayload);

        $response->assertStatus(200);
        // Transaksi tidak dihapus atau dirusak
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'order_id' => 'DP-CANCEL-TEST-002',
        ]);
    }

    /**
     * MOD-FEE-UT06: test_system_verifies_total_fee_allocation_against_project_budget_before_transaction
     * Sistem memverifikasi validitas akumulasi fee seluruh posisi terhadap batas total budget proyek sebelum transaksi diinisiasi.
     */
    public function test_system_verifies_total_fee_allocation_against_project_budget_before_transaction(): void
    {
        // Proyek budget: 5.000.000
        // Transaksi 1: 3.000.000 (lunas)
        Transaction::create([
            'project_id' => $this->project->id,
            'user_id' => $this->creator->id,
            'jumlah_fee' => 3000000,
            'order_id' => 'TRX-1',
            'status_pembayaran' => 'lunas',
        ]);

        // Verifikasi alokasi fee tambahan 1.500.000 (Total 4.500.000 <= 5.000.000) -> VALID
        $isValidUnderBudget = $this->service->verifyTotalFeeAllocation($this->project, 1500000);
        $this->assertTrue($isValidUnderBudget);

        // Verifikasi alokasi fee tambahan 2.500.000 (Total 5.500.000 > 5.000.000) -> TIDAK VALID
        $isInvalidOverBudget = $this->service->verifyTotalFeeAllocation($this->project, 2500000);
        $this->assertFalse($isInvalidOverBudget);
    }
}
