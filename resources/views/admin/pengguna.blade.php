<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Kelola Pengguna - SkillConnect</title>
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
    margin-bottom: 24px;
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
}
.badge.admin { background: #e5ebff; color: #2b3a8f; }
.badge.member { background: #f4e5ff; color: #7b4fe8; }

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
.btn.danger {
    background: #d8000c;
    color: #fff;
}
.btn.danger:hover {
    background: #b00009;
}
.btn.ghost {
    background: #eef0ff;
    color: #2b3a8f;
}
.btn.ghost:hover {
    background: #e0e3fa;
}

/* ===== ALERT ===== */
.alert {
    padding: 14px 18px;
    border-radius: 12px;
    margin-bottom: 20px;
    font-weight: 700;
    font-size: 14px;
}
.alert.success { background: #e6f7ed; color: #127345; border: 1px solid #b7e4c7; }
.alert.error { background: #fdecec; color: #b00009; border: 1px solid #f5b5b5; }

/* ===== ACTION LINKS ===== */
.action-link {
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-family: 'Nunito', sans-serif;
}
.action-link.edit { color: #2b3a8f; margin-right: 12px; }
.action-link.edit:hover { text-decoration: underline; }
.action-link.delete { color: #d8000c; }
.action-link.delete:hover { text-decoration: underline; }

/* ===== MODAL ===== */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(28, 39, 102, .5);
    backdrop-filter: blur(3px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    padding: 20px;
}
.modal-overlay.active { display: flex; }
.modal {
    background: #fff;
    border-radius: 18px;
    width: 100%;
    max-width: 460px;
    box-shadow: 0 30px 60px -20px rgba(80,70,200,.5);
    overflow: hidden;
    animation: pop .2s ease;
}
@keyframes pop {
    from { transform: scale(.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.modal-header {
    padding: 22px 26px;
    border-bottom: 1.5px solid #edf0ff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.modal-title {
    font-family: 'Fredoka', sans-serif;
    font-size: 20px;
    color: #1c2766;
}
.modal-close {
    background: none;
    border: none;
    font-size: 26px;
    line-height: 1;
    color: #8f9bd8;
    cursor: pointer;
}
.modal-close:hover { color: #1c2766; }
.modal-body {
    padding: 24px 26px;
}
.modal-footer {
    padding: 18px 26px;
    border-top: 1.5px solid #edf0ff;
    display: flex;
    justify-content: flex-end;
    gap: 12px;
}

/* ===== FORM ===== */
.form-group {
    margin-bottom: 18px;
}
.form-group label {
    display: block;
    font-weight: 700;
    font-size: 13px;
    color: #4b5686;
    margin-bottom: 6px;
}
.form-group input,
.form-group select {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #e0e3fa;
    border-radius: 10px;
    font-family: 'Nunito', sans-serif;
    font-size: 14px;
    color: #1c2766;
    transition: .2s;
}
.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #7b6cf6;
    box-shadow: 0 0 0 3px rgba(123,108,246,.15);
}
.form-hint {
    font-size: 12px;
    color: #8f9bd8;
    font-weight: 600;
    margin-top: 4px;
    display: block;
}
.form-error {
    color: #d8000c;
    font-size: 12px;
    font-weight: 700;
    margin-top: 4px;
    display: block;
}

/* ===== LOGOUT ===== */
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
}
.nav-item.logout svg { color: #d8000c; }
.nav-item.logout:hover {
    background: #fdecec;
    color: #b00009;
}
.nav-item.logout:hover svg { color: #b00009; }
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
                <a href="/pengguna" class="nav-item active">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Pengguna
                </a>
                <a href="/admin/proyek" class="nav-item">
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
                    <div class="name">{{ auth()->check() ? auth()->user()->name : 'Nama Pengguna' }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="avatar">{{ substr(auth()->check() ? auth()->user()->name : 'U', 0, 1) }}</div>
            </div>
        </header>

        <div class="page-header">
            <h1 class="page-title">Kelola Pengguna</h1>
            <button type="button" class="btn pri" onclick="openCreateModal()">+ Tambah Pengguna</button>
        </div>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        @if($errors->any() && !old('_edit_id') && old('_form') !== 'create')
            <div class="alert error">
                <ul style="margin-left: 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat Email</th>
                            <th>Role</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td style="color: #8f9bd8; font-weight: 600;">#{{ $loop->iteration }}</td>
                            <td style="font-weight: 700; color: #1c2766;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role === 'admin')
                                    <span class="badge admin">Admin</span>
                                @else
                                    <span class="badge member">Member</span>
                                @endif
                            </td>
                            <td style="color: #8f9bd8;">{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <button type="button" class="action-link edit"
                                    onclick="openEditModal(this)"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ $user->role }}">Edit</button>
                                <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna {{ addslashes($user->name) }}? Tindakan ini tidak dapat dibatalkan.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- ===== MODAL EDIT PENGGUNA ===== -->
    <div class="modal-overlay" id="editModal" onclick="if(event.target === this) closeEditModal();">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
            <div class="modal-header">
                <h2 class="modal-title" id="editModalTitle">Edit Pengguna : user ID {{ $user->id }}</h2>
                <button type="button" class="modal-close" onclick="closeEditModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="_edit_id" value="{{ old('_edit_id') }}">
                <input type="hidden" name="_form" value="edit">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Nama Lengkap</label>
                        <input type="text" id="edit_name" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Alamat Email</label>
                        <input type="email" id="edit_email" name="email" value="{{ old('email') }}" required>
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_role">Role</label>
                        <select id="edit_role" name="role" required>
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="edit_password">Password Baru</label>
                        <input type="password" id="edit_password" name="password" autocomplete="new-password">
                        <span class="form-hint">Kosongkan jika tidak ingin mengubah password.</span>
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn pri">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH PENGGUNA ===== -->
    <div class="modal-overlay" id="createModal" onclick="if(event.target === this) closeCreateModal();">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="createModalTitle">
            <div class="modal-header">
                <h2 class="modal-title" id="createModalTitle">Tambah Pengguna</h2>
                <button type="button" class="modal-close" onclick="closeCreateModal()" aria-label="Tutup">&times;</button>
            </div>
            <form id="createForm" method="POST" action="{{ route('pengguna.store') }}">
                @csrf
                <input type="hidden" name="_form" value="create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="create_name">Nama Lengkap</label>
                        <input type="text" id="create_name" name="name" value="{{ old('name') }}" required>
                        @error('name') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_email">Alamat Email</label>
                        <input type="email" id="create_email" name="email" value="{{ old('email') }}" required>
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_role">Role</label>
                        <select id="create_role" name="role" required>
                            <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="create_password">Password</label>
                        <input type="password" id="create_password" name="password" autocomplete="new-password" required>
                        <span class="form-hint">Minimal 8 karakter.</span>
                        @error('password') <span class="form-error">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn ghost" onclick="closeCreateModal()">Batal</button>
                    <button type="submit" class="btn pri">Simpan Pengguna</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('editModal');
        const editForm = document.getElementById('editForm');
        const createModal = document.getElementById('createModal');
        const createForm = document.getElementById('createForm');

        // ===== MODAL EDIT =====
        function openEditModal(button) {
            const id    = button.getAttribute('data-id');
            const name  = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const role  = button.getAttribute('data-role');

            // Set action form ke route update
            editForm.action = '/pengguna/' + id;
            document.getElementById('edit_id').value = id;

            // Isi nilai form
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role').value = role;
            document.getElementById('edit_password').value = '';

            // Hapus pesan error lama (jika ada)
            document.querySelectorAll('#editForm .form-error').forEach(el => el.remove());

            editModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            editModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // ===== MODAL TAMBAH =====
        function openCreateModal() {
            // Reset form ke kondisi bersih
            createForm.reset();

            // Hapus pesan error lama (jika ada)
            document.querySelectorAll('#createForm .form-error').forEach(el => el.remove());

            createModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeCreateModal() {
            createModal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Tutup modal aktif dengan tombol ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                if (editModal.classList.contains('active')) {
                    closeEditModal();
                }
                if (createModal.classList.contains('active')) {
                    closeCreateModal();
                }
            }
        });

        // Jika ada error validasi setelah submit, buka kembali modal yang sesuai
        @if($errors->any())
            @if(old('_form') === 'create')
                createModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            @else
                editForm.action = '/pengguna/' + document.getElementById('edit_id').value;
                editModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            @endif
        @endif
    </script>

</body>
</html>
