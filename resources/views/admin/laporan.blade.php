<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Laporan Sistem - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #0f172a;
    --mute: #64748b;
    --border: #e2e8f0;
    --primary: #4f46e5;
    --secondary: #7c3aed;
    box-sizing: border-box;
}

*{box-sizing:border-box;margin:0;padding:0;}

body {
    background: #f8fafc;
    color: var(--ink);
    font-family: 'Nunito', system-ui, sans-serif;
    line-height: 1.5;
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
    border-right: 1.5px solid #e0e3fa;
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
    background: linear-gradient(90deg,#1c2766,#7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.sidebar-nav {
    padding: 24px 16px;
    display: flex;
    flex-direction: column;
    gap: 8px;
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
    margin-top: auto;
    padding: 16px;
    border-top: 1.5px solid #f0f2ff;
}
.nav-item.logout {
    width: 100%;
    text-align: left;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    color: #d8000c;
    background: none;
    border: none;
}
.nav-item.logout svg { color: #d8000c; }
.nav-item.logout:hover { background: #fdecec; color: #b00009; }

/* ===== MAIN CONTENT ===== */
.main-content {
    flex: 1;
    margin-left: 280px;
    padding: 28px 40px 48px;
    display: flex;
    flex-direction: column;
    max-width: calc(100vw - 280px);
}

.top-bar {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 24px;
}

/* ===== PAGE HEADER ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 24px;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 26px;
    color: #1e293b;
    letter-spacing: -0.01em;
}

.report-meta {
    font-size: 13px;
    color: var(--mute);
    font-weight: 600;
    margin-top: 2px;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 13.5px;
    border: 1px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}
.btn.pri {
    background: #2b3a8f;
    color: #fff;
}
.btn.pri:hover {
    background: #1e293b;
}

/* ===== KPI CARDS (MINIMALIST) ===== */
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media(max-width: 1100px) {
    .kpi-grid { grid-template-columns: repeat(2, 1fr); }
}

.kpi-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.kpi-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.kpi-label {
    font-size: 13px;
    font-weight: 700;
    color: var(--mute);
}

.kpi-icon {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.kpi-icon svg { width: 18px; height: 18px; }
.kpi-icon.indigo { background: #eef2ff; color: #4f46e5; }
.kpi-icon.violet { background: #f5f3ff; color: #7c3aed; }
.kpi-icon.emerald { background: #ecfdf5; color: #059669; }
.kpi-icon.amber { background: #fffbeb; color: #d97706; }

.kpi-value {
    font-family: 'Fredoka', sans-serif;
    font-size: 26px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.15;
}

.kpi-foot {
    font-size: 12px;
    color: var(--mute);
    font-weight: 600;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
}

/* ===== VISUAL CHARTS GRID (3 COLUMNS) ===== */
.visual-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}
@media(max-width: 1150px) {
    .visual-grid { grid-template-columns: 1fr; }
}

.visual-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 20px 22px;
    display: flex;
    flex-direction: column;
}

.visual-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.visual-title {
    font-size: 14.5px;
    font-weight: 800;
    color: #1e293b;
}

.visual-sub {
    font-size: 12px;
    font-weight: 700;
    color: var(--mute);
    background: #f1f5f9;
    padding: 3px 9px;
    border-radius: 99px;
}

/* Stacked Bar */
.stacked-bar {
    height: 10px;
    width: 100%;
    background: #f1f5f9;
    border-radius: 99px;
    overflow: hidden;
    display: flex;
    margin-bottom: 16px;
}
.stacked-segment {
    height: 100%;
    transition: width .4s ease;
}

/* Metric Rows inside Visual Card */
.metric-list {
    display: flex;
    flex-direction: column;
    gap: 11px;
}

.metric-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.metric-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
}

.metric-name {
    font-weight: 700;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 8px;
}

.metric-val {
    font-weight: 800;
    color: #0f172a;
}
.metric-val span {
    font-weight: 600;
    color: var(--mute);
    font-size: 12px;
    margin-left: 3px;
}

.bar-track {
    width: 100%;
    height: 6px;
    background: #f1f5f9;
    border-radius: 99px;
    overflow: hidden;
}
.bar-fill {
    height: 100%;
    border-radius: 99px;
}

.divider {
    height: 1px;
    background: #f1f5f9;
    margin: 14px 0;
}

.mini-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}
.mini-tag {
    font-size: 11.5px;
    font-weight: 700;
    background: #f8fafc;
    border: 1px solid var(--border);
    color: #334155;
    padding: 4px 10px;
    border-radius: 8px;
}
.mini-tag strong {
    color: #4f46e5;
    margin-left: 3px;
}

/* Donut Chart Ringkas */
.donut-wrap {
    display: flex;
    align-items: center;
    gap: 18px;
    margin-bottom: 14px;
}
.donut-ring {
    width: 84px;
    height: 84px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.donut-hole {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    line-height: 1.1;
}
.donut-hole .num {
    font-family: 'Fredoka', sans-serif;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}
.donut-hole .lbl {
    font-size: 10px;
    color: var(--mute);
    font-weight: 700;
}

/* ===== FILTER TABS UNTUK TABEL DETAIL ===== */
.section-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 14px;
}

.tab-group {
    display: inline-flex;
    background: #e2e8f0;
    padding: 4px;
    border-radius: 10px;
    gap: 4px;
}

.tab-btn {
    border: none;
    background: transparent;
    padding: 7px 14px;
    border-radius: 7px;
    font-family: 'Nunito', sans-serif;
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    cursor: pointer;
    transition: .15s;
}
.tab-btn.active {
    background: #fff;
    color: #0f172a;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}

/* ===== CLEAN CARD & TABLE ===== */
.card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 24px;
}

.card-head {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.card-head-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
}

.count-badge {
    font-size: 12px;
    font-weight: 700;
    color: #475569;
    background: #f1f5f9;
    padding: 4px 10px;
    border-radius: 99px;
}

.table-responsive { overflow-x: auto; }

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}
.data-table th, .data-table td {
    padding: 13px 20px;
    text-align: left;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.data-table th {
    background: #f8fafc;
    color: #475569;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .04em;
    border-bottom: 1px solid var(--border);
    white-space: nowrap;
}
.data-table tr:hover td {
    background: #fcfdff;
}
.data-table tr:last-child td {
    border-bottom: none;
}

/* Badges & Chips */
.badge {
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 700;
    display: inline-block;
    white-space: nowrap;
}
.badge.success { background: #ecfdf5; color: #047857; }
.badge.warning { background: #fffbeb; color: #b45309; }
.badge.danger  { background: #fef2f2; color: #b91c1c; }
.badge.info    { background: #eef2ff; color: #4338ca; }
.badge.neutral { background: #f1f5f9; color: #334155; }

.skill-chip {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 11.5px;
    font-weight: 700;
    margin: 2px 4px 2px 0;
    background: #f8fafc;
    color: #334155;
    border: 1px solid var(--border);
    white-space: nowrap;
}
.skill-chip span {
    color: var(--mute);
    font-weight: 600;
}

.mono-id {
    font-family: monospace;
    font-weight: 700;
    font-size: 12.5px;
    color: #4f46e5;
    background: #eef2ff;
    padding: 3px 8px;
    border-radius: 5px;
}

.empty-row {
    text-align: center !important;
    color: var(--mute);
    padding: 28px 20px !important;
    font-weight: 600;
}

/* ===== PAGINATION ===== */
.pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    padding: 14px 20px;
    border-top: 1px solid var(--border);
    background: #fcfdff;
}

.pagination-info {
    font-size: 12.5px;
    color: var(--mute);
    font-weight: 600;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 5px;
}

.page-btn {
    min-width: 32px;
    padding: 6px 10px;
    border-radius: 7px;
    border: 1px solid var(--border);
    background: #fff;
    color: #334155;
    font-size: 12.5px;
    font-weight: 700;
    text-align: center;
    transition: .15s;
}
a.page-btn:hover {
    background: #f1f5f9;
}
.page-btn.active {
    background: #2b3a8f;
    border-color: #2b3a8f;
    color: #fff;
}
.page-btn.disabled {
    opacity: .45;
    cursor: not-allowed;
}

/* ===== PRINT / EXPORT DOKUMEN LAPORAN RESMI ===== */
.print-document { display: none; }

@media print {
    @page {
        size: A4 portrait;
        margin: 14mm 12mm;
    }
    .sidebar, .top-bar, .no-print, .pagination-bar, .section-bar,
    .page-header, .kpi-grid, .visual-grid, .report-panel {
        display: none !important;
    }
    .print-document {
        display: block !important;
        color: #0f172a !important;
        font-family: 'Nunito', Arial, sans-serif;
        font-size: 11px;
        line-height: 1.45;
    }
    body {
        background: #fff !important;
        color: #0f172a !important;
        display: block !important;
    }
    .main-content {
        margin-left: 0 !important;
        max-width: 100% !important;
        padding: 0 !important;
    }
    .doc-header {
        border-bottom: 2px solid #0f172a;
        padding-bottom: 10px;
        margin-bottom: 14px;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
    .doc-title {
        font-size: 15px;
        font-weight: 800;
        letter-spacing: 0.02em;
        text-transform: uppercase;
        color: #0f172a;
    }
    .doc-sub {
        font-size: 11px;
        color: #475569;
        margin-top: 2px;
    }
    .doc-meta {
        text-align: right;
        font-size: 10.5px;
        color: #334155;
        line-height: 1.4;
    }
    .doc-section-title {
        font-size: 11.5px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        color: #0f172a;
        margin: 14px 0 6px;
        padding-bottom: 3px;
        border-bottom: 1px solid #cbd5e1;
    }
    .doc-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
        font-size: 10.5px;
    }
    .doc-table th, .doc-table td {
        border: 1px solid #94a3b8;
        padding: 5px 8px;
        text-align: left;
        vertical-align: top;
    }
    .doc-table th {
        background: #f1f5f9 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-weight: 800;
        color: #0f172a;
        white-space: nowrap;
    }
    .doc-table tr {
        page-break-inside: avoid;
    }
    .doc-table tfoot td {
        background: #f8fafc !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        font-weight: 800;
    }
}
/* ===== INJECTED RESPONSIVE CSS ===== */

@media(max-width: 992px) {
    .main-content {
        margin-left: 0 !important;
        padding: 16px !important;
        padding-top: 76px !important;
        width: 100% !important;
        box-sizing: border-box !important;
        overflow-x: hidden !important;
    }
    .top-bar { display: none !important; }
    .grid-stats, .grid-stats-4, .stats-grid { grid-template-columns: repeat(2, 1fr) !important; }
    .grid-content { grid-template-columns: 1fr !important; }
    .filter-bar { flex-direction: column !important; align-items: stretch !important; }
}
@media(max-width: 600px) {
    .grid-stats, .grid-stats-4, .stats-grid { grid-template-columns: 1fr !important; }
    .search-box, .btn { width: 100% !important; }
}
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

</style>
</head>
<body>
    @include('shared.sidebar')
    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <a href="{{ route('profile.skill') }}" class="user-profile" title="Kelola Profil">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Admin' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">
                    @if(auth()->check() && auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{ substr(auth()->check() ? auth()->user()->name : 'A', 0, 1) }}
                    @endif
                </div>
            </a>
        </header>

        <!-- PAGE HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Laporan Analitik Sistem</h1>
                <p class="report-meta">
                    Data per {{ now()->format('d M Y, H:i') }} WIB &bull; Ringkasan Pengguna, Proyek &amp; Transaksi
                </p>
            </div>
            <button class="btn pri no-print" onclick="window.print()">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Export Laporan
            </button>
        </div>

        <!-- 4 KPI UTAMA -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Total Pengguna</span>
                    <div class="kpi-icon indigo">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4z"></path></svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalUsers }}</div>
                <div class="kpi-foot">
                    <span>{{ $totalMembers }} Member</span> &bull;
                    <span>{{ $totalCreators }} Creator</span> &bull;
                    <span>{{ $totalAdmins }} Admin</span>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Total Proyek</span>
                    <div class="kpi-icon violet">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalProjects }}</div>
                <div class="kpi-foot">
                    <span>{{ $totalActiveProjects }} Aktif</span> &bull;
                    <span>{{ $projectsSelesai }} Selesai</span> &bull;
                    <span>{{ $totalProjectMembers }} Tim</span>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Total Transaksi</span>
                    <div class="kpi-icon amber">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"></path></svg>
                    </div>
                </div>
                <div class="kpi-value">{{ $totalTransactions }}</div>
                <div class="kpi-foot">
                    <span style="color:#059669;">{{ $trxLunas }} Lunas</span> &bull;
                    <span style="color:#d97706;">{{ $trxPending }} Pending</span>
                    @if($trxBatal > 0)
                        &bull; <span style="color:#dc2626;">{{ $trxBatal }} Batal</span>
                    @endif
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Dana Escrow Lunas</span>
                    <div class="kpi-icon emerald">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div class="kpi-value" style="font-size: 22px; color: #047857;">
                    Rp {{ number_format($nominalLunas, 0, ',', '.') }}
                </div>
                <div class="kpi-foot">
                    Pending: Rp {{ number_format($nominalPending, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- 3 VISUALISASI DATA (PENGGUNA, PROYEK, TRANSAKSI) -->
        @php
            $uTotal = max($totalUsers, 1);
            $pctMember  = round(($totalMembers / $uTotal) * 100);
            $pctCreator = round(($totalCreators / $uTotal) * 100);
            $pctAdmin   = max(0, 100 - $pctMember - $pctCreator);

            $pTotal = max($totalProjects, 1);
            $pctCari    = round(($projectsMencariTim / $pTotal) * 100);
            $pctJalan   = round(($projectsBerjalan / $pTotal) * 100);
            $pctSelesai = max(0, 100 - $pctCari - $pctJalan);

            $tTotal = max($totalTransactions, 1);
            $pctLunas   = round(($trxLunas / $tTotal) * 100);
            $pctPending = round(($trxPending / $tTotal) * 100);
            $pctBatal   = max(0, 100 - $pctLunas - $pctPending);

            $degCari    = round(($projectsMencariTim / $pTotal) * 360);
            $degJalan   = $degCari + round(($projectsBerjalan / $pTotal) * 360);
        @endphp

        <div class="visual-grid">
            <!-- VISUAL 1: KOMPOSISI PENGGUNA & SKILL -->
            <div class="visual-card">
                <div class="visual-head">
                    <span class="visual-title">Distribusi Pengguna &amp; Skill</span>
                    <span class="visual-sub">{{ $totalUsers }} Akun</span>
                </div>

                <div class="stacked-bar" title="Komposisi Role Pengguna">
                    <div class="stacked-segment" style="width: {{ $pctMember }}%; background: #4f46e5;"></div>
                    <div class="stacked-segment" style="width: {{ $pctCreator }}%; background: #0ea5e9;"></div>
                    <div class="stacked-segment" style="width: {{ $pctAdmin }}%; background: #94a3b8;"></div>
                </div>

                <div class="metric-list">
                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#4f46e5;"></span>Member</span>
                            <span class="metric-val">{{ $totalMembers }} <span>({{ $pctMember }}%)</span></span>
                        </div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#0ea5e9;"></span>Creator</span>
                            <span class="metric-val">{{ $totalCreators }} <span>({{ $pctCreator }}%)</span></span>
                        </div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#94a3b8;"></span>Admin</span>
                            <span class="metric-val">{{ $totalAdmins }} <span>({{ $pctAdmin }}%)</span></span>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>
                <div style="font-size: 12px; font-weight: 700; color: var(--mute); margin-bottom: 8px;">
                    Skill Terpopuler ({{ $totalUserSkills }} total keahlian)
                </div>
                <div class="mini-tags">
                    @forelse($topSkills as $sk)
                        <span class="mini-tag">{{ $sk->nama_skill }} <strong>{{ $sk->total }}</strong></span>
                    @empty
                        <span style="font-size: 12px; color: var(--mute);">Belum ada data skill</span>
                    @endforelse
                </div>
            </div>

            <!-- VISUAL 2: STATUS & KATEGORI PROYEK -->
            <div class="visual-card">
                <div class="visual-head">
                    <span class="visual-title">Status &amp; Anggaran Proyek</span>
                    <span class="visual-sub">{{ $totalProjects }} Proyek</span>
                </div>

                <div class="donut-wrap">
                    <div class="donut-ring" style="background: conic-gradient(#6366f1 0deg {{ $degCari }}deg, #f59e0b {{ $degCari }}deg {{ $degJalan }}deg, #10b981 {{ $degJalan }}deg 360deg);">
                        <div class="donut-hole">
                            <span class="num">{{ $totalProjects }}</span>
                            <span class="lbl">Proyek</span>
                        </div>
                    </div>
                    <div class="metric-list" style="flex: 1;">
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#6366f1;"></span>Mencari Tim</span>
                            <span class="metric-val">{{ $projectsMencariTim }} <span>({{ $pctCari }}%)</span></span>
                        </div>
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#f59e0b;"></span>Berjalan</span>
                            <span class="metric-val">{{ $projectsBerjalan }} <span>({{ $pctJalan }}%)</span></span>
                        </div>
                        <div class="metric-row">
                            <span class="metric-name"><span class="dot" style="background:#10b981;"></span>Selesai</span>
                            <span class="metric-val">{{ $projectsSelesai }} <span>({{ $pctSelesai }}%)</span></span>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>
                <div style="display:flex; justify-content:space-between; align-items:center; font-size:12.5px; margin-bottom:8px;">
                    <span style="color:var(--mute); font-weight:700;">Total Nilai Budget Proyek</span>
                    <strong style="color:#0f172a;">Rp {{ number_format($totalProjectBudget, 0, ',', '.') }}</strong>
                </div>
                <div class="mini-tags">
                    @foreach($projectCategories as $cat => $cnt)
                        <span class="mini-tag">{{ $cat ?: 'Lainnya' }} <strong>{{ $cnt }}</strong></span>
                    @endforeach
                </div>
            </div>

            <!-- VISUAL 3: PERFORMA TRANSAKSI ESCROW -->
            <div class="visual-card">
                <div class="visual-head">
                    <span class="visual-title">Rasio Pembayaran Transaksi</span>
                    <span class="visual-sub">{{ $pctLunas }}% Lunas</span>
                </div>

                <div class="metric-list">
                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name">Lunas (Escrow)</span>
                            <span class="metric-val" style="color:#047857;">
                                Rp {{ number_format($nominalLunas, 0, ',', '.') }} <span>({{ $trxLunas }})</span>
                            </span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $pctLunas }}%; background: #10b981;"></div>
                        </div>
                    </div>

                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name">Tertunda (Pending)</span>
                            <span class="metric-val" style="color:#b45309;">
                                Rp {{ number_format($nominalPending, 0, ',', '.') }} <span>({{ $trxPending }})</span>
                            </span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $pctPending }}%; background: #f59e0b;"></div>
                        </div>
                    </div>

                    <div class="metric-item">
                        <div class="metric-row">
                            <span class="metric-name">Batal / Gagal</span>
                            <span class="metric-val" style="color:#64748b;">
                                {{ $trxBatal }} transaksi <span>({{ $pctBatal }}%)</span>
                            </span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: {{ $pctBatal }}%; background: #cbd5e1;"></div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>
                <div style="display:flex; justify-content:space-between; align-items:center; font-size:12.5px;">
                    <span style="color:var(--mute); font-weight:700;">Total Volume Transaksi</span>
                    <strong style="color:#2b3a8f; font-size:14px;">Rp {{ number_format($totalNominalTrx, 0, ',', '.') }}</strong>
                </div>
            </div>
        </div>

        <!-- TAB FILTER BAGIAN LAPORAN -->
        <div class="section-bar no-print">
            <div style="font-size: 16px; font-weight: 800; color: #0f172a;">Rincian Tabel Laporan</div>
            <div class="tab-group">
                <button type="button" class="tab-btn active" onclick="filterSection('all', this)">Semua Bagian</button>
                <button type="button" class="tab-btn" onclick="filterSection('users', this)">Pengguna ({{ $totalUsers }})</button>
                <button type="button" class="tab-btn" onclick="filterSection('projects', this)">Proyek ({{ $totalProjects }})</button>
                <button type="button" class="tab-btn" onclick="filterSection('transactions', this)">Transaksi ({{ $totalTransactions }})</button>
            </div>
        </div>

        <!-- TABEL 1: DATA PENGGUNA & SKILL -->
        <div class="card report-panel" data-panel="users">
            <div class="card-head">
                <div class="card-head-title">
                    1. Data Pengguna &amp; Keahlian
                </div>
                <span class="count-badge">{{ $totalUsers }} pengguna &bull; {{ $totalUserSkills }} skill</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Keahlian (Skill)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $u)
                        <tr>
                            <td style="color: var(--mute); font-weight: 700;">{{ $users->firstItem() + $i }}</td>
                            <td style="font-weight: 700; color: #0f172a;">{{ $u->name }}</td>
                            <td style="color: #475569;">{{ $u->email }}</td>
                            <td>
                                @if($u->role === 'admin')
                                    <span class="badge info">Admin</span>
                                @elseif($u->role === 'creator')
                                    <span class="badge warning">Creator</span>
                                @else
                                    <span class="badge neutral">Member</span>
                                @endif
                            </td>
                            <td>
                                @if($u->skills->isEmpty())
                                    <span style="color: #94a3b8; font-size: 12.5px;">Belum diatur</span>
                                @else
                                    @foreach($u->skills as $skill)
                                        <span class="skill-chip">{{ $skill->nama_skill }} <span>&bull; {{ $skill->pivot->tingkat_keahlian }}</span></span>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-row">Belum ada data pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
            <div class="pagination-bar">
                <div class="pagination-info">
                    Menampilkan {{ $users->firstItem() }}&ndash;{{ $users->lastItem() }} dari {{ $users->total() }} pengguna
                </div>
                <div class="pagination-controls">
                    @if($users->onFirstPage())
                        <span class="page-btn disabled">&laquo;</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-btn">&laquo;</a>
                    @endif

                    @for($p = 1; $p <= $users->lastPage(); $p++)
                        @if($p == $users->currentPage())
                            <span class="page-btn active">{{ $p }}</span>
                        @else
                            <a href="{{ $users->url($p) }}" class="page-btn">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-btn">&raquo;</a>
                    @else
                        <span class="page-btn disabled">&raquo;</span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- TABEL 2: DATA PROYEK & TIM -->
        <div class="card report-panel" data-panel="projects">
            <div class="card-head">
                <div class="card-head-title">
                    2. Data Proyek &amp; Tim Pelaksana
                </div>
                <span class="count-badge">{{ $totalProjects }} proyek &bull; Rp {{ number_format($totalProjectBudget, 0, ',', '.') }}</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul Proyek</th>
                            <th>Creator</th>
                            <th>Kategori</th>
                            <th>Anggota Tim</th>
                            <th>Budget</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $idx => $project)
                            @php
                                $teamMembers = $project->members->filter(function ($m) use ($project) {
                                    return $m->pivot->peran !== 'Project Creator / Leader'
                                        && $m->id !== $project->creator_id
                                        && in_array($m->pivot->status_keanggotaan, ['Diterima', 'Pending']);
                                });
                            @endphp
                            <tr>
                                <td style="color: var(--mute); font-weight: 700;">{{ $idx + 1 }}</td>
                                <td>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $project->judul_project }}</div>
                                    <div style="font-size: 12px; color: var(--mute);">Dibuat {{ $project->created_at ? $project->created_at->format('d M Y') : '-' }}</div>
                                </td>
                                <td style="font-weight: 600;">{{ $project->creator->name ?? '-' }}</td>
                                <td><span class="badge neutral">{{ $project->kategori }}</span></td>
                                <td>
                                    @if($teamMembers->isNotEmpty())
                                        @foreach($teamMembers as $tm)
                                            <span class="skill-chip">{{ $tm->name }} <span>({{ $tm->pivot->status_keanggotaan }})</span></span>
                                        @endforeach
                                    @else
                                        <span style="color: #94a3b8; font-size: 12.5px;">Belum ada member</span>
                                    @endif
                                </td>
                                <td style="font-weight: 700; color: #0f172a; white-space: nowrap;">
                                    Rp {{ number_format($project->budget, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($project->status_project === 'Selesai')
                                        <span class="badge success">Selesai</span>
                                    @elseif($project->status_project === 'Berjalan')
                                        <span class="badge warning">Berjalan</span>
                                    @else
                                        <span class="badge info">{{ $project->status_project }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-row">Belum ada data proyek pada sistem.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL 3: DATA TRANSAKSI ESCROW -->
        <div class="card report-panel" data-panel="transactions">
            <div class="card-head">
                <div class="card-head-title">
                    3. Data Transaksi Pembayaran Proyek
                </div>
                <span class="count-badge">{{ $totalTransactions }} transaksi &bull; Lunas Rp {{ number_format($nominalLunas, 0, ',', '.') }}</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Pengirim (Creator)</th>
                            <th>Penerima (Member)</th>
                            <th>Proyek</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            @php
                                $shortId = '#TRX-' . str_pad($trx->id, 3, '0', STR_PAD_LEFT);
                                $senderName = $trx->user->name ?? ($trx->project->creator->name ?? 'Creator');
                                $projectTitle = $trx->project->judul_project ?? 'Proyek';

                                $recipientMembers = collect();
                                if ($trx->project && $trx->project->members) {
                                    $recipientMembers = $trx->project->members->filter(function ($m) use ($trx) {
                                        return $m->pivot->peran !== 'Project Creator / Leader'
                                            && $m->id !== ($trx->project->creator_id ?? null)
                                            && in_array($m->pivot->status_keanggotaan, ['Diterima', 'Pending']);
                                    });
                                }
                            @endphp
                            <tr>
                                <td><span class="mono-id">{{ $shortId }}</span></td>
                                <td style="font-weight: 700; color: #0f172a;">{{ $senderName }}</td>
                                <td>
                                    @if($recipientMembers->isNotEmpty())
                                        {{ $recipientMembers->pluck('name')->implode(', ') }}
                                    @else
                                        <span style="color: #94a3b8;">Menunggu Tim</span>
                                    @endif
                                </td>
                                <td style="font-weight: 600;">{{ $projectTitle }}</td>
                                <td style="font-weight: 700; color: #0f172a; white-space: nowrap;">
                                    Rp {{ number_format($trx->jumlah_fee, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($trx->status_pembayaran === 'lunas')
                                        <span class="badge success">Lunas (Escrow)</span>
                                    @elseif($trx->status_pembayaran === 'pending')
                                        <span class="badge warning">Pending</span>
                                    @else
                                        <span class="badge danger">{{ ucfirst($trx->status_pembayaran) }}</span>
                                    @endif
                                </td>
                                <td style="color: var(--mute); white-space: nowrap;">
                                    {{ $trx->created_at ? $trx->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-row">Belum ada transaksi tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ===================== DOKUMEN LAPORAN KHUSUS CETAK (PRINT OUT) ===================== -->
        <div class="print-document">
            <!-- Kop Dokumen -->
            <div class="doc-header">
                <div>
                    <div class="doc-title">Laporan Rekapitulasi Sistem — SkillConnect</div>
                    <div class="doc-sub">Ringkasan Data Pengguna, Proyek &amp; Transaksi Pembayaran Escrow</div>
                </div>
                <div class="doc-meta">
                    <div><strong>Tanggal Cetak:</strong> {{ now()->format('d/m/Y H:i') }} WIB</div>
                    <div><strong>Dicetak Oleh:</strong> {{ auth()->check() ? auth()->user()->name : 'Administrator' }}</div>
                </div>
            </div>

            <!-- I. Ringkasan Eksekutif -->
            <div class="doc-section-title">I. Ringkasan Eksekutif</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 28%;">Kategori Laporan</th>
                        <th>Rincian Indikator</th>
                        <th style="width: 26%; text-align: right;">Total / Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Data Pengguna &amp; Skill</strong></td>
                        <td>{{ $totalMembers }} Member ({{ $pctMember }}%), {{ $totalCreators }} Creator ({{ $pctCreator }}%), {{ $totalAdmins }} Admin ({{ $pctAdmin }}%) &bull; {{ $totalUserSkills }} keahlian terdaftar</td>
                        <td style="text-align: right;"><strong>{{ $totalUsers }} Pengguna</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Data Proyek</strong></td>
                        <td>{{ $projectsMencariTim }} Mencari Tim, {{ $projectsBerjalan }} Berjalan, {{ $projectsSelesai }} Selesai &bull; {{ $totalProjectMembers }} anggota tim aktif</td>
                        <td style="text-align: right;"><strong>{{ $totalProjects }} Proyek (Rp {{ number_format($totalProjectBudget, 0, ',', '.') }})</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Transaksi</strong></td>
                        <td>{{ $trxLunas }} Lunas (Rp {{ number_format($nominalLunas, 0, ',', '.') }}), {{ $trxPending }} Pending (Rp {{ number_format($nominalPending, 0, ',', '.') }}), {{ $trxBatal }} Batal</td>
                        <td style="text-align: right;"><strong>{{ $totalTransactions }} Transaksi (Rp {{ number_format($totalNominalTrx, 0, ',', '.') }})</strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- II. Data Pengguna & Keahlian (Lengkap Tanpa Terpotong Pagination) -->
            <div class="doc-section-title">II. Daftar Pengguna &amp; Keahlian ({{ $totalUsers }} Pengguna)</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 32px; text-align: center;">No</th>
                        <th style="width: 22%;">Nama Pengguna</th>
                        <th style="width: 24%;">Alamat Email</th>
                        <th style="width: 12%;">Peran</th>
                        <th>Daftar Keahlian (Skill &amp; Tingkat)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $docUsers = $allUsers ?? $users; @endphp
                    @forelse($docUsers as $idx => $u)
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td><strong>{{ $u->name }}</strong></td>
                            <td>{{ $u->email }}</td>
                            <td>{{ ucfirst($u->role) }}</td>
                            <td>
                                @if($u->skills->isEmpty())
                                    -
                                @else
                                    {{ $u->skills->map(fn($s) => $s->nama_skill . ' (' . $s->pivot->tingkat_keahlian . ')')->implode(', ') }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- III. Data Proyek & Tim Pelaksana -->
            <div class="doc-section-title">III. Daftar Proyek &amp; Tim Pelaksana ({{ $totalProjects }} Proyek)</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 32px; text-align: center;">No</th>
                        <th style="width: 24%;">Judul Proyek</th>
                        <th style="width: 16%;">Creator</th>
                        <th style="width: 15%;">Kategori</th>
                        <th>Anggota Tim</th>
                        <th style="width: 15%; text-align: right;">Anggaran</th>
                        <th style="width: 12%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $idx => $project)
                        @php
                            $teamMembers = $project->members->filter(function ($m) use ($project) {
                                return $m->pivot->peran !== 'Project Creator / Leader'
                                    && $m->id !== $project->creator_id
                                    && in_array($m->pivot->status_keanggotaan, ['Diterima', 'Pending']);
                            });
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $idx + 1 }}</td>
                            <td><strong>{{ $project->judul_project }}</strong></td>
                            <td>{{ $project->creator->name ?? '-' }}</td>
                            <td>{{ $project->kategori }}</td>
                            <td>
                                @if($teamMembers->isNotEmpty())
                                    {{ $teamMembers->map(fn($m) => $m->name . ' (' . $m->pivot->status_keanggotaan . ')')->implode(', ') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap;">Rp {{ number_format($project->budget, 0, ',', '.') }}</td>
                            <td>{{ $project->status_project }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Belum ada data proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style="text-align: right;">Total Nilai Anggaran Proyek</td>
                        <td style="text-align: right; white-space: nowrap;">Rp {{ number_format($totalProjectBudget, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <!-- IV. Data Transaksi Pembayaran Proyek -->
            <div class="doc-section-title">IV. Riwayat Transaksi Pembayaran Escrow ({{ $totalTransactions }} Transaksi)</div>
            <table class="doc-table">
                <thead>
                    <tr>
                        <th style="width: 11%;">ID</th>
                        <th style="width: 18%;">Pengirim (Creator)</th>
                        <th style="width: 20%;">Penerima (Member)</th>
                        <th>Proyek</th>
                        <th style="width: 15%; text-align: right;">Nominal</th>
                        <th style="width: 11%;">Status</th>
                        <th style="width: 12%;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        @php
                            $shortId = '#TRX-' . str_pad($trx->id, 3, '0', STR_PAD_LEFT);
                            $senderName = $trx->user->name ?? ($trx->project->creator->name ?? 'Creator');
                            $projectTitle = $trx->project->judul_project ?? 'Proyek';

                            $recipientMembers = collect();
                            if ($trx->project && $trx->project->members) {
                                $recipientMembers = $trx->project->members->filter(function ($m) use ($trx) {
                                    return $m->pivot->peran !== 'Project Creator / Leader'
                                        && $m->id !== ($trx->project->creator_id ?? null)
                                        && in_array($m->pivot->status_keanggotaan, ['Diterima', 'Pending']);
                                });
                            }
                        @endphp
                        <tr>
                            <td style="font-family: monospace; font-weight: 700;">{{ $shortId }}</td>
                            <td>{{ $senderName }}</td>
                            <td>{{ $recipientMembers->isNotEmpty() ? $recipientMembers->pluck('name')->implode(', ') : 'Menunggu Tim' }}</td>
                            <td>{{ $projectTitle }}</td>
                            <td style="text-align: right; white-space: nowrap;">Rp {{ number_format($trx->jumlah_fee, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($trx->status_pembayaran) }}</td>
                            <td style="white-space: nowrap;">{{ $trx->created_at ? $trx->created_at->format('d/m/Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Belum ada transaksi tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="text-align: right;">Total Dana Escrow Lunas</td>
                        <td style="text-align: right; white-space: nowrap;">Rp {{ number_format($nominalLunas, 0, ',', '.') }}</td>
                        <td colspan="2">{{ $trxLunas }} Transaksi Lunas</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>

    <script>
        function filterSection(target, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            document.querySelectorAll('.report-panel').forEach(panel => {
                if (target === 'all' || panel.dataset.panel === target) {
                    panel.style.display = '';
                } else {
                    panel.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
