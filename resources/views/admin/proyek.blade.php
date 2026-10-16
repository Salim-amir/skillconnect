<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Pantau Proyek - SkillConnect Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --bg: #ffffff;
    --ink: #0a0a0a;
    --mute: #525252;
    --primary: #ff007f;
    --secondary: #7000ff;
    --tertiary: #00d4ff;
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

.user-info { text-align: right; }
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

/* ===== PAGE HEADER ===== */
.page-header {
    margin-bottom: 24px;
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
    margin-bottom: 28px;
}

.stat-card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 16px;
    padding: 22px 24px;
    text-align: center;
    box-shadow: 0 4px 20px -10px rgba(80,70,200,.15);
}
.stat-number {
    font-family: 'Fredoka', sans-serif;
    font-size: 36px;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 6px;
}
.stat-label {
    font-size: 13px;
    color: #6b7280;
    font-weight: 600;
}
.stat-card.total   .stat-number { color: #2b3a8f; }
.stat-card.cari    .stat-number { color: #7b6cf6; }
.stat-card.jalan   .stat-number { color: #f59e0b; }
.stat-card.selesai .stat-number { color: #10b981; }

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
.filter-bar input { flex: 1; min-width: 220px; }
.btn-cari {
    padding: 10px 22px;
    border-radius: 10px;
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    border: none;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: .2s;
    display: flex;
    align-items: center;
    gap: 6px;
}
.btn-cari:hover { transform: translateY(-1px); box-shadow: 0 8px 20px -8px rgba(123,108,246,.7); }

/* ===== CARD / TABLE ===== */
.card {
    background: #fff;
    border: 1.5px solid #e0e3fa;
    border-radius: 18px;
    box-shadow: 0 10px 30px -20px rgba(80,70,200,.2);
    overflow: hidden;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
.data-table th, .data-table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid #edf0ff;
}
.data-table th {
    background: #f8f9ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    border-bottom: 2px solid #e0e3fa;
}
.data-table tr:hover td { background: #fcfcff; }
.data-table tr:last-child td { border-bottom: none; }

.badge {
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
    white-space: nowrap;
}
.badge.mencari-tim  { background: #ede9fe; color: #6d28d9; }
.badge.berjalan     { background: #fef3c7; color: #92400e; }
.badge.selesai      { background: #d1fae5; color: #065f46; }
.badge.lainnya      { background: #f3f4f6; color: #374151; }

.project-title {
    font-weight: 700;
    color: #1c2766;
    font-size: 14px;
}
.project-date {
    font-size: 12px;
    color: #9ca3af;
    margin-top: 2px;
}
.budget-text {
    font-weight: 700;
    color: #2b3a8f;
}

.empty-state {
    padding: 60px 20px;
    text-align: center;
    color: #9ca3af;
}
.empty-state svg {
    width: 48px;
    height: 48px;
    margin: 0 auto 12px;
    opacity: .4;
}
.empty-state p { font-size: 15px; font-weight: 600; }

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
</style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <a class="brand" href="/dashboard" aria-label="SkillConnect">
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
                <a href="/admin/proyek" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    Proyek
                </a>
                <a href="/transaksi" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Transaksi
                </a>
                <a href="/laporan" class="nav-item">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan
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
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'A', 0, 1) }}</div>
            </div>
        </header>

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Pantau Proyek</h1>
            <p class="page-desc">Daftar seluruh proyek yang terdaftar di platform SkillConnect. Admin hanya dapat memantau.</p>
        </div>

        <!-- STAT CARDS -->
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-number">{{ $totalProjects }}</div>
                <div class="stat-label">Total Proyek</div>
            </div>
            <div class="stat-card cari">
                <div class="stat-number">{{ $mencariTim }}</div>
                <div class="stat-label">Mencari Tim</div>
            </div>
            <div class="stat-card jalan">
                <div class="stat-number">{{ $berjalan }}</div>
                <div class="stat-label">Berjalan</div>
            </div>
            <div class="stat-card selesai">
                <div class="stat-number">{{ $selesai }}</div>
                <div class="stat-label">Selesai</div>
            </div>
        </div>

        <!-- FILTER BAR -->
        <div class="filter-bar">
            <input type="text" id="searchInput" placeholder="Cari judul proyek, creator, atau kategori..." oninput="filterTable()">
            <select id="filterStatus" onchange="filterTable()">
                <option value="">Semua Status</option>
                <option value="Mencari Tim">Mencari Tim</option>
                <option value="Berjalan">Berjalan</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>

        <!-- TABLE -->
        <div class="card">
            <table class="data-table" id="proyekTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Proyek</th>
                        <th>Creator</th>
                        <th>Kategori</th>
                        <th>Budget</th>
                        <th>Anggota</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $i => $project)
                    <tr data-title="{{ strtolower($project->judul_project ?? '') }}"
                        data-creator="{{ strtolower($project->creator->name ?? '') }}"
                        data-kategori="{{ strtolower($project->kategori ?? '') }}"
                        data-status="{{ $project->status_project ?? '' }}">
                        <td style="color:#9ca3af;font-weight:600;">{{ $i + 1 }}</td>
                        <td>
                            <div class="project-title">{{ $project->judul_project ?? '-' }}</div>
                            <div class="project-date">{{ optional($project->created_at)->format('d M Y') }}</div>
                        </td>
                        <td>{{ $project->creator->name ?? '-' }}</td>
                        <td>{{ $project->kategori ?? '-' }}</td>
                        <td class="budget-text">
                            Rp {{ number_format($project->budget ?? 0, 0, ',', '.') }}
                        </td>
                        <td style="text-align:center;font-weight:700;color:#2b3a8f;">
                            {{ $project->members->count() ?? 0 }}
                        </td>
                        <td>
                            @php $status = $project->status_project ?? 'Lainnya'; @endphp
                            @if($status === 'Mencari Tim')
                                <span class="badge mencari-tim">Mencari Tim</span>
                            @elseif($status === 'Berjalan')
                                <span class="badge berjalan">Berjalan</span>
                            @elseif($status === 'Selesai')
                                <span class="badge selesai">Selesai</span>
                            @else
                                <span class="badge lainnya">{{ $status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                                <p>Belum ada proyek yang terdaftar.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

<script>
function filterTable() {
    const search  = document.getElementById('searchInput').value.toLowerCase();
    const status  = document.getElementById('filterStatus').value;
    const rows    = document.querySelectorAll('#proyekTable tbody tr[data-title]');

    rows.forEach(row => {
        const title    = row.dataset.title    || '';
        const creator  = row.dataset.creator  || '';
        const kategori = row.dataset.kategori || '';
        const rowStatus = row.dataset.status  || '';

        const matchSearch = !search || title.includes(search) || creator.includes(search) || kategori.includes(search);
        const matchStatus = !status || rowStatus === status;

        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}
</script>
</body>
</html>
