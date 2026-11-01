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

    <!-- SHARED UNIFIED SIDEBAR -->
    @include('shared.sidebar')

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="top-breadcrumb">
                SkillConnect / <a href="{{ route('proyek') }}">Proyek</a> / <span>{{ auth()->check() && (auth()->user()->role === 'creator' || auth()->user()->role === 'admin') ? 'Detail & Kelola Kandidat' : 'Detail Proyek' }}</span>
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

                {{-- KOTAK INFORMASI DANA & STATUS PEMBAYARAN PROYEK (OPSI A: FULL ESCROW) --}}
                <div style="margin-top: 24px; padding: 20px 22px; background: #ffffff; border: 1.5px solid var(--line); border-radius: 16px; box-shadow: 0 4px 14px -6px rgba(80,70,200,.08);">
                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
                        <div>
                            <div style="font-size: 11.5px; font-weight: 800; color: var(--mute); text-transform: uppercase; letter-spacing: .06em;">Budget / Dana Rekening Bersama (Escrow)</div>
                            <div style="font-size: 24px; font-weight: 800; font-family: 'Fredoka', sans-serif; color: var(--ink);">
                                Rp {{ number_format($project->budget, 0, ',', '.') }}
                            </div>
                            <div style="margin-top: 6px;">
                                @if($isPaid)
                                    <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 800; color: #065f46; background: #d1fae5; padding: 5px 14px; border-radius: 20px; border: 1px solid #6ee7b7;">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                        Dana Terjamin (100% Lunas di Rekening Bersama)
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 800; color: #92400e; background: #fef3c7; padding: 5px 14px; border-radius: 20px; border: 1px solid #fcd34d;">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Menunggu Pendanaan Escrow Creator
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Tombol Bayar Sekarang khusus Creator / Admin --}}
                        @if(auth()->check() && ((auth()->user()->role === 'creator' && auth()->id() === $project->creator_id) || auth()->user()->role === 'admin'))
                            @if(!$isPaid)
                                <button id="btnBayarSekarang" onclick="bayarProyek()" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 14.5px; border: none; background: linear-gradient(90deg, #10b981, #059669); color: #fff; cursor: pointer; font-family: 'Nunito', sans-serif; box-shadow: 0 6px 18px -4px rgba(16,185,129,.6); transition: all .2s;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    Danai Proyek Sekarang
                                </button>
                            @else
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <span style="font-size: 12px; font-weight: 700; color: #047857; background: #e8f9ee; border: 1px solid #a7f3d0; padding: 8px 14px; border-radius: 10px;">
                                        ID Transaksi: {{ $latestPayment->order_id ?? '-' }}
                                    </span>
                                </div>
                            @endif
                        @endif
                    </div>

                    {{-- Informasi Skema Escrow Opsi A --}}
                    @if($isPaid)
                        <div style="margin-top: 14px; padding: 12px 16px; background: #f0fdf4; border-radius: 10px; border-left: 4px solid #10b981; font-size: 12.5px; color: #166534; line-height: 1.5; display: flex; align-items: flex-start; gap: 8px;">
                            <svg width="18" height="18" fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink: 0; margin-top: 1px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <div>
                                <strong>Skema Escrow Terjamin:</strong> Dana proyek sebesar <strong>Rp {{ number_format($project->budget, 0, ',', '.') }}</strong> telah dikunci di Rekening Bersama SkillConnect. Dana ini aman dan akan otomatis dicairkan ke masing-masing anggota tim setelah proyek diselesaikan dan dievaluasi.
                            </div>
                        </div>
                    @else
                        <div style="margin-top: 14px; padding: 12px 16px; background: #fffbeb; border-radius: 10px; border-left: 4px solid #f59e0b; font-size: 12.5px; color: #92400e; line-height: 1.5; display: flex; align-items: flex-start; gap: 8px;">
                            <svg width="18" height="18" fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink: 0; margin-top: 1px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <strong>Info Jaminan Proyek:</strong> Sebagai jaminan bagi para pencari kerja (Member), Creator mengunci 100% dana budget ke Rekening Bersama sistem. Proyek akan resmi berstatus <strong>Berjalan</strong> setelah dana disetorkan.
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Link ke Task Board (MOD-08) --}}
                @if(auth()->check())
                    @php
                        $isTeamMember = $acceptedMembers->contains(function ($m) {
                            return $m->user_id == auth()->id();
                        });
                    @endphp
                    @if($isTeamMember || (auth()->user() && auth()->user()->role === 'creator' && auth()->id() === $project->creator_id) || (auth()->user() && auth()->user()->role === 'admin'))
                        <div style="margin-top: 20px;">
                            @if($isPaid)
                                <a href="{{ route('proyek.tasks', $project->id) }}" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 700; font-size: 14px; background: linear-gradient(90deg, #2b3a8f, #7b6cf6); color: #fff; box-shadow: 0 6px 18px -4px rgba(123,108,246,.5); transition: all .2s;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                    Buka Task Board
                                </a>
                            @else
                                <div style="display: inline-flex; align-items: center; gap: 10px; padding: 12px 20px; border-radius: 12px; background: #f8fafc; border: 1.5px dashed #cbd5e1; color: #64748b; font-size: 13.5px; font-weight: 700;">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    <span>Task Board Terkunci — Menunggu Pendanaan Proyek (Escrow) oleh Creator</span>
                                </div>
                            @endif
                        </div>
                    @endif
                @endif
            </div>

            <!-- KOLOM KANAN: DAFTAR KANDIDAT / FORM LAMARAN -->
            <div>
                @php
                    $canManageCandidates = auth()->check() && (
                        (auth()->user()->role === 'creator' && auth()->id() === $project->creator_id) || 
                        auth()->user()->role === 'admin'
                    );
                @endphp
                @if($canManageCandidates)
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

                                {{-- Tombol Lihat CV Pelamar: prioritaskan cv_path dari lamaran, fallback ke cv profil user --}}
                                @php $cvUrl = !empty($cand->cv_path) ? $cand->cv_path : ($cand->candidate_cv_path ?? null); @endphp
                                @if($cvUrl)
                                    <div style="margin-bottom: 14px;">
                                        <a href="{{ $cvUrl }}" target="_blank" rel="noopener noreferrer" style="font-size: 13px; font-weight: 700; color: #e0244d; text-decoration: underline; display: inline-flex; align-items: center; gap: 4px;">
                                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                            Lihat CV Pelamar (Google Drive)
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
                                            <form id="formKandidatTolak{{ $cand->application_id }}" action="{{ route('proyek.kandidat.status', [$project->id, $cand->application_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="action" value="tolak">
                                                <button type="button" class="btn-action btn-reject" onclick="konfirmasiAksiKandidat({{ $cand->application_id }}, 'tolak', '{{ addslashes($cand->user->name ?? 'Kandidat') }}')">Tolak</button>
                                            </form>
                                            <form id="formKandidatTerima{{ $cand->application_id }}" action="{{ route('proyek.kandidat.status', [$project->id, $cand->application_id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="action" value="terima">
                                                <button type="button" class="btn-action btn-accept" onclick="konfirmasiAksiKandidat({{ $cand->application_id }}, 'terima', '{{ addslashes($cand->user->name ?? 'Kandidat') }}')">Terima</button>
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
                    {{-- TAMPILAN JIKA USER ADALAH CREATOR LAIN ATAU GUEST ATAU MEMBER --}}
                    @if(auth()->check() && auth()->user()->role === 'creator')
                        <div class="card" style="border: 1.5px solid var(--line); text-align: center; padding: 36px 24px;">
                            <div style="width: 56px; height: 56px; border-radius: 50%; background: #eef0ff; color: #7b6cf6; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                                <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <h3 style="font-family: 'Fredoka', sans-serif; font-size: 20px; color: var(--ink); margin-bottom: 6px;">
                                Mode Creator
                            </h3>
                            <p style="font-size: 13.5px; color: var(--mute); line-height: 1.6; max-width: 380px; margin: 0 auto;">
                                Anda masuk sebagai <strong>Creator</strong>. Pelamaran dan pengajuan diri untuk bergabung ke tim proyek hanya dikhususkan untuk akun dengan peran <strong>Member</strong>.
                            </p>
                        </div>
                    @elseif(!auth()->check())
                        <div class="card" style="border: 1.5px solid var(--line); text-align: center; padding: 36px 24px;">
                            <h3 style="font-family: 'Fredoka', sans-serif; font-size: 20px; color: var(--ink); margin-bottom: 8px;">
                                Ingin Bergabung ke Proyek Ini?
                            </h3>
                            <p style="font-size: 13.5px; color: var(--mute); margin-bottom: 20px;">
                                Silakan masuk sebagai <strong>Member</strong> untuk mengajukan proposal dan lamaran Anda.
                            </p>
                            <a href="{{ route('login') }}" class="btn pri" style="display: inline-block; padding: 10px 24px;">
                                Masuk untuk Melamar
                            </a>
                        </div>
                    @elseif($myApplication)
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

                            <form action="{{ route('proyek.apply', $project->id) }}" method="POST">
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
                                    <label style="display: block; font-weight: 700; font-size: 14px; margin-bottom: 6px;">Tautan CV (Google Drive) <span style="color: #e0244d;">*</span></label>
                                    <div style="display: flex; align-items: center; gap: 10px; background: #f8f9ff; border: 2px solid #c4c9f0; border-radius: 14px; padding: 14px 18px; transition: border-color .2s; focus-within:border-color:#7b6cf6;">
                                        <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                        <input type="url" name="cv_link" required
                                            style="border: none; outline: none; background: transparent; flex: 1; font-size: 14px; color: #1c2766;"
                                            placeholder="https://drive.google.com/file/d/..."
                                            value="{{ old('cv_link', auth()->user()->cv_path) }}">
                                    </div>
                                    <div style="display: flex; align-items: flex-start; gap: 8px; background: #fff8e1; border: 1.5px solid #ffe082; border-radius: 10px; padding: 10px 14px; margin-top: 10px; font-size: 13px; color: #795400;">
                                        <svg width="16" height="16" fill="none" stroke="#b45309" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"></path>
                                        </svg>
                                        <span><strong>Penting:</strong> Pastikan tautan Google Drive sudah diatur agar <strong>dapat diakses oleh semua orang</strong> (Anyone with the link → Viewer).</span>
                                    </div>
                                    @error('cv_link')
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

    {{-- Midtrans Snap JS --}}
    @php
        $snapUrl = config('midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp
    <script src="{{ $snapUrl }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    {{-- CUSTOM MODAL POPUP STATUS PEMBAYARAN ESCROW --}}
    <div id="modalPaymentCustom" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 24px; padding: 36px 28px; text-align: center; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: popModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div id="payModalIconWrap" style="width: 76px; height: 76px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: #fff; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.5);">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 id="payModalTitle" style="font-family: 'Fredoka', sans-serif; font-size: 23px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Pembayaran Berhasil!</h3>
            <p id="payModalDesc" style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 22px;">Dana proyek sebesar Rp {{ number_format($project->budget, 0, ',', '.') }} telah berhasil dikunci di Rekening Bersama SkillConnect (Escrow). Proyek kini aktif berjalan!</p>
            
            <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 14px 18px; margin-bottom: 24px;">
                <div style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px;">Total Dana Diamankan</div>
                <div style="font-family: 'Fredoka', sans-serif; font-size: 24px; font-weight: 800; color: #047857;">Rp {{ number_format($project->budget, 0, ',', '.') }}</div>
                <div id="payModalBadge" style="display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; color: #059669; font-weight: 700; margin-top: 4px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Status: 100% Escrow Terkunci
                </div>
            </div>

            <button type="button" onclick="window.location.reload()" style="width: 100%; padding: 14px 24px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; border: none; border-radius: 14px; font-weight: 800; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4); font-family: 'Nunito', sans-serif;">
                <span>Lanjutkan ke Proyek</span>
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>

    <script>
        function showCustomPaymentModal(title, desc, isSuccess = true) {
            const modal = document.getElementById('modalPaymentCustom');
            const modalTitle = document.getElementById('payModalTitle');
            const modalDesc = document.getElementById('payModalDesc');
            const iconWrap = document.getElementById('payModalIconWrap');
            const badge = document.getElementById('payModalBadge');

            if (modal && modalTitle && modalDesc && iconWrap) {
                modalTitle.textContent = title;
                modalDesc.textContent = desc;
                if (isSuccess) {
                    iconWrap.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                    iconWrap.style.boxShadow = '0 10px 25px -5px rgba(16, 185, 129, 0.5)';
                    iconWrap.innerHTML = '<svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
                    if (badge) badge.innerHTML = '<svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg> Status: 100% Escrow Terkunci';
                } else {
                    iconWrap.style.background = 'linear-gradient(135deg, #f59e0b, #d97706)';
                    iconWrap.style.boxShadow = '0 10px 25px -5px rgba(245, 158, 11, 0.5)';
                    iconWrap.innerHTML = '<svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    if (badge) badge.innerHTML = 'Status: Menunggu Pembayaran';
                }
                modal.style.display = 'flex';
            } else {
                alert(title + '\n\n' + desc);
                window.location.reload();
            }
        }

        function verifikasiPembayaran(orderId, resultData, isPending = false) {
            const btn = document.getElementById('btnBayarSekarang');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="animation: spin 1s linear infinite;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Memverifikasi Dana...';
            }

            fetch('{{ route("proyek.bayar.sync", $project->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    order_id: orderId,
                    result: resultData || {}
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.is_paid) {
                    showCustomPaymentModal('Pembayaran Berhasil!', 'Dana proyek sebesar Rp {{ number_format($project->budget, 0, ",", ".") }} telah berhasil dikunci di Rekening Bersama SkillConnect (Escrow). Proyek kini resmi berstatus BERJALAN dan Task Board telah terbuka!', true);
                } else if (isPending) {
                    showCustomPaymentModal('Menunggu Pembayaran', 'Tagihan telah diterbitkan. Silakan selesaikan pembayaran di simulator / bank Anda. Halaman akan otomatis memverifikasi saat ditutup.', false);
                } else {
                    window.location.reload();
                }
            })
            .catch(err => {
                console.error(err);
                window.location.reload();
            });
        }

        function bayarProyek() {
            const btn = document.getElementById('btnBayarSekarang');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="animation: spin 1s linear infinite;"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 018-8v8H4z"></path></svg> Memproses...';
            }

            fetch('{{ route("proyek.bayar", $project->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message || 'Gagal memulai pembayaran.');
                    if (btn) {
                        btn.disabled = false;
                        btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg> Danai Proyek Sekarang';
                    }
                    return;
                }

                // Buka popup Midtrans Snap
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        verifikasiPembayaran(data.order_id, result, false);
                    },
                    onPending: function(result) {
                        verifikasiPembayaran(data.order_id, result, true);
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal atau dibatalkan.');
                        if (btn) {
                            btn.disabled = false;
                            btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg> Danai Proyek Sekarang';
                        }
                    },
                    onClose: function() {
                        // Cek apakah user sudah bayar di simulator saat popup ditutup
                        verifikasiPembayaran(data.order_id, {}, false);
                    }
                });
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg> Danai Proyek Sekarang';
                }
            });
        }

        let candConfirmCallback = null;
        function konfirmasiAksiKandidat(appId, action, candidateName) {
            const modal = document.getElementById('modalCustomConfirmProyek');
            const title = document.getElementById('confirmProyekTitle');
            const desc = document.getElementById('confirmProyekDesc');
            const submitBtn = document.getElementById('btnProyekConfirmAction');

            if (action === 'terima') {
                title.textContent = 'Terima Kandidat?';
                desc.textContent = 'Apakah Anda yakin ingin menerima "' + candidateName + '" sebagai anggota tim dalam proyek ini?';
                submitBtn.textContent = 'Ya, Terima Kandidat';
                submitBtn.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                submitBtn.style.boxShadow = '0 4px 14px -3px rgba(16,185,129,.5)';
                candConfirmCallback = function() {
                    const f = document.getElementById('formKandidatTerima' + appId);
                    if (f) f.submit();
                };
            } else {
                title.textContent = 'Tolak Kandidat?';
                desc.textContent = 'Apakah Anda yakin ingin menolak lamaran dari "' + candidateName + '"?';
                submitBtn.textContent = 'Ya, Tolak';
                submitBtn.style.background = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
                submitBtn.style.boxShadow = '0 4px 14px -3px rgba(239,68,68,.5)';
                candConfirmCallback = function() {
                    const f = document.getElementById('formKandidatTolak' + appId);
                    if (f) f.submit();
                };
            }

            modal.style.display = 'flex';
        }

        function closeProyekConfirm() {
            document.getElementById('modalCustomConfirmProyek').style.display = 'none';
            candConfirmCallback = null;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btnProyekConfirmAction');
            if (btn) {
                btn.addEventListener('click', function() {
                    if (typeof candConfirmCallback === 'function') {
                        const cb = candConfirmCallback;
                        closeProyekConfirm();
                        cb();
                    }
                });
            }
        });
    </script>
    <style>
        @keyframes spin { 100% { transform: rotate(360deg); } }
        @keyframes popModal {
            0% { opacity: 0; transform: scale(0.92); }
            100% { opacity: 1; transform: scale(1); }
        }
    </style>

    {{-- CUSTOM GENERIC CONFIRM MODAL PROYEK --}}
    <div id="modalCustomConfirmProyek" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 420px; border-radius: 24px; padding: 32px 26px; text-align: center; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: popModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div style="width: 64px; height: 64px; border-radius: 50%; background: #e0e7ff; color: #4338ca; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 id="confirmProyekTitle" style="font-family: 'Fredoka', sans-serif; font-size: 21px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Konfirmasi</h3>
            <p id="confirmProyekDesc" style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 24px;">Apakah Anda yakin?</p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <button type="button" onclick="closeProyekConfirm()" style="padding: 12px 18px; border-radius: 12px; font-weight: 700; font-size: 14px; border: 1.5px solid #e2e8f0; background: #fff; color: #64748b; cursor: pointer; font-family: 'Nunito', sans-serif;">
                    Batal
                </button>
                <button type="button" id="btnProyekConfirmAction" style="padding: 12px 18px; border-radius: 12px; font-weight: 800; font-size: 14px; border: none; color: #fff; cursor: pointer; font-family: 'Nunito', sans-serif;">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>

</body>
</html>
