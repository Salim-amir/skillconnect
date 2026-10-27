<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Atur Ulang Kata Sandi - SkillConnect</title>
<meta name="description" content="Atur ulang kata sandi akun SkillConnect Anda untuk mengamankan akses akun.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@600;700;800&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --bg: #eef0ff;
  --ink: #1c2766;
  --mute: #64748b;
  --line: #d6d9fb;
  --blue: #2b3a8f;
  --violet: #7b6cf6;
  --purple: #c26bf0;
}
html, body {
  min-height: 100vh;
  font-family: 'Nunito', system-ui, sans-serif;
  color: var(--ink);
  background: radial-gradient(55% 65% at 28% 48%, rgba(123, 108, 246, 0.22), transparent 70%),
              radial-gradient(40% 50% at 82% 20%, rgba(236, 170, 255, 0.35), transparent 70%),
              radial-gradient(45% 55% at 10% 85%, rgba(120, 180, 255, 0.32), transparent 70%),
              linear-gradient(135deg, #eef0ff 0%, #f6f3ff 50%, #fcf5ff 100%);
  background-attachment: fixed;
  display: flex;
  flex-direction: column;
}
a { color: inherit; text-decoration: none; }

header {
  padding: 24px 5vw;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  font-family: 'Fredoka', sans-serif;
  font-weight: 700;
  font-size: 19px;
  letter-spacing: .05em;
  color: var(--ink);
}
.brand svg { width: 44px; height: 22px; }
.brand span {
  background: linear-gradient(90deg, #1c2766, #7b6cf6);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

main {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 30px 20px 60px;
}
.card {
  width: 100%;
  max-width: 460px;
  background: rgba(255, 255, 255, 0.94);
  backdrop-filter: blur(14px);
  border: 1px solid #fff;
  border-radius: 28px;
  padding: 34px 32px 30px;
  box-shadow: 0 40px 80px -34px rgba(80, 70, 200, 0.4),
              16px 16px 0 -2px rgba(194, 107, 240, 0.14),
              -12px -12px 0 -2px rgba(111, 177, 255, 0.2);
}
.card h1 {
  font-family: 'Fredoka', sans-serif;
  font-weight: 800;
  font-size: 24px;
  margin-bottom: 6px;
  color: var(--ink);
}
.card .sub {
  color: var(--mute);
  font-size: 14px;
  line-height: 1.45;
  margin-bottom: 20px;
}
.f {
  display: block;
  margin-bottom: 14px;
}
.f span {
  display: block;
  font-size: 13px;
  font-weight: 700;
  margin-bottom: 4px;
  color: var(--ink);
}
.f input {
  width: 100%;
  padding: 11px 14px;
  border: 1.5px solid var(--line);
  border-radius: 14px;
  font: 14px 'Nunito', sans-serif;
  color: var(--ink);
  background: #fbfbff;
  transition: all 0.2s;
}
.f input:focus {
  outline: 0;
  border-color: var(--violet);
  box-shadow: 0 0 0 4px rgba(123, 108, 246, 0.18);
  background: #fff;
}
.f input[readonly] {
  background: #f1f3fd;
  color: var(--mute);
  cursor: not-allowed;
}
.pw {
  position: relative;
}
.pw input {
  padding-right: 100px;
}
.pw button.tg {
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
  border: 0;
  background: none;
  color: var(--blue);
  font: 700 12px 'Nunito', sans-serif;
  padding: 6px 10px;
  cursor: pointer;
  border-radius: 8px;
}
.pw button.tg:hover {
  background: #eef0ff;
}
.meter {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 5px;
  margin-top: 6px;
}
.meter i {
  height: 4px;
  border-radius: 5px;
  background: #e3e5fa;
  transition: background .25s;
}
.meter i.on {
  background: var(--c);
}
.mt {
  font-size: 12px;
  color: var(--mute);
  margin-top: 3px;
  min-height: 16px;
}
.go {
  width: 100%;
  margin-top: 8px;
  padding: 12px;
  border: 0;
  border-radius: 14px;
  color: #fff;
  font: 700 14.5px 'Nunito', sans-serif;
  cursor: pointer;
  background: linear-gradient(90deg, #2b3a8f, #7b6cf6 70%, #c26bf0);
  box-shadow: 0 14px 26px -12px rgba(123, 108, 246, 0.9);
  transition: transform 0.2s, box-shadow 0.2s;
}
.go:hover {
  transform: translateY(-2px);
  box-shadow: 0 18px 30px -10px rgba(123, 108, 246, 0.95);
}
.go:active {
  transform: translateY(0);
}

.alert-box {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 11px 14px;
  border-radius: 14px;
  font-size: 13px;
  font-weight: 600;
  line-height: 1.4;
  margin-bottom: 18px;
}
.alert-box.alert-danger {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fecaca;
}
.alert-box.alert-success {
  background: #dcfce7;
  color: #166534;
  border: 1px solid #bbf7d0;
}
.alert-box svg {
  width: 18px;
  height: 18px;
  flex-shrink: 0;
  margin-top: 1px;
}

.back-link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 20px;
  font-size: 13.5px;
  font-weight: 700;
  color: var(--blue);
  text-decoration: none;
  transition: color 0.2s;
}
.back-link:hover {
  color: var(--violet);
  text-decoration: underline;
}
</style>
</head>
<body>

<header>
  <a class="brand" href="/" aria-label="SkillConnect">
    <svg viewBox="0 0 64 32" fill="none">
      <defs>
        <linearGradient id="g" x1="0" x2="1">
          <stop offset="0" stop-color="#4d6bff"/>
          <stop offset="1" stop-color="#9b5cff"/>
        </linearGradient>
      </defs>
      <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/>
    </svg>
    <span>SKILL CONNECT</span>
  </a>
</header>

<main>
  <div class="card">
    <h1>Atur Ulang Kata Sandi</h1>
    <p class="sub">Silakan buat kata sandi baru untuk akun SkillConnect Anda.</p>

    @if (session('error') || (isset($errors) && $errors->any()))
      <div class="alert-box alert-danger" role="alert">
        <svg viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
        </svg>
        <div style="flex:1;">
          @if (session('error'))
            <div>{{ session('error') }}</div>
          @endif
          @if (isset($errors) && $errors->any())
            @if ($errors->count() === 1 && !session('error'))
              <div>{{ $errors->first() }}</div>
            @else
              <ul style="margin:{{ session('error') ? '4px 0 0' : '0' }};padding-left:14px;">
                @foreach ($errors->all() as $error)
                  @if ($error !== session('error'))
                    <li>{{ $error }}</li>
                  @endif
                @endforeach
              </ul>
            @endif
          @endif
        </div>
      </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <label class="f">
        <span>Email Terdaftar</span>
        <input name="email" type="email" value="{{ old('email', $email) }}" required readonly autocomplete="username">
      </label>

      <label class="f">
        <span>Kata Sandi Baru</span>
        <div class="pw">
          <input name="password" id="np" type="password" placeholder="Minimal 8 karakter" required autocomplete="new-password">
          <button type="button" class="tg">Tampilkan</button>
        </div>
        <div class="meter" id="meter"><i></i><i></i><i></i><i></i></div>
        <div class="mt" id="mt"></div>
      </label>

      <label class="f">
        <span>Ulangi Kata Sandi Baru</span>
        <div class="pw">
          <input name="password_confirmation" type="password" placeholder="Konfirmasi kata sandi baru" required autocomplete="new-password">
          <button type="button" class="tg">Tampilkan</button>
        </div>
      </label>

      <button class="go" type="submit">Simpan Kata Sandi Baru</button>

      <div style="text-align: center;">
        <a href="/#masuk" class="back-link">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Batal dan kembali ke halaman Masuk
        </a>
      </div>
    </form>
  </div>
</main>

<script>
// Toggle Password
[].forEach.call(document.querySelectorAll('.tg'), function(b) {
  b.addEventListener('click', function() {
    var i = b.parentNode.querySelector('input'), s = i.type === 'password';
    i.type = s ? 'text' : 'password';
    b.textContent = s ? 'Sembunyikan' : 'Tampilkan';
    i.focus();
  });
});

// Password Strength Meter
var mt = document.getElementById('mt'), bars = document.querySelectorAll('#meter i'),
    L = ['', 'Lemah', 'Cukup', 'Baik', 'Kuat'],
    C = ['', '#e5534b', '#f0a030', '#5b9bf0', '#2fb58a'];
document.getElementById('np').addEventListener('input', function(e) {
  var p = e.target.value, s = 0;
  if (p.length >= 8) s++;
  if (/[A-Z]/.test(p) && /[a-z]/.test(p)) s++;
  if (/\d/.test(p)) s++;
  if (/[^A-Za-z0-9]/.test(p) || p.length >= 12) s++;
  if (!p) s = 0;
  [].forEach.call(bars, function(b, i) {
    b.classList.toggle('on', i < s);
    b.style.setProperty('--c', C[s]);
  });
  mt.textContent = s ? 'Kekuatan: ' + L[s] : '';
});
</script>

</body>
</html>
