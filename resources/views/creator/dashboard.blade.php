<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard Creator - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #1c2766;
    --mute: #586586;
    --line: #e2e6fa;
    --primary: #2b3a8f;
    --secondary: #7b6cf6;
    --accent: #c26bf0;
    box-sizing: border-box;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
    background: linear-gradient(180deg, #eef0ff, #f6f3ff 50%, #edf2ff);
    color: var(--ink);
    font-family: 'Nunito', system-ui, sans-serif;
    line-height: 1.6;
    overflow-x: hidden;
    display: flex;
    min-height: 100vh;
}

a { color: inherit; text-decoration: none; }
button { font-family: inherit; }

/* ===== SIDEBAR ===== */
.sidebar {
    width: 280px;
    background: #fff;
    border-right: 1.5px solid #e0e3fa;
    display: flex;
    flex-direction: column;
    position: fixed;
    height: 100vh;
    z-index: 100;
}

.sidebar-header {
    padding: 28px 24px;
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
    padding: 22px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
    overflow-y: auto;
}

.nav-label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #8d98c2;
    padding: 10px 14px 4px;
}

.nav-item {
    padding: 13px 18px;
    border-radius: 12px;
    font-weight: 600;
    color: #4b5686;
    font-size: 14.5px;
    transition: all .2s;
    border: 1.5px solid transparent;
    display: flex;
    align-items: center;
    gap: 12px;
}

.nav-item svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.nav-item:hover {
    background: #f4f6ff;
    color: #1c2766;
}

.nav-item.active {
    background: linear-gradient(90deg, rgba(43,58,143,0.1), rgba(123,108,246,0.1));
    color: #2b3a8f;
    border-color: #d6d9fb;
    font-weight: 700;
}

.sidebar-footer {
    padding: 18px 16px;
    border-top: 1.5px solid #f0f2ff;
    margin-top: auto;
}

.btn-logout {
    width: 100%;
    padding: 11px;
    background: #fff;
    border: 1.5px solid #fecdd3;
    color: #e11d48;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-logout:hover {
    background: #ffe4e6;
    border-color: #fda4af;
}

/* ===== MAIN CONTENT ===== */
.main-content {
    flex: 1;
    margin-left: 280px;
    padding: 30px 40px 60px;
    display: flex;
    flex-direction: column;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 26px;
    color: #1c2766;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #7b6cf6, #c26bf0);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(194,107,240,.35);
    border: 2px solid #fff;
}

.user-info {
    text-align: right;
}
.user-info .name {
    font-weight: 700;
    color: #1c2766;
    font-size: 14.5px;
    line-height: 1.2;
}
.user-info .role-badge {
    display: inline-block;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 20px;
    background: rgba(123,108,246,0.14);
    color: #5b21b6;
    font-weight: 700;
    margin-top: 3px;
}

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, #1e295f 0%, #2b3a8f 55%, #7b6cf6 100%);
    color: #fff;
    border-radius: 20px;
    padding: 28px 32px;
    margin-bottom: 24px;
    box-shadow: 0 16px 36px -12px rgba(43, 58, 143, 0.4);
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    overflow: hidden;
}
.welcome-banner::after {
    content: '';
    position: absolute;
    right: -20px;
    top: -40px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(194, 107, 240, 0.35) 0%, transparent 70%);
    border-radius: 50%;
}
.welcome-text h2 {
    font-family: 'Fredoka', sans-serif;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 6px;
}
.welcome-text p {
    font-size: 14px;
    color: #dbe2ff;
    max-width: 580px;
    line-height: 1.5;
}
.welcome-actions {
    display: flex;
    gap: 12px;
    z-index: 1;
}
.btn-banner-pri {
    padding: 11px 22px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    background: #fff;
    color: #1c2766;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}
.btn-banner-pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

/* 4 STATS CARDS */
.grid-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 24px;
}
@media (max-width: 1100px) {
    .grid-stats { grid-template-columns: repeat(2, 1fr); }
}

.stat-card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 18px;
    padding: 20px 22px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.15);
    transition: transform .2s, box-shadow .2s;
    display: flex;
    align-items: center;
    gap: 16px;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 36px -20px rgba(80,70,200,.3);
}
.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: #eef2ff;
    color: #2b3a8f;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.stat-icon svg { width: 24px; height: 24px; }
.stat-info { flex: 1; min-width: 0; }
.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    margin-bottom: 4px;
}
.stat-val {
    font-family: 'Fredoka', sans-serif;
    font-size: 26px;
    font-weight: 700;
    color: #1c2766;
    line-height: 1.1;
}

/* CONTENT GRIDS */
.grid-content {
    display: grid;
    grid-template-columns: 1.25fr 1fr;
    gap: 24px;
    margin-bottom: 24px;
}
@media (max-width: 1000px) {
    .grid-content { grid-template-columns: 1fr; }
}

.card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.15);
}
.card-header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}
.card-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #1c2766;
    display: flex;
    align-items: center;
    gap: 8px;
}
.card-title svg { width: 20px; height: 20px; color: #7b6cf6; }
.card-link {
    font-size: 13px;
    font-weight: 700;
    color: #2b3a8f;
    text-decoration: underline;
}

/* Lists */
.list-item {
    padding: 14px 16px;
    border-radius: 14px;
    background: #f8faff;
    border: 1px solid #edf0ff;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all .2s;
}
.list-item:hover {
    background: #f1f4ff;
    border-color: #dbe2ff;
}
.list-item:last-child { margin-bottom: 0; }

.task-info h4 {
    color: #1c2766;
    font-size: 14.5px;
    font-weight: 700;
    margin-bottom: 3px;
}
.task-info p {
    color: #64748b;
    font-size: 12.5px;
}

.badge {
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}
.badge.danger { background: #fee2e2; color: #991b1b; }
.badge.success { background: #dcfce7; color: #166534; }
.badge.warning { background: #fef3c7; color: #92400e; }
.badge.info { background: #e0e7ff; color: #3730a3; }

.btn-sm {
    padding: 7px 14px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 12.5px;
    cursor: pointer;
    border: 1px solid transparent;
    transition: .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-sm.pri {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
}
.btn-sm.pri:hover {
    box-shadow: 0 4px 12px rgba(123,108,246,.35);
}
.btn-sm.ghost {
    background: #fff;
    border-color: #d6d9fb;
    color: #2b3a8f;
}
.btn-sm.ghost:hover {
    background: #f0f2ff;
}

.empty-state {
    padding: 32px 16px;
    text-align: center;
    color: #8d98c2;
    font-size: 13.5px;
    font-weight: 600;
}
.empty-state svg {
    width: 36px;
    height: 36px;
    margin: 0 auto 10px;
    display: block;
    color: #b0baeb;
}

/* Quick Guide Steps */
.step-card {
    padding: 14px;
    border-radius: 12px;
    background: #f8faff;
    border: 1px solid #edf0ff;
    margin-bottom: 10px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}
.step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #2b3a8f;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.step-content h4 {
    font-size: 13.5px;
    font-weight: 700;
    color: #1c2766;
    margin-bottom: 2px;
}
.step-content p {
    font-size: 12px;
    color: #64748b;
    line-height: 1.4;
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
            <div>
                <h1 class="page-title">Dashboard Creator</h1>
                <p style="font-size: 13.5px; color: #64748b; margin-top: 4px;">Kelola proyek, seleksi talenta pelamar, dan pantau progres tim.</p>
            </div>
            <div style="display: flex; align-items: center; gap: 16px;">
                <a href="{{ route('proyek.create') }}" class="btn-sm pri" style="padding: 10px 18px; border-radius: 12px; font-size: 13.5px; text-decoration: none;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Buat Proyek Baru
                </a>
                <div class="user-profile">
                    <div class="user-info">
                        <div class="name">{{ auth()->user()->name }}</div>
                        <span class="role-badge">Creator</span>
                    </div>
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                </div>
            </div>
        </header>

        <!-- FLASH NOTIFICATION -->
        @if(session('success'))
            <div style="background: #dcfce7; border: 1px solid #bbf7d0; color: #166534; padding: 12px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div style="background: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 12px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 13.5px; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- 4 STATS CARDS -->
        <div class="grid-stats">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Total Proyek Saya</div>
                    <div class="stat-val">{{ $totalMyProjects }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #e0f2fe; color: #0284c7;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Proyek Sedang Berjalan</div>
                    <div class="stat-val">{{ $activeProjects }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: {{ $pendingApplicantsCount > 0 ? '#fee2e2' : '#fef3c7' }}; color: {{ $pendingApplicantsCount > 0 ? '#dc2626' : '#d97706' }};">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Pelamar Perlu Review</div>
                    <div class="stat-val" style="{{ $pendingApplicantsCount > 0 ? 'color: #dc2626;' : '' }}">{{ $pendingApplicantsCount }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Anggota Tim Aktif</div>
                    <div class="stat-val">{{ $totalTeamMembers }}</div>
                </div>
            </div>
        </div>

        <!-- ROW 1 CONTENT: RECENT APPLICANTS & MY PROJECTS -->
        <div class="grid-content">
            <!-- Pelamar Masuk Terbaru -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Lamaran Masuk Menunggu Review
                    </h3>
                </div>

                @if($recentApplicants->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Semua lamaran sudah direview! Belum ada lamaran baru yang masuk.
                    </div>
                @else
                    <div class="applicant-list">
                        @foreach($recentApplicants as $applicant)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $applicant->applicant_name }}</h4>
                                    <p>Proyek: <b>{{ $applicant->judul_project }}</b> &bull; Peran: {{ $applicant->peran ?? 'Anggota Tim' }}</p>
                                </div>
                                <a href="{{ route('proyek.detail', $applicant->project_id) }}" class="btn-sm pri">Review</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Proyek Saya -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        Proyek Aktif Saya
                    </h3>
                    <a href="{{ route('proyek') }}" class="card-link">Kelola Proyek</a>
                </div>

                @if($recentProjects->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        Anda belum memiliki proyek. Mulai dengan membuat proyek pertama Anda!
                    </div>
                @else
                    <div class="project-list">
                        @foreach($recentProjects as $proj)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $proj->judul_project }}</h4>
                                    <p>Budget: <b>Rp {{ number_format($proj->budget ?? 0, 0, ',', '.') }}</b> &bull; Status: <span class="badge {{ $proj->status_project === 'Selesai' ? 'success' : 'info' }}">{{ $proj->status_project }}</span></p>
                                </div>
                                <a href="{{ route('proyek.detail', $proj->id) }}" class="btn-sm ghost">Kelola</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- ROW 2 CONTENT: QUICK GUIDE & ACTION SHORTCUTS -->
        <div class="grid-content">
            <!-- Panduan Pengelolaan Proyek -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Alur Kerja Efektif Creator
                    </h3>
                </div>

                <div class="step-card">
                    <div class="step-num">1</div>
                    <div class="step-content">
                        <h4>Buat Proyek dengan Kebutuhan Skill Jelas</h4>
                        <p>Tentukan deskripsi proyek, kategori, anggaran, dan skill yang dibutuhkan agar algoritma Skill Matching dapat merekomendasikan talenta yang tepat.</p>
                    </div>
                </div>

                <div class="step-card">
                    <div class="step-num">2</div>
                    <div class="step-content">
                        <h4>Seleksi Pelamar Berdasarkan Profil & Portofolio</h4>
                        <p>Tinjau skor kecocokan skill kandidat, evaluasi pengalaman sebelumnya, lalu terima talenta terbaik ke dalam tim Anda.</p>
                    </div>
                </div>

                <div class="step-card" style="margin-bottom: 0;">
                    <div class="step-num">3</div>
                    <div class="step-content">
                        <h4>Bagi Tugas di Task Board & Pantau Bukti Kerja</h4>
                        <p>Tetapkan tugas, tentukan tenggat waktu (deadline), dan verifikasi bukti hasil kerja sebelum memberikan nilai evaluasi.</p>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat / Pintasan -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Aksi Cepat
                    </h3>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('proyek.create') }}" class="btn-sm pri" style="padding: 12px 18px; justify-content: center; font-size: 14px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        Buat Proyek Baru Sekarang
                    </a>

                    <a href="{{ route('proyek') }}" class="btn-sm ghost" style="padding: 12px 18px; justify-content: center; font-size: 14px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        Lihat Semua Proyek Saya
                    </a>

                    <a href="{{ route('proyek.riwayat') }}" class="btn-sm ghost" style="padding: 12px 18px; justify-content: center; font-size: 14px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Kelola Pembayaran & Fee
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
