<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectChatController extends Controller
{
    /**
     * Mengambil daftar pesan obrolan tim dalam sebuah proyek.
     */
    public function getMessages(int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);
        $this->authorizeProjectMember($project);

        $messages = ProjectMessage::with('user:id,name,role,foto_profil')
            ->where('project_id', $project->id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'user_id' => $msg->user_id,
                    'user_name' => $msg->user->name ?? 'Anggota',
                    'user_role' => $msg->user->role ?? 'member',
                    'user_avatar' => $msg->user->foto_profil ? asset('storage/'.$msg->user->foto_profil) : null,
                    'pesan' => $msg->pesan,
                    'file_path' => $msg->file_path ? asset('storage/'.$msg->file_path) : null,
                    'file_name' => $msg->file_name,
                    'is_me' => Auth::id() === $msg->user_id,
                    'time' => $msg->created_at->format('H:i'),
                    'date' => $msg->created_at->translatedFormat('d M Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    /**
     * Mengirim pesan baru ke ruang obrolan proyek.
     */
    public function sendMessage(Request $request, int $projectId): JsonResponse|RedirectResponse
    {
        $project = Project::findOrFail($projectId);
        $this->authorizeProjectMember($project);

        $validated = $request->validate([
            'pesan' => 'nullable|string|max:2000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf,zip,doc,docx|max:10240',
        ], [
            'pesan.max' => 'Pesan maksimal 2000 karakter.',
            'attachment.mimes' => 'Format lampiran harus: foto (jpg, png, webp), atau dokumen (pdf, zip, doc, docx).',
            'attachment.max' => 'Ukuran lampiran maksimal 10 MB.',
        ]);

        if (empty(trim($validated['pesan'] ?? '')) && ! $request->hasFile('attachment')) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pesan atau lampiran berkas wajib diisi.',
                ], 422);
            }

            return redirect()->back()->with('error', 'Pesan atau lampiran berkas wajib diisi.');
        }

        $filePath = null;
        $fileName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = $file->getClientOriginalName();
            $storedName = 'chat_'.$project->id.'_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $filePath = $file->storeAs('chat-attachments', $storedName, 'public');
        }

        $message = ProjectMessage::create([
            'project_id' => $project->id,
            'user_id' => Auth::id(),
            'pesan' => $validated['pesan'] ?? '',
            'file_path' => $filePath,
            'file_name' => $fileName,
        ]);

        $message->load('user:id,name,role,foto_profil');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim.',
                'data' => [
                    'id' => $message->id,
                    'user_id' => $message->user_id,
                    'user_name' => $message->user->name ?? 'Anggota',
                    'user_role' => $message->user->role ?? 'member',
                    'user_avatar' => $message->user->foto_profil ? asset('storage/'.$message->user->foto_profil) : null,
                    'pesan' => $message->pesan,
                    'file_path' => $message->file_path ? asset('storage/'.$message->file_path) : null,
                    'file_name' => $message->file_name,
                    'is_me' => true,
                    'time' => $message->created_at->format('H:i'),
                    'date' => $message->created_at->translatedFormat('d M Y'),
                ],
            ]);
        }

        return redirect()->back()->with('success', 'Pesan berhasil dikirim.');
    }

    /**
     * Memperbarui tautan sumber daya kolaborasi proyek (GitHub, Figma, Demo, Docs).
     */
    public function updateLinks(Request $request, int $projectId): RedirectResponse
    {
        $project = Project::findOrFail($projectId);
        $this->authorizeProjectMember($project);

        $validated = $request->validate([
            'github_url' => 'nullable|url|max:255',
            'figma_url' => 'nullable|url|max:255',
            'demo_url' => 'nullable|url|max:255',
            'docs_url' => 'nullable|url|max:255',
        ], [
            'github_url.url' => 'Tautan GitHub harus berupa URL yang valid (misal: https://github.com/...).',
            'figma_url.url' => 'Tautan Figma harus berupa URL yang valid (misal: https://figma.com/...).',
            'demo_url.url' => 'Tautan Demo Website harus berupa URL yang valid (misal: https://my-site.vercel.app).',
            'docs_url.url' => 'Tautan Dokumen harus berupa URL yang valid.',
        ]);

        $project->update([
            'github_url' => $validated['github_url'] ?? null,
            'figma_url' => $validated['figma_url'] ?? null,
            'demo_url' => $validated['demo_url'] ?? null,
            'docs_url' => $validated['docs_url'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Tautan kolaborasi tim berhasil diperbarui!');
    }

    /**
     * Memverifikasi hak akses: hanya creator, admin, atau anggota yang diterima yang boleh akses.
     */
    private function authorizeProjectMember(Project $project): void
    {
        $isCreator = (Auth::user()?->role === 'creator' && Auth::id() === $project->creator_id) || Auth::user()?->role === 'admin';
        if ($isCreator) {
            return;
        }

        $isMember = DB::table('project_member')
            ->where('project_id', $project->id)
            ->where('user_id', Auth::id())
            ->where('status_keanggotaan', 'Diterima')
            ->exists();

        if (! $isMember) {
            abort(403, 'Anda bukan anggota tim proyek ini.');
        }
    }
}
