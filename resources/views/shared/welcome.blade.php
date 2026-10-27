<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>SkillConnect — Hubungkan skill, bangun tim</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--bg:#eef0ff;--ink:#1c2766;--mute:#4b5686;--line:#d6d9fb;--card:#fff;--blue:#2b3a8f;--violet:#7b6cf6;--silver:#8f9bd8;
box-sizing:border-box;padding-top:env(safe-area-inset-top,0px);padding-bottom:env(safe-area-inset-bottom,0px)}
html{scroll-behavior:smooth;scroll-padding-top:72px;background:var(--bg)}
*{box-sizing:border-box;margin:0}
body{background:linear-gradient(180deg,#eef0ff,#f4f1ff 50%,#eaf1ff);color:var(--ink);font-family:'Nunito',system-ui,sans-serif;line-height:1.6;overflow-x:hidden}
a{color:inherit;text-decoration:none}
a:focus-visible,button:focus-visible{outline:2px solid var(--violet);outline-offset:3px}
header{position:fixed;top:0;left:0;right:0;z-index:10;display:flex;align-items:center;justify-content:space-between;padding:calc(12px + env(safe-area-inset-top,0px)) 5vw 12px;background:rgba(238,240,255,.85);backdrop-filter:blur(10px)}
.brand{display:flex;align-items:center;gap:10px;font-family:'Fredoka',sans-serif;font-weight:800;font-size:19px;letter-spacing:.05em}
.brand svg{width:44px;height:22px}
.brand span{background:linear-gradient(90deg,#1c2766,#7b6cf6);-webkit-background-clip:text;background-clip:text;color:transparent}
nav{display:flex;gap:26px;align-items:center;font-size:14px;color:var(--mute);font-weight:500}
nav a:hover{color:var(--ink)}
.btn{display:inline-block;padding:11px 24px;border-radius:10px;font-weight:600;font-size:14px;border:1px solid var(--line);transition:.2s}
.pri{background:linear-gradient(90deg,#2b3a8f,#7b6cf6 70%,#c26bf0);background-origin:border-box;background-clip:border-box;border-color:transparent;color:#fff;box-shadow:0 10px 26px -10px rgba(123,108,246,.7)}
.pri:hover{transform:translateY(-2px)}
.ghost{background:#fff}.ghost:hover{border-color:var(--silver)}
.hero{position:relative;height:100svh;min-height:620px;overflow:hidden;background:radial-gradient(55% 65% at 74% 48%,rgba(123,108,246,.38),transparent 70%),radial-gradient(40% 50% at 100% 0%,rgba(236,170,255,.5),transparent 70%),radial-gradient(45% 55% at 0% 100%,rgba(120,180,255,.5),transparent 70%),linear-gradient(180deg,#f3f1ff,#e4e8ff)}
#fx{position:absolute;inset:0;width:100%;height:100%;display:block}
.copy{position:relative;z-index:2;height:100%;display:flex;flex-direction:column;justify-content:center;padding:0 5vw;max-width:640px;pointer-events:none}
.copy>*{pointer-events:auto}
.eyebrow{font-size:13px;letter-spacing:.2em;text-transform:uppercase;color:var(--violet);font-weight:600;margin-bottom:18px}
h1{font-family:'Fredoka',sans-serif;font-weight:800;font-size:clamp(36px,5.2vw,68px);line-height:1.08;letter-spacing:-.01em}
h1 span{background:linear-gradient(90deg,var(--blue),var(--violet));-webkit-background-clip:text;background-clip:text;color:transparent}
.copy p{margin:22px 0 30px;max-width:460px;color:var(--mute);font-size:17px}
.copy p b{color:var(--ink);font-weight:600}
.cta{display:flex;gap:12px;flex-wrap:wrap}
.hint{position:absolute;z-index:2;right:5vw;bottom:calc(24px + env(safe-area-inset-bottom,0px));font-size:13px;color:var(--mute)}
section{padding:100px 5vw;max-width:1200px;margin:0 auto}
h2{font-family:'Fredoka',sans-serif;font-weight:800;font-size:clamp(28px,4vw,48px);line-height:1.12;max-width:680px}
.sub{color:var(--mute);margin:16px 0 44px;max-width:540px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px}
.card{background:#fff;box-shadow:0 20px 44px -26px rgba(80,70,200,.45);border:1px solid var(--line);border-radius:16px;padding:28px;transition:border-color .25s,transform .25s}
.card:hover{border-color:var(--violet);transform:translateY(-4px)}
.card i{font-style:normal;font-family:'Fredoka',sans-serif;font-weight:800;font-size:14px;color:var(--blue);letter-spacing:.1em}
.card h3{font-family:'Fredoka',sans-serif;font-size:19px;margin:12px 0 8px}
.card p{color:var(--mute);font-size:15px}
.eyebrow{display:inline-block;align-self:flex-start;background:#fff;border:1px solid var(--line);padding:7px 16px;border-radius:99px;letter-spacing:.16em}

.blob{position:absolute;border-radius:50%;filter:blur(48px);opacity:.42;animation:bl 14s ease-in-out infinite}
@keyframes bl{50%{transform:translate(30px,-26px) scale(1.12)}}
.eyebrow{color:#5b3fd0}
.card{position:relative;overflow:hidden;background:linear-gradient(165deg,var(--t),#fff 68%)}
.card::before{content:"";position:absolute;inset:0 0 auto 0;height:6px;background:var(--c)}
.card i{background:var(--c);color:#fff;padding:4px 11px;border-radius:99px;font-size:12px}
.card:nth-child(1){--c:#4f5fe0;--t:#dfe3ff}
.card:nth-child(2){--c:#7b4fe8;--t:#ebe0ff}
.card:nth-child(3){--c:#2b7be0;--t:#d9ebff}
.card:nth-child(4){--c:#b049e0;--t:#f5e0ff}
.card:nth-child(1):hover{border-color:#4f5fe0}.card:nth-child(2):hover{border-color:#7b4fe8}.card:nth-child(3):hover{border-color:#2b7be0}.card:nth-child(4):hover{border-color:#b049e0}
@media(prefers-reduced-motion:reduce){.blob{animation:none}}
.about{display:grid;grid-template-columns:1.1fr .9fr;gap:48px;align-items:center}
.plate{border-radius:24px;overflow:hidden;box-shadow:0 30px 70px -30px rgba(123,108,246,.6),16px 16px 0 -2px rgba(194,107,240,.22),-14px -14px 0 -2px rgba(111,177,255,.3)}
.plate img{display:block;width:100%;height:auto}
.about p{color:var(--mute);margin-top:16px}
.final{text-align:center;background:linear-gradient(135deg,#2b3a8f,#7b6cf6 60%,#c26bf0);color:#fff;border-radius:32px;max-width:1100px;margin:0 auto 70px}.final .sub{color:#eceeff}.final .btn{background:#fff;color:#2b3a8f;box-shadow:none}
.final h2,.final .sub{margin-left:auto;margin-right:auto}
footer{padding:28px 5vw calc(30px + env(safe-area-inset-bottom,0px));color:var(--mute);font-size:14px;border-top:1px solid var(--line);text-align:center}
section{padding:84px 5vw}
.kick{font-size:12.5px;font-weight:700;letter-spacing:.16em;text-transform:uppercase;color:#5b3fd0;margin-bottom:12px}
.band{background:rgba(255,255,255,.55);border-top:1px solid var(--line);border-bottom:1px solid var(--line)}
.ck{display:inline-flex;align-items:center;gap:6px;border:1px solid var(--line);background:#fff;border-radius:99px;padding:4px 12px;font-size:13px;font-weight:600;color:var(--mute);margin:0 4px 6px 0}
.ck.on{background:#ece8ff;border-color:#c9c0ff;color:#3b2fb0}
.ck.on::before{content:"✓";font-size:11px}
.match{display:grid;grid-template-columns:.8fr 1.2fr;gap:20px;align-items:start}
.panel,.cand,.kan,.proj,.data li{background:#fff;border:1px solid var(--line)}
.panel{border-radius:20px;padding:28px;box-shadow:0 20px 44px -26px rgba(80,70,200,.45)}
.lbl{font-size:12.5px;letter-spacing:.12em;text-transform:uppercase;color:var(--mute);font-weight:600}
.panel h3{font-family:'Fredoka',sans-serif;font-size:22px;margin:6px 0 14px}
.formula{margin-top:18px;font-size:14px;color:var(--mute);background:#f4f1ff;border-radius:12px;padding:12px 14px}
.cands{display:grid;gap:12px}
.cand{display:flex;gap:16px;align-items:center;border-radius:18px;padding:16px 20px}
.av{flex:none;width:44px;height:44px;border-radius:50%;background:linear-gradient(135deg,#2b3a8f,#7b6cf6);color:#fff;display:grid;place-items:center;font-weight:700}
.ci{flex:1;min-width:0}.ci b{display:block;margin-bottom:6px}
.bar{height:8px;background:#e8e9fb;border-radius:9px;overflow:hidden;margin-top:4px}
.bar i{display:block;height:100%;width:var(--w);background:linear-gradient(90deg,#2b3a8f,#7b6cf6,#c26bf0);border-radius:9px;transition:width 1.2s ease}
.pre .bar i{width:0}
.sc{text-align:right;flex:none}.sc b{display:block;font-family:'Fredoka',sans-serif;font-size:24px;color:#2b3a8f}.sc small{color:var(--mute);font-size:12.5px}
.two{display:grid;grid-template-columns:.9fr 1.1fr;gap:48px;align-items:center}
.data{list-style:none;padding:0;display:grid;gap:10px}
.data li{border-radius:14px;padding:12px 16px;font-size:15px;color:var(--mute)}.data b{color:var(--ink)}
.kan{display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:10px;border-radius:20px;padding:16px;box-shadow:0 20px 44px -26px rgba(80,70,200,.45)}
.col h4{font-size:12.5px;color:var(--mute);margin-bottom:8px}
.tk{background:#f4f1ff;border-radius:10px;padding:9px 11px;font-size:13px;font-weight:600;margin-bottom:8px;border-left:3px solid var(--c)}
.tk small{display:block;color:var(--mute);font-size:11.5px;font-weight:500}
.proj{border-radius:20px;padding:26px;display:flex;flex-direction:column;gap:12px;box-shadow:0 20px 44px -28px rgba(80,70,200,.45);transition:transform .25s,border-color .25s}
.proj:hover{transform:translateY(-4px);border-color:var(--violet)}
.proj h3{font-family:'Fredoka',sans-serif;font-size:19px}.proj p{color:var(--mute);font-size:15px}
.proj .row{display:flex;justify-content:space-between;align-items:center;margin-top:auto}.proj .row b{color:#2b3a8f}.proj .btn{padding:8px 18px}
footer{text-align:left;padding:60px 5vw calc(26px + env(safe-area-inset-bottom,0px));background:linear-gradient(180deg,transparent,rgba(43,58,143,.09))}
.fg{max-width:1200px;margin:0 auto;display:flex;justify-content:space-between;gap:36px;flex-wrap:wrap}
footer h4{font-family:'Fredoka',sans-serif;font-size:13px;letter-spacing:.12em;text-transform:uppercase;color:var(--ink);margin-bottom:14px}
footer a,footer .l{display:block;margin-bottom:8px;font-size:14px}footer a:hover{color:var(--ink)}
footer .l b{color:var(--ink)}footer p{font-size:14px;margin-top:12px;max-width:290px}
.fb{max-width:1200px;margin:40px auto 0;padding-top:20px;border-top:1px solid var(--line);font-size:13px}
@media(max-width:900px){.match,.two{grid-template-columns:1fr}.fg{grid-template-columns:1fr 1fr}}
@media(max-width:560px){.fg{grid-template-columns:1fr}.cand{flex-wrap:wrap}}
[hidden]{display:none!important}
.copy{transition:opacity .45s,transform .6s cubic-bezier(.2,.8,.2,1)}.hint{transition:opacity .3s}
.acard{position:absolute;z-index:4;right:6vw;top:50%;width:min(460px,90%);opacity:0;visibility:hidden;pointer-events:none;transform:translate(60px,-50%);background:rgba(255,255,255,.94);backdrop-filter:blur(14px);border:1px solid #fff;border-radius:28px;padding:20px 26px 16px;box-shadow:0 40px 80px -34px rgba(80,70,200,.6),16px 16px 0 -2px rgba(194,107,240,.18),-12px -12px 0 -2px rgba(111,177,255,.24);transition:opacity .45s,transform .6s cubic-bezier(.2,.8,.2,1),visibility 0s .6s;height:595px;max-height:calc(100vh - 30px);display:flex;flex-direction:column;box-sizing:border-box;overflow:hidden}
.acard-body{flex:1;min-height:0;display:flex;flex-direction:column;overflow:hidden}
#fL, #fF{overflow-y:auto;overflow-x:hidden;flex:1;min-height:0;padding-right:4px;scrollbar-width:none}
#fL::-webkit-scrollbar, #fF::-webkit-scrollbar{display:none}
#fR{overflow-y:auto;overflow-x:hidden;flex:1;min-height:0;padding-right:6px;margin-right:-6px;scrollbar-width:thin;scrollbar-color:#c3c9f5 transparent}
#fR::-webkit-scrollbar{width:5px}
#fR::-webkit-scrollbar-track{background:rgba(220,225,250,.3);border-radius:10px}
#fR::-webkit-scrollbar-thumb{background:#c3c9f5;border-radius:10px}
#fR::-webkit-scrollbar-thumb:hover{background:#9fa9e8}
.auth .acard{opacity:1;visibility:visible;pointer-events:auto;transform:translate(0,-50%);transition:opacity .5s .3s,transform .75s .3s cubic-bezier(.2,.8,.2,1),visibility 0s}
.acard.shake{animation:shk .45s}
@keyframes shk{20%{translate:-8px 0}40%{translate:8px 0}60%{translate:-5px 0}80%{translate:4px 0}}
.auth .copy{opacity:0;transform:translateX(-50px);pointer-events:none}.auth .hint{opacity:0}
.auth nav .lk,.auth nav [data-open]{display:none}
@media(min-width:901px){.auth,.auth body{overflow:hidden}}
.auth body>section,.auth body>.band,.auth body>footer{display:none}
.tabs{position:relative;display:grid;grid-template-columns:1fr 1fr;background:#eef0ff;border-radius:14px;padding:4px;margin-bottom:8px;flex-shrink:0}
.tabs button{position:relative;z-index:1;border:0;background:none;padding:8px;font:600 13.5px 'Nunito',sans-serif;color:var(--mute);cursor:pointer;border-radius:10px}
.tabs button.on{color:var(--ink)}
.thumb{position:absolute;top:4px;bottom:4px;left:4px;width:calc(50% - 4px);background:#fff;border-radius:10px;box-shadow:0 4px 12px -4px rgba(43,58,143,.4);transition:transform .3s cubic-bezier(.3,.8,.3,1)}
.tabs.r .thumb{transform:translateX(100%)}
.role-switch{display:grid;grid-template-columns:1fr 1fr 1fr;gap:5px;background:#f0f2ff;border:1px solid #d8dcfa;border-radius:12px;padding:3px;margin-bottom:10px;flex-shrink:0}
.role-switch button{display:flex;align-items:center;justify-content:center;gap:5px;border:0;background:none;padding:7px 4px;font:700 12px 'Nunito',sans-serif;color:var(--mute);cursor:pointer;border-radius:9px;transition:all .2s ease}
.role-switch button svg{width:13px;height:13px;flex-shrink:0}
.role-switch button small{font-size:9.5px;font-weight:600;opacity:.8}
.role-switch button.on{background:#fff;color:#2b3a8f;box-shadow:0 2px 8px rgba(43,58,143,.2)}
.at{font-family:'Fredoka',sans-serif;font-weight:800;font-size:22px;line-height:1.15}
.lead{color:var(--mute);margin:2px 0 8px;font-size:13px}
.f{display:block;margin-bottom:8px}.f>span{display:block;font-size:12.5px;font-weight:600;margin-bottom:3px}
.f input{width:100%;padding:10px 13px;border:1.5px solid var(--line);border-radius:14px;font:14px 'Nunito',sans-serif;color:var(--ink);background:#fbfbff;transition:border-color .2s,box-shadow .2s}
.f input:focus{outline:0;border-color:var(--violet);box-shadow:0 0 0 4px rgba(123,108,246,.18);background:#fff}
.pw{position:relative}.pw input{padding-right:100px}
.pw button{position:absolute;right:8px;top:50%;transform:translateY(-50%);border:0;background:none;color:var(--navy);font:600 12px 'Nunito',sans-serif;padding:6px 10px;cursor:pointer;border-radius:8px}
.pw button:hover{background:#eef0ff}
.meter{display:grid;grid-template-columns:repeat(4,1fr);gap:5px;margin-top:6px}
.meter i{height:4px;border-radius:5px;background:#e3e5fa;transition:background .25s}.meter i.on{background:var(--c)}
.mt{font-size:12px;color:var(--mute);margin-top:3px;min-height:16px}
.go{width:100%;margin-top:2px;padding:11px;border:0;border-radius:14px;color:#fff;font:700 14.5px 'Nunito',sans-serif;cursor:pointer;background:linear-gradient(90deg,#2b3a8f,#7b6cf6 70%,#c26bf0);box-shadow:0 14px 26px -12px rgba(123,108,246,.9);transition:transform .2s}
.alert-box{display:flex;align-items:flex-start;gap:8px;padding:9px 12px;border-radius:12px;font-size:12.5px;font-weight:600;line-height:1.4;margin-bottom:10px}
.alert-box.alert-danger{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}
.alert-box.alert-success{background:#dcfce7;color:#166534;border:1px solid #bbf7d0}
.alert-box svg{width:16px;height:16px;flex-shrink:0;margin-top:1px}
.alert-close{border:0;background:none;color:inherit;font-size:16px;cursor:pointer;padding:0 2px;line-height:1;margin-left:auto;opacity:.7}
.alert-close:hover{opacity:1}
.js-msg{min-height:16px;font-size:12.5px;margin:6px 0 0;text-align:center;font-weight:600;color:transparent;transition:color .2s}
.js-msg.bad{color:#dc2626}
.js-msg.ok{color:#16a34a}
.msg{min-height:18px;font-size:13px;margin:6px 0 0;color:#c0392b}.msg.ok{color:#177a54}
.sw{margin-top:6px;font-size:13.5px;color:var(--mute);text-align:center;padding-bottom:2px}
.sw button{border:0;background:none;color:var(--navy);font:700 14px 'Nunito',sans-serif;cursor:pointer;text-decoration:underline;text-underline-offset:3px}
@media(max-width:900px){.auth .hero{height:auto;min-height:100svh;overflow:visible}.auth .copy{position:absolute}.acard{right:auto;top:auto;left:50%;transform:translate(-50%,40px);padding:26px 22px}.auth .acard{position:relative;left:auto;margin:290px auto 30px;transform:none;width:min(520px,90%);height:630px;max-height:calc(100vh - 80px)}}
@media(prefers-reduced-motion:reduce){.acard,.copy{transition:none}.acard.shake{animation:none}}
@media(max-width:820px){nav .lk{display:none}nav{gap:10px}.copy{max-width:none;justify-content:flex-end;padding-bottom:11vh}.hint{display:none}.about{grid-template-columns:1fr;gap:28px}.copy p{font-size:16px}}
@media(prefers-reduced-motion:reduce){html{scroll-behavior:auto}.card{transition:none}}
</style>
</head>
<body>
<header>
  <a class="brand" href="#" aria-label="SkillConnect">
    <svg viewBox="0 0 64 32" fill="none"><defs><linearGradient id="g" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs>
    <path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g)" stroke-width="4" stroke-linejoin="round"/></svg>
    <span>SKILL CONNECT</span>
  </a>
  <nav>
    <a class="lk" href="#fitur">Fitur Utama</a>
    <a class="lk" href="#katalog">Katalog Proyek Publik</a>
    <a class="btn ghost" href="#masuk" data-open="l">Masuk</a>
    <a class="btn pri" href="#daftar" data-open="r">Daftar</a>
  </nav>
</header>

<div class="hero">
  <span class="blob" style="width:280px;height:280px;left:46%;top:4%;background:#a99bff"></span><span class="blob" style="width:300px;height:300px;right:0;bottom:0;background:#e08cff;animation-delay:-5s"></span><span class="blob" style="width:240px;height:240px;left:-4%;bottom:6%;background:#6fb1ff;animation-delay:-9s"></span>
  <canvas id="fx" aria-label="Logo tak terhingga dari partikel. Arahkan kursor untuk menyebarkan partikel."></canvas>
  <div class="copy">
    <div class="eyebrow">Platform Manajemen Tim Proyek</div>
    <h1>Hubungkan skill, <span>bangun tim</span>, selesaikan proyek.</h1>
    <p>SkillConnect mempertemukan <b>Project Creator</b> dengan anggota yang tepat melalui pencocokan skill, lalu mengelola <b>tugas, progres, dan fee</b> dalam satu sistem yang terdokumentasi.</p>
    <div class="cta"><a class="btn pri" href="#daftar" data-open="r">Mulai sekarang</a><a class="btn ghost" href="#katalog">Jelajahi proyek</a></div>
  </div>
  <div class="acard" id="acard" role="dialog" aria-label="Masuk atau daftar">
    <div class="tabs" id="tabs" role="tablist">
      <button type="button" id="tL" class="on" role="tab">Masuk</button>
      <button type="button" id="tR" role="tab">Daftar</button>
      <i class="thumb"></i>
    </div>

    <!-- Pilihan Peran: Member vs Creator vs Admin -->
    <div class="role-switch" id="roleSwitch" role="tablist" aria-label="Pilih peran">
      <button type="button" id="rtMember" class="on" onclick="setRole('member')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
        </svg>
        <span>Member</span>
      </button>
      <button type="button" id="rtCreator" class="creator" onclick="setRole('creator')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/>
          <path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/>
        </svg>
        <span>Creator</span>
      </button>
      <button type="button" id="rtAdmin" class="admin" onclick="setRole('admin')">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        <span>Admin</span>
      </button>
    </div>

    <div class="acard-body" id="acardBody">
    <form id="fL" action="{{ route('login') }}" method="POST">
      @csrf
      <input type="hidden" name="login_role" id="fL_role" value="member">

      @if (session('success'))
        <div class="alert-box alert-success" role="alert">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <div style="flex:1;">{{ session('success') }}</div>
          <button type="button" class="alert-close" onclick="var p=this.parentElement;p.style.opacity='0';p.style.transition='opacity .2s';setTimeout(function(){p.remove()},200)">&times;</button>
        </div>
      @endif

      @if (!old('is_register') && (session('error') || (isset($errors) && $errors->any())))
        <div class="alert-box alert-danger" role="alert">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          <div style="flex:1;">
            @if (session('error'))
              <div>{{ session('error') }}</div>
            @endif
            @if (isset($errors) && $errors->any())
              @php
                $cleanErrors = array_filter($errors->all(), function($e) {
                  return $e !== session('error');
                });
              @endphp
              @if (count($cleanErrors) === 1 && !session('error'))
                <div>{{ reset($cleanErrors) }}</div>
              @elseif (count($cleanErrors) > 0)
                <ul style="margin:{{ session('error') ? '4px 0 0' : '0' }};padding-left:14px;">
                  @foreach ($cleanErrors as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif
            @endif
          </div>
          <button type="button" class="alert-close" onclick="var p=this.parentElement;p.style.opacity='0';p.style.transition='opacity .2s';setTimeout(function(){p.remove()},200)">&times;</button>
        </div>
      @endif

      <h3 class="at">Selamat datang kembali</h3>
      <p class="lead" id="loginLead">Masuk sebagai <b>Member</b> untuk melanjutkan ke dashboard.</p>
      <label class="f"><span>Email</span><input name="email" type="email" autocomplete="email" placeholder="nama@email.com" value="{{ old('email') }}" required></label>
      <label class="f">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:3px">
          <span>Kata sandi</span>
          <button type="button" data-to="f" style="border:0;background:none;padding:0;font-size:12px;color:var(--navy);font-weight:700;cursor:pointer;text-decoration:underline;text-underline-offset:2px">Lupa kata sandi?</button>
        </div>
        <div class="pw"><input name="password" type="password" data-pw autocomplete="current-password" placeholder="Masukkan kata sandi" required><button type="button" class="tg">Tampilkan</button></div>
      </label>
      <button class="go" type="submit" id="loginBtnSubmit">Masuk sebagai Member</button>
      <p class="js-msg" role="alert"></p>
      
      <div id="loginOrDivider" style="display:flex;align-items:center;gap:10px;margin:8px 0 6px;color:var(--mute);font-size:12px;font-weight:600;text-transform:uppercase"><span style="flex:1;height:1px;background:var(--line)"></span>atau<span style="flex:1;height:1px;background:var(--line)"></span></div>
      <a href="{{ route('google.login') }}?role=member" id="loginGoogleLink" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:9px;border-radius:12px;border:1.5px solid var(--line);background:#fff;color:var(--ink);font:700 13.5px 'Nunito',sans-serif;transition:background .2s;text-decoration:none">
        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
        <span id="loginGoogleText">Masuk sebagai Member dengan Google</span>
      </a>
    </form>
    <form id="fR" action="{{ route('register') }}" method="POST" hidden>
      @csrf
      <input type="hidden" name="is_register" value="1">
      <input type="hidden" name="role" id="fR_role" value="member">

      @if (old('is_register') && (session('error') || (isset($errors) && $errors->any())))
        <div class="alert-box alert-danger" role="alert">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          <div style="flex:1;">
            @if (session('error'))
              <div>{{ session('error') }}</div>
            @endif
            @if (isset($errors) && $errors->any())
              @php
                $cleanErrors = array_filter($errors->all(), function($e) {
                  return $e !== session('error');
                });
              @endphp
              @if (count($cleanErrors) === 1 && !session('error'))
                <div>{{ reset($cleanErrors) }}</div>
              @elseif (count($cleanErrors) > 0)
                <ul style="margin:{{ session('error') ? '4px 0 0' : '0' }};padding-left:14px;">
                  @foreach ($cleanErrors as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              @endif
            @endif
          </div>
          <button type="button" class="alert-close" onclick="var p=this.parentElement;p.style.opacity='0';p.style.transition='opacity .2s';setTimeout(function(){p.remove()},200)">&times;</button>
        </div>
      @endif

      <h3 class="at">Buat akun SkillConnect</h3>
      <p class="lead" id="registerLead">Daftar sebagai <b>Member</b> untuk bergabung ke proyek.</p>
      <label class="f"><span>Nama lengkap</span><input name="name" type="text" autocomplete="name" placeholder="Nama lengkap" value="{{ old('name') }}" required></label>
      <label class="f"><span>Email</span><input name="email" type="email" autocomplete="email" placeholder="nama@email.com" value="{{ old('email') }}" required></label>
      <label class="f"><span>Kata sandi</span><div class="pw"><input name="password" id="np" type="password" data-pw autocomplete="new-password" placeholder="Minimal 8 karakter" required><button type="button" class="tg">Tampilkan</button></div>
        <div class="meter" id="meter"><i></i><i></i><i></i><i></i></div><div class="mt" id="mt"></div></label>
      <label class="f"><span>Konfirmasi kata sandi</span><div class="pw"><input name="password_confirmation" type="password" data-pw autocomplete="new-password" placeholder="Ulangi kata sandi" required><button type="button" class="tg">Tampilkan</button></div></label>
      <button class="go" type="submit" id="registerBtnSubmit">Daftar sebagai Member</button>
      <p class="js-msg" role="alert"></p>
      
      <div style="display:flex;align-items:center;gap:10px;margin:8px 0 6px;color:var(--mute);font-size:12px;font-weight:600;text-transform:uppercase"><span style="flex:1;height:1px;background:var(--line)"></span>atau<span style="flex:1;height:1px;background:var(--line)"></span></div>
      <a href="{{ route('google.login') }}?role=member" id="registerGoogleLink" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:9px;border-radius:12px;border:1.5px solid var(--line);background:#fff;color:var(--ink);font:700 13.5px 'Nunito',sans-serif;transition:background .2s;text-decoration:none">
        <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/></svg>
        <span id="registerGoogleText">Daftar sebagai Member dengan Google</span>
      </a>
    </form>

    <!-- Form Pemulihan Kata Sandi (Lupa Sandi) -->
    <form id="fF" action="{{ route('password.email') }}" method="POST" hidden>
      @csrf
      <input type="hidden" name="is_forgot" value="1">

      @if (session('status'))
        <div class="alert-box alert-success" role="alert">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <div style="flex:1;">
            <div>{{ session('status') }}</div>
            @if (config('mail.default') === 'log' && session('reset_url'))
              <div style="margin-top:6px;font-size:12px;">
                <a href="{{ session('reset_url') }}" style="color:#166534;font-weight:700;text-decoration:underline;">[Mode Dev/Lokal] Klik di sini untuk langsung atur kata sandi baru &rarr;</a>
              </div>
            @endif
          </div>
          <button type="button" class="alert-close" onclick="var p=this.parentElement;p.style.opacity='0';p.style.transition='opacity .2s';setTimeout(function(){p.remove()},200)">&times;</button>
        </div>
      @endif

      @if (old('is_forgot') && (session('error') || (isset($errors) && $errors->any())))
        <div class="alert-box alert-danger" role="alert">
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          <div style="flex:1;">
            {{ session('error') ?: ($errors->first('email') ?: $errors->first()) }}
          </div>
          <button type="button" class="alert-close" onclick="var p=this.parentElement;p.style.opacity='0';p.style.transition='opacity .2s';setTimeout(function(){p.remove()},200)">&times;</button>
        </div>
      @endif

      <h3 class="at">Pemulihan Kata Sandi</h3>
      <p class="lead">Masukkan email akun Anda. Kami akan membuat tautan untuk mengatur ulang kata sandi.</p>
      <label class="f"><span>Email Akun</span><input name="email" type="email" autocomplete="email" placeholder="nama@email.com" value="{{ old('email') }}" required></label>
      <button class="go" type="submit" id="forgotBtnSubmit">Kirim Tautan Reset</button>
      <p class="js-msg" role="alert"></p>

      <div style="margin-top:16px;text-align:center;">
        <button type="button" data-to="l" style="border:0;background:none;color:var(--navy);font:700 13px 'Nunito',sans-serif;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Kembali ke halaman Masuk
        </button>
      </div>
    </form>
    </div>
  </div>
</div>

<section id="masalah">
  <div class="kick">Latar belakang</div>
  <h2>Membangun tim proyek seharusnya tidak serumit ini</h2>
  <p class="sub">Tiga hambatan yang paling sering dialami pemilik proyek, dan yang diselesaikan SkillConnect.</p>
  <div class="grid">
    <div class="card"><i>01</i><h3>Pencarian anggota manual</h3><p>Mencari anggota lewat grup chat, media sosial, atau jaringan pertemanan memakan waktu dan hasilnya belum tentu sesuai kebutuhan proyek.</p></div>
    <div class="card"><i>02</i><h3>Kekurangan skill terlambat disadari</h3><p>Skill yang belum terpenuhi sering baru ketahuan setelah proyek berjalan, saat perbaikannya lebih sulit dan mahal.</p></div>
    <div class="card"><i>03</i><h3>Fee dan tugas tidak terdokumentasi</h3><p>Pembagian budget, fee, dan tugas yang tidak tercatat rapi memicu perselisihan soal siapa mengerjakan apa.</p></div>
  </div>
</section>

<div class="band" id="cara"><section>
  <div class="kick">Cara kerja</div>
  <h2>Dari profil sampai portofolio dalam empat langkah</h2>
  <p class="sub">Alur sederhana yang sama untuk setiap proyek.</p>
  <div class="grid">
    <div class="card"><i>01</i><h3>Lengkapi profil & skill</h3><p>Isi skill beserta tingkat keahlian, pengalaman, dan portofolio.</p></div>
    <div class="card"><i>02</i><h3>Buat proyek</h3><p>Creator menentukan deskripsi, kategori, kebutuhan skill, dan budget.</p></div>
    <div class="card"><i>03</i><h3>Dapatkan rekomendasi</h3><p>Sistem mencocokkan skill dan menampilkan kandidat beserta persentase kecocokan.</p></div>
    <div class="card"><i>04</i><h3>Bentuk tim & kerjakan</h3><p>Ketua membagi fee dan tugas, memantau progres, lalu hasil tersimpan sebagai portofolio.</p></div>
  </div>
</section></div>

<section id="matching">
  <div class="kick">Skill Matching</div>
  <h2>Kandidat yang tepat, lengkap dengan skor kecocokan</h2>
  <p class="sub">Pencocokan memakai skill yang sama pada master skill, lalu kandidat diurutkan berdasarkan jumlah skill yang cocok. Berikut contoh ilustrasinya.</p>
  <div class="match">
    <div class="panel">
      <div class="lbl">Kebutuhan proyek</div>
      <h3>Website UMKM</h3>
      <span class="ck on">Laravel</span> <span class="ck on">React</span> <span class="ck on">MySQL</span>
      <p class="formula">Skor Kecocokan = (Skill yang cocok ÷ Skill yang dibutuhkan) × 100%</p>
    </div>
    <div class="cands">
      <div class="cand"><div class="av">A</div><div class="ci"><b>Kandidat A</b><span class="ck on">Laravel</span><span class="ck on">React</span><span class="ck on">MySQL</span><div class="bar" style="--w:100%"><i></i></div></div><div class="sc"><b>100%</b><small>Cocok 3 dari 3 Skill</small></div></div>
      <div class="cand"><div class="av">B</div><div class="ci"><b>Kandidat B</b><span class="ck on">Laravel</span><span class="ck on">React</span><span class="ck">MySQL</span><div class="bar" style="--w:67%"><i></i></div></div><div class="sc"><b>67%</b><small>Cocok 2 dari 3 Skill</small></div></div>
      <div class="cand"><div class="av">C</div><div class="ci"><b>Kandidat C</b><span class="ck on">Laravel</span><span class="ck">React</span><span class="ck">MySQL</span><div class="bar" style="--w:33%"><i></i></div></div><div class="sc"><b>33%</b><small>Cocok 1 dari 3 Skill</small></div></div>
    </div>
  </div>
</section>

<section id="fitur">
  <div class="kick">Fitur utama</div>
  <h2>Satu platform untuk seluruh siklus proyek</h2>
  <p class="sub">Dari mencari anggota hingga pembayaran fee, setiap langkah tercatat dan dapat ditelusuri.</p>
  <div class="grid">
    <div class="card"><i>01</i><h3>Profil & Portofolio</h3><p>Kelola skill, pengalaman, dan karya agar mudah ditemukan oleh Project Creator.</p></div>
    <div class="card"><i>02</i><h3>Skill Matching</h3><p>Rekomendasi kandidat berdasarkan jumlah dan persentase skill yang cocok dengan kebutuhan proyek.</p></div>
    <div class="card"><i>03</i><h3>Ruang Kerja Tim</h3><p>Task board, bukti kerja, serta persetujuan atau revisi tugas oleh Ketua proyek.</p></div>
    <div class="card"><i>04</i><h3>Transaksi & Fee</h3><p>Pencatatan budget, pembagian fee per anggota, dan status pembayaran yang transparan.</p></div>
  </div>
</section>

<div class="band"><section id="transparansi"><div class="two">
  <div>
    <div class="kick">Transparansi tugas</div>
    <h2>Bukti objektif untuk setiap tugas</h2>
    <p class="sub">Setiap tugas menyimpan empat data inti sekaligus, sehingga mudah ditelusuri bila terjadi perselisihan.</p>
    <ul class="data">
      <li><b>Ditugaskan ke</b> — pemilik resmi tugas</li>
      <li><b>Waktu perubahan status</b> — mulai, submit, hingga disetujui</li>
      <li><b>Bukti kerja</b> — file, link, atau screenshot</li>
      <li><b>Persetujuan Ketua</b> — disetujui atau revisi beserta catatan</li>
    </ul>
  </div>
  <div class="kan" aria-label="Contoh papan tugas">
    <div class="col"><h4>Belum dikerjakan</h4><div class="tk" style="--c:#a9b2c9">Rancang database<small>Anggota 1</small></div></div>
    <div class="col"><h4>Sedang dikerjakan</h4><div class="tk" style="--c:#2b7be0">Halaman login<small>Anggota 2</small></div></div>
    <div class="col"><h4>Menunggu review</h4><div class="tk" style="--c:#b049e0">Endpoint API<small>Bukti kerja diunggah</small></div></div>
    <div class="col"><h4>Selesai</h4><div class="tk" style="--c:#4f5fe0">Desain UI<small>Disetujui Ketua</small></div></div>
  </div>
</div></section></div>

<section id="peran">
  <div class="kick">Untuk siapa</div>
  <h2>Tiga peran, satu alur kerja</h2>
  <p class="sub">Satu akun dapat berperan sebagai Creator pada satu proyek dan sebagai Member pada proyek lain.</p>
  <div class="grid">
    <div class="card"><i>Creator</i><h3>Project Creator</h3><p>Membuat proyek, menentukan kebutuhan skill dan budget, melihat rekomendasi anggota, membagi tugas, memantau progres, dan mengonfirmasi pembayaran.</p></div>
    <div class="card"><i>Member</i><h3>Project Member</h3><p>Melengkapi profil dan skill, mengajukan diri ke proyek, mengerjakan tugas, mengunggah bukti kerja, dan menerima fee.</p></div>
    <div class="card"><i>Admin</i><h3>Admin</h3><p>Mengelola pengguna dan master skill, memoderasi proyek, serta memantau analitik dan log transaksi platform.</p></div>
  </div>
</section>

<section id="katalog">
  <div class="kick">Katalog proyek publik</div>
  <h2>Temukan proyek yang cocok dengan skill-mu</h2>
  <p class="sub">Contoh tampilan katalog. Setiap proyek menampilkan kebutuhan skill dan budget.</p>
  <div class="grid">
    <div class="proj"><h3>Website UMKM</h3><p>Pembangunan situs untuk usaha kecil dengan katalog dan formulir pemesanan.</p><div><span class="ck">Laravel</span> <span class="ck">React</span> <span class="ck">UI/UX</span></div><div class="row"><b>Rp3.000.000</b><a class="btn ghost" href="#">Lihat Detail</a></div></div>
    <div class="proj"><h3>Sistem Inventori Kampus</h3><p>Aplikasi pencatatan aset laboratorium dengan laporan berkala.</p><div><span class="ck">Laravel</span> <span class="ck">MySQL</span></div><div class="row"><b>Rp2.500.000</b><a class="btn ghost" href="#">Lihat Detail</a></div></div>
    <div class="proj"><h3>Redesain Aplikasi Komunitas</h3><p>Penyegaran antarmuka dan sistem desain untuk aplikasi komunitas.</p><div><span class="ck">UI/UX</span> <span class="ck">Tailwind</span></div><div class="row"><b>Rp1.800.000</b><a class="btn ghost" href="#">Lihat Detail</a></div></div>
  </div>
</section>

<section class="final" id="mulai">
  <h2>Punya proyek? Temukan timnya sekarang.</h2>
  <p class="sub">Daftar, lengkapi profil skill, dan biarkan sistem merekomendasikan kandidat yang paling sesuai.</p>
  <a class="btn pri" href="#daftar" data-open="r">Buat proyek baru</a>
</section>

<footer>
  <div class="fg">
    <div>
      <a class="brand" href="#" aria-label="SkillConnect"><svg viewBox="0 0 64 32" fill="none"><defs><linearGradient id="g2" x1="0" x2="1"><stop offset="0" stop-color="#4d6bff"/><stop offset="1" stop-color="#9b5cff"/></linearGradient></defs><path d="M12 16C12 5 26 5 32 16C38 27 52 27 52 16C52 5 38 5 32 16C26 27 12 27 12 16Z" stroke="url(#g2)" stroke-width="4" stroke-linejoin="round"/></svg><span>SKILL CONNECT</span></a>
      <p>Platform pencarian anggota dan manajemen tim proyek berdasarkan skill.</p>
    </div>
    <div><h4>Platform</h4><a href="#fitur">Fitur Utama</a><a href="#katalog">Katalog Proyek Publik</a><a href="#masuk" data-open="l">Masuk</a><a href="#daftar" data-open="r">Daftar</a></div>
  </div>
  <div class="fb">© 2026 SkillConnect</div>
</footer>


<script>
(function(){
  var c=document.getElementById('fx'),x=c.getContext('2d');
  var W=0,H=0,cx=0,cy=0,S=0,tcx=0,tcy=0,tS=0,first=true,R=75,P=[],stars=[],m={x:-999,y:-999},auth=false,lock=0,lockT=0,sv=.00075,svT=.00075,tm=0,cur='inf',free=0,ia=1,tg={};
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
    buildShapes();
  }
  // ===== bentuk-bentuk partikel: gembok (Masuk) dan siluet orang (Daftar) =====
  function rr(g,x,y,w,h,r){g.beginPath();g.moveTo(x+r,y);g.arcTo(x+w,y,x+w,y+h,r);g.arcTo(x+w,y+h,x,y+h,r);g.arcTo(x,y+h,x,y,r);g.arcTo(x,y,x+w,y,r);g.closePath()}
  function pts(draw){var o=document.createElement('canvas');o.width=o.height=400;var g=o.getContext('2d');
    var lg=g.createLinearGradient(60,0,340,0);lg.addColorStop(0,'#2b3a8f');lg.addColorStop(.55,'#7b6cf6');lg.addColorStop(1,'#c26bf0');
    g.lineJoin='round';g.lineCap='round';draw(g,lg);
    var d=g.getImageData(0,0,400,400).data,out=[];
    for(var j=0;j<400;j+=3)for(var i=0;i<400;i+=3){var k=(j*400+i)*4;if(d[k+3]>128)out.push({nx:(i-200)/600,ny:(j-200)/600,r:d[k],g:d[k+1],b:d[k+2]})}
    return out}
  function lockBody(g,lg){g.strokeStyle=lg;g.lineWidth=18;rr(g,82,196,236,146,30);g.stroke();
    g.strokeStyle='#8f9bd8';g.lineWidth=3;rr(g,100,214,200,110,20);g.stroke();
    g.fillStyle=lg;g.beginPath();g.arc(200,262,16,0,6.283);g.fill();g.fillRect(193,270,14,34)}
  function shackle(g,lg,dy){g.strokeStyle=lg;g.lineWidth=22;g.beginPath();g.moveTo(130,200+dy);g.lineTo(130,150+dy);g.arc(200,150+dy,70,Math.PI,0);g.lineTo(270,200+dy);g.stroke()}
  function person(g,lg){g.strokeStyle=lg;g.lineWidth=18;g.beginPath();g.arc(190,128,58,0,6.283);g.stroke();
    g.strokeStyle='#8f9bd8';g.lineWidth=3;g.beginPath();g.arc(190,128,40,0,6.283);g.stroke();
    g.strokeStyle=lg;g.lineWidth=18;g.beginPath();g.moveTo(60,346);g.bezierCurveTo(60,250,120,214,190,214);g.bezierCurveTo(260,214,320,250,320,346);g.closePath();g.stroke();
    g.strokeStyle='#8f9bd8';g.lineWidth=3;g.beginPath();g.moveTo(96,330);g.bezierCurveTo(96,266,140,238,190,238);g.bezierCurveTo(240,238,284,266,284,330);g.stroke();
    g.strokeStyle=lg;g.lineWidth=12;g.beginPath();g.arc(322,98,34,0,6.283);g.stroke();
    g.lineWidth=9;g.beginPath();g.moveTo(322,80);g.lineTo(322,116);g.moveTo(304,98);g.lineTo(340,98);g.stroke()}
  function mk(q){var l=.8+Math.random()*.45;return{nx:q.nx+(Math.random()-.5)*.004,ny:q.ny+(Math.random()-.5)*.004,col:'rgb('+Math.min(255,q.r*l|0)+','+Math.min(255,q.g*l|0)+','+Math.min(255,q.b*l|0)+')'}}
  function pick(a){return a[Math.random()*a.length|0]}
  function buildShapes(){
    var N=P.length;tg.inf=P.map(function(p){return{nx:p.nx,ny:p.ny,col:p.col}});
    var bd=pts(lockBody),sc=pts(function(g,lg){shackle(g,lg,0)}),so=pts(function(g,lg){shackle(g,lg,-44)}),pr=pts(person);
    var nb=Math.round(N*bd.length/(bd.length+sc.length)),A=[],B=[],C=[];
    for(var i=0;i<N;i++){
      if(i<nb){var q=mk(pick(bd));A.push(q);B.push(q)}else{A.push(mk(pick(so)));B.push(mk(pick(sc)))}
      C.push(mk(pick(pr)))}
    tg.lockO=A;tg.lockC=B;tg.person=C;
  }
  // soft=true: bergeser halus; soft=false: logo/bentuk pecah dulu lalu menyusun bentuk baru
  function shape(name,soft){
    if(name===cur||!tg[name])return;cur=name;var a=tg[name];
    for(var i=0;i<P.length;i++){var p=P[i],q=a[i];p.nx=q.nx;p.ny=q.ny;p.col=q.col;
      if(!soft){var an=Math.random()*6.283,sp=5+Math.random()*11;p.vx+=Math.cos(an)*sp;p.vy+=Math.sin(an)*sp}}
    if(!soft)free=performance.now()+650;
  }
  function resize(){
    var pw=W,ph=H,dpr=Math.min(devicePixelRatio||1,2),r=c.getBoundingClientRect();W=r.width;H=r.height;
    c.width=W*dpr;c.height=H*dpr;x.setTransform(dpr,0,0,dpr,0,0);
    var wide=W>820;
    if(auth){var w2=W>900;tcx=w2?Math.min(W*.3,420):W*.5;tcy=w2?H*.5:150;tS=w2?Math.min(W*.46,H*1.05):Math.min(W*.92,330)}
    else{tcx=wide?W*.7:W*.5;tcy=wide?H*.5:H*.3;tS=wide?Math.min(W*.54,H*1.3):W*.98}
    if(first){cx=tcx;cy=tcy;S=tS;first=false}
    R=wide?75:55;
    if(stars.length&&pw===W&&ph===H)return;stars=[];for(var i=0;i<150;i++)stars.push([Math.random()*W,Math.random()*H,Math.random()*1.8+.5,Math.random()*.5+.15]);
  }
  function move(e){var r=c.getBoundingClientRect();m.x=e.clientX-r.left;m.y=e.clientY-r.top}
  addEventListener('pointermove',move);addEventListener('pointerdown',move);
  document.addEventListener('pointerleave',function(){m.x=m.y=-999});
  addEventListener('resize',resize);
  function sp(t,s){var p=curve(t,s);return[cx+(p[0]-300)/600*S,cy+(p[1]-150)/600*S]}
  function glow(px,py,r,a){x.shadowBlur=18;x.shadowColor='#7b6cf6';x.fillStyle='rgba(123,108,246,'+a+')';x.beginPath();x.arc(px,py,r,0,6.283);x.fill();x.shadowBlur=0}
  function frame(t){
    x.clearRect(0,0,W,H);cx+=(tcx-cx)*.07;cy+=(tcy-cy)*.07;S+=(tS-S)*.07;lock+=(lockT-lock)*.12;sv+=(svT-sv)*.05;tm+=sv*16;ia+=((cur==='inf'?1:0)-ia)*.08;
    for(var i=0;i<stars.length;i++){var s=stars[i];x.fillStyle='rgba('+['79,95,224','123,79,232','43,123,224','176,73,224'][i%4]+','+s[3]*1.1*(.6+.4*Math.sin(t*.001+i))+')';x.fillRect(s[0],s[1],s[2],s[2])}
    var bob=Math.sin(t*.0008)*5;
    for(var n=0;n<P.length;n++){var p=P[n];
      var tx=cx+p.nx*S+Math.sin(t*.0011+p.ph)*1.2,ty=cy+p.ny*S+bob+Math.cos(t*.0013+p.ph)*1.2;
      var dx=p.x-m.x,dy=p.y-m.y,d=Math.sqrt(dx*dx+dy*dy);
      if(d<R&&d>0){var f=1-d/R;f*=f;p.vx+=dx/d*f*1.3+(Math.random()-.5)*f*5;p.vy+=dy/d*f*1.3+(Math.random()-.5)*f*5}
      var kk=t<free?.0025:.03,fr=t<free?.96:.89;if(t<free){p.vx+=(Math.random()-.5)*.7;p.vy+=(Math.random()-.5)*.7}p.vx+=(tx-p.x)*kk;p.vy+=(ty-p.y)*kk;p.vx*=fr;p.vy*=fr;p.x+=p.vx;p.y+=p.vy;
      x.fillStyle=p.col;x.fillRect(p.x,p.y,p.s,p.s)}
    // 1 pesawat kertas yang terbang mulus mengikuti alur logo
    if(ia>.02){var pk=Math.max(.95,S/600)*1.18;
      var tt=tm,a=sp(tt,.92),b=sp(tt+.03,.92);a[1]+=bob;b[1]+=bob;var ang=Math.atan2(b[1]-a[1],b[0]-a[0]);
      x.globalAlpha=ia;x.lineCap='round';
      var pa=a;for(var j=1;j<=14;j++){var q=sp(tt-j*.032,.92);q[1]+=bob;x.strokeStyle='rgba(123,108,246,'+(.55*(1-j/14))+')';x.lineWidth=Math.max(.7,(3.4-j*.22)*pk*.6);x.beginPath();x.moveTo(pa[0],pa[1]);x.lineTo(q[0],q[1]);x.stroke();pa=q}
      x.save();x.translate(a[0],a[1]);x.rotate(ang);x.scale(pk,pk);x.shadowBlur=16;x.shadowColor='#7b6cf6';x.lineWidth=1;x.lineJoin='round';x.strokeStyle='rgba(43,58,143,.75)';
      x.fillStyle='#fff';x.beginPath();x.moveTo(15,0);x.lineTo(-10,-9);x.lineTo(-5,0);x.closePath();x.fill();x.stroke();
      x.fillStyle='#9a88f8';x.beginPath();x.moveTo(15,0);x.lineTo(-5,0);x.lineTo(-10,9);x.closePath();x.fill();x.stroke();
      x.shadowBlur=0;x.fillStyle='#2b3a8f';x.beginPath();x.moveTo(-5,0);x.lineTo(-10,9);x.lineTo(-1,4);x.closePath();x.fill();
      x.restore();x.globalAlpha=1;
    }
    requestAnimationFrame(frame);
  }
  window.__fx={
    lock:function(v){if(cur==='lockO'||cur==='lockC')shape(v?'lockC':'lockO',true)},
    shape:shape,
    burst:function(){P.forEach(function(p){var dx=p.x-cx,dy=p.y-cy,d=Math.hypot(dx,dy)||1;p.vx+=dx/d*9;p.vy+=dy/d*9});sv=.005;svT=.0007},
    success:function(){var f=window.__fx;if(cur==='lockC'){shape('lockO',true);setTimeout(f.burst,500)}else f.burst()},
    setAuth:function(v,inst){auth=v;if(inst)first=true;resize()}};
  resize();init();requestAnimationFrame(frame);
})();
</script>
<script>(function(){var m=document.querySelector('.match');if(!m||!('IntersectionObserver' in window))return;m.classList.add('pre');new IntersectionObserver(function(e,o){if(e[0].isIntersecting){m.classList.remove('pre');o.disconnect()}},{threshold:.3}).observe(m)})();</script>
<script>
(function(){
  var root=document.documentElement,card=document.getElementById('acard'),fL=document.getElementById('fL'),fR=document.getElementById('fR'),fF=document.getElementById('fF'),tabs=document.getElementById('tabs'),tL=document.getElementById('tL'),tR=document.getElementById('tR'),fx=window.__fx;
  function sync(){var a=document.activeElement;fx.lock(!!(a&&a.hasAttribute&&a.hasAttribute('data-pw')&&a.type==='password'))}
  document.addEventListener('focusin',sync);document.addEventListener('focusout',function(){setTimeout(sync,0)});
  [].forEach.call(document.querySelectorAll('.tg'),function(b){
    b.addEventListener('mousedown',function(e){e.preventDefault()});
    b.addEventListener('click',function(){var i=b.parentNode.querySelector('input'),s=i.type==='password';i.type=s?'text':'password';b.textContent=s?'Sembunyikan':'Tampilkan';i.focus();sync()})});
  function show(w){
    var isR = w === 'r';
    var isF = w === 'f';
    fL.hidden = isR || isF;
    fR.hidden = !isR;
    if (fF) fF.hidden = !isF;
    tabs.style.display = isF ? 'none' : 'grid';
    var roleSwitch = document.getElementById('roleSwitch');
    if (roleSwitch) roleSwitch.style.display = isF ? 'none' : 'grid';
    tabs.classList.toggle('r', isR);
    tL.classList.toggle('on', !isR && !isF);
    tR.classList.toggle('on', isR);
    if(fR && isR) fR.scrollTop = 0;
    if(fF && isF) fF.scrollTop = 0;
    [].forEach.call(card.querySelectorAll('.js-msg'), function(e){ e.textContent=''; e.className='js-msg'; });
    fx.shape(isR ? 'person' : 'lockO');
    sync();
  }
  tL.onclick=function(){show('l')};tR.onclick=function(){show('r')};
  [].forEach.call(card.querySelectorAll('[data-to]'),function(b){
    b.onclick=function(){
      show(b.dataset.to);
      push(b.dataset.to === 'f' ? 'lupa-sandi' : (b.dataset.to === 'r' ? 'daftar' : 'masuk'));
    };
  });
  // kekuatan kata sandi
  var mt=document.getElementById('mt'),bars=document.querySelectorAll('#meter i'),L=['','Lemah','Cukup','Baik','Kuat'],C=['','#e5534b','#f0a030','#5b9bf0','#2fb58a'];
  document.getElementById('np').addEventListener('input',function(e){var p=e.target.value,s=0;
    if(p.length>=8)s++;if(/[A-Z]/.test(p)&&/[a-z]/.test(p))s++;if(/\d/.test(p))s++;if(/[^A-Za-z0-9]/.test(p)||p.length>=12)s++;if(!p)s=0;
    [].forEach.call(bars,function(b,i){b.classList.toggle('on',i<s);b.style.setProperty('--c',C[s])});mt.textContent=s?'Kekuatan: '+L[s]:''});
  // buka / tutup mode masuk-daftar (logo berpindah ke kiri)
  function isAuth(){return root.classList.contains('auth')}
  function open(w,inst){
    if(!isAuth()){window.scrollTo({top:0,behavior:'instant'});root.classList.add('auth');fx.setAuth(true,inst)}
    show(w);
    if(!inst&&matchMedia('(hover:hover)').matches)setTimeout(function(){var i=card.querySelector('form:not([hidden]) input');if(i)i.focus({preventScroll:true})},800)}
  function close(){if(!isAuth())return;root.classList.remove('auth');fx.setAuth(false);fx.shape('inf');if(document.activeElement)document.activeElement.blur()}
  function push(h){try{history.pushState({a:1},'',h?'#'+h:location.pathname+location.search)}catch(e){}}
  [].forEach.call(document.querySelectorAll('[data-open]'),function(a){a.addEventListener('click',function(e){e.preventDefault();var w=a.getAttribute('data-open');open(w);push(w==='r'?'daftar':'masuk')})});
  document.querySelector('.brand').addEventListener('click',function(e){if(isAuth()){e.preventDefault();close();push('')}});
  addEventListener('keydown',function(e){if(e.key==='Escape'&&isAuth()){close();push('')}});
  var currentRole = 'member';
  function setRole(role) {
    if (role === 'admin') currentRole = 'admin';
    else if (role === 'creator') currentRole = 'creator';
    else currentRole = 'member';

    var isA = currentRole === 'admin';
    var isC = currentRole === 'creator';
    var rName = isA ? 'Admin' : (isC ? 'Creator' : 'Member');

    var btnM = document.getElementById('rtMember');
    var btnC = document.getElementById('rtCreator');
    var btnA = document.getElementById('rtAdmin');
    if (btnM) btnM.classList.toggle('on', currentRole === 'member');
    if (btnC) btnC.classList.toggle('on', currentRole === 'creator');
    if (btnA) btnA.classList.toggle('on', currentRole === 'admin');

    var inL = document.getElementById('fL_role');
    var inR = document.getElementById('fR_role');
    if (inL) inL.value = currentRole;
    if (inR) inR.value = currentRole;

    var lL = document.getElementById('loginLead');
    if (lL) {
      if (isA) lL.innerHTML = 'Masuk sebagai <b>Admin</b> untuk mengelola sistem & data platform.';
      else if (isC) lL.innerHTML = 'Masuk sebagai <b>Creator</b> untuk mengelola proyek.';
      else lL.innerHTML = 'Masuk sebagai <b>Member</b> untuk melanjutkan ke dashboard.';
    }

    var lB = document.getElementById('loginBtnSubmit');
    if (lB) {
      lB.textContent = 'Masuk sebagai ' + rName;
    }

    var lOr = document.getElementById('loginOrDivider');
    var lG = document.getElementById('loginGoogleLink');
    if (lOr) lOr.style.display = isA ? 'none' : 'flex';
    if (lG) {
      lG.style.display = isA ? 'none' : 'flex';
      lG.href = "{{ route('google.login') }}?role=" + currentRole;
    }
    var lGT = document.getElementById('loginGoogleText');
    if (lGT) lGT.textContent = 'Masuk sebagai ' + rName + ' dengan Google';

    // Jika memilih Admin saat tab pendaftaran sedang terbuka, alihkan ke formulir Masuk
    var fR = document.getElementById('fR');
    if (isA && fR && !fR.hidden) {
      open('l', true);
    }
    var tR = document.getElementById('tR');
    if (tR) {
      if (isA) {
        tR.style.opacity = '0.5';
        tR.title = 'Pendaftaran Admin dilakukan secara internal';
      } else {
        tR.style.opacity = '1';
        tR.title = '';
      }
    }

    var rL = document.getElementById('registerLead');
    if (rL) rL.innerHTML = isC ? 'Daftar sebagai <b>Creator</b> untuk buat tim & kelola proyek.' : 'Daftar sebagai <b>Member</b> untuk bergabung ke proyek.';
    var rB = document.getElementById('registerBtnSubmit');
    if (rB) rB.textContent = 'Daftar sebagai ' + (isA ? 'Member' : rName);
    var rG = document.getElementById('registerGoogleLink');
    if (rG) rG.href = "{{ route('google.login') }}?role=" + (isA ? 'member' : currentRole);
    var rGT = document.getElementById('registerGoogleText');
    if (rGT) rGT.textContent = 'Daftar sebagai ' + (isA ? 'Member' : rName) + ' dengan Google';
  }
  window.setRole = setRole;

  // Klik tab Daftar otomatis keluar dari Admin jika sebelumnya Admin aktif
  var btnTabRegister = document.getElementById('tR');
  if (btnTabRegister) {
    btnTabRegister.addEventListener('click', function() {
      if (currentRole === 'admin') {
        setRole('member');
      }
    });
  }

  function fromUrl(inst){
    var p = location.pathname + location.hash;
    if(/lupa|forgot/i.test(p)) open('f', inst);
    else if(/register|daftar/i.test(p)) open('r', inst);
    else if(/login|masuk/i.test(p)) open('l', inst);
    else close();
  }
  addEventListener('popstate',function(){fromUrl(false)});
  if(/register|daftar|login|masuk|lupa|forgot/i.test(location.pathname+location.hash))fromUrl(true);
  
  @php
    $welcomeInitRole = old('role', old('login_role', request('role', 'member')));
    if (!in_array($welcomeInitRole, ['member', 'creator', 'admin'])) {
      $welcomeInitRole = 'member';
    }
  @endphp
  var searchParams = new URLSearchParams(window.location.search);
  var roleFromQuery = searchParams.get('role');
  var hashMatch = window.location.hash.match(/[?&]role=([^&]+)/);
  var roleFromHash = hashMatch ? decodeURIComponent(hashMatch[1]) : null;
  setRole("{{ $welcomeInitRole }}" || roleFromQuery || roleFromHash || 'member');

  @if (old('is_forgot') || session('status') || session('reset_url'))
    setTimeout(function(){ open('f', true); }, 60);
  @elseif ((isset($errors) && $errors->any()) || session('error') || session('success') || old('is_register') || old('email'))
    setTimeout(function(){ open('{{ old('is_register') ? 'r' : 'l' }}', true); }, 60);
  @endif
  // validasi form interaktif
  function bad(f,t){
    var oldAlert = f.querySelector('.alert-box');
    if(oldAlert) oldAlert.remove();
    var e = f.querySelector('.js-msg');
    if(e){ e.className = 'js-msg bad'; e.textContent = t; }
    card.classList.remove('shake');
    void card.offsetWidth;
    card.classList.add('shake');
  }
  function ok(f,t){
    var e = f.querySelector('.js-msg');
    if(e){ e.className = 'js-msg ok'; e.textContent = t; }
    fx.success();
  }
  fL.addEventListener('input', function(){ var e = fL.querySelector('.js-msg'); if(e && e.textContent){ e.textContent = ''; e.className = 'js-msg'; } });
  fR.addEventListener('input', function(){ var e = fR.querySelector('.js-msg'); if(e && e.textContent){ e.textContent = ''; e.className = 'js-msg'; } });
  if (fF) {
    fF.addEventListener('input', function(){ var e = fF.querySelector('.js-msg'); if(e && e.textContent){ e.textContent = ''; e.className = 'js-msg'; } });
  }

  var re=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  fL.onsubmit=function(e){var v=fL.elements;
    if(!re.test(v.email.value)){e.preventDefault(); return bad(fL,'Masukkan alamat email yang valid.');}
    if(!v.password.value){e.preventDefault(); return bad(fL,'Kata sandi wajib diisi.');}
  };
  fR.onsubmit=function(e){var v=fR.elements;
    if(!v.name.value.trim()){e.preventDefault(); return bad(fR,'Nama lengkap wajib diisi.');}
    if(!re.test(v.email.value)){e.preventDefault(); return bad(fR,'Masukkan alamat email yang valid.');}
    if(v.password.value.length<8){e.preventDefault(); return bad(fR,'Kata sandi minimal 8 karakter.');}
    if(v.password.value!==v.password_confirmation.value){e.preventDefault(); return bad(fR,'Konfirmasi kata sandi tidak sama.');}
  };
  if (fF) {
    fF.onsubmit=function(e){var v=fF.elements;
      if(!re.test(v.email.value)){e.preventDefault(); return bad(fF,'Masukkan alamat email yang valid.');}
    };
  }
})();
</script>

</body>
</html>