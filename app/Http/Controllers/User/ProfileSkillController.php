<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileSkillController extends Controller
{
    /**
     * Tampilkan halaman Profil & Skill User (AD-02)
     */
    public function index()
    {
        $user = Auth::user();
        
        // Pastikan relasi skills dimuat beserta pivot tingkat_keahlian
        $userSkills = $user->skills ?? collect();
        
        // Ambil daftar master skill yang tersedia
        $masterSkills = Skill::orderBy('nama_skill', 'asc')->get();
        if ($masterSkills->isEmpty()) {
            // Seed master skills jika kosong
            $defaultSkills = [
                'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 'Node.js', 
                'Python', 'UI/UX Design', 'Figma', 'Flutter', 'Tailwind CSS', 
                'SQL / MySQL', 'Data Science', 'DevOps / Docker'
            ];
            foreach ($defaultSkills as $name) {
                Skill::firstOrCreate(['nama_skill' => $name]);
            }
            $masterSkills = Skill::orderBy('nama_skill', 'asc')->get();
        }

        return view('user.profile-skill', compact('user', 'userSkills', 'masterSkills'));
    }

    /**
     * Memperbarui identitas user, master skill & tingkat keahlian, serta portofolio (AD-02)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input, format tautan, dan kelengkapan data sesuai diagram
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'cv_file'     => 'required_without:cv_exists|nullable|file|mimes:pdf,doc,docx|max:2048',
            'portofolio'  => 'nullable|url|max:255',
            'skill_id'    => 'nullable|array',
            'skill_id.*'  => 'nullable|exists:skills,id',
            'level'       => 'nullable|array',
            'level.*'     => 'nullable|in:Beginner,Intermediate,Advanced',
            'custom_skill'=> 'nullable|string|max:50',
            'custom_level'=> 'nullable|in:Beginner,Intermediate,Advanced',
        ], [
            'name.required'        => 'Nama lengkap wajib diisi.',
            'cv_file.required_without' => 'File CV wajib diunggah.',
            'cv_file.mimes'        => 'File CV harus berformat PDF, DOC, atau DOCX.',
            'cv_file.max'          => 'Ukuran file CV maksimal 2 MB.',
            'portofolio.url'       => 'Tautan bukti portofolio harus berupa URL yang valid (misal: https://github.com/username).',
            'level.*.in'           => 'Tingkat keahlian harus Beginner, Intermediate, atau Advanced.',
        ]);

        DB::beginTransaction();
        try {
            $cvPath = $user->cv_path; // Pertahankan file lama jika tidak ada file baru

            // Proses upload file CV baru jika ada
            if ($request->hasFile('cv_file') && $request->file('cv_file')->isValid()) {
                // Hapus file CV lama jika ada
                if ($cvPath && Storage::disk('public')->exists($cvPath)) {
                    Storage::disk('public')->delete($cvPath);
                }
                // Simpan file baru ke storage/app/public/cv
                $cvPath = $request->file('cv_file')->store('cv', 'public');
            }

            // 1. Perbarui data pada tabel users (name, cv_path, portofolio)
            $user->update([
                'name'       => $validated['name'],
                'cv_path'    => $cvPath,
                'portofolio' => $validated['portofolio'] ?? null,
            ]);

            // 2. Jika user menambahkan custom skill baru
            if (!empty($validated['custom_skill'])) {
                $newSkill = Skill::firstOrCreate([
                    'nama_skill' => trim($validated['custom_skill'])
                ]);
                $cLevel = $validated['custom_level'] ?? 'Intermediate';
                
                // Hubungkan ke user
                $user->skills()->syncWithoutDetaching([
                    $newSkill->id => ['tingkat_keahlian' => $cLevel]
                ]);
            }

            // 3. Sinkronisasi relasi master skill yang dipilih
            if (isset($validated['skill_id']) && is_array($validated['skill_id'])) {
                $syncData = [];
                foreach ($validated['skill_id'] as $idx => $sId) {
                    if ($sId) {
                        $lvl = $validated['level'][$idx] ?? 'Intermediate';
                        $syncData[$sId] = ['tingkat_keahlian' => $lvl];
                    }
                }
                $user->skills()->sync($syncData);
            }

            DB::commit();

            return redirect()->route('profile.skill')->with('success', 'Profil dan keahlian berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan perubahan: ' . $e->getMessage());
        }
    }

    /**
     * Tambah skill cepat via AJAX / Form
     */
    public function addSkill(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'skill_id'         => 'required|exists:skills,id',
            'tingkat_keahlian' => 'required|in:Beginner,Intermediate,Advanced',
        ], [
            'skill_id.required'         => 'Pilih skill yang ingin ditambahkan.',
            'tingkat_keahlian.required' => 'Pilih tingkat keahlian.',
        ]);

        $user->skills()->syncWithoutDetaching([
            $request->skill_id => ['tingkat_keahlian' => $request->tingkat_keahlian]
        ]);

        return redirect()->route('profile.skill')->with('success', 'Skill berhasil ditambahkan ke profil Anda.');
    }

    /**
     * Hapus skill dari profil user
     */
    public function removeSkill($skillId)
    {
        $user = Auth::user();
        $user->skills()->detach($skillId);

        return redirect()->route('profile.skill')->with('success', 'Skill berhasil dihapus dari profil.');
    }
}
