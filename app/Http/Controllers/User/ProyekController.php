<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use App\Services\ExactSkillMatchingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyekController extends Controller
{
    protected ExactSkillMatchingService $matchingService;

    public function __construct(ExactSkillMatchingService $matchingService)
    {
        $this->matchingService = $matchingService;
    }

    /**
     * AD-03: Menampilkan daftar proyek yang tersedia & pencarian
     */
    public function index(Request $request)
    {
        $query = Project::with(['creator', 'skills', 'members']);

        // Filter pencarian berdasarkan judul proyek atau deskripsi
        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function($q) use ($keyword) {
                $q->where('judul_project', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi', 'like', "%{$keyword}%")
                  ->orWhere('kategori', 'like', "%{$keyword}%");
            });
        }

        // Filter kategori
        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }

        // Filter skill
        if ($request->filled('skill_id')) {
            $query->whereHas('skills', function($q) use ($request) {
                $q->where('skills.id', $request->skill_id);
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status_project', $request->status);
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(9);

        // Jika user login, dapatkan juga ID proyek yang sudah pernah dia apply
        $userAppliedProjectIds = [];
        if (Auth::check()) {
            $userAppliedProjectIds = DB::table('project_member')
                ->where('user_id', Auth::id())
                ->pluck('project_id')
                ->toArray();
        }

        $allSkills = Skill::orderBy('nama_skill')->get();
        if ($allSkills->isEmpty()) {
            $defaultSkills = ['Laravel', 'Vue.js', 'React', 'Flutter', 'UI/UX Design', 'Node.js', 'Python'];
            foreach ($defaultSkills as $name) {
                Skill::firstOrCreate(['nama_skill' => $name]);
            }
            $allSkills = Skill::orderBy('nama_skill')->get();
        }

        return view('user.proyek', compact('projects', 'allSkills', 'userAppliedProjectIds'));
    }

    /**
     * AD-03, AD-06, AD-07: Detail Proyek, Daftar Kandidat (Pelamar), & Kelola Tim
     * Menggunakan ExactSkillMatchingService [MVP 2]
     */
    public function show(Request $request, $id)
    {
        $project = Project::with(['creator', 'skills'])->findOrFail($id);

        $myApplication = null;
        if (Auth::check()) {
            $myApplication = DB::table('project_member')
                ->where('user_id', Auth::id())
                ->where('project_id', $project->id)
                ->first();
        }

        $selectedPosition = $request->query('posisi');

        // AD-06 Revisi: Daftar posisi unik pelamar
        $availablePositions = $this->matchingService->getAvailablePositions($project->id);

        // MVP 2: Exact Skill Matching Query & Urutan Kandidat Sesuai Filter Posisi
        $candidates = $this->matchingService->getCandidatesForProject($project, $selectedPosition);

        // Ambil daftar anggota tim yang sudah resmi diterima (Accepted)
        $acceptedMembers = DB::table('project_member')
            ->join('users', 'project_member.user_id', '=', 'users.id')
            ->where('project_member.project_id', $project->id)
            ->where('project_member.status_keanggotaan', 'Diterima')
            ->select('project_member.*', 'users.name', 'users.email', 'users.portofolio')
            ->get();

        // Cek status pembayaran proyek (Midtrans Escrow)
        $latestPayment = \App\Models\Transaction::where('project_id', $project->id)
            ->latest()
            ->first();
        $isPaid = $latestPayment && $latestPayment->status_pembayaran === 'lunas';

        return view('user.proyek-detail', compact(
            'project', 
            'myApplication', 
            'candidates', 
            'availablePositions', 
            'selectedPosition',
            'acceptedMembers',
            'isPaid',
            'latestPayment'
        ));
    }

    /**
     * AD-07: Creator Menerima atau Menolak Kandidat
     */
    public function updateCandidateStatus(Request $request, $projectId, $applicationId)
    {
        $project = Project::findOrFail($projectId);

        // Hanya creator proyek atau admin yang boleh menerima/menolak
        if (Auth::id() !== $project->creator_id && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya Creator proyek atau Admin yang memiliki wewenang mengelola tim.');
        }

        $request->validate([
            'action' => 'required|in:terima,tolak',
        ]);

        $newStatus = $request->action === 'terima' ? 'Diterima' : 'Ditolak';

        DB::table('project_member')
            ->where('id', $applicationId)
            ->where('project_id', $project->id)
            ->update([
                'status_keanggotaan' => $newStatus,
                'updated_at'         => now(),
            ]);

        $msg = $request->action === 'terima' 
            ? 'Kandidat berhasil DITERIMA ke dalam tim proyek!' 
            : 'Lamaran kandidat telah DITOLAK.';

        return redirect()->back()->with('success', $msg);
    }

    /**
     * AD-03: Submit proposal / lamaran untuk bergabung ke proyek
     */
    public function apply(Request $request, $id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);

        if ($project->creator_id === $user->id) {
            return redirect()->back()->with('error', 'Anda adalah pembuat proyek ini, tidak dapat melamar sebagai anggota.');
        }

        $existing = DB::table('project_member')
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Anda sudah pernah mengajukan lamaran untuk proyek ini (Status: ' . ucfirst($existing->status_keanggotaan) . ').');
        }

        $validated = $request->validate([
            'peran'       => 'required|string|max:100',
            'nominal_fee' => 'required|numeric|min:0',
            'pesan'       => 'nullable|string|max:1000',
            'cv_link'     => 'required|url|max:500',
        ], [
            'peran.required'       => 'Posisi/peran yang dilamar wajib dipilih atau diisi.',
            'nominal_fee.required' => 'Nominal ekspektasi fee wajib diisi.',
            'nominal_fee.numeric'  => 'Nominal fee harus berupa angka.',
            'cv_link.required'     => 'Tautan CV wajib diisi.',
            'cv_link.url'          => 'Tautan CV harus berupa URL yang valid (misal: https://drive.google.com/...).',
        ]);

        // Simpan tautan CV (Google Drive atau link lainnya)
        $cvPath = $validated['cv_link'];

        DB::table('project_member')->insert([
            'user_id'            => $user->id,
            'project_id'         => $project->id,
            'peran'              => $validated['peran'],
            'nominal_fee'        => $validated['nominal_fee'],
            'status_keanggotaan' => 'Pending',
            'nilai_evaluasi'     => null,
            'cv_path'            => $cvPath,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->route('proyek.detail', $project->id)
            ->with('success', 'Lamaran berhasil dikirim! Status lamaran Anda: Pending.');
    }

    /**
     * AD-04: Menampilkan halaman Form Buat Proyek Baru
     */
    public function create()
    {
        // Hanya Creator yang berhak membuat proyek baru
        if (Auth::user()->role !== 'creator') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak: Hanya pengguna dengan peran Creator yang dapat membuat proyek baru.');
        }

        $allSkills = Skill::orderBy('nama_skill')->get();
        if ($allSkills->isEmpty()) {
            $defaultSkills = ['Laravel', 'Vue.js', 'React', 'Flutter', 'UI/UX Design', 'Node.js', 'Python'];
            foreach ($defaultSkills as $name) {
                Skill::firstOrCreate(['nama_skill' => $name]);
            }
            $allSkills = Skill::orderBy('nama_skill')->get();
        }

        return view('user.proyek-create', compact('allSkills'));
    }

    /**
     * AD-04: Simpan Proyek Baru & Relasi Skill serta Posisi/Peran ke MySQL
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Hanya Creator yang berhak membuat proyek baru
        if ($user->role !== 'creator') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak: Hanya pengguna dengan peran Creator yang dapat membuat proyek baru.');
        }


        $validated = $request->validate([
            'judul_project'  => 'required|string|max:255',
            'kategori'       => 'required|string|max:100',
            'deskripsi'      => 'required|string|min:20',
            'budget'         => 'required|numeric|min:100000',
            'skills'         => 'required|array|min:1',
            'skills.*'       => 'exists:skills,id',
            'posisi'         => 'required|string|max:255',
        ], [
            'judul_project.required' => 'Judul proyek wajib diisi.',
            'kategori.required'      => 'Kategori proyek wajib dipilih.',
            'deskripsi.required'     => 'Deskripsi proyek wajib diisi (minimal 20 karakter).',
            'budget.required'        => 'Estimasi budget wajib diisi.',
            'budget.numeric'         => 'Budget harus berupa angka valid.',
            'skills.required'        => 'Pilih minimal 1 kebutuhan skill untuk proyek.',
            'posisi.required'        => 'Posisi atau peran yang dicari wajib diisi.',
        ]);

        DB::beginTransaction();
        try {
            $project = Project::create([
                'creator_id'     => $user->id,
                'judul_project'  => $validated['judul_project'],
                'kategori'       => $validated['kategori'],
                'deskripsi'      => $validated['deskripsi'] . "\n\n[Posisi Dibutuhkan: " . $validated['posisi'] . "]",
                'budget'         => $validated['budget'],
                'status_project' => 'Mencari Tim',
            ]);

            $project->skills()->sync($validated['skills']);

            DB::table('project_member')->insert([
                'user_id'            => $user->id,
                'project_id'         => $project->id,
                'peran'              => 'Project Creator / Leader',
                'nominal_fee'        => $validated['budget'],
                'status_keanggotaan' => 'Diterima',
                'nilai_evaluasi'     => null,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            DB::commit();

            return redirect()->route('proyek.detail', $project->id)
                ->with('success', 'Proyek berhasil dibuat dan dipublikasikan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan proyek: ' . $e->getMessage());
        }
    }

    /**
     * REVISI AD-11: Riwayat Proyek & Dompet / Kotak Fee
     * - Riwayat proyek bersih tanpa tercampur fee
     * - Kotak fee dan total akumulasi pendapatan ditaruh terpisah di widget/card sendiri
     */
    public function riwayat(Request $request)
    {
        $user = Auth::user();

        // 1. Ambil proyek yang pernah dibuat (sebagai Creator)
        $createdProjects = Project::where('creator_id', $user->id)
            ->with(['skills', 'members'])
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil proyek yang pernah diikuti (sebagai Member)
        $joinedProjects = DB::table('project_member')
            ->join('projects', 'project_member.project_id', '=', 'projects.id')
            ->join('users as creator', 'projects.creator_id', '=', 'creator.id')
            ->where('project_member.user_id', $user->id)
            ->where('project_member.peran', '!=', 'Project Creator / Leader')
            ->select(
                'projects.*',
                'project_member.peran as user_role',
                'project_member.nominal_fee as earned_fee',
                'project_member.status_keanggotaan',
                'project_member.created_at as joined_at',
                'creator.name as creator_name'
            )
            ->orderBy('projects.created_at', 'desc')
            ->get();

        // 3. KOTAK FEE TERPISAH (Sesuai revisi teman: Fee punya kotak sendiri)
        $totalEarnedFee = DB::table('project_member')
            ->where('user_id', $user->id)
            ->where('status_keanggotaan', 'Diterima')
            ->where('peran', '!=', 'Project Creator / Leader')
            ->sum('nominal_fee');

        $pendingFee = DB::table('project_member')
            ->where('user_id', $user->id)
            ->where('status_keanggotaan', 'Pending')
            ->where('peran', '!=', 'Project Creator / Leader')
            ->sum('nominal_fee');

        $totalCompletedProjects = $joinedProjects->where('status_project', 'Selesai')->count() 
            + $createdProjects->where('status_project', 'Selesai')->count();

        $totalActiveProjects = $joinedProjects->where('status_project', '!=', 'Selesai')->count() 
            + $createdProjects->where('status_project', '!=', 'Selesai')->count();

        // 4. GRAFIK PEMASUKAN BULANAN (Portofolio & Keuangan - UC-11)
        $monthlyFeeData = DB::table('project_member')
            ->where('user_id', $user->id)
            ->where('status_keanggotaan', 'Diterima')
            ->where('peran', '!=', 'Project Creator / Leader')
            ->whereRaw("strftime('%Y', updated_at) = ?", [now()->year])
            ->selectRaw("CAST(strftime('%m', updated_at) AS INTEGER) as bulan, SUM(nominal_fee) as total")
            ->groupByRaw("strftime('%m', updated_at)")
            ->orderBy('bulan')
            ->get();

        return view('user.riwayat-proyek', compact(
            'user',
            'createdProjects',
            'joinedProjects',
            'totalEarnedFee',
            'pendingFee',
            'totalCompletedProjects',
            'totalActiveProjects',
            'monthlyFeeData'
        ));
    }
}
