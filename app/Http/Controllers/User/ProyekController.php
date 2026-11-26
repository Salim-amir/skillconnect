<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Transaction;
use App\Models\User;
use App\Services\ExactSkillMatchingService;
use App\Http\Controllers\User\PaymentController;
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

        // Jika user adalah Creator, khusus tampilkan proyek miliknya sendiri untuk dikelola
        if (Auth::check() && Auth::user()->role === 'creator') {
            $query->where('creator_id', Auth::id());
        }

        // Filter pencarian berdasarkan judul proyek atau deskripsi
        if ($request->filled('q')) {
            $keyword = $request->input('q');
            $query->where(function ($q) use ($keyword) {
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
            $query->whereHas('skills', function ($q) use ($request) {
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

        // Cek status pembayaran proyek (Midtrans Escrow - Opsi A)
        PaymentController::checkAndSyncProjectPayment($project->id);

        $latestPayment = Transaction::where('project_id', $project->id)
            ->where('status_pembayaran', '!=', 'batal')
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

        $maxSlots = $project->max_members ? (int) $project->max_members : (int) $request->input('max_slots', 3);
        $currentAccepted = DB::table('project_member')
            ->where('project_id', $project->id)
            ->where('status_keanggotaan', 'Diterima')
            ->where('peran', '!=', 'Project Creator / Leader')
            ->count();

        if ($request->action === 'terima' && $currentAccepted >= $maxSlots) {
            return redirect()->back()->with('error', 'Kuota posisi atau tim proyek sudah penuh.');
        }

        $newStatus = $request->action === 'terima' ? 'Diterima' : 'Ditolak';

        DB::table('project_member')
            ->where('id', $applicationId)
            ->where('project_id', $project->id)
            ->update([
                'status_keanggotaan' => $newStatus,
                'updated_at' => now(),
            ]);

        // Jika setelah diterima kuota terpenuhi (misal 3/3 atau $maxSlots)
        if ($request->action === 'terima' && ($currentAccepted + 1) >= $maxSlots) {
            $project->update(['status_project' => 'Tim Terbentuk']);

            Transaction::firstOrCreate([
                'project_id' => $project->id,
                'user_id' => $project->creator_id,
                'order_id' => 'DP-'.$project->id.'-'.date('Ymd'),
            ], [
                'jumlah_fee' => $project->budget * 0.3,
                'snap_token' => 'SNAP-DP-'.$project->id,
                'status_pembayaran' => 'pending',
            ]);
        }

        $msg = $request->action === 'terima'
            ? 'Kandidat berhasil DITERIMA ke dalam tim proyek!'
            : 'Lamaran kandidat telah DITOLAK.';

        return redirect()->back()->with('success', $msg);
    }

    /**
     * MOD-06 / MOD-07: Project Creator mengundang kandidat dari rekomendasi
     */
    public function inviteCandidate(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        if (Auth::id() !== $project->creator_id && Auth::user()?->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya Creator yang dapat mengundang kandidat.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'peran' => 'required|string|max:100',
            'nominal_fee' => 'nullable|numeric|min:0',
        ]);

        DB::table('project_member')->insert([
            'user_id' => $validated['user_id'],
            'project_id' => $project->id,
            'peran' => $validated['peran'],
            'nominal_fee' => $validated['nominal_fee'] ?? 0,
            'status_keanggotaan' => 'Undangan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Undangan proyek berhasil dikirimkan kepada kandidat!');
    }

    /**
     * MOD-06 / MOD-07: Member menerima tawaran / undangan proyek
     */
    public function acceptInvitation($projectId)
    {
        $user = Auth::user();
        $invitation = DB::table('project_member')
            ->where('project_id', $projectId)
            ->where('user_id', $user->id)
            ->where('status_keanggotaan', 'Undangan')
            ->first();

        if (! $invitation) {
            return redirect()->back()->with('error', 'Undangan proyek tidak ditemukan.');
        }

        DB::table('project_member')
            ->where('id', $invitation->id)
            ->update([
                'status_keanggotaan' => 'Diterima',
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Selamat, Anda resmi bergabung ke dalam tim proyek!');
    }

    /**
     * MOD-07: Creator mengeluarkan anggota sebelum proyek dimulai
     */
    public function removeMember($projectId, $memberId)
    {
        $project = Project::findOrFail($projectId);

        if (Auth::id() !== $project->creator_id && Auth::user()?->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya Creator yang berhak mengeluarkan anggota.');
        }

        DB::table('project_member')
            ->where('project_id', $project->id)
            ->where('user_id', $memberId)
            ->delete();

        return redirect()->back()->with('success', 'Anggota tim berhasil dikeluarkan sebelum proyek dimulai.');
    }

    /**
     * AD-03: Submit proposal / lamaran untuk bergabung ke proyek
     */
    public function apply(Request $request, $id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);

        // Hanya pengguna dengan role 'member' yang berhak melamar ke proyek
        if ($user->role !== 'member') {
            return redirect()->back()->with('error', 'Akses ditolak: Hanya pengguna dengan peran Member yang dapat melamar dan bergabung ke dalam proyek.');
        }

        if ($project->creator_id === $user->id) {
            return redirect()->back()->with('error', 'Anda adalah pembuat proyek ini, tidak dapat melamar sebagai anggota.');
        }

        $existing = DB::table('project_member')
            ->where('user_id', $user->id)
            ->where('project_id', $project->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'Anda sudah pernah mengajukan lamaran untuk proyek ini (Status: '.ucfirst($existing->status_keanggotaan).').');
        }

        if ($project->max_members) {
            $acceptedCount = DB::table('project_member')
                ->where('project_id', $project->id)
                ->where('status_keanggotaan', 'Diterima')
                ->where('peran', '!=', 'Project Creator / Leader')
                ->count();

            if ($acceptedCount >= (int) $project->max_members) {
                return redirect()->back()->with('error', 'Maaf, kuota pendaftaran anggota untuk proyek ini sudah penuh.');
            }
        }

        $cvValidationRule = function ($attribute, $value, $fail) {
            $parsed = parse_url($value);
            $host = strtolower($parsed['host'] ?? '');

            if ($host !== 'drive.google.com') {
                if (str_contains($host, 'photos.google') || str_contains($host, 'photos.app.goo.gl')) {
                    $fail('Tautan CV tidak boleh berupa tautan Google Photos. Wajib berupa tautan file dokumen CV berformat PDF di Google Drive.');
                    return;
                }
                if (str_contains($host, 'youtube') || str_contains($host, 'youtu.be') || str_contains($host, 'tiktok')) {
                    $fail('Tautan CV tidak boleh berupa tautan video. Wajib berupa tautan file dokumen CV berformat PDF di Google Drive.');
                    return;
                }
                $fail('Tautan CV wajib menggunakan Google Drive resmi (format: https://drive.google.com/file/d/...). Tautan selain Google Drive tidak diterima.');
                return;
            }

            if (str_contains($value, '/folders/')) {
                $fail('Tautan CV tidak boleh berupa tautan folder. Harap cantumkan tautan langsung ke berkas dokumen PDF CV (format: /file/d/...).');
                return;
            }

            $isDriveFile = preg_match('~^https://drive\.google\.com/(file/d/[a-zA-Z0-9_-]+|open\?id=[a-zA-Z0-9_-]+|uc\?id=[a-zA-Z0-9_-]+)~i', $value);
            if (!$isDriveFile) {
                $fail('Format tautan Google Drive tidak valid. Gunakan format file resmi: https://drive.google.com/file/d/<ID_FILE>/view.');
                return;
            }

            if (preg_match('/\.(jpe?g|png|gif|webp|bmp|svg|mp4|mov|avi|mkv|webm|mp3|wav|m4a|zip|rar|7z)(\?|$)/i', $value)) {
                $fail('Tautan CV khusus untuk dokumen berkas PDF. Tautan file foto/gambar, video, audio, atau arsip dilarang.');
                return;
            }
        };

        $validated = $request->validate([
            'peran' => 'required|string|max:100',
            'pesan' => 'nullable|string|max:1000',
            'cv_link' => ['required', 'url', 'max:500', $cvValidationRule],
        ], [
            'peran.required' => 'Posisi/peran yang dilamar wajib dipilih atau diisi.',
            'cv_link.required' => 'Tautan CV wajib diisi.',
            'cv_link.url' => 'Tautan CV harus berupa URL yang valid (misal: https://drive.google.com/file/d/...).',
        ]);

        // Simpan tautan CV (Google Drive atau link lainnya)
        $cvPath = $validated['cv_link'];

        DB::table('project_member')->insert([
            'user_id' => $user->id,
            'project_id' => $project->id,
            'peran' => $validated['peran'],
            'nominal_fee' => $project->budget ?? 0,
            'status_keanggotaan' => 'Pending',
            'nilai_evaluasi' => null,
            'cv_path' => $cvPath,
            'created_at' => now(),
            'updated_at' => now(),
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

        // Bersihkan titik ribuan dari input budget jika dikirim dalam format angka berformat (cth: 5.000.000)
        if ($request->has('budget') && is_string($request->budget)) {
            $cleanedBudget = str_replace(['.', ','], '', $request->budget);
            $request->merge(['budget' => $cleanedBudget]);
        }

        $validated = $request->validate([
            'judul_project' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'deskripsi' => 'required|string|min:20',
            'budget' => 'required|numeric|min:100000',
            'skills' => 'required|array|min:1',
            'skills.*' => 'exists:skills,id',
            'posisi' => 'required|string|max:255',
            'max_members' => 'nullable|integer|min:1|max:50',
            'posisi_fee' => 'nullable|numeric|lte:budget',
        ], [
            'judul_project.required' => 'Judul proyek wajib diisi.',
            'kategori.required' => 'Kategori proyek wajib dipilih.',
            'deskripsi.required' => 'Deskripsi proyek wajib diisi (minimal 20 karakter).',
            'budget.required' => 'Estimasi budget wajib diisi.',
            'budget.numeric' => 'Budget harus berupa angka valid.',
            'skills.required' => 'Pilih minimal 1 kebutuhan skill untuk proyek.',
            'posisi.required' => 'Posisi atau peran yang dicari wajib diisi.',
            'max_members.integer' => 'Kebutuhan anggota tim harus berupa angka bulat.',
            'max_members.min' => 'Kebutuhan anggota tim minimal 1 orang.',
            'posisi_fee.lte' => 'Total alokasi fee posisi tidak boleh melebihi budget proyek.',
        ]);

        DB::beginTransaction();
        try {
            $project = Project::create([
                'creator_id' => $user->id,
                'judul_project' => $validated['judul_project'],
                'kategori' => $validated['kategori'],
                'deskripsi' => $validated['deskripsi']."\n\n[Posisi Dibutuhkan: ".$validated['posisi'].']',
                'budget' => $validated['budget'],
                'max_members' => $validated['max_members'] ?? null,
                'status_project' => 'Mencari Tim',
            ]);

            $project->skills()->sync($validated['skills']);

            DB::table('project_member')->insert([
                'user_id' => $user->id,
                'project_id' => $project->id,
                'peran' => 'Project Creator / Leader',
                'nominal_fee' => $validated['budget'],
                'status_keanggotaan' => 'Diterima',
                'nilai_evaluasi' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('proyek.detail', $project->id)
                ->with('success', 'Proyek berhasil dibuat dan dipublikasikan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan proyek: '.$e->getMessage());
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

        // 3. KOTAK FEE TERPISAH
        // Total Fee Diterima: hanya bertambah jika member diterima, proyek berstatus Selesai, dan transaksi sudah Lunas
        $totalEarnedFee = DB::table('project_member')
            ->join('projects', 'project_member.project_id', '=', 'projects.id')
            ->where('project_member.user_id', $user->id)
            ->where('project_member.status_keanggotaan', 'Diterima')
            ->where('project_member.peran', '!=', 'Project Creator / Leader')
            ->where('projects.status_project', 'Selesai')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('transactions')
                    ->whereColumn('transactions.project_id', 'projects.id')
                    ->where('transactions.status_pembayaran', 'lunas');
            })
            ->sum('project_member.nominal_fee');

        // Fee Dalam Proses: lamaran pending/menunggu, atau sudah diterima tapi proyek belum selesai / pembayaran belum lunas
        $pendingFee = DB::table('project_member')
            ->join('projects', 'project_member.project_id', '=', 'projects.id')
            ->where('project_member.user_id', $user->id)
            ->where('project_member.peran', '!=', 'Project Creator / Leader')
            ->where(function ($query) {
                $query->whereIn('project_member.status_keanggotaan', ['Pending', 'Menunggu'])
                    ->orWhere(function ($q) {
                        $q->where('project_member.status_keanggotaan', 'Diterima')
                            ->where(function ($sub) {
                                $sub->where('projects.status_project', '!=', 'Selesai')
                                    ->orWhereNotExists(function ($tx) {
                                        $tx->select(DB::raw(1))
                                            ->from('transactions')
                                            ->whereColumn('transactions.project_id', 'projects.id')
                                            ->where('transactions.status_pembayaran', 'lunas');
                                    });
                            });
                    });
            })
            ->sum('project_member.nominal_fee');

        $inProgressProjectIds = $joinedProjects
            ->whereIn('status_keanggotaan', ['Pending', 'Menunggu', 'Diterima'])
            ->where('status_project', '!=', 'Selesai')
            ->pluck('id');

        $totalInProgressTasks = DB::table('tasks')->whereIn('project_id', $inProgressProjectIds)->count();
        $completedInProgressTasks = DB::table('tasks')
            ->whereIn('project_id', $inProgressProjectIds)
            ->where('status_task', 'Selesai')
            ->count();

        // Proyek yang benar-benar diikuti oleh Member (sudah diterima oleh Creator)
        $acceptedJoinedProjects = $joinedProjects->where('status_keanggotaan', 'Diterima');

        $totalCompletedProjects = $acceptedJoinedProjects->where('status_project', 'Selesai')->count()
            + $createdProjects->where('status_project', 'Selesai')->count();

        // Hanya dihitung berjalan jika member sudah diterima dan proyek belum selesai
        $totalActiveProjects = $acceptedJoinedProjects->where('status_project', '!=', 'Selesai')->count()
            + $createdProjects->where('status_project', '!=', 'Selesai')->count();

        // 4. GRAFIK PEMASUKAN BULANAN (Portofolio & Keuangan - UC-11)
        $isSqlite = DB::connection()->getDriverName() === 'sqlite';
        $monthExpr = $isSqlite ? "CAST(strftime('%m', project_member.updated_at) AS INTEGER)" : "MONTH(project_member.updated_at)";
        $monthlyFeeData = DB::table('project_member')
            ->join('projects', 'project_member.project_id', '=', 'projects.id')
            ->where('project_member.user_id', $user->id)
            ->where('project_member.status_keanggotaan', 'Diterima')
            ->where('project_member.peran', '!=', 'Project Creator / Leader')
            ->where('projects.status_project', 'Selesai')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('transactions')
                    ->whereColumn('transactions.project_id', 'projects.id')
                    ->where('transactions.status_pembayaran', 'lunas');
            })
            ->whereYear('project_member.updated_at', now()->year)
            ->selectRaw("{$monthExpr} as bulan, SUM(project_member.nominal_fee) as total")
            ->groupByRaw($monthExpr)
            ->orderBy('bulan')
            ->get();

        return view('user.riwayat-proyek', compact(
            'user',
            'createdProjects',
            'joinedProjects',
            'totalEarnedFee',
            'pendingFee',
            'totalInProgressTasks',
            'completedInProgressTasks',
            'totalCompletedProjects',
            'totalActiveProjects',
            'monthlyFeeData'
        ));
    }

    /**
     * Selesaikan Proyek & Cairkan Dana Escrow ke Seluruh Anggota Tim (Opsi A)
     */
    public function completeProject(Request $request, $projectId)
    {
        $project = Project::with(['tasks', 'members'])->findOrFail($projectId);

        // Hanya creator pemilik proyek atau admin yang boleh menyelesaikan
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (!$isCreator) {
            return redirect()->back()->with('error', 'Hanya Creator pemilik proyek yang berwenang menyelesaikan proyek.');
        }

        // Verifikasi apakah proyek sudah didanai di awal (Escrow Lunas)
        $isPaid = Transaction::where('project_id', $project->id)
            ->where('status_pembayaran', 'lunas')
            ->exists();

        if (!$isPaid) {
            return redirect()->back()->with('error', 'Proyek belum dapat diselesaikan karena dana proyek (Escrow) belum didanai/lunas oleh Creator.');
        }

        // Cek apakah masih ada task yang belum selesai
        $unfinishedTasks = $project->tasks()->where('status_task', '!=', 'Selesai')->count();
        if ($unfinishedTasks > 0) {
            return redirect()->back()->with('error', "Masih terdapat {$unfinishedTasks} tugas di papan kerja yang belum selesai. Pastikan seluruh tugas telah ditinjau dan tuntas.");
        }

        // Ubah status proyek menjadi Selesai
        $project->update([
            'status_project' => 'Selesai',
            'selesai_at'     => now(),
        ]);

        return redirect()->back()->with('success', 'Selamat! Proyek telah resmi ditandai SELESAI. Dana Rekening Bersama (Escrow) telah berhasil dicairkan ke saldo/fee masing-masing anggota tim!');
    }
}
