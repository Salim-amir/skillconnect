<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard Member - SkillConnect</title>
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
    background: linear-gradient(135deg, #2b3a8f, #7b6cf6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 18px;
    box-shadow: 0 4px 12px rgba(123,108,246,.35);
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
    background: rgba(43,58,143,0.1);
    color: #2b3a8f;
    font-weight: 700;
    margin-top: 3px;
}

/* Welcome Banner */
.welcome-banner {
    background: linear-gradient(135deg, #1e295f 0%, #2b3a8f 55%, #6355d8 100%);
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
    background: radial-gradient(circle, rgba(194, 107, 240, 0.3) 0%, transparent 70%);
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
.btn-banner {
    padding: 10px 20px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    background: #fff;
    color: #1c2766;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}
.btn-banner:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.18);
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
.stat-val.currency {
    font-size: 20px;
    color: #166534;
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

/* Skills pill tags */
.skill-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.skill-pill {
    padding: 6px 12px;
    border-radius: 20px;
    background: #eef2ff;
    color: #2b3a8f;
    font-size: 12.5px;
    font-weight: 700;
    border: 1px solid #dbe2ff;
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
                <h1 class="page-title">Dashboard Member</h1>
                <p style="font-size: 13.5px; color: #64748b; margin-top: 4px;">Pantau tugas, proyek aktif, dan status lamaran kolaborasimu.</p>
            </div>
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->user()->name }}</div>
                    <span class="role-badge">Member</span>
                </div>
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
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
                    <div class="stat-label">Proyek Aktif Diikuti</div>
                    <div class="stat-val">{{ $myActiveProjectsCount }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Tugas Belum Selesai</div>
                    <div class="stat-val">{{ $totalMyTasksCount }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Proyek Diselesaikan</div>
                    <div class="stat-val">{{ $myCompletedProjectsCount }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #dcfce7; color: #166534;">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Estimasi Fee Diterima</div>
                    <div class="stat-val currency">Rp {{ number_format($totalEarned, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        <!-- ROW 1 CONTENT: TASKS & RECOMMENDED PROJECTS -->
        <div class="grid-content">
            <!-- Tugas Mendekati Deadline -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tugas Saya (Mendekati Deadline)
                    </h3>
                </div>

                @if($myPendingTasks->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Hebat! Tidak ada tugas yang tertunda atau mendekati deadline.
                    </div>
                @else
                    <div class="task-list">
                        @foreach($myPendingTasks as $task)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $task->nama_task }}</h4>
                                    <p>Proyek: <b>{{ $task->project->judul_project ?? 'Proyek' }}</b> &bull; Deadline: {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M Y') : 'Tanpa batas' }}</p>
                                </div>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <span class="badge {{ $task->status_task === 'Revisi' ? 'danger' : 'warning' }}">{{ $task->status_task }}</span>
                                    <a href="{{ route('proyek.tasks', $task->project_id) }}" class="btn-sm pri">Buka Task</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Rekomendasi Proyek Berdasarkan Skill -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Rekomendasi Proyek
                    </h3>
                    <a href="{{ route('proyek') }}" class="card-link">Lihat Semua</a>
                </div>

                @if($recommendedProjects->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Belum ada rekomendasi proyek baru yang cocok dengan keahlianmu.
                    </div>
                @else
                    <div class="project-list">
                        @foreach($recommendedProjects as $proj)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $proj->judul_project }}</h4>
                                    <p>Budget: <b>Rp {{ number_format($proj->budget ?? 0, 0, ',', '.') }}</b> &bull; Kategori: {{ $proj->kategori }}</p>
                                </div>
                                <a href="{{ route('proyek.detail', $proj->id) }}" class="btn-sm ghost">Detail</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- ROW 2 CONTENT: APPLICATIONS & SKILLS OVERVIEW -->
        <div class="grid-content">
            <!-- Status Pendaftaran / Lamaran -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Status Lamaran Proyek
                    </h3>
                </div>

                @if($myApplications->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Kamu belum melamar ke proyek manapun.
                    </div>
                @else
                    <div class="application-list">
                        @foreach($myApplications as $app)
                            <div class="list-item">
                                <div class="task-info">
                                    <h4>{{ $app->judul_project }}</h4>
                                    <p>Peran: <b>{{ $app->peran ?? 'Anggota Tim' }}</b> &bull; Diajukan: {{ \Carbon\Carbon::parse($app->created_at)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    @if($app->status_keanggotaan === 'Diterima')
                                        <span class="badge success">Diterima</span>
                                    @elseif($app->status_keanggotaan === 'Menunggu')
                                        <span class="badge warning">Menunggu Review</span>
                                    @else
                                        <span class="badge danger">{{ $app->status_keanggotaan }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Keahlian & Profil Singkat -->
            <div class="card">
                <div class="card-header-row">
                    <h3 class="card-title">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Keahlian Terdaftar
                    </h3>
                    <a href="{{ route('profile.skill') }}" class="card-link">Kelola Skill</a>
                </div>

                @if($mySkills->isEmpty())
                    <div class="empty-state">
                        <svg fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Belum ada skill yang ditambahkan. Tambahkan skill agar Creator dapat menemukanmu!
                    </div>
                @else
                    <div class="skill-tags" style="margin-top: 10px;">
                        @foreach($mySkills as $skill)
                            <span class="skill-pill">
                                {{ $skill->nama_skill }}
                                @if(isset($skill->pivot->tingkat_keahlian))
                                    &bull; <small style="opacity:.8;">{{ $skill->pivot->tingkat_keahlian }}</small>
                                @endif
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

</body>
</html>
