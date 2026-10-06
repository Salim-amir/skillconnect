<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uji Autentikasi - SkillConnect</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 40px 20px;
            background: #f4f6f9; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            margin-bottom: 16px;
            color: #333;
        }

        .card { 
            background: white; 
            padding: 24px; 
            border-radius: 8px; 
            margin-bottom: 20px; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.08); 
            width: 100%;
            max-width: 480px;
            box-sizing: border-box;
        }

        /* Notifikasi Inline */
        .alert-box {
            display: none;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            max-width: 480px;
            box-sizing: border-box;
            line-height: 1.4;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        input, select, button { 
            width: 100%; 
            padding: 10px 12px; 
            margin: 8px 0; 
            box-sizing: border-box; 
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button { 
            background: #007bff; 
            color: white; 
            border: none; 
            cursor: pointer; 
            font-weight: bold;
            transition: background 0.2s;
        }

        button:hover { 
            background: #0056b3; 
        }

        pre { 
            background: #272822; 
            color: #f8f8f2; 
            padding: 12px; 
            border-radius: 4px; 
            overflow-x: auto; 
            font-size: 13px;
        }
    </style>
</head>
<body>

    <h2>SkillConnect - Panel Uji Autentikasi API</h2>

    <!-- Elemen Notifikasi Inline Form -->
    <div id="inlineAlert" class="alert-box"></div>

    <!-- Form Register -->
    <div class="card">
        <h3>Register</h3>
        <input type="text" id="reg_name" placeholder="Nama Lengkap">
        <input type="email" id="reg_email" placeholder="Email">
        <input type="password" id="reg_password" placeholder="Password">
        <select id="reg_role">
            <option value="creator">Creator</option>
            <option value="member">Member</option>
            <option value="admin">Admin</option>
        </select>
        <button onclick="handleRegister()">Register</button>
    </div>

    <!-- Form Login -->
    <div class="card">
        <h3>Sudah punya akun?</h3>
        <input type="email" id="login_email" placeholder="Email">
        <input type="password" id="login_password" placeholder="Password">
        <button onclick="handleLogin()">Login</button>
    </div>

    <!-- Log Respons / Output Debug -->
    <div class="card">
        <h3>Respons JSON</h3>
        <pre id="output">Belum ada aksi...</pre>
    </div>

    <script>
        let authToken = localStorage.getItem('token') || '';

        function showAlert(message, type = 'danger') {
            const alertEl = document.getElementById('inlineAlert');
            alertEl.className = 'alert-box alert-' + type;
            alertEl.innerHTML = message;
            alertEl.style.display = 'block';
        }

        function hideAlert() {
            document.getElementById('inlineAlert').style.display = 'none';
        }

        function logOutput(data) {
            document.getElementById('output').textContent = JSON.stringify(data, null, 2);
        }

        // --- HANDLER REGISTER ---
        async function handleRegister() {
            hideAlert();
            const name = document.getElementById('reg_name').value.trim();
            const email = document.getElementById('reg_email').value.trim();
            const password = document.getElementById('reg_password').value.trim();
            const role = document.getElementById('reg_role').value;

            if (!name || !email || !password) {
                showAlert('⚠️ Harap isi semua bidang input register!', 'warning');
                return;
            }

            try {
                const res = await fetch('/api/register', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json' 
                    },
                    body: JSON.stringify({ name, email, password, role })
                });

                const data = await res.json();
                logOutput(data);

                if (res.ok) {
                    showAlert('✅ Register Berhasil! Silakan lanjut Login.', 'success');
                    if (data.token) {
                        authToken = data.token;
                        localStorage.setItem('token', authToken);
                    }
                } else {
                    if (data.errors && data.errors.email) {
                        showAlert('❌ Register Gagal: ' + data.errors.email[0], 'danger');
                    } else if (data.message) {
                        showAlert('❌ Register Gagal: ' + data.message, 'danger');
                    } else {
                        showAlert('❌ Register Gagal! Periksa kembali inputan Anda.', 'danger');
                    }
                }
            } catch (err) {
                showAlert('💥 Terjadi kesalahan koneksi ke server!', 'danger');
                console.error(err);
            }
        }

        // --- HANDLER LOGIN ---
        async function handleLogin() {
            hideAlert();
            const email = document.getElementById('login_email').value.trim();
            const password = document.getElementById('login_password').value.trim();

            if (!email || !password) {
                showAlert('⚠️ Harap isi Email dan Password!', 'warning');
                return;
            }

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'Accept': 'application/json' 
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await res.json();
                logOutput(data);

                if (res.ok) {
                    showAlert('✅ Login Berhasil! Welcome ' + (data.user?.name || 'User'), 'success');
                    if (data.token) {
                        authToken = data.token;
                        localStorage.setItem('token', authToken);
                    }
                } else {
                    if (res.status === 401 || (data.message && data.message.toLowerCase().includes('invalid'))) {
                        showAlert('❌ Login Gagal: Email atau Password salah!', 'danger');
                    } else if (data.errors) {
                        const firstErrKey = Object.keys(data.errors)[0];
                        showAlert('❌ Login Gagal: ' + data.errors[firstErrKey][0], 'danger');
                    } else {
                        showAlert('❌ Login Gagal: ' + (data.message || 'Email atau Password tidak cocok!'), 'danger');
                    }
                }
            } catch (err) {
                showAlert('💥 Terjadi kesalahan koneksi ke server!', 'danger');
                console.error(err);
            }
        }
    </script>
</body>
</html>