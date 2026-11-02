<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        // 1. Tampilan Admin Dashboard
        if ($currentUser->role === 'admin') {
            $totalUsers      = User::count();
            $totalProjects   = Project::count();
            $totalCompleted  = Project::where('status_project', 'Selesai')->count();
            $latestUsers     = User::latest()->take(5)->get();
            $totalFee        = Transaction::where('status_pembayaran', 'lunas')->sum('jumlah_fee');
            $totalTransaksi  = Transaction::count();

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalProjects',
                'totalCompleted',
                'latestUsers',
                'totalFee',
                'totalTransaksi'
            ));
        }

        // 2. Tampilan Dashboard Creator
        if ($currentUser->role === 'creator') {
            $myProjects = Project::where('creator_id', $currentUser->id)->latest()->get();
            $totalMyProjects = $myProjects->count();
            $activeProjects = $myProjects->whereIn('status_project', ['Mencari Tim', 'Berjalan'])->count();
            $completedProjects = $myProjects->where('status_project', 'Selesai')->count();
            $myProjectIds = $myProjects->pluck('id');

            $pendingApplicantsCount = DB::table('project_member')
                ->whereIn('project_id', $myProjectIds)
                ->where('status_keanggotaan', 'Menunggu')
                ->count();

            $totalTeamMembers = DB::table('project_member')
                ->whereIn('project_id', $myProjectIds)
                ->where('status_keanggotaan', 'Diterima')
                ->distinct('user_id')
                ->count('user_id');

            $recentApplicants = DB::table('project_member')
                ->join('users', 'project_member.user_id', '=', 'users.id')
                ->join('projects', 'project_member.project_id', '=', 'projects.id')
                ->whereIn('project_member.project_id', $myProjectIds)
                ->where('project_member.status_keanggotaan', 'Menunggu')
                ->select(
                    'project_member.*',
                    'users.name as applicant_name',
                    'users.email as applicant_email',
                    'projects.judul_project'
                )
                ->latest('project_member.created_at')
                ->take(5)
                ->get();

            $recentProjects = $myProjects->take(5);

            return view('creator.dashboard', compact(
                'totalMyProjects',
                'activeProjects',
                'completedProjects',
                'pendingApplicantsCount',
                'totalTeamMembers',
                'recentApplicants',
                'recentProjects'
            ));
        }

        // 3. Tampilan Dashboard Member
        $joinedProjectMembers = DB::table('project_member')->where('user_id', $currentUser->id)->get();
        $acceptedProjectIds = $joinedProjectMembers->where('status_keanggotaan', 'Diterima')->pluck('project_id');

        $myActiveProjectsCount = Project::whereIn('id', $acceptedProjectIds)
            ->where('status_project', '!=', 'Selesai')
            ->count();

        $myCompletedProjectsCount = Project::whereIn('id', $acceptedProjectIds)
            ->where('status_project', 'Selesai')
            ->count();

        $myPendingTasks = Task::with('project')
            ->where('user_id', $currentUser->id)
            ->whereIn('status_task', ['Belum Selesai', 'Revisi', 'Sedang Dikerjakan'])
            ->orderBy('deadline', 'asc')
            ->take(5)
            ->get();

        $totalMyTasksCount = Task::where('user_id', $currentUser->id)
            ->where('status_task', '!=', 'Selesai')
            ->count();

        $totalEarned = (float) DB::table('project_member')
            ->where('user_id', $currentUser->id)
            ->where('status_keanggotaan', 'Diterima')
            ->sum('nominal_fee');

        $myApplications = DB::table('project_member')
            ->join('projects', 'project_member.project_id', '=', 'projects.id')
            ->where('project_member.user_id', $currentUser->id)
            ->select('project_member.*', 'projects.judul_project', 'projects.kategori', 'projects.status_project')
            ->latest('project_member.created_at')
            ->take(5)
            ->get();

        $userSkillIds = $currentUser->skills()->pluck('skills.id');
        $recommendedProjects = Project::with(['skills', 'creator'])
            ->where('status_project', 'Mencari Tim')
            ->where('creator_id', '!=', $currentUser->id)
            ->whereNotIn('id', $joinedProjectMembers->pluck('project_id'))
            ->when($userSkillIds->isNotEmpty(), function($q) use ($userSkillIds) {
                $q->whereHas('skills', function($sub) use ($userSkillIds) {
                    $sub->whereIn('skills.id', $userSkillIds);
                });
            })
            ->latest()
            ->take(4)
            ->get();

        $mySkills = $currentUser->skills()->take(6)->get();

        return view('member.dashboard', compact(
            'myActiveProjectsCount',
            'myCompletedProjectsCount',
            'myPendingTasks',
            'totalMyTasksCount',
            'totalEarned',
            'myApplications',
            'recommendedProjects',
            'mySkills'
        ));
    }
}
