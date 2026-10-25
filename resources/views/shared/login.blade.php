<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Masuk ke Akun - SkillConnect</title>
<meta name="description" content="Masuk ke akun SkillConnect Anda dan lanjutkan kolaborasi proyek.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --bg: #eef0ff;
  --ink: #1c2766;
  --mute: #64748b;
  --line: #d6d9fb;
  --card: #ffffff;
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
  overflow-x: hidden;
}
a { color: inherit; text-decoration: none; }

/* Top Header */
.top-header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  padding: 24px 5vw;
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 10;
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

/* Page Layout */
.auth-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 100px 6vw 50px;
  max-width: 1300px;
  margin: 0 auto;
  gap: 40px;
}

/* Left Illustration Panel */
.visual-panel {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  min-height: 480px;
}
#avatarCanvas {
  width: 100%;
  max-width: 480px;
  height: 480px;
  display: block;
  filter: drop-shadow(0 15px 35px rgba(123, 108, 246, 0.25));
}

/* Right Card Panel */
.card-panel {
  flex: none;
  width: 100%;
  max-width: 470px;
}
.auth-card {
  background: var(--card);
  border: 1px solid rgba(214, 217, 251, 0.85);
  border-radius: 28px;
  padding: 34px 38px;
  box-shadow: 0 25px 60px -15px rgba(100, 90, 210, 0.18), 0 10px 25px -5px rgba(0, 0, 0, 0.03);
  position: relative;
  backdrop-filter: blur(8px);
}

/* Segmented Tab Pill */
.tab-switch {
  display: grid;
  grid-template-columns: 1fr 1fr;
  background: #eef2ff;
  border-radius: 14px;
  padding: 4px;
  gap: 4px;
  margin-bottom: 24px;
}
.tab-btn {
  text-align: center;
  padding: 10px 16px;
  font-size: 14px;
  font-weight: 600;
  color: var(--mute);
  border-radius: 10px;
  transition: all 0.2s ease;
  cursor: pointer;
  border: none;
  background: transparent;
}
.tab-btn.active {
  background: #ffffff;
  color: var(--ink);
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
}

/* Card Header */
.card-title {
  font-family: 'Fredoka', sans-serif;
  font-size: 26px;
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 6px;
  line-height: 1.2;
}
.card-subtitle {
  font-size: 14px;
  color: var(--mute);
  margin-bottom: 22px;
}

/* Form Groups */
.form-group {
  margin-bottom: 18px;
}
.form-label {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 7px;
}
.input-wrap {
  position: relative;
  display: flex;
  align-items: center;
}
.form-input {
  width: 100%;
  padding: 12px 16px;
  font-family: 'Nunito', sans-serif;
  font-size: 14px;
  color: var(--ink);
  background: #ffffff;
  border: 1.5px solid var(--line);
  border-radius: 12px;
  outline: none;
  transition: all 0.2s ease;
}
.form-input:focus {
  border-color: var(--violet);
  box-shadow: 0 0 0 3px rgba(123, 108, 246, 0.15);
}
.form-input::placeholder {
  color: #94a3b8;
}

/* Password Toggle */
.btn-toggle-pw {
  position: absolute;
  right: 14px;
  background: none;
  border: none;
  color: var(--mute);
  font-family: 'Nunito', sans-serif;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  padding: 4px;
  transition: color 0.2s;
}
.btn-toggle-pw:hover {
  color: var(--violet);
}

/* Submit Button */
.btn-submit {
  width: 100%;
  padding: 13px 20px;
  margin-top: 10px;
  margin-bottom: 18px;
  font-family: 'Nunito', sans-serif;
  font-size: 15px;
  font-weight: 700;
  color: #ffffff;
  background: linear-gradient(90deg, #2b3a8f, #7b6cf6 70%, #c26bf0);
  border: none;
  border-radius: 12px;
  cursor: pointer;
  box-shadow: 0 10px 24px -8px rgba(123, 108, 246, 0.65);
  transition: all 0.2s ease;
}
.btn-submit:hover {
  transform: translateY(-2px);
  box-shadow: 0 14px 28px -8px rgba(123, 108, 246, 0.75);
}
.btn-submit:active {
  transform: translateY(0);
}

/* Divider & Google Login */
.divider {
  display: flex;
  align-items: center;
  gap: 12px;
  margin: 10px 0 16px;
  color: #94a3b8;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: .04em;
}
.divider::before, .divider::after {
  content: "";
  flex: 1;
  height: 1px;
  background: var(--line);
}
.btn-google {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  width: 100%;
  padding: 11px 18px;
  background: #ffffff;
  border: 1.5px solid var(--line);
  border-radius: 12px;
  color: var(--ink);
  font-size: 14px;
  font-weight: 700;
  transition: all 0.2s ease;
  margin-bottom: 18px;
}
.btn-google:hover {
  background: #f8faff;
  border-color: #b9c2f6;
  transform: translateY(-1px);
}

/* Card Bottom Footer */
.card-footer {
  text-align: center;
  font-size: 13.5px;
  color: var(--mute);
}
.card-footer a {
  color: var(--blue);
  font-weight: 700;
  text-decoration: underline;
  transition: color 0.2s;
}
.card-footer a:hover {
  color: var(--violet);
}

/* Alert Notification */
.alert {
  padding: 12px 16px;
  border-radius: 12px;
  font-size: 13px;
  font-weight: 600;
  margin-bottom: 16px;
  line-height: 1.4;
}
.alert-danger {
  background: #fee2e2;
  color: #b91c1c;
  border: 1px solid #fecaca;
}
.alert-success {
  background: #dcfce7;
  color: #15803d;
  border: 1px solid #bbf7d0;
}
.alert-list {
  margin-left: 18px;
  padding-left: 0;
}

/* Responsive */
@media (max-width: 960px) {
  .visual-panel { display: none; }
  .auth-container { justify-content: center; padding: 90px 4vw 40px; }
  .card-panel { max-width: 440px; }
}
</style>
</head>
<body>

<header class="top-header">
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

<main class="auth-container">
  <!-- Left Particle Avatar Illustration -->
  <div class="visual-panel">
    <canvas id="avatarCanvas" width="480" height="480" aria-label="Partikel ilustrasi profil pengguna"></canvas>
  </div>

  <!-- Right Form Card -->
  <div class="card-panel">
    <div class="auth-card">
      <!-- Tabs: Masuk / Daftar -->
      <div class="tab-switch">
        <a href="{{ route('login') }}" class="tab-btn active">Masuk</a>
        <a href="{{ route('register') }}" class="tab-btn">Daftar</a>
      </div>

      <h1 class="card-title">Masuk ke SkillConnect</h1>
      <p class="card-subtitle">Selamat datang kembali! Lanjutkan proyek kolaborasi Anda.</p>

      {{-- Flash Message Success (Notifikasi Registrasi Berhasil) --}}
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- Flash Message Single Error (Pesan Salah Password / Autentikasi Gagal) --}}
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @elseif ($errors->any())
        {{-- Tampilkan error validasi jika session('error') tidak ada --}}
        <div class="alert alert-danger">
          <ul class="alert-list" style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label" for="email">Email</label>
          <div class="input-wrap">
            <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus autocomplete="username">
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Kata sandi</label>
          <div class="input-wrap">
            <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi" required autocomplete="current-password">
            <button type="button" class="btn-toggle-pw" id="togglePassword">Tampilkan</button>
          </div>
        </div>

        <button type="submit" class="btn-submit" id="btn-submit-masuk">Masuk</button>
      </form>

      <div class="divider">atau</div>

      <a href="{{ route('google.login') }}" class="btn-google" id="btn-google-sso">
        <svg width="18" height="18" viewBox="0 0 24 24">
          <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
          <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
          <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
          <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
        </svg>
        <span>Masuk dengan Google</span>
      </a>

      <div class="card-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
      </div>
    </div>
  </div>
</main>

<script>
// Toggle Password Visibility
const togglePw = (btnId, inputId) => {
  const btn = document.getElementById(btnId);
  const input = document.getElementById(inputId);
  if (!btn || !input) return;
  btn.addEventListener('click', () => {
    if (input.type === 'password') {
      input.type = 'text';
      btn.textContent = 'Sembunyikan';
    } else {
      input.type = 'password';
      btn.textContent = 'Tampilkan';
    }
  });
};
togglePw('togglePassword', 'password');

// Particle Avatar Canvas Illustration
(function() {
  const canvas = document.getElementById('avatarCanvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let width, height, dpr;
  const particles = [];
  const mouse = { x: -999, y: -999 };

  function resize() {
    dpr = window.devicePixelRatio || 1;
    const rect = canvas.getBoundingClientRect();
    width = rect.width || 480;
    height = rect.height || 480;
    canvas.width = width * dpr;
    canvas.height = height * dpr;
    ctx.scale(dpr, dpr);
  }

  function generateTargets() {
    const targets = [];
    const cx = 230, cy = 250;

    // 1. Head circle: center (cx, cy - 40), radius 55
    const headRadius = 55;
    for (let i = 0; i < 300; i++) {
      const angle = Math.random() * Math.PI * 2;
      const r = headRadius + (Math.random() - 0.5) * 8;
      targets.push({
        x: cx + Math.cos(angle) * r,
        y: (cy - 50) + Math.sin(angle) * r,
        colorRatio: (angle / (Math.PI * 2))
      });
    }

    // 2. Shoulders / Chest curve
    for (let i = 0; i < 550; i++) {
      const u = Math.random();
      const angle = Math.PI * 0.12 + u * Math.PI * 0.76;
      const rx = 100 + (Math.random() - 0.5) * 14;
      const ry = 80 + (Math.random() - 0.5) * 14;
      const x = cx + Math.cos(angle) * rx * 1.05;
      const y = (cy + 75) - Math.sin(angle) * ry;
      targets.push({
        x: x,
        y: y,
        colorRatio: u
      });
    }

    // Inner shoulder fill dots
    for (let i = 0; i < 180; i++) {
      const angle = Math.PI * 0.2 + Math.random() * Math.PI * 0.6;
      const r = 40 + Math.random() * 45;
      targets.push({
        x: cx + Math.cos(angle) * r * 1.1,
        y: (cy + 78) - Math.sin(angle) * r * 0.8,
        colorRatio: Math.random()
      });
    }

    // 3. Plus badge: center (cx + 65, cy - 85), radius 24
    const bx = cx + 72, by = cy - 90, br = 26;
    for (let i = 0; i < 160; i++) {
      const angle = Math.random() * Math.PI * 2;
      const r = br + (Math.random() - 0.5) * 5;
      targets.push({
        x: bx + Math.cos(angle) * r,
        y: by + Math.sin(angle) * r,
        colorRatio: 0.8
      });
    }
    for (let i = 0; i < 40; i++) {
      targets.push({
        x: bx - 12 + Math.random() * 24,
        y: by + (Math.random() - 0.5) * 4,
        colorRatio: 0.9
      });
    }
    for (let i = 0; i < 40; i++) {
      targets.push({
        x: bx + (Math.random() - 0.5) * 4,
        y: by - 12 + Math.random() * 24,
        colorRatio: 0.9
      });
    }

    return targets;
  }

  function init() {
    const targets = generateTargets();
    particles.length = 0;
    const colors = [
      'rgba(43, 58, 143, 0.85)',
      'rgba(79, 95, 224, 0.85)',
      'rgba(123, 108, 246, 0.9)',
      'rgba(176, 73, 224, 0.85)',
      'rgba(194, 107, 240, 0.85)'
    ];

    targets.forEach((t) => {
      const cIndex = Math.min(colors.length - 1, Math.floor(t.colorRatio * colors.length));
      particles.push({
        origX: t.x,
        origY: t.y,
        x: t.x + (Math.random() - 0.5) * 40,
        y: t.y + (Math.random() - 0.5) * 40,
        vx: 0,
        vy: 0,
        color: colors[cIndex],
        size: 1.6 + Math.random() * 1.5,
        phase: Math.random() * Math.PI * 2
      });
    });
  }

  function animate(time) {
    ctx.clearRect(0, 0, width, height);

    const t = time * 0.002;
    for (let i = 0; i < particles.length; i++) {
      const p = particles[i];
      const targetX = p.origX + Math.sin(t + p.phase) * 2;
      const targetY = p.origY + Math.cos(t + p.phase) * 2.5;

      const dx = p.x - mouse.x;
      const dy = p.y - mouse.y;
      const dist = Math.sqrt(dx * dx + dy * dy);
      if (dist < 70 && dist > 0) {
        const force = (1 - dist / 70) * 8;
        p.vx += (dx / dist) * force;
        p.vy += (dy / dist) * force;
      }

      p.vx += (targetX - p.x) * 0.05;
      p.vy += (targetY - p.y) * 0.05;
      p.vx *= 0.82;
      p.vy *= 0.82;

      p.x += p.vx;
      p.y += p.vy;

      ctx.fillStyle = p.color;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
      ctx.fill();
    }

    requestAnimationFrame(animate);
  }

  canvas.addEventListener('mousemove', (e) => {
    const rect = canvas.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  });
  canvas.addEventListener('mouseleave', () => {
    mouse.x = -999;
    mouse.y = -999;
  });

  window.addEventListener('resize', () => {
    resize();
    init();
  });

  resize();
  init();
  requestAnimationFrame(animate);
})();
</script>
</body>
</html>