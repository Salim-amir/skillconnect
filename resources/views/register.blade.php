<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Daftar - SkillConnect</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--bg:#ffffff;--ink:#0a0a0a;--mute:#525252;--line:rgba(0,0,0,.06);--card:rgba(255,255,255,.6);--primary:#ff007f;--secondary:#7000ff;--tertiary:#00d4ff;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{scroll-behavior:smooth;scroll-padding-top:72px;background:var(--bg)}
*{box-sizing:border-box;margin:0}
body{background:linear-gradient(180deg,#eef0ff,#f4f1ff 50%,#eaf1ff);color:var(--ink);font-family:'Nunito',system-ui,sans-serif;line-height:1.6;overflow-x:hidden; display:flex; justify-content:center; align-items:center; min-height:100vh; padding: 40px 0;}
a{color:inherit;text-decoration:none}
a:focus-visible,button:focus-visible{outline:2px solid var(--secondary);outline-offset:3px}

.blob{position:absolute;border-radius:50%;filter:blur(48px);opacity:.42;animation:bl 14s ease-in-out infinite; z-index: -1;}
@keyframes bl{50%{transform:translate(30px,-26px) scale(1.12)}}

.auth-container {
    background: #fff;
    box-shadow: 0 20px 44px -26px rgba(80,70,200,.4);
    border: 1.5px solid #e0e3fa;
    border-radius: 24px;
    padding: 40px;
    width: 100%;
    max-width: 460px;
    position: relative;
    z-index: 10;
}

.auth-container h2 {
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 32px;
    color: #1c2766;
    margin-bottom: 24px;
    text-align: center;
}

.auth-container .brand {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-family: 'Fredoka', sans-serif;
    font-weight: 700;
    font-size: 19px;
    letter-spacing: .05em;
    margin-bottom: 30px;
}
.auth-container .brand svg { width: 44px; height: 22px; }
.auth-container .brand span {
    background: linear-gradient(90deg,#1c2766,#7b6cf6);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: #4b5686;
    margin-bottom: 8px;
}

.form-group input, .form-group select {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e0e3fa;
    border-radius: 12px;
    font-family: 'Nunito', sans-serif;
    font-size: 15px;
    outline: none;
    transition: border-color .2s;
}

.form-group input:focus, .form-group select:focus {
    border-color: #7b6cf6;
}

/* --- Wrapper & Penataan Tombol Password di Dalam Input --- */
.password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.password-wrapper input {
    padding-right: 45px; /* Memberikan ruang agar teks tidak tertutup ikon */
}

.toggle-btn {
    position: absolute;
    right: 12px;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7b6cf6;
    outline: none;
}

.toggle-btn svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
}
/* -------------------------------------------------------- */

.btn {
    display: inline-block;
    width: 100%;
    text-align: center;
    padding: 14px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 16px;
    border: 1.5px solid #d6d9fb;
    transition: .2s;
    font-family: 'Nunito', sans-serif;
    cursor: pointer;
}

.btn.pri {
    background: linear-gradient(90deg,#2b3a8f,#7b6cf6);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 10px 26px -10px rgba(123,108,246,.7);
}

.btn.pri:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px -10px rgba(123,108,246,.75);
}

.divider {
    display: flex;
    align-items: center;
    text-align: center;
    margin: 20px 0;
    color: #8b95b5;
    font-size: 13px;
    font-weight: 600;
}
.divider::before,
.divider::after {
    content: '';
    flex: 1;
    border-bottom: 1.5px solid #e0e3fa;
}
.divider:not(:empty)::before {
    margin-right: 12px;
}
.divider:not(:empty)::after {
    margin-left: 12px;
}

.btn-google {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    padding: 12px 20px;
    border-radius: 12px;
    background: #ffffff;
    border: 1.5px solid #e0e3fa;
    color: #2b3648;
    font-size: 15px;
    font-weight: 600;
    font-family: 'Nunito', sans-serif;
    text-decoration: none;
    transition: all .2s ease;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
}

.btn-google:hover {
    background: #f8f9ff;
    border-color: #c4cbf7;
    box-shadow: 0 6px 16px -4px rgba(80, 70, 200, 0.15);
    transform: translateY(-2px);
    color: #1c2766;
}

.btn-google svg {
    flex-shrink: 0;
}

.auth-footer {
    margin-top: 24px;
    text-align: center;
    font-size: 14px;
    color: #4b5686;
}
.auth-footer a {
    color: #7b6cf6;
    font-weight: 700;
}
.auth-footer a:hover {
    text-decoration: underline;
}

.alert {
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}
.alert-danger {
    background: #ffe5e5;
    color: #d8000c;
    border: 1.5px solid #ffbaba;
}
</style>
</head>
<body>
    <span class="blob" style="width:280px;height:280px;left:20%;top:10%;background:#a99bff"></span>
    <span class="blob" style="width:300px;height:300px;right:20%;bottom:10%;background:#e08cff;animation-delay:-5s"></span>

    <div class="auth-container">
        <a class="brand" href="/" aria-label="SkillConnect">
            <svg viewBox="0 0 64 32" fill="none">
              <defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
              <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/>
            </svg>
            <span>SKILL CONNECT</span>
        </a>
        
        <h2>Buat Akun Baru</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: user@email.com" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" id="togglePassword" class="toggle-btn" aria-label="Toggle password visibility">
                        <!-- Icon SVG Mata (Show) -->
                        <svg id="eyeShow" viewBox="0 0 24 24">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                        </svg>
                        <!-- Icon SVG Mata Silang (Hide) -->
                        <svg id="eyeHide" viewBox="0 0 24 24" style="display: none;">
                            <path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.17c0-1.66-1.34-3-3-3l-.17.02z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn pri">Daftar Sekarang</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
            </svg>
            <span>Lanjutkan dengan Google</span>
        </a>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

    <!-- Script Logika Toggle Show/Hide Password -->
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeShow = document.getElementById('eyeShow');
            const eyeHide = document.getElementById('eyeHide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeShow.style.display = 'none';
                eyeHide.style.display = 'block';
            } else {
                passwordInput.type = 'password';
                eyeShow.style.display = 'block';
                eyeHide.style.display = 'none';
            }
        });
    </script>
</body>
</html>