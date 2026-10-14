<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>SkillConnect — Hubungkan skill, bangun tim</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--bg:#ffffff;--ink:#0a0a0a;--mute:#525252;--line:rgba(0,0,0,.06);--card:rgba(255,255,255,.6);--primary:#ff007f;--secondary:#7000ff;--tertiary:#00d4ff;box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{scroll-behavior:smooth;scroll-padding-top:72px;background:var(--bg)}
*{box-sizing:border-box;margin:0}
body{background:linear-gradient(180deg,#eef0ff,#f4f1ff 50%,#eaf1ff);color:var(--ink);font-family:'Nunito',system-ui,sans-serif;line-height:1.6;overflow-x:hidden}
a{color:inherit;text-decoration:none}
a:focus-visible,button:focus-visible{outline:2px solid var(--secondary);outline-offset:3px}

header{position:fixed;top:0;left:0;right:0;z-index:10;display:flex;align-items:center;justify-content:space-between;padding:calc(12px + env(safe-area-inset-top,0px)) 5vw 12px;background:rgba(238,240,255,.85);backdrop-filter:blur(10px)}

.brand{display:flex;align-items:center;gap:10px;font-family:'Fredoka',sans-serif;font-weight:700;font-size:19px;letter-spacing:.05em}
.brand svg{width:44px;height:22px}
.brand span{background:linear-gradient(90deg,#1c2766,#7b6cf6);-webkit-background-clip:text;background-clip:text;color:transparent}

nav{display:flex;gap:26px;align-items:center;font-size:14px;color:#4b5686;font-weight:600}
nav a.lk{position:relative;padding-bottom:4px;transition:.2s}
nav a.lk::after{content:"";position:absolute;left:0;bottom:0;width:100%;height:2px;background:linear-gradient(90deg,#2b3a8f,#7b6cf6);transform:scaleX(0);transform-origin:right;transition:transform .3s ease;border-radius:2px}
nav a.lk:hover{color:#1c2766}
nav a.lk:hover::after{transform:scaleX(1);transform-origin:left}

.btn{display:inline-block;padding:11px 24px;border-radius:10px;font-weight:700;font-size:14px;border:1.5px solid #d6d9fb;transition:.2s;font-family:'Nunito',sans-serif;cursor:pointer}
.pri{background:linear-gradient(90deg,#2b3a8f,#7b6cf6);border-color:transparent;color:#fff;box-shadow:0 10px 26px -10px rgba(123,108,246,.7)}
.pri:hover{transform:translateY(-2px);box-shadow:0 14px 32px -10px rgba(123,108,246,.75)}
.ghost{background:#fff;color:#1c2766}
.ghost:hover{border-color:#8f9bd8;transform:translateY(-1px)}

.hero{position:relative;height:100svh;min-height:620px;overflow:hidden;background:radial-gradient(55% 65% at 74% 48%,rgba(123,108,246,.38),transparent 70%),radial-gradient(40% 50% at 100% 0%,rgba(236,170,255,.5),transparent 70%),radial-gradient(45% 55% at 0% 100%,rgba(120,180,255,.5),transparent 70%),linear-gradient(180deg,#f3f1ff,#e4e8ff)}
#fx{position:absolute;inset:0;width:100%;height:100%;display:block}
.copy{position:relative;z-index:2;height:100%;display:flex;flex-direction:column;justify-content:center;padding:0 5vw;max-width:640px;pointer-events:none}
.copy>*{pointer-events:auto}
.eyebrow{font-size:11px;letter-spacing:.22em;text-transform:uppercase;color:#5b3fd0;font-weight:700;margin-bottom:18px;display:inline-block;align-self:flex-start;background:#fff;border:1.5px solid #d6d9fb;padding:7px 18px;border-radius:99px}
h1{font-family:'Fredoka',sans-serif;font-weight:700;font-size:clamp(38px,5.8vw,72px);line-height:1.07;letter-spacing:-.01em;color:#1c2766}
h1 span{background:linear-gradient(90deg,#4b5ce8,#7b6cf6);-webkit-background-clip:text;background-clip:text;color:transparent}
.copy p{margin:22px 0 34px;max-width:460px;color:#4b5686;font-size:16.5px;line-height:1.72}
.copy p b{color:#1c2766;font-weight:700}
.cta{display:flex;gap:14px;flex-wrap:wrap}

.blob{position:absolute;border-radius:50%;filter:blur(48px);opacity:.42;animation:bl 14s ease-in-out infinite}
@keyframes bl{50%{transform:translate(30px,-26px) scale(1.12)}}

section{padding:100px 5vw;max-width:1200px;margin:0 auto}
h2{font-family:'Fredoka',sans-serif;font-weight:700;font-size:clamp(28px,4vw,48px);line-height:1.12;max-width:680px;color:#1c2766}
.sub{color:#4b5686;margin:16px 0 48px;max-width:540px;font-size:17px;font-weight:500}

.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}
.card{background:#fff;box-shadow:0 20px 44px -26px rgba(80,70,200,.4);border:1.5px solid #e0e3fa;border-radius:18px;padding:30px;transition:border-color .25s,transform .3s cubic-bezier(.34,1.56,.64,1);position:relative;overflow:hidden}
.card:hover{transform:translateY(-6px)}
.card::before{content:"";position:absolute;inset:0 0 auto 0;height:5px;background:var(--c)}
.card i{font-style:normal;font-family:'Fredoka',sans-serif;font-weight:700;font-size:13px;letter-spacing:.1em;background:var(--c);color:#fff;padding:4px 12px;border-radius:99px}
.card h3{font-family:'Fredoka',sans-serif;font-size:20px;margin:14px 0 8px;color:#1c2766}
.card p{color:#4b5686;font-size:15px;line-height:1.65}
.card:nth-child(1){--c:linear-gradient(90deg,#4f5fe0,#7b6cf6)}
.card:nth-child(2){--c:linear-gradient(90deg,#7b4fe8,#c26bf0)}
.card:nth-child(3){--c:linear-gradient(90deg,#2b7be0,#5eadff)}
.card:nth-child(4){--c:linear-gradient(90deg,#b049e0,#e87bf6)}
.card:nth-child(1):hover{border-color:#4f5fe0}
.card:nth-child(2):hover{border-color:#7b4fe8}
.card:nth-child(3):hover{border-color:#2b7be0}
.card:nth-child(4):hover{border-color:#b049e0}

.about{display:grid;grid-template-columns:1.1fr .9fr;gap:52px;align-items:center}
.plate{border-radius:24px;overflow:hidden;box-shadow:0 30px 70px -30px rgba(123,108,246,.55),16px 16px 0 -2px rgba(194,107,240,.2),-14px -14px 0 -2px rgba(111,177,255,.25)}
.plate img{display:block;width:100%;height:auto}
.about p{color:#4b5686;margin-top:16px;font-size:16px;line-height:1.7}

.final{text-align:center;background:linear-gradient(135deg,#2b3a8f,#7b6cf6 55%,#c26bf0);color:#fff;border-radius:32px;max-width:1100px;margin:0 auto 80px;padding:80px 5vw}
.final h2{max-width:none;text-align:center;color:#fff}
.final .sub{color:rgba(255,255,255,.82);text-align:center;margin-left:auto;margin-right:auto}
.final .btn{background:#fff;color:#2b3a8f;border-color:transparent;box-shadow:0 8px 24px rgba(0,0,0,.14)}
.final .btn:hover{background:#f0f2ff}

/* ===== STATS ===== */
.stats-row{display:flex;justify-content:space-around;flex-wrap:wrap;gap:24px;padding:60px 0;border-top:1.5px solid #e0e3fa;border-bottom:1.5px solid #e0e3fa;margin:0 0 20px}
.stat-item{text-align:center;padding:12px 20px}
.stat-num{font-family:'Fredoka',sans-serif;font-size:clamp(36px,5vw,58px);font-weight:700;line-height:1;background:linear-gradient(90deg,#2b3a8f,#7b6cf6);-webkit-background-clip:text;background-clip:text;color:transparent}
.stat-num span{font-size:.7em}
.stat-label{font-size:14px;font-weight:600;color:#4b5686;margin-top:6px;letter-spacing:.04em}

/* ===== STEPS ===== */
.steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:32px;margin-top:8px;position:relative}

.step{text-align:center;padding:24px 16px;background:#fff;border:1.5px solid #e0e3fa;border-radius:18px;transition:transform .3s cubic-bezier(.34,1.56,.64,1),box-shadow .3s}
.step:hover{transform:translateY(-6px);box-shadow:0 20px 44px -20px rgba(80,70,200,.3);border-color:#a99bff}
.step-num{width:54px;height:54px;border-radius:50%;background:linear-gradient(135deg,#4f5fe0,#7b6cf6);color:#fff;font-family:'Fredoka',sans-serif;font-weight:700;font-size:22px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;box-shadow:0 8px 22px rgba(80,70,200,.35)}
.step h3{font-family:'Fredoka',sans-serif;font-size:19px;font-weight:700;color:#1c2766;margin-bottom:8px}
.step p{font-size:14px;color:#4b5686;line-height:1.65}

/* ===== FOOTER ===== */
.site-footer{background:linear-gradient(180deg,#1a1f5e 0%,#0f1240 100%);color:#c5c8e8;padding:60px 5vw 0;margin-top:0}
.footer-inner{display:grid;grid-template-columns:1.4fr 1fr;gap:48px;padding-bottom:48px;border-bottom:1px solid rgba(255,255,255,.08)}
.footer-brand{max-width:320px}
.footer-logo{display:flex;align-items:center;gap:10px;margin-bottom:16px}
.footer-name{font-family:'Fredoka',sans-serif;font-weight:700;font-size:18px;letter-spacing:.06em;color:#fff}
.footer-tagline{font-size:14px;line-height:1.7;color:#9498c8}
.footer-links{display:flex;gap:40px;flex-wrap:wrap}
.footer-col{display:flex;flex-direction:column;gap:10px}
.footer-col-title{font-family:'Fredoka',sans-serif;font-weight:600;font-size:14px;color:#fff;letter-spacing:.08em;margin-bottom:4px}
.footer-col a{font-size:13.5px;color:#8891cc;transition:color .2s}
.footer-col a:hover{color:#c5c8ff}
.footer-bottom{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;padding:20px 0 calc(22px + env(safe-area-inset-bottom,0px));font-size:13px;color:#5a5f9a}

@media(max-width:820px){nav .lk{display:none}nav{gap:10px}.copy{max-width:none;justify-content:flex-end;padding-bottom:11vh}.copy p{font-size:15px}.steps::before{display:none}.footer-inner{grid-template-columns:1fr}.footer-links{gap:24px}.footer-bottom{flex-direction:column;text-align:center}}
@media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}.card,.btn,.blob,.step{animation:none;transition:none}}
</style>
</head>
<body>

<header>
  <a class="brand" href="#" aria-label="SkillConnect">
    <svg viewBox="0 0 64 32" fill="none">
      <defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
      <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/>
    </svg>
    <span>SKILL CONNECT</span>
  </a>
  <nav>
    <a class="lk" href="#fitur">Fitur Utama</a>
    <a class="lk" href="#katalog">Katalog Proyek Publik</a>
    <a class="lk" href="#tentang">Tentang Kami</a>
    <a class="btn ghost" href="/login">Masuk</a>
    <a class="btn pri" href="/register">Daftar</a>
  </nav>
</header>

<div class="hero">
  <span class="blob" style="width:280px;height:280px;left:46%;top:4%;background:#a99bff"></span>
  <span class="blob" style="width:300px;height:300px;right:0;bottom:0;background:#e08cff;animation-delay:-5s"></span>
  <span class="blob" style="width:240px;height:240px;left:-4%;bottom:6%;background:#6fb1ff;animation-delay:-9s"></span>
  <canvas id="fx" aria-label="Logo tak terhingga dari partikel. Arahkan kursor untuk menyebarkan partikel."></canvas>
  <div class="copy">
    <div class="eyebrow">Platform Manajemen Tim Proyek</div>
    <h1>Hubungkan skill, <span>bangun tim</span>, selesaikan proyek.</h1>
    <p>SkillConnect mempertemukan <b>Project Creator</b> dengan anggota yang tepat melalui pencocokan skill, lalu mengelola <b>tugas, progres, dan fee</b> dalam satu sistem yang terdokumentasi.</p>
    <div class="cta">
      <a class="btn pri" href="/register">Mulai sekarang</a>
      <a class="btn ghost" href="#katalog">Jelajahi proyek</a>
    </div>
  </div>
</div>

<section id="fitur">
  <h2>Satu platform untuk seluruh siklus proyek</h2>
  <p class="sub">Dari mencari anggota hingga pembayaran fee, setiap langkah tercatat dan dapat ditelusuri.</p>
  <div class="grid">
    <div class="card"><i>01</i><h3>Profil & Portofolio</h3><p>Kelola skill, pengalaman, dan karya agar mudah ditemukan oleh Project Creator.</p></div>
    <div class="card"><i>02</i><h3>Skill Matching</h3><p>Rekomendasi kandidat berdasarkan jumlah dan persentase skill yang cocok dengan kebutuhan proyek.</p></div>
    <div class="card"><i>03</i><h3>Ruang Kerja Tim</h3><p>Task board, bukti kerja, serta persetujuan atau revisi tugas oleh Ketua proyek.</p></div>
    <div class="card"><i>04</i><h3>Transaksi & Fee</h3><p>Pencatatan budget, pembagian fee per anggota, dan status pembayaran yang transparan.</p></div>
  </div>
</section>

<!-- STATS STRIP -->
<section id="tentang" style="padding:0 5vw;max-width:1200px;margin:0 auto">
  <div class="stats-row">
    <div class="stat-item">
      <div class="stat-num">2.4K<span>+</span></div>
      <div class="stat-label">Proyek Aktif</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">8.1K<span>+</span></div>
      <div class="stat-label">Member Terdaftar</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">94<span>%</span></div>
      <div class="stat-label">Proyek Selesai</div>
    </div>
    <div class="stat-item">
      <div class="stat-num">120<span>+</span></div>
      <div class="stat-label">Kategori Skill</div>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section id="cara-kerja" style="padding:80px 5vw;max-width:1200px;margin:0 auto">
  <h2>Mulai dalam 3 langkah</h2>
  <p class="sub">Bergabung gratis, temukan proyek, dan mulai berkolaborasi hari ini.</p>
  <div class="steps">
    <div class="step">
      <div class="step-num">1</div>
      <h3>Buat Profil</h3>
      <p>Lengkapi skill, portofolio, dan preferensi kerjamu dalam hitungan menit.</p>
    </div>
    <div class="step">
      <div class="step-num">2</div>
      <h3>Temukan Proyek</h3>
      <p>Sistem mencocokkan skill-mu dengan proyek yang paling relevan secara otomatis.</p>
    </div>
    <div class="step">
      <div class="step-num">3</div>
      <h3>Kerjakan &amp; Dibayar</h3>
      <p>Kelola tugas di dashboard tim dan terima fee secara transparan dan tepat waktu.</p>
    </div>
  </div>
</section>

<section class="final" id="katalog">
  <h2>Punya proyek? Temukan timnya sekarang.</h2>
  <p class="sub">Satu akun dapat berperan sebagai Creator pada satu proyek dan Member pada proyek lain.</p>
  <a class="btn pri" href="/register">Buat proyek baru</a>
</section>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="footer-logo">
        <svg viewBox="0 0 64 32" fill="none" width="40" height="20">
          <defs><linearGradient id="fg" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
          <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#fg)" stroke-width="4" stroke-linejoin="round"/>
        </svg>
        <span class="footer-name">SKILL CONNECT</span>
      </div>
      <p class="footer-tagline">Platform manajemen tim proyek berbasis skill. Hubungkan skill, bangun tim, selesaikan proyek.</p>
    </div>
    <div class="footer-links">
      <div class="footer-col">
        <div class="footer-col-title">Platform</div>
        <a href="#fitur">Fitur Utama</a>
        <a href="#katalog">Katalog Proyek</a>
        <a href="#cara-kerja">Cara Kerja</a>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Akun</div>
        <a href="/login">Masuk</a>
        <a href="/register">Daftar Gratis</a>
      </div>
      <div class="footer-col">
        <div class="footer-col-title">Tentang</div>
        <a href="#tentang">Tentang Kami</a>
        <a href="#">Kontak</a>
        <a href="#">Kebijakan Privasi</a>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <span>&copy; 2026 SkillConnect. All rights reserved.</span>
    <span>Made with ♥ for Indonesia</span>
  </div>
</footer>

<script>
(function(){
  var c=document.getElementById('fx'),x=c.getContext('2d');
  var W=0,H=0,cx=0,cy=0,S=0,R=75,P=[],stars=[],m={x:-999,y:-999};
  function curve(t,s){var d=1+Math.sin(t)*Math.sin(t);return[300+250*s*Math.cos(t)/d,150+375*s*Math.sin(t)*Math.cos(t)/d]}
  function sample(){
    var o=document.createElement('canvas');o.width=600;o.height=300;var g=o.getContext('2d');
    var lg=g.createLinearGradient(50,0,550,0);lg.addColorStop(0,'#2b3a8f');lg.addColorStop(.55,'#7b6cf6');lg.addColorStop(1,'#c26bf0');
    g.lineJoin='round';
    function ring(s,w,st){g.beginPath();for(var t=0;t<=6.2832;t+=.02){var p=curve(t,s);t?g.lineTo(p[0],p[1]):g.moveTo(p[0],p[1])}g.closePath();g.lineWidth=w;g.strokeStyle=st;g.stroke()}
    ring(1,18,lg);ring(.9,3,'#8f9bd8');ring(.8,10,lg);ring(.7,3,'#b9bff0');
    var d=g.getImageData(0,0,600,300).data,out=[];
    for(var j=0;j<300;j+=3)for(var i=0;i<600;i+=3){var k=(j*600+i)*4;
      if(d[k+3]>128)out.push({nx:(i-300)/600,ny:(j-150)/600,r:d[k],g:d[k+1],b:d[k+2]})}
    return out;
  }
  function init(){
    P=sample().map(function(p){var l=.8+Math.random()*.45;
      return{nx:p.nx+(Math.random()-.5)*.004,ny:p.ny+(Math.random()-.5)*.004,x:Math.random()*innerWidth,y:Math.random()*innerHeight,vx:0,vy:0,
        s:.9+Math.random()*1.3,ph:Math.random()*6.28,col:'rgb('+Math.min(255,p.r*l|0)+','+Math.min(255,p.g*l|0)+','+Math.min(255,p.b*l|0)+')'}});
  }
  function resize(){
    var dpr=Math.min(devicePixelRatio||1,2),r=c.getBoundingClientRect();W=r.width;H=r.height;
    c.width=W*dpr;c.height=H*dpr;x.setTransform(dpr,0,0,dpr,0,0);
    var wide=W>820;cx=wide?W*.7:W*.5;cy=wide?H*.5:H*.3;S=wide?Math.min(W*.54,H*1.3):W*.98;R=wide?75:55;
    stars=[];for(var i=0;i<150;i++)stars.push([Math.random()*W,Math.random()*H,Math.random()*1.8+.5,Math.random()*.5+.15]);
  }
  function move(e){var r=c.getBoundingClientRect();m.x=e.clientX-r.left;m.y=e.clientY-r.top}
  addEventListener('pointermove',move);addEventListener('pointerdown',move);
  document.addEventListener('pointerleave',function(){m.x=m.y=-999});
  addEventListener('resize',resize);
  function sp(t,s){var p=curve(t,s);return[cx+(p[0]-300)/600*S,cy+(p[1]-150)/600*S]}
  // Draw paper airplane shape at (px,py) with rotation angle ang and size sz
  function plane(px,py,ang,sz,a){
    x.save();
    x.translate(px,py);
    x.rotate(ang);
    x.shadowBlur=22;
    x.shadowColor='rgba(123,108,246,'+a+')';
    x.globalAlpha=a;
    // Paper airplane: pointy nose to the right
    x.beginPath();
    x.moveTo(sz,0);          // nose tip
    x.lineTo(-sz*.7,-sz*.55); // top-left wing
    x.lineTo(-sz*.3,0);       // tail notch
    x.lineTo(-sz*.7, sz*.55); // bottom-left wing
    x.closePath();
    x.fillStyle='rgba(180,160,255,'+a+')';
    x.fill();
    // Inner crease line
    x.beginPath();
    x.moveTo(sz,0);
    x.lineTo(-sz*.3,0);
    x.strokeStyle='rgba(255,255,255,'+(a*.7)+')';
    x.lineWidth=1.2;
    x.stroke();
    x.globalAlpha=1;
    x.shadowBlur=0;
    x.restore();
  }
  // Get tangent angle at parameter t on the lemniscate
  function pathAngle(t,s){
    var dt=0.04;
    var p1=sp(t,s),p2=sp(t+dt,s);
    return Math.atan2(p2[1]-p1[1],p2[0]-p1[0]);
  }
  function frame(t){
    x.clearRect(0,0,W,H);
    for(var i=0;i<stars.length;i++){var s=stars[i];x.fillStyle='rgba('+['79,95,224','123,79,232','43,123,224','176,73,224'][i%4]+','+s[3]*1.1*(.6+.4*Math.sin(t*.001+i))+')';x.fillRect(s[0],s[1],s[2],s[2])}
    var bob=Math.sin(t*.0008)*5;
    for(var n=0;n<P.length;n++){var p=P[n];
      var tx=cx+p.nx*S+Math.sin(t*.0011+p.ph)*1.2,ty=cy+p.ny*S+bob+Math.cos(t*.0013+p.ph)*1.2;
      var dx=p.x-m.x,dy=p.y-m.y,d=Math.sqrt(dx*dx+dy*dy);
      if(d<R&&d>0){var f=1-d/R;f*=f;p.vx+=dx/d*f*1.3+(Math.random()-.5)*f*5;p.vy+=dy/d*f*1.3+(Math.random()-.5)*f*5}
      p.vx+=(tx-p.x)*.028;p.vy+=(ty-p.y)*.028;p.vx*=.89;p.vy*=.89;p.x+=p.vx;p.y+=p.vy;
      x.fillStyle=p.col;x.fillRect(p.x,p.y,p.s,p.s)}
    // Node dots at fixed positions on path (keep as small glowing dots)
    [.9,2.3,3.9,5.4].forEach(function(a,i){
      var q=sp(a,.95);
      x.shadowBlur=14;x.shadowColor='#7b6cf6';
      x.fillStyle='rgba(200,180,255,.9)';
      x.beginPath();x.arc(q[0],q[1]+bob,2.5+1.2*Math.sin(t*.003+i),0,6.283);x.fill();
      x.shadowBlur=0;
    });
    // Traveling PAPER AIRPLANES along the path
    var speed=t*.0007;
    for(var k=0;k<4;k++){
      var tParam=speed - k*.38;  // 4 planes evenly spaced
      var q=sp(tParam,.95);
      var ang=pathAngle(tParam,.95);
      var fade=1-k*.22;
      var sz=11-k*1.8;
      plane(q[0],q[1]+bob,ang,sz,fade*.92);
    }
    requestAnimationFrame(frame);
  }
  resize();init();requestAnimationFrame(frame);
})();
</script>

</body>
</html>
