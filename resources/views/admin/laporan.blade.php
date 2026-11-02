<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Laporan - SkillConnect</title>
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
    align-items: center;
    margin-bottom: 10px;
}

.page-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 28px;
    color: #1c2766;
}

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
    padding: 16px 24px;
    text-align: left;
    border-bottom: 1px solid #edf0ff;
    vertical-align: top;
}
.data-table th {
    background: #f8f9ff;
    color: #4b5686;
    font-weight: 700;
    font-family: 'Fredoka', sans-serif;
    border-bottom: 2px solid #e0e3fa;
}
.data-table tr:hover td {
    background: #fcfcff;
}
.data-table tr:last-child td {
    border-bottom: none;
}

.badge {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
    display: inline-block;
    white-space: nowrap;
}
.badge.success { background: #e5ffe5; color: #008000; }
.badge.warning { background: #fff5e5; color: #cc7700; }
.badge.danger { background: #ffe5e5; color: #cc0000; }
.badge.info { background: #e5f2ff; color: #0055cc; }

.btn {
    display: inline-block;
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
    background: transparent;
    color: #4b5686;
    border-color: #d6d9fb;
}
.btn.ghost:hover {
    background: #f4f6ff;
    color: #1c2766;
}
/* ===== RINGKASAN LAPORAN ===== */
.grid-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 8px;
}
@media(max-width: 1024px) {
    .grid-stats { grid-template-columns: repeat(2, 1fr); }
}

.stat-card { padding: 24px; }
.card-title {
    font-size: 15px;
    font-weight: 600;
    color: #4b5686;
    margin-bottom: 12px;
}
.stat-value {
    font-family: 'Fredoka', sans-serif;
    font-size: 32px;
    font-weight: 700;
    color: #1c2766;
    line-height: 1.2;
}
.stat-sub {
    font-size: 12.5px;
    color: #8f9bd8;
    font-weight: 600;
    margin-top: 4px;
}

.report-meta {
    font-size: 13px;
    color: #8f9bd8;
    font-weight: 600;
    margin-bottom: 24px;
}

/* ===== SECTION HEADER ===== */
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 34px 0 16px;
}
.section-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: #1c2766;
    display: flex;
    align-items: center;
    gap: 10px;
}
.section-title svg {
    width: 22px;
    height: 22px;
    color: #7b6cf6;
}

.count-pill {
    background: #eef0ff;
    color: #2b3a8f;
    padding: 5px 14px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 700;
    display: inline-block;
    border: 1px solid #d6d9fb;
}

.table-responsive { overflow-x: auto; }

/* ===== SKILL CHIPS ===== */
.skill-chip {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    margin: 2px 4px 2px 0;
    border: 1px solid transparent;
    white-space: nowrap;
}
.skill-chip.level-Beginner { background: #e5f2ff; color: #0055cc; border-color: #c9e4ff; }
.skill-chip.level-Intermediate { background: #fff5e5; color: #cc7700; border-color: #ffe4b8; }
.skill-chip.level-Advanced { background: #e5ffe5; color: #008000; border-color: #c9f5c9; }
.skill-chip.plain { background: #f4f6ff; color: #4b5686; border-color: #d6d9fb; }

/* ===== PROYEK AKTIF & MEMBER ===== */
.project-card { margin-bottom: 24px; }

.project-card-head {
    padding: 20px 24px;
    background: #f8f9ff;
    border-bottom: 1.5px solid #e0e3fa;
    display: flex;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    align-items: flex-start;
}

.project-name {
    font-family: 'Fredoka', sans-serif;
    font-size: 17px;
    color: #1c2766;
    margin-bottom: 4px;
}

.project-meta {
    font-size: 13px;
    color: #4b5686;
    font-weight: 600;
}

.project-badges {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

.kategori-pill {
    background: #eef0ff;
    color: #2b3a8f;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 700;
}

.member-table th { background: #fbfbff; }

.empty-row {
    text-align: center !important;
    color: #8f9bd8;
    padding: 22px 24px !important;
    font-weight: 600;
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

/* ===== PRINT / EXPORT ===== */
@media print {
    .sidebar, .top-bar, .btn, .no-print { display: none !important; }
    .main-content { margin-left: 0; padding: 0; }
    body { background: #fff; }
    .card, .project-card { box-shadow: none; break-inside: avoid; page-break-inside: avoid; }
    .section-header { margin-top: 22px; }
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
            <div class="user-profile">
                <div class="user-info">
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Admin' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'A', 0, 1) }}</div>
            </div>
        </header>

        <div class="page-header">
            <h1 class="page-title">Laporan Data Pengguna, Skill &amp; Proyek</h1>
            <button class="btn pri no-print" onclick="window.print()">Export Laporan</button>
        </div>
        <p class="report-meta">Dicetak pada {{ now()->format('d/m/Y H:i') }} &bull; Total {{ $totalProjects }} proyek tercatat pada sistem</p>

        <!-- RINGKASAN ANGKA LAPORAN -->
        <div class="grid-stats">
            <div class="card stat-card">
                <div class="card-title">Total Pengguna</div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-sub">{{ $totalMembers }} member &bull; {{ $totalAdmins }} admin</div>
            </div>
            <div class="card stat-card">
                <div class="card-title">Skill Pengguna Terdaftar</div>
                <div class="stat-value">{{ $totalUserSkills }}</div>
                <div class="stat-sub">Data skill pada seluruh pengguna</div>
            </div>
            <div class="card stat-card">
                <div class="card-title">Proyek Aktif</div>
                <div class="stat-value">{{ $totalActiveProjects }}</div>
                <div class="stat-sub">Mencari Tim / Berjalan</div>
            </div>
            <div class="card stat-card">
                <div class="card-title">Member Proyek Aktif</div>
                <div class="stat-value">{{ $totalProjectMembers }}</div>
                <div class="stat-sub">Keanggotaan pada proyek aktif</div>
            </div>
        </div>

        <!-- BAGIAN 1: DATA PENGGUNA + SKILL -->
        <div class="section-header">
            <h2 class="section-title">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6-4a4 4 0 11-4-4"></path></svg>
                Data Pengguna &amp; Skill
            </h2>
            <span class="count-pill">{{ $totalUsers }} pengguna &bull; {{ $totalUserSkills }} skill</span>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Skill (Tingkat Keahlian)</th>
                            <th style="text-align: center;">Jumlah Skill</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $u)
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">{{ $users->firstItem() + $i }}</td>
                            <td style="font-weight: 700; color: #1c2766;">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                <span class="badge {{ $u->role === 'admin' ? 'info' : 'success' }}">
                                    {{ $u->role === 'admin' ? 'Admin' : 'Member' }}
                                </span>
                            </td>
                            <td>
                                @if($u->skills->isEmpty())
                                    <span style="color: #8f9bd8; font-style: italic;">Belum ada skill</span>
                                @else
                                    @foreach($u->skills as $skill)
                                        <span class="skill-chip level-{{ $skill->pivot->tingkat_keahlian }}">{{ $skill->nama_skill }} &bull; {{ $skill->pivot->tingkat_keahlian }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <span class="count-pill">{{ $u->skills->count() }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="empty-row">Belum ada data pengguna.</td>
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
                        <span class="page-btn disabled">&laquo; Sebelumnya</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="page-btn">&laquo; Sebelumnya</a>
                    @endif

                    @for($p = 1; $p <= $users->lastPage(); $p++)
                        @if($p == $users->currentPage())
                            <span class="page-btn active">{{ $p }}</span>
                        @else
                            <a href="{{ $users->url($p) }}" class="page-btn">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="page-btn">Berikutnya &raquo;</a>
                    @else
                        <span class="page-btn disabled">Berikutnya &raquo;</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
        <!-- BAGIAN 2: PROYEK AKTIF + INFORMASI MEMBER -->
        <div class="section-header">
            <h2 class="section-title">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                Proyek Aktif &amp; Informasi Member
            </h2>
            <span class="count-pill">{{ $totalActiveProjects }} proyek aktif &bull; {{ $totalProjectMembers }} member</span>
        </div>

        @forelse($activeProjects as $project)
        <div class="card project-card">
            <div class="project-card-head">
                <div>
                    <div class="project-name">{{ $project->judul_project }}</div>
                    <div class="project-meta">
                        Dibuat oleh <strong>{{ $project->creator->name ?? '-' }}</strong>
                        &bull; Budget <strong style="color: #2b3a8f;">Rp {{ number_format($project->budget, 0, ',', '.') }}</strong>
                        &bull; {{ $project->members->count() }} member
                        &bull; Dibuat {{ $project->created_at ? $project->created_at->format('d M Y') : '-' }}
                    </div>
                    @if($project->skills->isNotEmpty())
                    <div style="margin-top: 8px;">
                        @foreach($project->skills as $ps)
                            <span class="skill-chip plain">{{ $ps->nama_skill }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="project-badges">
                    <span class="kategori-pill">{{ $project->kategori }}</span>
                    @if($project->status_project === 'Berjalan')
                        <span class="badge warning">{{ $project->status_project }}</span>
                    @elseif($project->status_project === 'Mencari Tim')
                        <span class="badge info">{{ $project->status_project }}</span>
                    @else
                        <span class="badge success">{{ $project->status_project }}</span>
                    @endif
                </div>
            </div>

            <div class="table-responsive">
                <table class="data-table member-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Member</th>
                            <th>Email</th>
                            <th>Peran di Proyek</th>
                            <th>Fee</th>
                            <th>Status Keanggotaan</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($project->members as $j => $member)
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">{{ $j + 1 }}</td>
                            <td style="font-weight: 700; color: #1c2766;">{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->pivot->peran }}</td>
                            <td style="font-weight: 700; color: #2b3a8f;">Rp {{ number_format($member->pivot->nominal_fee, 0, ',', '.') }}</td>
                            <td>
                                @if($member->pivot->status_keanggotaan === 'Diterima')
                                    <span class="badge success">Diterima</span>
                                @elseif($member->pivot->status_keanggotaan === 'Pending')
                                    <span class="badge warning">Pending</span>
                                @else
                                    <span class="badge danger">{{ $member->pivot->status_keanggotaan }}</span>
                                @endif
                            </td>
                            <td>{{ $member->pivot->created_at ? \Carbon\Carbon::parse($member->pivot->created_at)->format('d M Y') : '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty-row">Belum ada member yang tergabung dalam proyek ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @empty
        <div class="card" style="padding: 40px; text-align: center;">
            <div style="font-family: 'Fredoka', sans-serif; font-size: 17px; color: #1c2766; margin-bottom: 6px;">Belum ada proyek aktif</div>
            <div style="color: #8f9bd8; font-weight: 600; font-size: 14px;">Semua proyek pada sistem saat ini berstatus Selesai.</div>
        </div>
        @endforelse
    </main>
</body>
</html>
