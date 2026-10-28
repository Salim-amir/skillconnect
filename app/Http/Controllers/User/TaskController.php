<?php

namespace App\Http\Controllers\User;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatusHistory;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * MOD-08: Menampilkan Task Board proyek
     * Hanya anggota tim yang diterima (dan creator) yang bisa melihat task board.
     */
    public function index($projectId)
    {
        $project = Project::with(['creator', 'tasks.user'])->findOrFail($projectId);

        // Verifikasi: hanya anggota tim yang sudah diterima
        $this->authorizeProjectMember($project);

        // Ambil anggota tim yang sudah diterima beserta data evaluasi
        $acceptedMembers = DB::table('project_member')
            ->join('users', 'project_member.user_id', '=', 'users.id')
            ->where('project_member.project_id', $project->id)
            ->where('project_member.status_keanggotaan', 'Diterima')
            ->select(
                'users.id',
                'users.name',
                'project_member.id as member_id',
                'project_member.peran',
                'project_member.nilai_evaluasi',
                'project_member.catatan_evaluasi'
            )
            ->get();

        // Kelompokkan task berdasarkan status untuk tampilan Kanban
        $tasksByStatus = [
            'Belum Dikerjakan'  => $project->tasks->where('status_task', 'Belum Dikerjakan'),
            'Sedang Dikerjakan' => $project->tasks->where('status_task', 'Sedang Dikerjakan'),
            'Menunggu Review'   => $project->tasks->where('status_task', 'Menunggu Review'),
            'Selesai'           => $project->tasks->where('status_task', 'Selesai'),
        ];

        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';

        // Status Pembayaran Proyek
        $latestPayment = Transaction::where('project_id', $project->id)->latest()->first();
        $isPaid = $latestPayment && $latestPayment->status_pembayaran === 'lunas';

        // Evaluasi milik user yang sedang login (untuk tampilan anggota)
        $myEvaluation = $acceptedMembers->firstWhere('id', Auth::id());

        return view('user.task-board', compact(
            'project',
            'tasksByStatus',
            'acceptedMembers',
            'isCreator',
            'myEvaluation',
            'isPaid',
            'latestPayment'
        ));
    }

    /**
     * MOD-08: Creator menambah task baru ke proyek
     */
    public function store(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        // Hanya creator pemilik proyek atau admin yang boleh menambah task
        if ((Auth::user()?->role !== 'creator' || Auth::id() !== $project->creator_id) && Auth::user()?->role !== 'admin') {
            return redirect()->back()->with('error', 'Hanya creator proyek yang dapat menambahkan task.');
        }

        $validated = $request->validate([
            'nama_task' => 'required|string|max:255',
            'user_id'   => 'required|exists:users,id',
            'deadline'  => 'required|date|after_or_equal:today',
        ], [
            'nama_task.required' => 'Nama task wajib diisi.',
            'user_id.required'   => 'Pilih anggota tim yang ditugaskan.',
            'deadline.required'  => 'Deadline wajib diisi.',
            'deadline.after_or_equal' => 'Deadline tidak boleh di masa lalu.',
        ]);

        // Verifikasi bahwa user_id adalah anggota tim yang diterima
        $isMember = DB::table('project_member')
            ->where('project_id', $project->id)
            ->where('user_id', $validated['user_id'])
            ->where('status_keanggotaan', 'Diterima')
            ->exists();

        if (!$isMember) {
            return redirect()->back()->with('error', 'User yang dipilih bukan anggota tim yang aktif.');
        }

        $task = Task::create([
            'project_id'     => $project->id,
            'user_id'        => $validated['user_id'],
            'nama_task'      => $validated['nama_task'],
            'deadline'       => $validated['deadline'],
            'status_task'    => 'Belum Dikerjakan',
            'bukti_kerja'    => null,
            'catatan_revisi' => null,
        ]);

        // Catat history
        TaskStatusHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'status'  => 'Belum Dikerjakan',
        ]);

        return redirect()->route('proyek.tasks', $project->id)
            ->with('success', 'Task "' . $task->nama_task . '" berhasil ditambahkan!');
    }

    /**
     * MOD-08: Anggota tim mengubah status task (misal: mulai kerjakan, selesai, dll.)
     */
    public function updateStatus(Request $request, $projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = Task::where('project_id', $project->id)->findOrFail($taskId);

        $this->authorizeProjectMember($project);

        $validated = $request->validate([
            'status_task' => 'required|in:Belum Dikerjakan,Sedang Dikerjakan,Menunggu Review,Selesai',
        ]);

        // Hanya pemilik task atau creator yang boleh ubah status
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (Auth::id() !== $task->user_id && !$isCreator) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk mengubah status task ini.');
        }

        $task->update(['status_task' => $validated['status_task']]);

        TaskStatusHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'status'  => $validated['status_task'],
        ]);

        return redirect()->route('proyek.tasks', $project->id)
            ->with('success', 'Status task "' . $task->nama_task . '" diperbarui menjadi ' . $validated['status_task'] . '.');
    }

    /**
     * MOD-08: Upload bukti kerja untuk sebuah task
     */
    public function uploadBukti(Request $request, $projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = Task::where('project_id', $project->id)->findOrFail($taskId);

        // Hanya pemilik task yang boleh upload bukti
        if (Auth::id() !== $task->user_id) {
            return redirect()->back()->with('error', 'Hanya penanggung jawab task yang dapat mengupload bukti kerja.');
        }

        $validated = $request->validate([
            'bukti_kerja' => 'required|file|mimes:jpg,jpeg,png,pdf,zip,doc,docx|max:10240',
        ], [
            'bukti_kerja.required' => 'File bukti kerja wajib diunggah.',
            'bukti_kerja.mimes'    => 'Format file harus: jpg, png, pdf, zip, doc, atau docx.',
            'bukti_kerja.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        // Simpan file
        $file = $request->file('bukti_kerja');
        $filename = 'bukti_' . $task->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('bukti-kerja', $filename, 'public');

        $task->update([
            'bukti_kerja' => $path,
            'status_task' => 'Menunggu Review',
        ]);

        TaskStatusHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'status'  => 'Menunggu Review',
        ]);

        return redirect()->route('proyek.tasks', $project->id)
            ->with('success', 'Bukti kerja untuk task "' . $task->nama_task . '" berhasil diunggah!');
    }

    /**
     * MOD-08: Creator memberikan catatan revisi pada task
     */
    public function addRevision(Request $request, $projectId, $taskId)
    {
        $project = Project::findOrFail($projectId);
        $task = Task::where('project_id', $project->id)->findOrFail($taskId);

        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (!$isCreator) {
            return redirect()->back()->with('error', 'Hanya creator proyek yang dapat memberikan catatan revisi.');
        }

        $validated = $request->validate([
            'catatan_revisi' => 'required|string|max:1000',
        ], [
            'catatan_revisi.required' => 'Catatan revisi wajib diisi.',
        ]);

        $task->update([
            'catatan_revisi' => $validated['catatan_revisi'],
            'status_task'    => 'Sedang Dikerjakan',
        ]);

        TaskStatusHistory::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'status'  => 'Sedang Dikerjakan',
        ]);

        return redirect()->route('proyek.tasks', $project->id)
            ->with('success', 'Catatan revisi berhasil ditambahkan. Task dikembalikan ke "Sedang Dikerjakan".');
    }

    /**
     * MOD-09: Creator memberikan evaluasi (rating + catatan) ke anggota tim
     */
    public function evaluateMember(Request $request, $projectId, $memberId)
    {
        $project = Project::findOrFail($projectId);

        // Hanya creator atau admin yang boleh mengevaluasi
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if (!$isCreator) {
            return redirect()->back()->with('error', 'Hanya creator proyek yang dapat memberikan evaluasi.');
        }

        $validated = $request->validate([
            'nilai_evaluasi'   => 'required|integer|min:1|max:5',
            'catatan_evaluasi' => 'nullable|string|max:1000',
        ], [
            'nilai_evaluasi.required' => 'Nilai evaluasi (bintang) wajib dipilih.',
            'nilai_evaluasi.min'      => 'Nilai minimal adalah 1 bintang.',
            'nilai_evaluasi.max'      => 'Nilai maksimal adalah 5 bintang.',
        ]);

        // Verifikasi bahwa memberId adalah anggota tim yang diterima pada proyek ini
        $memberExists = DB::table('project_member')
            ->where('id', $memberId)
            ->where('project_id', $project->id)
            ->where('status_keanggotaan', 'Diterima')
            ->exists();

        if (!$memberExists) {
            return redirect()->back()->with('error', 'Anggota tim tidak ditemukan.');
        }

        DB::table('project_member')
            ->where('id', $memberId)
            ->where('project_id', $project->id)
            ->update([
                'nilai_evaluasi'   => $validated['nilai_evaluasi'],
                'catatan_evaluasi' => $validated['catatan_evaluasi'] ?? null,
                'updated_at'       => now(),
            ]);

        return redirect()->route('proyek.tasks', $project->id)
            ->with('success', 'Evaluasi anggota tim berhasil disimpan!');
    }

    /**
     * Helper: Verifikasi bahwa user adalah anggota tim yang diterima
     */
    private function authorizeProjectMember(Project $project)
    {
        // Creator proyek atau Admin otomatis diizinkan tanpa perlu record di project_member
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if ($isCreator) {
            return;
        }

        $isMember = DB::table('project_member')
            ->where('project_id', $project->id)
            ->where('user_id', Auth::id())
            ->where('status_keanggotaan', 'Diterima')
            ->exists();

        if (!$isMember) {
            abort(403, 'Anda bukan anggota tim proyek ini.');
        }
    }
}
