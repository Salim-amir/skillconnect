<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Buat Proyek Baru - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #1c2766;
    --mute: #4b5686;
    --line: #e0e3fa;
    --primary: #ff007f;
    --secondary: #7000ff;
    --accent: #7b6cf6;
    box-sizing: border-box;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: linear-gradient(180deg, #eef0ff, #f4f1ff 50%, #eaf1ff);
    color: var(--ink);
    font-family: 'Nunito', system-ui, sans-serif;
    line-height: 1.6;
    overflow-x: hidden;
    display: flex;
    min-height: 100vh;
}

a { color: inherit; text-decoration: none; }
a:focus-visible, button:focus-visible { outline: 2px solid var(--secondary); outline-offset: 3px; }

/* ===== SIDEBAR ===== */
.sidebar {
    width: 280px;
    background: #fff;
    border-right: 1.5px solid var(--line);
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    z-index: 100;
}

.sidebar-header {
    padding: 30px 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-bottom: 1.5px solid #f0f2ff;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 19px;
    letter-spacing: .05em;
}
.brand svg { width: 44px; height: 22px; }
.brand span {
    background: linear-gradient(90deg, #1c2766, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.sidebar-nav {
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
}

.nav-item {
    padding: 14px 20px;
    border-radius: 12px;
    font-weight: 600;
    color: #4b5686;
    font-size: 15px;
    transition: all .2s;
    border: 1.5px solid transparent;
    display: flex;
    align-items: center;
    gap: 12px;
}

.nav-item svg { width: 20px; height: 20px; flex-shrink: 0; }

.nav-item:hover { background: #f4f6ff; color: #1c2766; }

.nav-item.active {
    background: linear-gradient(90deg, rgba(43,58,143,0.1), rgba(123,108,246,0.1));
    color: #2b3a8f;
    border-color: #d6d9fb;
    font-weight: 700;
}

.sidebar-footer {
    padding: 20px 16px;
    border-top: 1.5px solid #f0f2ff;
}

.btn-logout {
    width: 100%;
    padding: 12px;
    background: #fff;
    border: 1.5px solid #f0e0e5;
    color: #d80044;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: .2s;
    font-family: 'Nunito', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

/* ===== MAIN CONTENT ===== */
.main-content {
    flex: 1;
    margin-left: 280px;
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
}

.top-breadcrumb {
    font-size: 14px;
    color: var(--mute);
    font-weight: 600;
}
.top-breadcrumb span { color: var(--ink); font-weight: 700; }

.user-profile { display: flex; align-items: center; gap: 12px; }

.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(123,108,246,.4);
    border: 2px solid #fff;
}

/* Alerts */
.alert {
    padding: 14px 20px;
    border-radius: 12px;
    margin-bottom: 24px;
    font-size: 14.5px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
}
.alert-danger { background: #ffe8ec; color: #cf113b; border: 1.5px solid #fec0cc; }

/* Page Header */
.page-header { margin-bottom: 24px; }
.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 30px;
    color: var(--ink);
}
.page-desc { color: var(--mute); font-size: 15px; margin-top: 2px; }

/* Card & Form Container */
.form-container-card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    box-shadow: 0 10px 32px -16px rgba(80,70,200,.25);
    padding: 36px 40px;
    max-width: 860px;
}

.form-section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 18px;
    color: var(--ink);
    margin: 24px 0 14px;
    padding-bottom: 8px;
    border-bottom: 1.5px solid #f0f2ff;
    display: flex;
    align-items: center;
    gap: 8px;
}
.form-section-title:first-child { margin-top: 0; }

.form-group { margin-bottom: 20px; }
.form-group label {
    display: block;
    font-size: 14.5px;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 8px;
}
.form-group label span.req { color: #e0244d; }
.form-group .hint { font-size: 12.5px; color: var(--mute); margin-top: 4px; }

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-size: 15px;
    color: var(--ink);
    background: #fff;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}
.form-control:focus {
    border-color: #7b6cf6;
    box-shadow: 0 0 0 3px rgba(123,108,246,.15);
}

.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Checkbox Skills Selection */
.skills-selector-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
    gap: 10px;
    max-height: 220px;
    overflow-y: auto;
    padding: 14px;
    background: #f8f9ff;
    border: 1.5px solid #e0e3fa;
    border-radius: 12px;
}

.skill-check-item {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #e0e3fa;
    cursor: pointer;
    font-size: 13.5px;
    font-weight: 600;
    color: #2b3a8f;
    transition: all .15s;
}
.skill-check-item:hover {
    border-color: #7b6cf6;
    background: #f4f6ff;
}
.skill-check-item input[type="checkbox"] {
    accent-color: #7b6cf6;
    width: 16px;
    height: 16px;
}

/* Button */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px 28px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    border: 1.5px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}
.btn.pri {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    box-shadow: 0 8px 22px -6px rgba(123,108,246,.7);
}
.btn.pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px -6px rgba(123,108,246,.85);
}
.btn.outline {
    background: #fff;
    color: #2b3a8f;
    border-color: #d6d9fb;
}
.btn.outline:hover {
    border-color: #7b6cf6;
    background: #f7f8ff;
}

@media(max-width: 992px) {
    .grid-2 { grid-template-columns: 1fr; }
    .form-container-card { padding: 24px; }
    .main-content { margin-left: 0; padding: 20px; }
    .sidebar { display: none; }
}
</style>
</head>
<body>

    <!-- SHARED UNIFIED SIDEBAR -->
    @include('shared.sidebar')

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="top-breadcrumb">
                SkillConnect / <a href="{{ route('proyek') }}">Proyek</a> / <span>Buat & Kelola Proyek</span>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Tamu' }}</div>
                    <div class="role">Project Creator</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        <!-- FLASH ERRORS -->
        @if($errors->any())
            <div class="alert alert-danger">
                <div>
                    <strong>Data Belum Lengkap!</strong>
                    <ul style="margin-top: 4px; padding-left: 20px;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Buat Proyek Baru</h1>
            <p class="page-desc">Isi formulir judul, deskripsi, estimasi budget, posisi yang dibutuhkan, serta kebutuhan skill tim.</p>
        </div>

        <!-- FORM BUAT PROYEK BARU -->
        <div class="form-container-card">
            <form action="{{ route('proyek.store') }}" method="POST">
                @csrf

                <div class="form-section-title">
                    <svg width="20" height="20" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Informasi Utama Proyek
                </div>

                <div class="form-group">
                    <label for="judul_project">Judul Proyek <span class="req">*</span></label>
                    <input type="text" id="judul_project" name="judul_project" class="form-control" value="{{ old('judul_project') }}" required placeholder="Contoh: Redesign Aplikasi Mobile SkillConnect">
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label for="kategori">Kategori Proyek <span class="req">*</span></label>
                        <select id="kategori" name="kategori" class="form-control" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="Web Development" {{ old('kategori') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Mobile App" {{ old('kategori') == 'Mobile App' ? 'selected' : '' }}>Mobile App</option>
                            <option value="UI/UX Design" {{ old('kategori') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="Data Science & AI" {{ old('kategori') == 'Data Science & AI' ? 'selected' : '' }}>Data Science & AI</option>
                            <option value="Digital Marketing" {{ old('kategori') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="budget">Estimasi Budget (Rp) <span class="req">*</span></label>
                        <input type="number" id="budget" name="budget" class="form-control" value="{{ old('budget') }}" required min="100000" placeholder="Contoh: 5000000">
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi Lengkap Proyek <span class="req">*</span></label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control" style="min-height: 120px;" required placeholder="Jelaskan tujuan proyek, deliverables yang diharapkan, dan timeline kerja...">{{ old('deskripsi') }}</textarea>
                    <div class="hint">Minimal 20 karakter agar pelamar memahami kebutuhan tim.</div>
                </div>

                <div class="form-section-title">
                    <svg width="20" height="20" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Kebutuhan Posisi & Skill
                </div>

                <div class="form-group">
                    <label for="posisi">Menambahkan Posisi / Peran yang Dibutuhkan <span class="req">*</span></label>
                    <input type="text" id="posisi" name="posisi" class="form-control" value="{{ old('posisi') }}" required placeholder="Contoh: UI/UX Lead, Backend Developer, QA Tester">
                    <div class="hint">Tentukan spesifikasi peran anggota tim yang ingin Anda rekrut.</div>
                </div>

                <div class="form-group">
                    <label>Pilih Kebutuhan Skill yang Dibutuhkan <span class="req">*</span></label>
                    <div class="skills-selector-grid">
                        @foreach($allSkills as $sk)
                            <label class="skill-check-item">
                                <input type="checkbox" name="skills[]" value="{{ $sk->id }}" {{ (is_array(old('skills')) && in_array($sk->id, old('skills'))) ? 'checked' : '' }}>
                                <span>{{ $sk->nama_skill }}</span>
                            </label>
                        @endforeach
                    </div>
                    <div class="hint">Pilih minimal 1 skill agar algoritma pencocokan anggota berjalan optimal.</div>
                </div>

                <div style="margin-top: 36px; display: flex; justify-content: flex-end; gap: 14px;">
                    <a href="{{ route('proyek') }}" class="btn outline">Batal</a>
                    <button type="submit" class="btn pri">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Proyek
                    </button>
                </div>
            </form>
        </div>

    </main>

</body>
</html>
