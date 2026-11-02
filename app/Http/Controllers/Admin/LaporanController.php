<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Menampilkan laporan:
     * - Data pengguna beserta skill yang dimiliki
     * - Proyek yang masih aktif (belum selesai)
     * - Informasi member pada setiap proyek aktif
     */
    public function index()
    {
        // Semua pengguna beserta skill yang dimiliki (dengan tingkat keahlian)
        $users = User::with('skills')->orderBy('name')->paginate(4)->withQueryString();

        // Proyek aktif (status_project != 'Selesai') beserta relasinya
        $activeProjects = Project::with(['creator', 'skills', 'members'])
            ->where('status_project', '!=', 'Selesai')
            ->latest()
            ->get();

        // Ringkasan angka laporan
        $totalUsers          = User::count();
        $totalAdmins         = User::where('role', 'admin')->count();
        $totalMembers        = User::where('role', '!=', 'admin')->count();
        $totalUserSkills     = DB::table('user_skill')->count();
        $totalProjects       = Project::count();
        $totalActiveProjects = $activeProjects->count();
        $totalProjectMembers = $activeProjects->sum(fn ($p) => $p->members->count());

        return view('admin.laporan', compact(
            'users',
            'activeProjects',
            'totalUsers',
            'totalAdmins',
            'totalMembers',
            'totalUserSkills',
            'totalProjects',
            'totalActiveProjects',
            'totalProjectMembers'
        ));
    }
}
