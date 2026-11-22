<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::firstOrCreate([
            'email' => 'admin@skillconnect.com',
        ], [
            'name' => 'Admin SkillConnect',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat akun Member (User biasa)
        User::firstOrCreate([
            'email' => 'member@skillconnect.com',
        ], [
            'name' => 'User Member',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::firstOrCreate([
            'email' => 'della@skillconnect.com',
        ], [
            'name' => 'della',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::firstOrCreate([
            'email' => 'mulia@skillconnect.com',
        ], [
            'name' => 'mulmul',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::firstOrCreate([
            'email' => 'vinda@skillconnect.com',
        ], [
            'name' => 'vinda',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::firstOrCreate([
            'email' => 'salim@skillconnect.com',
        ], [
            'name' => 'salim',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        // Seed Default Skills
        $skillsList = [
            'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 'Node.js', 
            'Python', 'UI/UX Design', 'Figma', 'Flutter', 'Tailwind CSS', 
            'SQL / MySQL', 'Data Science', 'Game Developer', 'Frontend'
        ];
        $skillModels = [];
        foreach ($skillsList as $sName) {
            $skillModels[$sName] = \App\Models\Skill::firstOrCreate(['nama_skill' => $sName]);
        }

        // Creator User untuk pemilik proyek
        $creatorUser = User::firstOrCreate([
            'email' => 'creator@skillconnect.com',
        ], [
            'name' => 'Creator SkillConnect',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'creator',
        ]);

        // Seed Default Projects
        $defaultProjects = [
            [
                'judul_project' => 'Proyek Task Board Testing',
                'deskripsi'     => 'Membuat tampilan yang menarik semenarik mungkin [Posisi Dibutuhkan: UI/UX Lead, Backend Developer]',
                'kategori'      => 'Web Development',
                'budget'        => 1000000,
                'status_project'=> 'Mencari Tim',
                'creator_id'    => $creatorUser->id,
                'skills'        => ['UI/UX Design', 'Frontend', 'Laravel'],
            ],
            [
                'judul_project' => 'Bikin Game',
                'deskripsi'     => 'Membuat game roblox yang sempurna wkwk [Posisi Dibutuhkan: Game Developer]',
                'kategori'      => 'Mobile App',
                'budget'        => 10000000,
                'status_project'=> 'Mencari Tim',
                'creator_id'    => $creatorUser->id,
                'skills'        => ['Flutter', 'Laravel', 'Node.js', 'Python', 'React', 'UI/UX Design', 'Vue.js', 'Game Developer'],
            ],
            [
                'judul_project' => 'Membuat Aplikasi untuk Warung Makan Hemat',
                'deskripsi'     => 'Tujuannya untuk menjadi lebih baik [Posisi Dibutuhkan: UI/UX design, Frontend]',
                'kategori'      => 'Mobile App',
                'budget'        => 10000000,
                'status_project'=> 'Mencari Tim',
                'creator_id'    => $creatorUser->id,
                'skills'        => ['Flutter', 'Laravel', 'Node.js', 'UI/UX Design'],
            ],
            [
                'judul_project' => 'APLIKASI ROBLOX SEMPURNA',
                'deskripsi'     => 'harus bisa fullstack [Posisi Dibutuhkan: UI/UX design, Frontend]',
                'kategori'      => 'Web Development',
                'budget'        => 50000000,
                'status_project'=> 'Berjalan',
                'creator_id'    => $creatorUser->id,
                'skills'        => ['Flutter', 'Laravel', 'Node.js', 'Python'],
            ],
            [
                'judul_project' => 'Aplikasi To Do List',
                'deskripsi'     => 'Pengembangan aplikasi manajemen tugas dan to do list kolaboratif berbasis web [Posisi Dibutuhkan: Frontend, Backend]',
                'kategori'      => 'Web Development',
                'budget'        => 5000000,
                'status_project'=> 'Mencari Tim',
                'creator_id'    => $creatorUser->id,
                'skills'        => ['Laravel', 'Vue.js', 'PHP', 'Tailwind CSS'],
            ],
        ];

        foreach ($defaultProjects as $dpData) {
            $projSkills = $dpData['skills'];
            unset($dpData['skills']);

            $p = \App\Models\Project::firstOrCreate([
                'judul_project' => $dpData['judul_project'],
            ], $dpData);

            // Hubungkan skills
            $attachIds = [];
            foreach ($projSkills as $skName) {
                if (isset($skillModels[$skName])) {
                    $attachIds[] = $skillModels[$skName]->id;
                }
            }
            $p->skills()->syncWithoutDetaching($attachIds);

            // Daftarkan creator sebagai member leader
            \Illuminate\Support\Facades\DB::table('project_member')->updateOrInsert([
                'project_id' => $p->id,
                'user_id'    => $p->creator_id,
            ], [
                'peran'              => 'Project Creator / Leader',
                'nominal_fee'        => $p->budget,
                'status_keanggotaan' => 'Diterima',
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }

    }
}
