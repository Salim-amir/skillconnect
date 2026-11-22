<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Task Board - {{ $project->judul_project }} - SkillConnect</title>
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
    min-width: 0;
    max-width: calc(100vw - 280px);
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
}

.top-breadcrumb {
    font-size: 14px;
    color: var(--mute);
    font-weight: 600;
}
.top-breadcrumb a { color: var(--mute); transition: color .2s; }
.top-breadcrumb a:hover { color: var(--secondary); }
.top-breadcrumb span { color: var(--ink); font-weight: 700; }

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

/* ===== TASK BOARD HEADER ===== */
.task-board-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 28px;
    flex-wrap: wrap;
    gap: 16px;
}

.task-board-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 12px;
}
.task-board-title svg { width: 32px; height: 32px; color: var(--accent); }

.task-board-subtitle {
    font-size: 14px;
    color: var(--mute);
    margin-top: 4px;
}

.btn-add-task {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14.5px;
    border: none;
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    box-shadow: 0 6px 18px -4px rgba(123,108,246,.6);
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.btn-add-task:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 24px -4px rgba(123,108,246,.7);
}

/* ===== KANBAN BOARD ===== */
.kanban-board {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    align-items: start;
}

.kanban-column {
    background: rgba(255,255,255,.75);
    border: 1.5px solid var(--line);
    border-radius: 18px;
    padding: 20px 16px;
    min-height: 350px;
    min-width: 0;
    box-shadow: 0 4px 16px -6px rgba(80,70,200,.06);
}

.kanban-column-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid transparent;
}

.kanban-column:nth-child(1) .kanban-column-header { border-bottom-color: #94a3b8; }
.kanban-column:nth-child(2) .kanban-column-header { border-bottom-color: #3b82f6; }
.kanban-column:nth-child(3) .kanban-column-header { border-bottom-color: #f59e0b; }
.kanban-column:nth-child(4) .kanban-column-header { border-bottom-color: #10b981; }

.kanban-column-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 16px;
    color: var(--ink);
}

.kanban-count {
    padding: 2px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    background: #f4f6ff;
    color: var(--mute);
    border: 1px solid var(--line);
}

/* ===== TASK CARD ===== */
.task-card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 12px;
    transition: transform .2s, box-shadow .2s;
    box-shadow: 0 2px 8px -4px rgba(80,70,200,.08);
}
.task-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px -6px rgba(80,70,200,.15);
}

.task-card-title {
    font-weight: 700;
    font-size: 14.5px;
    color: var(--ink);
    margin-bottom: 8px;
    line-height: 1.4;
}

.task-card-meta {
    font-size: 12.5px;
    color: var(--mute);
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.task-card-meta svg { width: 14px; height: 14px; vertical-align: -2px; margin-right: 4px; }

.task-assignee {
    display: flex;
    align-items: center;
    gap: 8px;
}

.task-assignee-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4f5fe0, #7b6cf6);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}

.task-deadline {
    display: flex;
    align-items: center;
    gap: 4px;
}
.deadline-overdue { color: #dc2626; font-weight: 700; }
.deadline-soon { color: #d97706; font-weight: 700; }
.deadline-ok { color: #059669; }

.task-card-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #f0f2ff;
}

.btn-task-action {
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 700;
    cursor: pointer;
    border: 1px solid var(--line);
    background: #f8f9ff;
    color: var(--ink);
    font-family: 'Nunito', sans-serif;
    transition: .15s;
}
.btn-task-action:hover { background: #eef0ff; }
.btn-task-action.upload { background: #eef2ff; color: #2563eb; border-color: #bfdbfe; }
.btn-task-action.upload:hover { background: #dbeafe; }
.btn-task-action.review { background: #fef3c7; color: #92400e; border-color: #fcd34d; }
.btn-task-action.review:hover { background: #fde68a; }
.btn-task-action.done { background: #d1fae5; color: #065f46; border-color: #6ee7b7; }
.btn-task-action.done:hover { background: #a7f3d0; }

/* Bukti Kerja Badge */
.bukti-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 11.5px;
    font-weight: 700;
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
    margin-top: 8px;
    text-decoration: none;
    transition: background .15s;
}
.bukti-badge:hover { background: #d7edd9; }
.bukti-badge svg { width: 14px; height: 14px; }

/* Bukti Foto Image Preview */
.bukti-preview-img-wrap {
    display: block;
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    margin-top: 10px;
    border: 1.5px solid #d6d9fb;
    background: #f8f9ff;
    cursor: pointer;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(80,70,200,.08);
}
.bukti-preview-img {
    width: 100%;
    height: 110px;
    object-fit: cover;
    display: block;
    transition: transform .25s ease;
}
.bukti-preview-img-wrap:hover .bukti-preview-img {
    transform: scale(1.05);
}
.bukti-preview-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(180deg, transparent, rgba(28,39,102,.85));
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}
.bukti-preview-overlay svg { width: 13px; height: 13px; }

/* Revision Note */
.revision-note {
    margin-top: 8px;
    padding: 8px 12px;
    background: #fff3e0;
    border: 1px solid #ffcc80;
    border-radius: 8px;
    font-size: 12px;
    color: #e65100;
    font-weight: 600;
}
.revision-note strong { display: block; margin-bottom: 2px; font-size: 11px; }

/* ===== MODAL ===== */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(28,39,102,.4);
    backdrop-filter: blur(4px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}
.modal-overlay.active { display: flex; }

.modal-box {
    background: #fff;
    border-radius: 20px;
    padding: 32px;
    width: 95%;
    max-width: 520px;
    box-shadow: 0 20px 60px -12px rgba(28,39,102,.3);
    animation: modalIn .25s ease;
}

@keyframes modalIn {
    from { opacity: 0; transform: translateY(20px) scale(.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

.modal-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 22px;
    color: var(--ink);
    margin-bottom: 20px;
}

.form-group { margin-bottom: 16px; }
.form-group label {
    display: block;
    font-weight: 700;
    font-size: 14px;
    margin-bottom: 6px;
    color: var(--ink);
}
.form-group label .req { color: #e0244d; }

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    outline: none;
    font-size: 14px;
    font-family: 'Nunito', sans-serif;
    transition: border-color .2s;
}
.form-input:focus { border-color: var(--accent); }

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
}

.btn-cancel {
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    border: 1.5px solid var(--line);
    background: #fff;
    color: var(--mute);
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
}
.btn-submit {
    padding: 10px 24px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    border: none;
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    box-shadow: 0 4px 12px -2px rgba(123,108,246,.5);
}

/* Stats Row */
.task-stats-row {
    display: flex;
    gap: 16px;
    margin-bottom: 28px;
    flex-wrap: wrap;
}

.stat-card {
    flex: 1;
    min-width: 140px;
    background: #fff;
    border: 1.5px solid var(--line);
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 4px 12px -6px rgba(80,70,200,.1);
}
.stat-card-value {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: var(--ink);
}
.stat-card-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--mute);
    margin-top: 2px;
}

.stat-card:nth-child(1) { border-left: 4px solid #94a3b8; }
.stat-card:nth-child(2) { border-left: 4px solid #3b82f6; }
.stat-card:nth-child(3) { border-left: 4px solid #f59e0b; }
.stat-card:nth-child(4) { border-left: 4px solid #10b981; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: 30px 16px;
    color: #9aa2cc;
    font-size: 13.5px;
    font-style: italic;
}

@media(max-width: 1200px) {
    .kanban-board { grid-template-columns: repeat(2, 1fr); }
}

@media(max-width: 992px) {
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
    .top-bar { display: none !important; }
    .board-header-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
    }
    .board-header-row button,
    .board-header-row a {
        width: 100%;
        justify-content: center;
    }
}

@media(max-width: 768px) {
    .kanban-board { grid-template-columns: 1fr; }
    .task-stats-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .eval-section {
        padding: 20px 16px;
    }
    .eval-grid {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 480px) {
    .task-stats-row {
        grid-template-columns: 1fr;
    }
}
/* ===== MOD-09: EVALUASI ===== */
.eval-section {
    margin-top: 36px;
    background: #fff;
    border-radius: 20px;
    padding: 28px 32px;
    box-shadow: 0 4px 20px -6px rgba(28,39,102,.1);
    border: 1.5px solid var(--line);
}
.eval-section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
}
.eval-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 16px;
}
.eval-card {
    border: 1.5px solid var(--line);
    border-radius: 14px;
    padding: 18px;
    background: #f8f9ff;
    transition: box-shadow .2s;
}
.eval-card:hover { box-shadow: 0 6px 18px -6px rgba(123,108,246,.2); }
.eval-member-name {
    font-weight: 700;
    font-size: 15px;
    color: var(--ink);
    margin-bottom: 2px;
}
.eval-member-role {
    font-size: 12px;
    color: var(--mute);
    margin-bottom: 12px;
}
.eval-stars {
    display: flex;
    gap: 4px;
    margin-bottom: 10px;
}
.eval-stars .star {
    font-size: 22px;
    color: #e2e8f0;
    cursor: default;
}
.eval-stars .star.filled { color: #f59e0b; }
.eval-catatan {
    font-size: 13px;
    color: var(--mute);
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 8px;
    padding: 8px 12px;
    margin-bottom: 12px;
    font-style: italic;
}
.btn-eval {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    border: none;
    cursor: pointer;
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    color: #fff;
    transition: opacity .2s;
}
.btn-eval:hover { opacity: .85; }
.eval-badge-done {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    background: #d1fae5;
    color: #065f46;
    margin-left: 8px;
}
/* Star rating interactive (modal) */
.star-rating-input { display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end; }
.star-rating-input input { display: none; }
.star-rating-input label {
    font-size: 32px;
    color: #e2e8f0;
    cursor: pointer;
    transition: color .15s;
}
.star-rating-input label:hover,
.star-rating-input label:hover ~ label,
.star-rating-input input:checked ~ label { color: #f59e0b; }

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
                SkillConnect / <a href="{{ route('proyek') }}">Proyek</a> / <a href="{{ route('proyek.detail', $project->id) }}">{{ $project->judul_project }}</a> / <span>Task Board</span>
            </div>
            <a href="{{ route('profile.skill') }}" class="user-profile" title="Kelola Profil">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Tamu' }}</div>
                    <div class="role">{{ auth()->check() ? ucfirst(auth()->user()->role) : 'Guest' }}</div>
                </div>
                <div class="avatar">
                    @if(auth()->check() && auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}
                    @endif
                </div>
            </a>
        </header>



        <!-- TASK BOARD HEADER -->
        <div class="task-board-header">
            <div>
                <h1 class="task-board-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    Task Board
                </h1>
                <p class="task-board-subtitle">{{ $project->judul_project }} — Kelola tugas & upload bukti kerja anggota tim</p>
            </div>
            @if($isCreator)
                <button class="btn-add-task" onclick="document.getElementById('modalAddTask').classList.add('active')">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Task
                </button>
            @endif
        </div>

        <!-- PAYMENT STATUS ESCROW BANNER (OPSI A) -->
        @if($project->status_project === 'Selesai')
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding: 14px 20px; background: #ecfdf5; border: 2px solid #10b981; border-radius: 14px; margin-bottom: 24px; font-size: 14px; color: #065f46; font-weight: 700; box-shadow: 0 4px 14px -4px rgba(16,185,129,.2);">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 38px; height: 38px; border-radius: 10px; background: #d1fae5; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="22" height="22" fill="none" stroke="#059669" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div style="font-size: 15px; font-weight: 800; color: #047857;">Proyek Telah Resmi SELESAI</div>
                        <div style="font-size: 12.5px; font-weight: 500; color: #065f46; margin-top: 2px;">Dana Rekening Bersama (Escrow) sebesar Rp {{ number_format($project->budget, 0, ',', '.') }} telah resmi dicairkan ke masing-masing anggota tim.</div>
                    </div>
                </div>
                <span style="font-size: 12px; font-weight: 800; background: #10b981; color: #fff; padding: 6px 14px; border-radius: 99px;">Tuntas & Lunas</span>
            </div>
        @elseif($isPaid)
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px; padding: 12px 18px; background: #e8f9ee; border: 1.5px solid #b6edc8; border-radius: 12px; margin-bottom: 24px; font-size: 13.5px; color: #0d8239; font-weight: 700;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Dana Proyek Terjamin: 100% Lunas di Rekening Bersama (Rp {{ number_format($project->budget, 0, ',', '.') }})</span>
                </div>
                <span style="font-size: 12px; font-weight: 600; background: #fff; padding: 3px 10px; border-radius: 99px; border: 1px solid #b6edc8;">Escrow Terkunci</span>
            </div>
        @else
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; padding: 14px 18px; background: #fffbeb; border: 1.5px solid #fde68a; border-radius: 12px; margin-bottom: 24px; font-size: 13.5px; color: #92400e;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span><strong>Perhatian:</strong> Dana proyek sebesar <strong>Rp {{ number_format($project->budget, 0, ',', '.') }}</strong> belum dikunci di Rekening Bersama oleh Creator.</span>
                </div>
                @if($isCreator)
                    <button id="btnBayarSekarangTask" onclick="bayarProyekTaskBoard()" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 10px; font-weight: 700; font-size: 13.5px; border: none; background: linear-gradient(90deg, #10b981, #059669); color: #fff; cursor: pointer; font-family: 'Nunito', sans-serif; box-shadow: 0 4px 12px -2px rgba(16,185,129,.5);">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Danai Proyek Sekarang
                    </button>
                @endif
            </div>
        @endif

        <!-- STATS ROW -->
        @php
            $totalTasks = collect($tasksByStatus)->flatten()->count();
            $belum = $tasksByStatus['Belum Dikerjakan']->count();
            $sedang = $tasksByStatus['Sedang Dikerjakan']->count();
            $review = $tasksByStatus['Menunggu Review']->count();
            $selesai = $tasksByStatus['Selesai']->count();
        @endphp
        <div class="task-stats-row">
            <div class="stat-card">
                <div class="stat-card-value">{{ $belum }}</div>
                <div class="stat-card-label">Belum Dikerjakan</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value">{{ $sedang }}</div>
                <div class="stat-card-label">Sedang Dikerjakan</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value">{{ $review }}</div>
                <div class="stat-card-label">Menunggu Review</div>
            </div>
            <div class="stat-card">
                <div class="stat-card-value">{{ $selesai }}</div>
                <div class="stat-card-label">Selesai</div>
            </div>
        </div>

        {{-- KARTU PENYELESAIAN PROYEK & PENCAIRAN FEE (OPSI A: FULL ESCROW RELEASE) --}}
        @if($isCreator && $project->status_project !== 'Selesai')
            @if($totalTasks > 0 && $belum === 0 && $sedang === 0 && $review === 0)
                <div style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 2px dashed #16a34a; border-radius: 14px; padding: 18px 24px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px; box-shadow: 0 4px 14px -4px rgba(22,163,74,.2);">
                    <div>
                        <div style="display: flex; align-items: center; gap: 8px; font-size: 16px; font-weight: 800; color: #15803d;">
                            <svg width="20" height="20" fill="none" stroke="#15803d" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Seluruh Tugas Selesai Dikerjakan!</span>
                        </div>
                        <div style="font-size: 13px; color: #166534; margin-top: 4px; line-height: 1.5;">
                            Semua tugas di papan kerja telah tuntas. Klik tombol di samping untuk menyelesaikan proyek secara resmi dan mencairkan dana Escrow (<strong>Rp {{ number_format($project->budget, 0, ',', '.') }}</strong>) ke saldo/fee masing-masing anggota tim.
                        </div>
                    </div>
                    <form id="formSelesaikanProyek" action="{{ route('proyek.selesaikan', $project->id) }}" method="POST">
                        @csrf
                        <button type="button" onclick="openSelesaikanProyekModal()" style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 800; font-size: 14px; background: linear-gradient(90deg, #16a34a, #15803d); color: #fff; border: none; cursor: pointer; box-shadow: 0 4px 14px -3px rgba(22,163,74,.5); font-family: 'Nunito', sans-serif;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            Selesaikan Proyek & Cairkan Dana Tim
                        </button>
                    </form>
                </div>
            @endif
        @endif

        <!-- KANBAN BOARD -->
        <div class="kanban-board" id="taskBoard">
            @foreach($tasksByStatus as $status => $tasks)
                <div class="kanban-column" data-status="{{ $status }}">
                    <div class="kanban-column-header">
                        <h3 class="kanban-column-title">{{ $status }}</h3>
                        <span class="kanban-count">{{ $tasks->count() }}</span>
                    </div>

                    @forelse($tasks as $task)
                        <div class="task-card" data-task-id="{{ $task->id }}">
                            <div class="task-card-title">{{ $task->nama_task }}</div>
                            <div class="task-card-meta">
                                <div class="task-assignee">
                                    <span class="task-assignee-avatar">{{ substr($task->user->name ?? 'U', 0, 1) }}</span>
                                    <span>{{ $task->user->name ?? 'Tidak ada' }}</span>
                                </div>
                                @php
                                    $isOverdue = $task->deadline && $task->deadline->endOfDay()->isPast();
                                    $isDueSoon = !$isOverdue && $task->deadline && $task->deadline->diffInDays(now()) <= 3;
                                @endphp
                                <div class="task-deadline {{ $isOverdue ? 'deadline-overdue' : ($isDueSoon ? 'deadline-soon' : 'deadline-ok') }}">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ $task->deadline ? $task->deadline->format('d M Y') : 'Tanpa batas' }}
                                    @if($isOverdue)
                                        <span style="font-size: 11px;">(Terlambat!)</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Bukti Kerja --}}
                            @if($task->bukti_kerja)
                                @php
                                    $ext = strtolower(pathinfo($task->bukti_kerja, PATHINFO_EXTENSION));
                                    $isImg = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                                @endphp
                                @if($isImg)
                                    <a href="{{ asset('storage/' . $task->bukti_kerja) }}" target="_blank" class="bukti-preview-img-wrap" title="Klik untuk memperbesar bukti kerja">
                                        <img src="{{ asset('storage/' . $task->bukti_kerja) }}" alt="Bukti Kerja" class="bukti-preview-img">
                                        <span class="bukti-preview-overlay">
                                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                            Lihat Foto Penuh
                                        </span>
                                    </a>
                                @else
                                    <a href="{{ asset('storage/' . $task->bukti_kerja) }}" target="_blank" class="bukti-badge">
                                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        Lihat Dokumen Bukti ({{ strtoupper($ext) }})
                                    </a>
                                @endif
                            @endif

                            {{-- Catatan Revisi --}}
                            @if($task->catatan_revisi)
                                <div class="revision-note">
                                    <strong>Catatan Revisi:</strong>
                                    {{ $task->catatan_revisi }}
                                </div>
                            @endif

                            {{-- ACTIONS --}}
                            <div class="task-card-actions">
                                {{-- Pemilik task: bisa upload bukti & ubah status --}}
                                @if(auth()->id() === $task->user_id)
                                    @if($task->status_task !== 'Selesai')
                                        @if($task->status_task === 'Belum Dikerjakan')
                                            <form action="{{ route('proyek.tasks.status', [$project->id, $task->id]) }}" method="POST" style="display:inline;">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status_task" value="Sedang Dikerjakan">
                                                <button type="submit" class="btn-task-action" style="display:inline-flex; align-items:center; gap:4px;">
                                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                                    Mulai Kerjakan
                                                </button>
                                            </form>
                                        @endif

                                        <button class="btn-task-action upload" onclick="openUploadModal({{ $task->id }})" style="display:inline-flex; align-items:center; gap:4px;">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                            Upload Bukti
                                        </button>
                                    @endif
                                @endif

                                {{-- Creator: bisa approve, revisi, ubah status --}}
                                @if($isCreator)
                                    @if($task->status_task === 'Menunggu Review')
                                        <form id="formApproveTask{{ $task->id }}" action="{{ route('proyek.tasks.status', [$project->id, $task->id]) }}" method="POST" style="display:inline;">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status_task" value="Selesai">
                                            <button type="button" class="btn-task-action done" onclick="konfirmasiSetujuiTask({{ $task->id }}, '{{ addslashes($task->nama_task) }}')" style="display:inline-flex; align-items:center; gap:4px;">
                                                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                Setujui
                                            </button>
                                        </form>
                                        <button class="btn-task-action review" onclick="openRevisionModal({{ $task->id }})" style="display:inline-flex; align-items:center; gap:4px;">
                                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Minta Revisi
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">Belum ada task.</div>
                    @endforelse
                </div>
            @endforeach
        </div>

        {{-- ===== MOD-09: SECTION EVALUASI ANGGOTA TIM ===== --}}
        <div class="eval-section">

            {{-- TAMPILAN CREATOR: Beri nilai ke semua anggota --}}
            @if($isCreator)
                <div class="eval-section-title">
                    <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    Evaluasi Anggota Tim
                    <span style="font-size: 13px; font-weight: 500; color: var(--mute); font-family: 'Nunito';">— Berikan penilaian untuk setiap anggota tim proyek ini</span>
                </div>
                @if($acceptedMembers->isEmpty())
                    <p style="color: var(--mute); font-size: 14px;">Belum ada anggota tim yang diterima.</p>
                @else
                    <div class="eval-grid">
                        @foreach($acceptedMembers as $member)
                            @if($member->id !== $project->creator_id)
                                <div class="eval-card">
                                    <div class="eval-member-name">
                                        {{ $member->name }}
                                        @if($member->nilai_evaluasi)
                                            <span class="eval-badge-done">✓ Sudah Dinilai</span>
                                        @endif
                                    </div>
                                    <div class="eval-member-role">{{ $member->peran }}</div>

                                    {{-- Tampilkan bintang yang sudah diberikan --}}
                                    <div class="eval-stars" style="margin-bottom: 8px;">
                                        @for($s = 1; $s <= 5; $s++)
                                            <span class="star {{ $s <= ($member->nilai_evaluasi ?? 0) ? 'filled' : '' }}">★</span>
                                        @endfor
                                        @if($member->nilai_evaluasi)
                                            <span style="font-size: 13px; color: var(--mute); margin-left: 4px;">{{ $member->nilai_evaluasi }}/5</span>
                                        @endif
                                    </div>

                                    @if($member->catatan_evaluasi)
                                        <div class="eval-catatan">"{{ $member->catatan_evaluasi }}"</div>
                                    @endif

                                    <button class="btn-eval" onclick="openEvalModal({{ $member->member_id }}, '{{ addslashes($member->name) }}', {{ $member->nilai_evaluasi ?? 0 }}, '{{ addslashes($member->catatan_evaluasi ?? '') }}')">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        {{ $member->nilai_evaluasi ? 'Ubah Penilaian' : 'Beri Penilaian' }}
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

            {{-- TAMPILAN ANGGOTA TIM: Lihat nilai sendiri --}}
            @else
                <div class="eval-section-title">
                    <svg width="22" height="22" fill="none" stroke="#7b6cf6" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Evaluasi Kamu
                </div>
                @if($myEvaluation && $myEvaluation->nilai_evaluasi)
                    <div class="eval-card" style="max-width: 400px; background: linear-gradient(135deg, #f8f9ff, #fff);">
                        <div class="eval-member-name" style="margin-bottom: 4px;">Penilaian dari Creator Proyek</div>
                        <div class="eval-stars" style="margin: 12px 0;">
                            @for($s = 1; $s <= 5; $s++)
                                <span class="star {{ $s <= $myEvaluation->nilai_evaluasi ? 'filled' : '' }}" style="font-size: 28px;">★</span>
                            @endfor
                        </div>
                        <div style="font-size: 22px; font-weight: 800; color: #f59e0b; margin-bottom: 8px;">
                            {{ $myEvaluation->nilai_evaluasi }} / 5
                            <span style="font-size: 14px; font-weight: 500; color: var(--mute);"> bintang</span>
                        </div>
                        @if($myEvaluation->catatan_evaluasi)
                            <div class="eval-catatan" style="margin-top: 8px;">"{{ $myEvaluation->catatan_evaluasi }}"</div>
                        @endif
                    </div>
                @else
                    <div style="color: var(--mute); font-size: 14px; padding: 24px 20px; text-align: center; background: #f8f9ff; border-radius: 14px; border: 1.5px dashed var(--line);">
                        <div style="display: flex; justify-content: center; margin-bottom: 10px;">
                            <svg width="34" height="34" fill="none" stroke="#94a3b8" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <strong>Belum ada penilaian</strong><br>
                        <span style="font-size: 13px;">Creator proyek belum memberikan evaluasi untukmu.</span>
                    </div>
                @endif
            @endif

        </div>
    </main>

    {{-- MODAL: Tambah Task (Creator Only) --}}
    @if($isCreator)
    <div class="modal-overlay" id="modalAddTask">
        <div class="modal-box">
            <h2 class="modal-title">Tambah Task Baru</h2>
            <form action="{{ route('proyek.tasks.store', $project->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Task <span class="req">*</span></label>
                    <input type="text" name="nama_task" class="form-input" required placeholder="Contoh: Desain Wireframe Halaman Login">
                </div>
                <div class="form-group">
                    <label>Ditugaskan Kepada <span class="req">*</span></label>
                    <select name="user_id" class="form-input" required>
                        <option value="">-- Pilih Anggota Tim --</option>
                        @foreach($acceptedMembers as $member)
                            <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->peran }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Deadline <span class="req">*</span></label>
                    <input type="date" name="deadline" class="form-input" required min="{{ date('Y-m-d') }}">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modalAddTask').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-submit">Tambah Task</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL: Upload Bukti Kerja --}}
    <div class="modal-overlay" id="modalUploadBukti">
        <div class="modal-box">
            <h2 class="modal-title">Upload Bukti Kerja</h2>
            <form id="formUploadBukti" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>File Bukti Kerja <span class="req">*</span></label>
                    <input type="file" name="bukti_kerja" id="buktiFileInput" class="form-input" required accept=".jpg,.jpeg,.png,.webp,.pdf,.zip,.doc,.docx">
                    <p style="font-size: 12px; color: var(--mute); margin-top: 4px;">Format didukung: Foto (JPG, PNG, WEBP), Dokumen (PDF, DOC, DOCX, ZIP). Maks 10MB.</p>
                    
                    {{-- Live Image Preview --}}
                    <div id="imagePreviewContainer" style="display: none; margin-top: 12px; text-align: center;">
                        <p style="font-size: 11px; font-weight: 700; color: var(--mute); margin-bottom: 6px; text-align: left;">Pratinjau Foto:</p>
                        <img id="imagePreview" src="" alt="Pratinjau Bukti" style="max-height: 180px; max-width: 100%; border-radius: 10px; border: 1.5px solid var(--line); object-fit: contain;">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modalUploadBukti').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-submit">Upload Bukti</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL: Catatan Revisi (Creator Only) --}}
    @if($isCreator)
    <div class="modal-overlay" id="modalRevisi">
        <div class="modal-box">
            <h2 class="modal-title">Catatan Revisi</h2>
            <form id="formRevisi" method="POST">
                @csrf
                <div class="form-group">
                    <label>Catatan Revisi <span class="req">*</span></label>
                    <textarea name="catatan_revisi" class="form-input" required rows="4" placeholder="Jelaskan apa yang perlu diperbaiki..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modalRevisi').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-submit">Kirim Revisi</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- MODAL: Evaluasi Anggota Tim (Creator Only - MOD-09) --}}
    @if($isCreator)
    <div class="modal-overlay" id="modalEvaluasi">
        <div class="modal-box">
            <h2 class="modal-title">Evaluasi Anggota Tim</h2>
            <p id="evalMemberName" style="font-size: 14px; color: var(--mute); margin-bottom: 20px;"></p>
            <form id="formEvaluasi" method="POST">
                @csrf
                <div class="form-group">
                    <label>Rating Kinerja <span class="req">*</span></label>
                    <div class="star-rating-input" id="starRatingInput">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" name="nilai_evaluasi" id="star{{ $i }}" value="{{ $i }}">
                            <label for="star{{ $i }}" title="{{ $i }} bintang">★</label>
                        @endfor
                    </div>
                    <p style="font-size: 12px; color: var(--mute); margin-top: 6px;">1 = Kurang &nbsp;·&nbsp; 3 = Cukup &nbsp;·&nbsp; 5 = Sangat Baik</p>
                </div>
                <div class="form-group">
                    <label>Catatan / Komentar</label>
                    <textarea name="catatan_evaluasi" id="evalCatatan" class="form-input" rows="3" placeholder="Tuliskan komentar mengenai kinerja anggota ini..." maxlength="1000"></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modalEvaluasi').classList.remove('active')">Batal</button>
                    <button type="submit" class="btn-submit">Simpan Evaluasi</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @php
        $snapUrl = config('midtrans.is_production')
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    @endphp
    <script src="{{ $snapUrl }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        function openUploadModal(taskId) {
            const form = document.getElementById('formUploadBukti');
            form.action = '/proyek/{{ $project->id }}/tasks/' + taskId + '/bukti';
            
            // Reset input dan live preview
            const fileInput = document.getElementById('buktiFileInput');
            if (fileInput) fileInput.value = '';
            const previewContainer = document.getElementById('imagePreviewContainer');
            if (previewContainer) previewContainer.style.display = 'none';

            document.getElementById('modalUploadBukti').classList.add('active');
        }

        // Live image preview listener
        const fileInputEl = document.getElementById('buktiFileInput');
        if (fileInputEl) {
            fileInputEl.addEventListener('change', function() {
                const previewContainer = document.getElementById('imagePreviewContainer');
                const previewImg = document.getElementById('imagePreview');
                const file = this.files[0];

                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewContainer.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else if (previewContainer) {
                    previewContainer.style.display = 'none';
                }
            });
        }

        function openRevisionModal(taskId) {
            const form = document.getElementById('formRevisi');
            form.action = '/proyek/{{ $project->id }}/tasks/' + taskId + '/revisi';
            document.getElementById('modalRevisi').classList.add('active');
        }

        @if($isCreator)
        function openEvalModal(memberId, memberName, currentRating, currentCatatan) {
            // Set form action
            document.getElementById('formEvaluasi').action = '/proyek/{{ $project->id }}/evaluasi/' + memberId;

            // Set member name
            document.getElementById('evalMemberName').textContent = 'Memberikan penilaian untuk: ' + memberName;

            // Set catatan
            document.getElementById('evalCatatan').value = currentCatatan;

            // Set star rating yang sudah ada
            if (currentRating > 0) {
                const radio = document.getElementById('star' + currentRating);
                if (radio) radio.checked = true;
            } else {
                document.querySelectorAll('.star-rating-input input').forEach(r => r.checked = false);
            }

            document.getElementById('modalEvaluasi').classList.add('active');
        }
        @endif

        @if($isCreator && !$isPaid)
        function showCustomPaymentModalTaskBoard(title, desc, isSuccess = true) {
            const modal = document.getElementById('modalPaymentCustomTask');
            const modalTitle = document.getElementById('payModalTitleTask');
            const modalDesc = document.getElementById('payModalDescTask');
            const iconWrap = document.getElementById('payModalIconWrapTask');
            const badge = document.getElementById('payModalBadgeTask');

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
                    iconWrap.innerHTML = '<svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    if (badge) badge.innerHTML = 'Status: Menunggu Pembayaran';
                }
                modal.style.display = 'flex';
            } else {
                alert(title + '\n\n' + desc);
                window.location.reload();
            }
        }

        function verifikasiPembayaranTaskBoard(orderId, resultData, isPending = false) {
            const btn = document.getElementById('btnBayarSekarangTask');
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
                    showCustomPaymentModalTaskBoard(
                        'Pembayaran Berhasil!',
                        'Dana proyek sebesar Rp {{ number_format($project->budget, 0, ",", ".") }} telah berhasil dikunci di Rekening Bersama SkillConnect (Escrow). Anda dan tim kini dapat mengerjakan tugas secara aman!',
                        true
                    );
                } else if (isPending) {
                    showCustomPaymentModalTaskBoard(
                        'Menunggu Pembayaran',
                        'Instruksi pembayaran telah dibuat. Silakan selesaikan pembayaran agar Task Board dapat digunakan secara penuh.',
                        false
                    );
                } else {
                    window.location.reload();
                }
            })
            .catch(err => {
                console.error(err);
                window.location.reload();
            });
        }

        function bayarProyekTaskBoard() {
            const btn = document.getElementById('btnBayarSekarangTask');
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
                        btn.innerHTML = 'Danai Proyek Sekarang';
                    }
                    return;
                }

                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        verifikasiPembayaranTaskBoard(data.order_id, result, false);
                    },
                    onPending: function(result) {
                        verifikasiPembayaranTaskBoard(data.order_id, result, true);
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal atau dibatalkan.');
                        if (btn) {
                            btn.disabled = false;
                            btn.innerHTML = 'Danai Proyek Sekarang';
                        }
                    },
                    onClose: function() {
                        verifikasiPembayaranTaskBoard(data.order_id, {}, false);
                    }
                });
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = 'Danai Proyek Sekarang';
                }
            });
        }
        @endif

        // Handlers untuk Custom Modal Konfirmasi Selesaikan Proyek & Aksi Task
        function openSelesaikanProyekModal() {
            const m = document.getElementById('modalConfirmSelesaikanProyek');
            if (m) m.style.display = 'flex';
        }
        function closeSelesaikanProyekModal() {
            const m = document.getElementById('modalConfirmSelesaikanProyek');
            if (m) m.style.display = 'none';
        }
        function submitSelesaikanProyek() {
            const f = document.getElementById('formSelesaikanProyek');
            if (f) f.submit();
        }

        let customConfirmCallback = null;
        function showCustomConfirm(title, desc, onConfirm, btnText = 'Ya, Lanjutkan') {
            document.getElementById('confirmModalTitle').textContent = title;
            document.getElementById('confirmModalDesc').textContent = desc;
            document.getElementById('btnConfirmAction').textContent = btnText;
            customConfirmCallback = onConfirm;
            document.getElementById('modalCustomConfirm').style.display = 'flex';
        }
        function closeCustomConfirm() {
            document.getElementById('modalCustomConfirm').style.display = 'none';
            customConfirmCallback = null;
        }
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btnConfirmAction');
            if (btn) {
                btn.addEventListener('click', function() {
                    if (typeof customConfirmCallback === 'function') {
                        const cb = customConfirmCallback;
                        closeCustomConfirm();
                        cb();
                    }
                });
            }
        });

        function konfirmasiSetujuiTask(taskId, taskName) {
            showCustomConfirm(
                'Setujui Task Ini?',
                'Tandai task "' + taskName + '" sebagai selesai. Task ini akan dipindahkan ke kolom Selesai.',
                function() {
                    const f = document.getElementById('formApproveTask' + taskId);
                    if (f) f.submit();
                },
                'Ya, Setujui Selesai'
            );
        }

        // Close modal on overlay click
        document.querySelectorAll('.modal-overlay').forEach(el => {
            el.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('active');
            });
        });
    </script>

    {{-- CUSTOM MODAL POPUP STATUS PEMBAYARAN ESCROW --}}
    <div id="modalPaymentCustomTask" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 24px; padding: 36px 28px; text-align: center; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: popModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div id="payModalIconWrapTask" style="width: 76px; height: 76px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: #fff; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.5);">
                <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 id="payModalTitleTask" style="font-family: 'Fredoka', sans-serif; font-size: 23px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Pembayaran Berhasil!</h3>
            <p id="payModalDescTask" style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 22px;">Dana proyek sebesar Rp {{ number_format($project->budget, 0, ',', '.') }} telah berhasil dikunci di Rekening Bersama SkillConnect (Escrow). Proyek kini aktif berjalan!</p>
            
            <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 16px; padding: 14px 18px; margin-bottom: 24px;">
                <div style="font-size: 11px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px;">Total Dana Diamankan</div>
                <div style="font-family: 'Fredoka', sans-serif; font-size: 24px; font-weight: 800; color: #047857;">Rp {{ number_format($project->budget, 0, ',', '.') }}</div>
                <div id="payModalBadgeTask" style="display: inline-flex; align-items: center; gap: 4px; font-size: 11.5px; color: #059669; font-weight: 700; margin-top: 4px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    Status: 100% Escrow Terkunci
                </div>
            </div>

            <button type="button" onclick="window.location.reload()" style="width: 100%; padding: 14px 24px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; border: none; border-radius: 14px; font-weight: 800; font-size: 15px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 8px 20px -4px rgba(16, 185, 129, 0.4); font-family: 'Nunito', sans-serif;">
                <span>Mulai Kerjakan Tugas</span>
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>

    {{-- CUSTOM MODAL KONFIRMASI SELESAIKAN PROYEK & PENCAIRAN ESCROW --}}
    <div id="modalConfirmSelesaikanProyek" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 460px; border-radius: 24px; padding: 34px 28px; text-align: center; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: popModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, #10b981, #059669); color: #fff; margin: 0 auto 18px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);">
                <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 style="font-family: 'Fredoka', sans-serif; font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Selesaikan Proyek?</h3>
            <p style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 20px;">
                Apakah Anda yakin ingin menyelesaikan proyek ini secara resmi? Seluruh tugas telah tuntas dikerjakan oleh tim Anda.
            </p>

            <div style="background: #f0fdf4; border: 1.5px solid #bbf7d0; border-radius: 16px; padding: 14px 18px; margin-bottom: 24px; text-align: left;">
                <div style="font-size: 11px; font-weight: 800; color: #166534; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 4px;">Pencairan Dana Rekening Bersama</div>
                <div style="font-family: 'Fredoka', sans-serif; font-size: 22px; font-weight: 800; color: #047857; margin-bottom: 4px;">Rp {{ number_format($project->budget, 0, ',', '.') }}</div>
                <div style="font-size: 12px; color: #15803d; line-height: 1.4;">
                    Dana Escrow akan otomatis dicairkan ke masing-masing anggota tim sesuai porsi kerja dan fee yang disepakati.
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 12px;">
                <button type="button" onclick="closeSelesaikanProyekModal()" style="padding: 13px 18px; border-radius: 12px; font-weight: 700; font-size: 14px; border: 1.5px solid #e2e8f0; background: #fff; color: #64748b; cursor: pointer; font-family: 'Nunito', sans-serif;">
                    Batal
                </button>
                <button type="button" onclick="submitSelesaikanProyek()" style="padding: 13px 18px; border-radius: 12px; font-weight: 800; font-size: 14px; border: none; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; cursor: pointer; box-shadow: 0 4px 14px -3px rgba(16,185,129,.5); font-family: 'Nunito', sans-serif;">
                    Ya, Selesaikan & Cairkan
                </button>
            </div>
        </div>
    </div>

    {{-- CUSTOM GENERIC CONFIRM MODAL (SETUJUI TASK, DLL) --}}
    <div id="modalCustomConfirm" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.72); backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 420px; border-radius: 24px; padding: 32px 26px; text-align: center; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: popModal 0.3s cubic-bezier(0.16, 1, 0.3, 1);">
            <div id="confirmModalIconWrap" style="width: 64px; height: 64px; border-radius: 50%; background: #e0e7ff; color: #4338ca; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center;">
                <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 id="confirmModalTitle" style="font-family: 'Fredoka', sans-serif; font-size: 21px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Konfirmasi</h3>
            <p id="confirmModalDesc" style="font-size: 13.5px; color: #64748b; line-height: 1.55; margin-bottom: 24px;">Apakah Anda yakin?</p>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <button type="button" onclick="closeCustomConfirm()" style="padding: 12px 18px; border-radius: 12px; font-weight: 700; font-size: 14px; border: 1.5px solid #e2e8f0; background: #fff; color: #64748b; cursor: pointer; font-family: 'Nunito', sans-serif;">
                    Batal
                </button>
                <button type="button" id="btnConfirmAction" style="padding: 12px 18px; border-radius: 12px; font-weight: 800; font-size: 14px; border: none; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #fff; cursor: pointer; box-shadow: 0 4px 14px -3px rgba(16,185,129,.5); font-family: 'Nunito', sans-serif;">
                    Ya, Setujui
                </button>
            </div>
        </div>
    </div>
</body>
</html>
