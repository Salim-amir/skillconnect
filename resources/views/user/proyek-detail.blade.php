<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>{{ $project->judul_project }} - SkillConnect</title>
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
.alert-success { background: #e8f9ee; color: #0d8239; border: 1.5px solid #b6edc8; }
.alert-danger { background: #ffe8ec; color: #cf113b; border: 1.5px solid #fec0cc; }
.alert-info { background: #eaf3ff; color: #0b57d0; border: 1.5px solid #c2dbff; }

/* Grid Layout */
.detail-grid {
    display: grid;
    grid-template-columns: 1.4fr 1.25fr;
    gap: 28px;
}

.card {
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 20px;
    box-shadow: 0 10px 32px -16px rgba(80,70,200,.25);
    padding: 30px;
    position: relative;
}

.project-hero-badge {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 14px;
}
.category-pill {
    font-size: 12px;
    font-weight: 700;
    color: #5b3fd0;
    background: #f1edff;
    padding: 4px 14px;
    border-radius: 99px;
    border: 1px solid #e0d6ff;
}
.status-pill {
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 8px;
    background: #e5f2ff;
    color: #0055cc;
}

.project-title-large {
    font-family: 'Fredoka', sans-serif;
    font-size: 30px;
    color: var(--ink);
    margin-bottom: 18px;
    line-height: 1.3;
}

.creator-card {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #f8f9ff;
    border: 1.5px solid #e0e3fa;
    border-radius: 14px;
    padding: 16px 20px;
    margin-bottom: 24px;
}
.creator-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #2b3a8f, #7b6cf6);
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.section-label {
    font-size: 13px;
    font-weight: 700;
    color: #7b6cf6;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 8px;
}

.project-content-text {
    font-size: 15px;
    color: #3b4676;
    line-height: 1.7;
    white-space: pre-line;
    margin-bottom: 24px;
}

.skills-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 28px;
}
.skill-item {
    font-weight: 700;
    font-size: 13px;
    padding: 6px 14px;
    border-radius: 10px;
    background: #f4f6ff;
    color: #2b3a8f;
    border: 1.5px solid #d6d9fb;
}

/* Tab Filter Posisi untuk Daftar Kandidat (AD-06 Revisi) */
.candidate-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
    padding-bottom: 14px;
    border-bottom: 1.5px solid #f0f2ff;
    flex-wrap: wrap;
    gap: 12px;
}
.candidate-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 22px;
    color: var(--ink);
}

.filter-posisi-bar {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 4px;
    margin-bottom: 18px;
}
.pos-filter-chip {
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 13px;
    font-weight: 700;
    background: #f4f6ff;
    color: var(--mute);
    border: 1.5px solid #e0e3fa;
    white-space: nowrap;
    transition: all .2s;
}
.pos-filter-chip.active {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 12px -2px rgba(123,108,246,.5);
}

/* Candidate Card (AD-06 & AD-07) */
.candidate-item-card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 16px;
    transition: transform .2s, border-color .2s;
    box-shadow: 0 4px 16px -6px rgba(80,70,200,.1);
}
.candidate-item-card:hover {
    border-color: #7b6cf6;
    transform: translateY(-2px);
}

.candidate-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}
.cand-name {
    font-family: 'Fredoka', sans-serif;
    font-size: 18px;
    color: var(--ink);
}
.cand-role-pill {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 700;
    background: #edf0ff;
    color: #2b3a8f;
    margin-top: 4px;
}

/* Badge Skor Kesesuaian Skill */
.score-badge {
    padding: 6px 12px;
    border-radius: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.score-high { background: #e5ffe8; color: #008736; border: 1px solid #b5f0be; }
.score-mid { background: #fff8e5; color: #b37400; border: 1px solid #ffe199; }
.score-low { background: #f4f6ff; color: #4b5686; border: 1px solid #d6d9fb; }

.cand-meta {
    font-size: 13.5px;
    color: var(--mute);
    margin-bottom: 12px;
    line-height: 1.5;
}

.cand-skills-row {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 14px;
}
.matched-skill-tag {
    font-size: 11.5px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 6px;
    background: #eef2ff;
    color: #4b5ce8;
    border: 1px solid #d2dbfa;
}

/* Actions Accept / Reject (AD-07) */
.action-decision-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 1px solid #f0f2ff;
    gap: 10px;
}
.btn-action {
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 13.5px;
    cursor: pointer;
    border: none;
    font-family: 'Nunito', sans-serif;
    transition: .15s;
}
.btn-accept { background: #00a651; color: #fff; }
.btn-accept:hover { background: #008f45; }
.btn-reject { background: #fff0f3; color: #d80044; border: 1px solid #ffd1dc; }
.btn-reject:hover { background: #ffd9e2; }

/* Status Banner */
.badge-status {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}
.badge-status.Diterima { background: #e5ffe8; color: #008736; }
.badge-status.Ditolak { background: #ffe8ec; color: #d80044; }
.badge-status.Pending { background: #fff8e5; color: #b37400; }

@media(max-width: 992px) {
    .detail-grid { grid-template-columns: 1fr; }
    .main-content { margin-left: 0; padding: 20px; }
    .sidebar { display: none; }
}
</style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a class="brand" href="/" aria-label="SkillConnect">
                <svg viewBox="0 0 64 32" fill="none">
                  <defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
                  <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/>
                </svg>
                <span>SKILL CONNECT</span>
            </a>
        </div>
        <nav class="sidebar-nav">
            <a href="/dashboard" class="nav-item">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="/pengguna" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pengguna
                </a>
                <a href="/proyek" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
            @else
                <a href="{{ route('profile.skill') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil & Skill
                </a>
                <a href="{{ route('proyek') }}" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Cari Proyek
                </a>
                <a href="{{ route('proyek.create') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Buat Proyek
                </a>
                <a href="{{ route('proyek.riwayat') }}" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Portofolio & Fee
                </a>
            @endif
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="top-breadcrumb">
                SkillConnect / <a href="{{ route('proyek') }}">Proyek</a> / <span>Detail & Kelola Kandidat</span>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Tamu' }}</div>
                    <div class="role">{{ auth()->check() ? ucfirst(auth()->user()->role) : 'Guest' }}</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        <!-- FLASH NOTIFICATION -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                <span>{{ session('error') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <div class="detail-grid">

            <!-- KOLOM KIRI: DETAIL PROYEK & ANGGOTA AKTIF -->
            <div class="card">
                <div class="project-hero-badge">
                    <span class="category-pill">{{ $project->kategori }}</span>
                    <span class="status-pill">{{ $project->status_project }}</span>
                </div>

                <h1 class="project-title-large">{{ $project->judul_project }}</h1>

                <div class="creator-card">
                    <div class="creator-avatar">{{ substr($project->creator->name ?? 'C', 0, 1) }}</div>
                    <div>
                        <div style="font-size: 11.5px; font-weight: 700; color: #7b6cf6; text-transform: uppercase;">Creator Proyek</div>
                        <div style="font-weight: 700; color: var(--ink); font-size: 16px;">{{ $project->creator->name ?? 'Anonim' }}</div>
                        <div style="font-size: 13px; color: var(--mute);">{{ $project->creator->email ?? '' }}</div>
                    </div>
                </div>

                <div class="section-label">Deskripsi Proyek</div>
                <div class="project-content-text">{{ $project->deskripsi }}</div>

                <div class="section-label">Kebutuhan Skill Posisi</div>
                <div class="skills-wrapper">
                    @forelse($project->skills as $sk)
                        <span class="skill-item">{{ $sk->nama_skill }}</span>
                    @empty
                        <span style="color: #9aa2cc; font-style: italic;">Skill Terbuka</span>
                    @endforelse
                </div>

                <!-- ANGGOTA TIM RESMI YANG DITERIMA (ACCEPTED) -->
                <div class="section-label" style="margin-top: 10px;">Anggota Tim Resmi ({{ $acceptedMembers->count() }})</div>
                <div style="margin-top: 8px;">
                    @forelse($acceptedMembers as $mem)
                        <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: #f8f9ff; border: 1px solid #edf0ff; border-radius: 12px; margin-bottom: 8px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 34px; height: 34px; border-radius: 50%; background: #00a651; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">
                                    {{ substr($mem->name, 0, 1) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; font-size: 14.5px; color: var(--ink);">{{ $mem->name }}</div>
                                    <div style="font-size: 12px; color: var(--mute);">Peran: {{ $mem->peran }}</div>
                                </div>
                            </div>
                            <span class="badge-status Diterima">Aktif di Tim</span>
                        </div>
                    @empty
                        <p style="color: #9aa2cc; font-size: 13.5px; font-style: italic;">Belum ada anggota yang diterima.</p>
                    @endforelse
                </div>

                {{-- Link ke Task Board (MOD-08) --}}
                @if(auth()->check())
                    @php
                        $isTeamMember = $acceptedMembers->contains(function ($m) {
                            return $m->user_id == auth()->id();
                        });
                    @endphp
                    @if($isTeamMember || auth()->id() === $project->creator_id || (auth()->user() && auth()->user()->role === 'admin'))
                        <div style="margin-top: 20px;">
                            <a href="{{ route('proyek.tasks', $project->id) }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; background: linear-gradient(90deg, #2b3a8f, #7b6cf6); color: #fff; box-shadow: 0 6px 18px -4px rgba(123,108,246,.5); transition: all .2s;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                Buka Task Board
                            </a>
                        </div>
                    @endif
                @endif
            </div>

            <!-- KOLOM KANAN: DAFTAR KANDIDAT / FORM LAMARAN -->
            <div>
                @if(auth()->check() && (auth()->id() === $project->creator_id || auth()->user()->role === 'admin'))
                    <!-- TAMPILAN KHUSUS CREATOR: DAFTAR KANDIDAT (REVISI AD-06 & AD-07) -->
                    <div class="card">
                        <div class="candidate-header">
                            <div>
                                <h2 class="candidate-title">Daftar Kandidat</h2>
                                <p style="font-size: 13px; color: var(--mute); margin-top: 2px;">
                                    @if(!empty($selectedPosition) && $selectedPosition !== 'Semua')
                                        Filter: <strong>{{ $selectedPosition }}</strong> &bull; Diurutkan berdasarkan skor kecocokan skill (Exact Match).
                                    @else
                                        Sebelum filter posisi diklik, kandidat diurutkan berdasarkan pendaftar terbaru (*new*).
                                    @endif
                                </p>
                            </div>
                            <span style="font-size: 13px; font-weight: 700; color: #7b6cf6; background: #f1edff; padding: 4px 10px; border-radius: 8px;">
                                Total: {{ $candidates->count() }} Pelamar
                            </span>
                        </div>

                        <!-- FILTER BERDASARKAN POSISI (SESUAI CATATAN REVISI & PROPOSAL) -->
                        <div class="filter-posisi-bar">
                            <a href="{{ route('proyek.detail', $project->id) }}" class="pos-filter-chip {{ empty($selectedPosition) || $selectedPosition === 'Semua' ? 'active' : '' }}">
                                Semua Posisi (New Default)
                            </a>
                            @foreach($availablePositions as $pos)
                                <a href="{{ route('proyek.detail', ['id' => $project->id, 'posisi' => $pos]) }}" class="pos-filter-chip {{ $selectedPosition === $pos ? 'active' : '' }}">
                                    Posisi: {{ $pos }}
                                </a>
                            @endforeach
                        </div>

                        <!-- LIST KANDIDAT -->
                        @forelse($candidates as $cand)
                            <div class="candidate-item-card">
                                <div class="candidate-top">
                                    <div>
                                        <div class="cand-name">{{ $cand->candidate_name }}</div>
                                        <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-top: 4px;">
                                            <span class="cand-role-pill">Melamar: {{ $cand->peran }}</span>
                                            <span style="font-size: 12px; font-weight: 700; color: #4338ca; background: #eef2ff; padding: 2px 8px; border-radius: 6px; border: 1px solid #dbe4ff;">
                                                {{ $cand->match_summary ?? 'Cocok 0 Skill' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="score-badge {{ $cand->match_score >= 70 ? 'score-high' : ($cand->match_score >= 40 ? 'score-mid' : 'score-low') }}">
                                        {{ $cand->match_score }}% Cocok
                                    </div>
                                </div>

                                <div class="cand-meta">
                                    <strong>Ekspektasi Fee:</strong> Rp {{ number_format($cand->nominal_fee, 0, ',', '.') }}<br>
                                    <strong>Mendaftar:</strong> {{ \Carbon\Carbon::parse($cand->applied_at)->diffForHumans() }}
                                </div>

                                <!-- Skill yang Cocok dengan Proyek (Exact Match) -->
                                <div class="cand-skills-row">
                                    <span style="font-size: 12px; color: var(--mute); font-weight: 600; align-self: center; margin-right: 4px;">Skill Cocok:</span>
                                    @forelse($cand->matching_skills as $ms)
                                        <span class="matched-skill-tag">{{ $ms }}</span>
                                    @empty
                                        <span style="font-size: 12px; color: #9aa2cc; font-style: italic;">Belum ada skill yang cocok dengan kriteria proyek</span>
                                    @endforelse
                                </div>

                                @if(!empty($cand->missing_skills) && count($cand->missing_skills) > 0 && $cand->matching_count > 0)
                                    <div style="margin-bottom: 12px; font-size: 12px; color: #8892b0;">
                                        <span style="font-weight: 600;">Skill Belum Ada:</span> {{ implode(', ', $cand->missing_skills) }}
                                    </div>
                                @endif

                                <!-- Tautan Bukti Portofolio Pelamar -->
                                @if($cand->candidate_portofolio)
                                    <div style="margin-bottom: 14px;">
                                        <a href="{{ $cand->candidate_portofolio }}" target="_blank" rel="noopener noreferrer" style="font-size: 13px; font-weight: 700; color: #2b3a8f; text-decoration: underline; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                            Lihat Bukti Portofolio
                                        </a>
                                    </div>
                                @endif

                                {{-- Tombol Download CV Pelamar --}}
                                @if(!empty($cand->cv_path))
                                    <div style="margin-bottom: 14px;">
                                        <a href="{{ asset('storage/' . $cand->cv_path) }}" target="_blank" rel="noopener noreferrer" style="font-size: 13px; font-weight: 700; color: #e0244d; text-decoration: underline; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Unduh CV Pelamar (PDF)
                                        </a>
                                    </div>
                                @endif

                                <!-- AKSI AD-07: TERIMA ATAU TOLAK PELAMAR -->
                                <div class="action-decision-bar">
                                    <div>
                                        Status: <span class="badge-status {{ $cand->status_keanggotaan }}">{{ $cand->status_keanggotaan }}</span>
                                    </div>
                                    @if($cand->status_keanggotaan === 'Pending')
                                        <div style="display: flex; gap: 8px;">
                                            <form action="{{ route('proyek.kandidat.status', [$project->id, $cand->application_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="action" value="tolak">
                                                <button type="submit" class="btn-action btn-reject" onclick="return confirm('Tolak lamaran kandidat ini?')">Tolak</button>
                                            </form>
                                            <form action="{{ route('proyek.kandidat.status', [$project->id, $cand->application_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="action" value="terima">
                                                <button type="submit" class="btn-action btn-accept" onclick="return confirm('Terima kandidat ini ke dalam tim?')">Terima</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px 20px; color: #9aa2cc;">
                                <p style="font-size: 15px;">Belum ada kandidat yang melamar untuk posisi ini.</p>
                            </div>
                        @endforelse
                    </div>

                @else
                    <!-- TAMPILAN KHUSUS MEMBER: FORM PENGAJUAN / STATUS LAMARAN -->
                    @if($myApplication)
                        <div class="card" style="border: 2px solid #7b6cf6;">
                            <h3 style="font-family: 'Fredoka', sans-serif; font-size: 20px; color: var(--ink); margin-bottom: 8px;">
                                Status Lamaran Anda
                            </h3>
                            <p style="font-size: 14px; color: var(--mute); margin-bottom: 16px;">
                                Anda telah mengajukan lamaran untuk posisi <strong>{{ $myApplication->peran }}</strong>.
                            </p>
                            <div style="background: #f8f9ff; padding: 16px; border-radius: 12px; border: 1px solid #e0e3fa;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-weight: 700; color: var(--ink);">Status Lamaran:</span>
                                    <span class="badge-status {{ $myApplication->status_keanggotaan }}">{{ $myApplication->status_keanggotaan }}</span>
                                </div>
                                <div style="margin-top: 10px; font-size: 13.5px; color: var(--mute);">
                                    Ekspektasi Fee Diajukan: <strong style="color: #2b3a8f;">Rp {{ number_format($myApplication->nominal_fee, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- FORM AJUKAN LAMARAN -->
                        <div class="card">
                            <h3 style="font-family: 'Fredoka', sans-serif; font-size: 22px; color: var(--ink); margin-bottom: 6px;">
                                Ajukan Lamaran ke Proyek
                            </h3>
                            <p style="font-size: 13.5px; color: var(--mute); margin-bottom: 20px;">
                                Tentukan posisi yang ingin Anda isi dan ajukan ekspektasi fee Anda.
                            </p>

                            <form action="{{ route('proyek.apply', $project->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="margin-bottom: 16px;">
                                    <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 6px;">Posisi / Peran <span style="color: #e0244d;">*</span></label>
                                    <input type="text" name="peran" required class="form-control" placeholder="Contoh: Frontend Developer, UI Designer" style="width: 100%; padding: 12px 16px; border: 1.5px solid var(--line); border-radius: 12px; outline: none;">
                                </div>

                                <div style="margin-bottom: 16px;">
                                    <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 6px;">Ekspektasi Fee (Rp) <span style="color: #e0244d;">*</span></label>
                                    <input type="number" name="nominal_fee" required min="0" value="{{ $project->budget }}" style="width: 100%; padding: 12px 16px; border: 1.5px solid var(--line); border-radius: 12px; outline: none;">
                                </div>

                                <div style="margin-bottom: 16px;">
                                    <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 6px;">Upload CV <span style="color: #e0244d;">*</span></label>
                                    <div style="position: relative; border: 2px dashed #c8ccee; border-radius: 12px; padding: 16px 20px; background: #f8f9ff; cursor: pointer; transition: border-color .2s;" onclick="document.getElementById('cv_file_input').click()">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <svg width="32" height="32" fill="none" stroke="#7b6cf6" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <div>
                                                <p id="cv_file_label" style="font-size: 14px; font-weight: 600; color: #2b3a8f; margin: 0;">Klik untuk pilih file CV</p>
                                                <p style="font-size: 12px; color: #9aa2cc; margin: 2px 0 0;">Format: PDF saja &bull; Maks. 2MB</p>
                                            </div>
                                        </div>
                                        <input type="file" id="cv_file_input" name="cv_file" accept=".pdf" required style="display: none;" onchange="document.getElementById('cv_file_label').textContent = this.files[0] ? this.files[0].name : 'Klik untuk pilih file CV'">
                                    </div>
                                    @error('cv_file')
                                        <p style="color: #e0244d; font-size: 12px; margin-top: 6px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 6px;">Pesan / Catatan Tambahan</label>
                                    <textarea name="pesan" style="width: 100%; min-height: 80px; padding: 12px 16px; border: 1.5px solid var(--line); border-radius: 12px; outline: none;" placeholder="Ceritakan kesiapan Anda..."></textarea>
                                </div>

                                <button type="submit" style="width: 100%; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 15px; border: none; background: linear-gradient(90deg, #2b3a8f, #7b6cf6); color: #fff; cursor: pointer; box-shadow: 0 8px 22px -6px rgba(123,108,246,.7);">
                                    Kirim Lamaran Sekarang
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

        </div>

    </main>

</body>
</html>
