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
        $isCreator = ($user->role === 'creator');

        // Validasi input, format tautan, dan kelengkapan data sesuai diagram
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'cv_link'     => $isCreator ? 'nullable|url|max:500' : 'required|url|max:500',
            'portofolio'  => 'nullable|url|max:255',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'skill_id'    => 'nullable|array',
            'skill_id.*'  => 'nullable|exists:skills,id',
            'level'       => 'nullable|array',
            'level.*'     => 'nullable|in:Beginner,Intermediate,Advanced',
            'custom_skill'=> 'nullable|string|max:50',
            'custom_level'=> 'nullable|in:Beginner,Intermediate,Advanced',
        ], [
            'name.required'    => 'Nama lengkap wajib diisi.',
            'cv_link.required' => 'Tautan CV wajib diisi.',
            'cv_link.url'      => 'Link CV harus berupa URL yang valid (misal: https://drive.google.com/...).',
            'portofolio.url'   => 'Tautan bukti portofolio harus berupa URL yang valid (misal: https://github.com/username).',
            'foto_profil.image'=> 'File foto profil harus berupa gambar.',
            'foto_profil.mimes'=> 'Format foto profil harus JPG, JPEG, PNG, atau WEBP.',
            'foto_profil.max'  => 'Ukuran foto profil maksimal 2MB.',
            'level.*.in'       => 'Tingkat keahlian harus Beginner, Intermediate, atau Advanced.',
        ]);

        DB::beginTransaction();
        try {
            // Data pembaruan user
            $updateData = [
                'name'       => $validated['name'],
                'cv_path'    => $validated['cv_link'] ?? $user->cv_path,
                'portofolio' => $validated['portofolio'] ?? null,
            ];

            // 1. Simpan foto profil jika ada unggahan baru
            if ($request->hasFile('foto_profil')) {
                if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                    Storage::disk('public')->delete($user->foto_profil);
                }
                $path = $request->file('foto_profil')->store('avatars', 'public');
                $updateData['foto_profil'] = $path;
            }

            // Perbarui data pada tabel users (name, cv_path, portofolio, foto_profil)
            $user->update($updateData);

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
