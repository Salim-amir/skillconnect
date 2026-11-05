<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Menampilkan laporan komprehensif:
     * - Ringkasan & visualisasi data Pengguna, Proyek, dan Transaksi
     * - Data pengguna beserta skill yang dimiliki
     * - Daftar seluruh proyek beserta tim & anggarannya
     * - Rekapitulasi transaksi pembayaran escrow
     */
    public function index()
    {
        // 1. Data Pengguna (Paginasi untuk tabel & Semua untuk print/visualisasi)
        $users = User::with('skills')->orderBy('name')->paginate(6)->withQueryString();
        $allUsers = User::with('skills')->orderBy('name')->get();

        $totalUsers      = $allUsers->count();
        $totalAdmins     = $allUsers->where('role', 'admin')->count();
        $totalCreators   = $allUsers->where('role', 'creator')->count();
        $totalMembers    = $allUsers->where('role', 'member')->count();
        $totalUserSkills = DB::table('user_skill')->count();

        // Top Skills yang paling banyak dimiliki pengguna
        $topSkills = DB::table('user_skill')
            ->join('skills', 'user_skill.skill_id', '=', 'skills.id')
            ->select('skills.nama_skill', DB::raw('COUNT(user_skill.user_id) as total'))
            ->groupBy('skills.id', 'skills.nama_skill')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // 2. Data Proyek
        $projects = Project::with(['creator', 'skills', 'members'])->latest()->get();
        $activeProjects = $projects->where('status_project', '!=', 'Selesai');

        $totalProjects        = $projects->count();
        $projectsMencariTim   = $projects->where('status_project', 'Mencari Tim')->count();
        $projectsBerjalan     = $projects->where('status_project', 'Berjalan')->count();
        $projectsSelesai      = $projects->where('status_project', 'Selesai')->count();
        $totalActiveProjects  = $activeProjects->count();
        $totalProjectBudget   = $projects->sum('budget');
        $totalProjectMembers  = $activeProjects->sum(fn ($p) => $p->members->count());

        // Distribusi Kategori Proyek
        $projectCategories = $projects->groupBy('kategori')->map(fn ($group) => $group->count());

        // 3. Data Transaksi
        $transactions = Transaction::with(['project.members', 'user'])->latest()->get();

        $totalTransactions = $transactions->count();
        $trxLunas          = $transactions->where('status_pembayaran', 'lunas')->count();
        $trxPending        = $transactions->where('status_pembayaran', 'pending')->count();
        $trxBatal          = $transactions->whereNotIn('status_pembayaran', ['lunas', 'pending'])->count();
        $nominalLunas      = $transactions->where('status_pembayaran', 'lunas')->sum('jumlah_fee');
        $nominalPending    = $transactions->where('status_pembayaran', 'pending')->sum('jumlah_fee');
        $totalNominalTrx   = $transactions->sum('jumlah_fee');

        return view('admin.laporan', compact(
            'users',
            'allUsers',
            'totalUsers',
            'totalAdmins',
            'totalCreators',
            'totalMembers',
            'totalUserSkills',
            'topSkills',
            'projects',
            'activeProjects',
            'totalProjects',
            'projectsMencariTim',
            'projectsBerjalan',
            'projectsSelesai',
            'totalActiveProjects',
            'totalProjectBudget',
            'totalProjectMembers',
            'projectCategories',
            'transactions',
            'totalTransactions',
            'trxLunas',
            'trxPending',
            'trxBatal',
            'nominalLunas',
            'nominalPending',
            'totalNominalTrx'
        ));
    }
}
