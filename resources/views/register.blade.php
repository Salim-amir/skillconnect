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
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
            </div>
            
            <button type="submit" class="btn pri">Daftar Sekarang</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
