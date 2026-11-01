<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Riwayat Transaksi - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #0a0a0a;
    --mute: #525252;
    --primary: #ff007f;
    --secondary: #7000ff;
    box-sizing: border-box;
}

*{box-sizing:border-box;margin:0;padding:0;}

body {
    background: linear-gradient(180deg,#eef0ff,#f4f1ff 50%,#eaf1ff);
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

/* ===== SIDEBAR FOOTER ===== */
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
.nav-item.logout:hover svg { color: #b00009; }

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
    justify-content: flex-end;
    align-items: center;
    margin-bottom: 30px;
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

.user-info {
    text-align: right;
}
.user-info .name {
    font-weight: 700;
    color: #1c2766;
    font-size: 15px;
    line-height: 1.2;
}
.user-info .role {
    font-size: 12px;
    color: #7b6cf6;
    font-weight: 600;
}

/* ===== PAGE CONTENT ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 24px;
    gap: 16px;
    flex-wrap: wrap;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: #1c2766;
}

.page-desc {
    color: #6b7280;
    font-size: 14px;
    margin-top: 4px;
}

/* ===== STAT CARDS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
@media(max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}

.stat-card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 16px;
    padding: 20px 22px;
    box-shadow: 0 4px 20px -10px rgba(80,70,200,.15);
}
.stat-label {
    font-size: 13px;
    color: #4b5686;
    font-weight: 700;
    margin-bottom: 8px;
}
.stat-number {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    font-weight: 700;
    line-height: 1.1;
    color: #1c2766;
}
.stat-sub {
    font-size: 12px;
    color: #8f9bd8;
    font-weight: 600;
    margin-top: 6px;
}
.stat-card.total .stat-number   { color: #2b3a8f; }
.stat-card.lunas .stat-number   { color: #10b981; }
.stat-card.pending .stat-number { color: #f59e0b; }
.stat-card.dana .stat-number    {
    background: linear-gradient(90deg, #2b3a8f, #7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    font-size: 24px;
}

/* ===== FILTER BAR ===== */
.filter-bar {
    display: flex;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
    align-items: center;
}
.filter-bar input,
.filter-bar select {
    padding: 10px 16px;
    border-radius: 10px;
    border: 1.5px solid #dde0f5;
    font-family: 'Nunito', sans-serif;
    font-size: 14px;
    background: #fff;
    color: #1c2766;
    outline: none;
    transition: border-color .2s;
}
.filter-bar input:focus,
.filter-bar select:focus { border-color: #7b6cf6; }
.filter-bar input { flex: 1; min-width: 240px; }

/* ===== CARD & TABLE ===== */
.card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 18px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.2);
    overflow: hidden;
}

.table-responsive { overflow-x: auto; }

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.data-table th, .data-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid #edf0ff;
    vertical-align: middle;
}
.data-table th {
    background: #f8f9ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    border-bottom: 2px solid #e0e3fa;
    white-space: nowrap;
}
.data-table tr:hover td {
    background: #fcfcff;
}
.data-table tr:last-child td {
    border-bottom: none;
}

.trx-id {
    color: #7b6cf6;
    font-weight: 700;
    font-family: monospace;
    font-size: 13px;
    background: #f4f1ff;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #e4dcff;
    display: inline-block;
    white-space: nowrap;
}

.user-cell .user-name {
    font-weight: 700;
    color: #1c2766;
    font-size: 14px;
}
.user-cell .user-sub {
    font-size: 12px;
    color: #8f9bd8;
    font-weight: 600;
}

.member-chip {
    display: inline-block;
    background: #eef0ff;
    color: #2b3a8f;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    margin: 2px 4px 2px 0;
    border: 1px solid #d6d9fb;
}

.project-cell .proj-title {
    font-weight: 700;
    color: #1c2766;
}
.project-cell .proj-cat {
    font-size: 12px;
    color: #7b6cf6;
    font-weight: 600;
}

.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
    white-space: nowrap;
}
.badge.success { background: #e5ffe5; color: #008000; border: 1px solid #b8f5b8; }
.badge.warning { background: #fff5e5; color: #cc7700; border: 1px solid #ffe0b2; }
.badge.danger  { background: #ffe5e5; color: #cc0000; border: 1px solid #ffc2c2; }

.currency {
    font-family: 'Fredoka', sans-serif;
    font-weight: 600;
    color: #2b3a8f;
    white-space: nowrap;
    font-size: 15px;
}

.date-cell .date-main {
    font-weight: 700;
    color: #1c2766;
    font-size: 13.5px;
    white-space: nowrap;
}
.date-cell .date-time {
    font-size: 12px;
    color: #8f9bd8;
    font-weight: 600;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    border: 1.5px solid transparent;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
}
.btn.pri {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    color: #fff;
    box-shadow: 0 8px 20px -8px rgba(123,108,246,.7);
}
.btn.pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -8px rgba(123,108,246,.8);
}
.btn.ghost {
    background: #fff;
    color: #4b5686;
    border-color: #d6d9fb;
}
.btn.ghost:hover {
    background: #f4f6ff;
    color: #1c2766;
}

/* ===== PAGINATION ===== */
.pagination-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    padding: 16px 24px;
    border-top: 1.5px solid #edf0ff;
}

.pagination-info {
    font-size: 13px;
    color: #8f9bd8;
    font-weight: 600;
}

.pagination-controls {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}

.page-btn {
    min-width: 36px;
    padding: 8px 12px;
    border-radius: 8px;
    border: 1.5px solid #d6d9fb;
    background: #fff;
    color: #4b5686;
    font-size: 13px;
    font-weight: 700;
    text-align: center;
    transition: .2s;
}

a.page-btn:hover {
    background: #f4f6ff;
    color: #1c2766;
}

.page-btn.active {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 6px 16px -8px rgba(123,108,246,.7);
}

.page-btn.disabled {
    opacity: .45;
    cursor: not-allowed;
}

.empty-state {
    text-align: center;
    padding: 50px 24px;
    color: #8f9bd8;
}
.empty-state svg {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    opacity: .5;
}
.empty-state .empty-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 17px;
    color: #1c2766;
    margin-bottom: 4px;
}

/* ===== PRINT / EXPORT ===== */
.print-only { display: none; }

@media print {
    @page {
        size: A4 portrait;
        margin: 12mm;
    }
    .sidebar, .top-bar, .filter-bar, .no-print, .pagination-bar, .screen-only, .stats-grid {
        display: none !important;
    }
    .print-only {
        display: block !important;
    }
    body {
        background: #fff !important;
        color: #000 !important;
        display: block !important;
        font-size: 12px !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .print-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }
    .print-table th, .print-table td {
        border: 1px solid #cbd5e1;
        padding: 8px 10px;
        text-align: left;
    }
    .print-table th {
        background: #f1f5f9 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        font-weight: 700;
        color: #1e293b;
    }
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
                <a href="/admin/proyek" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
                <a href="/transaksi" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Transaksi
                </a>
                <a href="/laporan" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan
                </a>
            @else
                <a href="/profile-skill" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil &amp; Skill
                </a>
                <a href="/proyek" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-item logout">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <!-- TOP BAR -->
        <header class="top-bar">
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Pengguna' }}</div>
                    <div class="role">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            Administrator
                        @else
                            Project Creator &amp; Member
                        @endif
                    </div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        <!-- HEADER CETAK SIMPLE (Hanya tampil saat Print Out) -->
        <div class="print-only" style="margin-bottom: 14px; border-bottom: 1.5px solid #1e293b; padding-bottom: 8px;">
            <div style="font-size: 16px; font-weight: 800; color: #0f172a;">Riwayat Transaksi Sistem — SkillConnect</div>
            <div style="font-size: 11.5px; color: #475569; margin-top: 2px;">
                Dicetak: {{ now()->format('d/m/Y H:i') }} &bull; Total: {{ $totalTransactions ?? 0 }} transaksi ({{ $totalLunas ?? 0 }} Lunas &mdash; Rp {{ number_format($nominalLunas ?? 0, 0, ',', '.') }})
            </div>
        </div>

        <!-- PAGE HEADER -->
        <div class="page-header screen-only">
            <div>
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <h1 class="page-title">Riwayat Transaksi Sistem</h1>
                @else
                    <h1 class="page-title">Riwayat Transaksi Anda</h1>
                @endif
                <p class="page-desc">Daftar lengkap pembayaran escrow proyek dari Creator kepada tim Member di platform SkillConnect.</p>
            </div>
            
            <div class="no-print" style="display: flex; gap: 10px;">
                <button type="button" class="btn pri" onclick="exportPrintTransaksi()">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Export Data
                </button>
            </div>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-label">Total Transaksi</div>
                <div class="stat-number">{{ $totalTransactions ?? 0 }}</div>
                <div class="stat-sub">Seluruh catatan transaksi sistem</div>
            </div>
            <div class="stat-card lunas">
                <div class="stat-label">Transaksi Lunas (Escrow)</div>
                <div class="stat-number">{{ $totalLunas ?? 0 }}</div>
                <div class="stat-sub">Pembayaran terverifikasi</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-label">Menunggu / Lainnya</div>
                <div class="stat-number">{{ ($totalPending ?? 0) + ($totalBatal ?? 0) }}</div>
                <div class="stat-sub">{{ $totalPending ?? 0 }} pending &bull; {{ $totalBatal ?? 0 }} batal</div>
            </div>
            <div class="stat-card dana">
                <div class="stat-label">Total Dana Escrow Masuk</div>
                <div class="stat-number">Rp {{ number_format($nominalLunas ?? 0, 0, ',', '.') }}</div>
                <div class="stat-sub">Pending: Rp {{ number_format($nominalPending ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <input type="text" id="searchInput" placeholder="Cari ID transaksi, nama pengirim, penerima, atau judul proyek..." oninput="filterTransactions()">
            <select id="filterStatus" onchange="filterTransactions()">
                <option value="">Semua Status</option>
                <option value="lunas">Lunas (Escrow)</option>
                <option value="pending">Tertunda (Pending)</option>
                <option value="batal">Batal / Gagal</option>
            </select>
        </div>

        <!-- TABEL TRANSAKSI (Tampilan Layar dengan Pagination) -->
        <div class="card screen-only">
            <div class="table-responsive">
                <table class="data-table" id="transaksiTable">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Pengirim (Creator)</th>
                            <th>Penerima (Member)</th>
                            <th>Proyek</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            @php
                                $shortId = '#TRX-' . str_pad($trx->id, 3, '0', STR_PAD_LEFT);
                                $orderId = $trx->order_id ?? $shortId;
                                $senderName = $trx->user->name ?? ($trx->project->creator->name ?? 'Creator');
                                $senderEmail = $trx->user->email ?? ($trx->project->creator->email ?? '');
                                $projectTitle = $trx->project->judul_project ?? 'Proyek';
                                $projectCat = $trx->project->kategori ?? '-';

                                // Ambil daftar anggota tim penerima (selain Project Creator / Leader)
                                $recipientMembers = collect();
                                if ($trx->project && $trx->project->members) {
                                    $recipientMembers = $trx->project->members->filter(function ($m) use ($trx) {
                                        return $m->pivot->peran !== 'Project Creator / Leader'
                                            && $m->id !== ($trx->project->creator_id ?? null)
                                            && in_array($m->pivot->status_keanggotaan, ['Diterima', 'Pending']);
                                    });
                                }
                                $recipientSearchText = $recipientMembers->pluck('name')->implode(' ');
                            @endphp
                            <tr data-search="{{ strtolower($shortId . ' ' . $orderId . ' ' . $senderName . ' ' . $senderEmail . ' ' . $recipientSearchText . ' ' . $projectTitle . ' ' . $projectCat) }}"
                                data-status="{{ strtolower($trx->status_pembayaran) }}">
                                <td>
                                    <span class="trx-id" title="Order ID: {{ $orderId }}">{{ $shortId }}</span>
                                </td>
                                <td class="user-cell">
                                    <div class="user-name">{{ $senderName }}</div>
                                    @if($senderEmail)
                                        <div class="user-sub">{{ $senderEmail }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($recipientMembers->isNotEmpty())
                                        @foreach($recipientMembers as $member)
                                            <span class="member-chip" title="Peran: {{ $member->pivot->peran }} ({{ $member->pivot->status_keanggotaan }})">
                                                {{ $member->name }}
                                            </span>
                                        @endforeach
                                    @elseif($trx->project && $trx->project->members->isNotEmpty())
                                        <span style="color: #8f9bd8; font-weight: 600; font-size: 13px;">Menunggu Tim Member</span>
                                    @else
                                        <span style="color: #8f9bd8; font-weight: 600; font-size: 13px;">Tim Proyek</span>
                                    @endif
                                </td>
                                <td class="project-cell">
                                    <div class="proj-title">{{ $projectTitle }}</div>
                                    <div class="proj-cat">{{ $projectCat }}</div>
                                </td>
                                <td class="currency">Rp {{ number_format($trx->jumlah_fee, 0, ',', '.') }}</td>
                                <td>
                                    @if($trx->status_pembayaran === 'lunas')
                                        <span class="badge success">Lunas (Escrow)</span>
                                    @elseif($trx->status_pembayaran === 'pending')
                                        <span class="badge warning">Tertunda (Pending)</span>
                                    @else
                                        <span class="badge danger">{{ ucfirst($trx->status_pembayaran) }}</span>
                                    @endif
                                </td>
                                <td class="date-cell">
                                    @if($trx->created_at)
                                        <div class="date-main">{{ $trx->created_at->format('d M Y') }}</div>
                                        <div class="date-time">{{ $trx->created_at->format('H:i') }} WIB</div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        <div class="empty-title">Belum Ada Riwayat Transaksi</div>
                                        <div>Belum ada transaksi pembayaran yang tercatat di sistem.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($transactions, 'hasPages') && $transactions->hasPages())
            <div class="pagination-bar">
                <div class="pagination-info">
                    Menampilkan {{ $transactions->firstItem() }}&ndash;{{ $transactions->lastItem() }} dari {{ $transactions->total() }} transaksi
                </div>
                <div class="pagination-controls">
                    @if($transactions->onFirstPage())
                        <span class="page-btn disabled">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $transactions->previousPageUrl() }}" class="page-btn">&laquo; Sebelumnya</a>
                    @endif

                    @for($p = 1; $p <= $transactions->lastPage(); $p++)
                        @if($p == $transactions->currentPage())
                            <span class="page-btn active">{{ $p }}</span>
                        @else
                            <a href="{{ $transactions->url($p) }}" class="page-btn">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($transactions->hasMorePages())
                        <a href="{{ $transactions->nextPageUrl() }}" class="page-btn">Berikutnya &raquo;</a>
                    @else
                        <span class="page-btn disabled">Berikutnya &raquo;</span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- TABEL CETAK SIMPLE & RINGKAS (Khusus Print Out) -->
        <div class="print-only">
            <table class="print-table">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Pengirim (Creator)</th>
                        <th>Penerima (Member)</th>
                        <th>Proyek</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $printRows = $allTransactions ?? $transactions; @endphp
                    @forelse($printRows as $trx)
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
                            <td style="white-space: nowrap;">Rp {{ number_format($trx->jumlah_fee, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($trx->status_pembayaran) }}</td>
                            <td style="white-space: nowrap;">{{ $trx->created_at ? $trx->created_at->format('d/m/Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 14px;">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

<script>
function exportPrintTransaksi() {
    window.print();
}

function filterTransactions() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('filterStatus').value.toLowerCase();
    const rows   = document.querySelectorAll('#transaksiTable tbody tr[data-search]');

    rows.forEach(row => {
        const text      = row.dataset.search || '';
        const rowStatus = row.dataset.status || '';

        const matchSearch = !search || text.includes(search);
        const matchStatus = !status || rowStatus === status;

        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}
</script>
</body>
</html>
