<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil — Nama Anda</title>
  <meta name="description" content="Profil pribadi modern gaya glassmorphism — satu halaman, responsif, ringan." />
  <meta name="color-scheme" content="dark light" />
  <style>
    /* ========================
       THEME & RESET
    =========================*/
    :root {
      --bg-1: #0b1020;
      --bg-2: #121a36;
      --text: #e8ecf2;
      --muted: #b8c0d8;
      --glass: 24, 28, 56;         /* rgb base for glass layer */
      --accent: 212 100% 60%;      /* hsl */
      --accent-2: 280 100% 65%;
      --ring: 210 80% 60%;
      --card: rgba(var(--glass), 0.18);
      --stroke: rgba(255, 255, 255, 0.16);
      --shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
      --radius: 18px;
      --maxw: 1120px;
    }

    [data-theme="light"] {
      --bg-1: #eef2ff;
      --bg-2: #dfe7ff;
      --text: #0b1020;
      --muted: #384568;
      --glass: 255, 255, 255;
      --card: rgba(var(--glass), 0.55);
      --stroke: rgba(10, 20, 60, 0.12);
      --shadow: 0 20px 60px rgba(8, 16, 56, 0.15);
    }

    *, *::before, *::after { box-sizing: border-box; }
    html, body { height: 100%; }
    body {
      margin: 0;
      font: 500 16px/1.6 system-ui, -apple-system, Segoe UI, Roboto, Inter, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      color: var(--text);
      background: radial-gradient(1200px 900px at 10% -10%, #4f46e5 0%, transparent 40%),
                  radial-gradient(1000px 800px at 110% 10%, #06b6d4 0%, transparent 40%),
                  radial-gradient(800px 700px at 50% 120%, #9333ea 0%, transparent 40%),
                  linear-gradient(180deg, var(--bg-1), var(--bg-2));
      background-attachment: fixed;
      letter-spacing: 0.1px;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
    }
    img { max-width: 100%; display: block; }
    a { color: hsl(var(--accent)); text-decoration: none; }
    .container { width: min(100% - 32px, var(--maxw)); margin-inline: auto; }

    /* ========================
       DECORATIVE ORBS
    =========================*/
    .orbs { position: fixed; inset: -10vmax; z-index: -1; filter: blur(60px); opacity: 0.55; pointer-events: none; }
    .orbs::before, .orbs::after {
      content: ""; position: absolute; width: 40vmax; height: 40vmax; border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, hsla(212,100%,60%,.8), transparent 60%);
      animation: floatA 18s ease-in-out infinite;
    }
    .orbs::after { left: 55%; top: 20%; background: radial-gradient(circle at 70% 70%, hsla(280,100%,65%,.85), transparent 60%); animation: floatB 22s ease-in-out infinite; }
    @keyframes floatA { 0%,100%{transform: translate3d(0,0,0) scale(1);} 50%{transform: translate3d(4vmax, -2vmax,0) scale(1.05);} }
    @keyframes floatB { 0%,100%{transform: translate3d(0,0,0) scale(1);} 50%{transform: translate3d(-3vmax, 2vmax,0) scale(1.08);} }

    /* ========================
       NAVBAR
    =========================*/
    .nav {
      position: sticky; top: 0; z-index: 50;
      backdrop-filter: saturate(140%) blur(10px); -webkit-backdrop-filter: saturate(140%) blur(10px);
      border-bottom: 1px solid var(--stroke);
      background: linear-gradient(180deg, rgba(10,12,30,.55), rgba(10,12,30,.25));
    }
    .nav-inner { display: flex; align-items: center; justify-content: space-between; gap: 12px; padding: 10px 0; }
    .brand { display: flex; align-items: center; gap: 10px; font-weight: 800; letter-spacing: 0.4px; }
    .brand .dot { width: 10px; height: 10px; border-radius: 999px; background: hsl(var(--accent)); box-shadow: 0 0 24px hsl(var(--accent)); }
    .menu { display: flex; align-items: center; gap: 12px; }
    .menu a { padding: 8px 12px; border-radius: 999px; color: var(--text); border: 1px solid transparent; }
    .menu a:hover, .menu a[aria-current="page"] { border-color: var(--stroke); background: rgba(255,255,255,.06); }
    .nav-actions { display: flex; gap: 8px; align-items: center; }
    .btn, button {
      display: inline-flex; align-items: center; gap: 8px; padding: 10px 14px; border-radius: 999px; border: 1px solid var(--stroke);
      background: linear-gradient(160deg, rgba(255,255,255,.08), rgba(255,255,255,.02));
      color: var(--text); cursor: pointer; box-shadow: var(--shadow);
      backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);
      transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
    }
    .btn:hover { transform: translateY(-1px); border-color: rgba(255,255,255,.28); box-shadow: 0 16px 40px rgba(0,0,0,.35); }
    .btn.primary { border: none; background: linear-gradient(135deg, hsl(var(--accent)), hsl(var(--accent-2))); color: white; }

    /* Mobile */
    .burger { display: none; } 
    @media (max-width: 860px) {
      .menu { display: none; position: absolute; left: 0; right: 0; top: 60px; padding: 12px; gap: 8px; flex-direction: column; background: rgba(10,12,30,.5); border-bottom: 1px solid var(--stroke); }
      .menu.open { display: flex; }
      .burger { display: inline-flex; }
    }

    /* ========================
       SECTIONS & GLASS
    =========================*/
    section { scroll-margin-top: 90px; }
    .pad { padding: clamp(48px, 6vw, 96px) 0; }
    .title { font-size: clamp(28px, 4vw, 42px); line-height: 1.2; letter-spacing: .3px; margin: 0 0 12px; }
    .subtitle { color: var(--muted); margin: 0 0 24px; }
    .grid { display: grid; gap: 18px; }

    .card {
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
    }

    /* ========================
       HERO
    =========================*/
    .hero { padding: 84px 0 48px; }
    .hero-wrap { display: grid; grid-template-columns: 1.2fr .8fr; gap: 28px; align-items: center; }
    .hero .kicker { display: inline-flex; align-items: center; gap: 8px; padding: 6px 10px; border-radius: 999px; border: 1px solid var(--stroke); background: rgba(255,255,255,.06); color: var(--muted); font-size: 13px; }
    .hero h1 { font-size: clamp(36px, 6vw, 64px); line-height: 1.08; margin: 10px 0 14px; letter-spacing: .4px; }
    .hero p { color: var(--muted); font-size: clamp(16px, 2vw, 18px); }
    .actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 18px; }

    .avatar {
      place-self: center; width: min(280px, 70%); aspect-ratio: 1/1; border-radius: 28px; position: relative; isolation: isolate;
      background: linear-gradient(160deg, rgba(255,255,255,.06), rgba(255,255,255,.02));
      border: 1px solid var(--stroke); box-shadow: var(--shadow);
      overflow: hidden; backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    }
    .avatar::before {
      content: ""; position: absolute; inset: -10%; z-index: -1; filter: blur(16px);
      background: conic-gradient(from 60deg, hsl(var(--accent)), hsl(var(--accent-2)), hsl(var(--ring)), hsl(var(--accent)));
      opacity: .4;
    }
    .avatar .ring { position: absolute; inset: -2px; border-radius: 30px; background: linear-gradient(135deg, rgba(255,255,255,.08), rgba(255,255,255,.02)); border: 1px solid var(--stroke); }
    .avatar .img { position: absolute; inset: 10px; border-radius: 22px; background: linear-gradient(160deg, rgba(255,255,255,.1), rgba(255,255,255,.02)); display: grid; place-items: center; font-size: 14px; color: var(--muted); text-align: center; padding: 18px; }

    @media (max-width: 960px) { .hero-wrap { grid-template-columns: 1fr; } .avatar { width: 58vw; max-width: 320px; } }

    /* ========================
       ABOUT
    =========================*/
    .about { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .about p { margin: 0; color: var(--muted); }
    .stat { display: grid; grid-template-columns: auto 1fr; gap: 10px 14px; align-items: center; padding: 16px; }
    .stat b { font-size: 24px; }
    .pill { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 999px; border: 1px solid var(--stroke); background: rgba(255,255,255,.06); color: var(--muted); font-size: 13px; }
    @media (max-width: 960px) { .about { grid-template-columns: 1fr; } }

    /* ========================
       SKILLS
    =========================*/
    .skills { display: grid; grid-template-columns: repeat(12, 1fr); gap: 12px; }
    .skill { grid-column: span 6; padding: 16px; }
    .bar { height: 8px; background: rgba(255,255,255,.08); border: 1px solid var(--stroke); border-radius: 999px; overflow: hidden; }
    .bar > span { display: block; height: 100%; background: linear-gradient(90deg, hsl(var(--accent)), hsl(var(--accent-2))); width: var(--val, 60%); }
    .tags { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; }
    .tag { padding: 6px 10px; border: 1px solid var(--stroke); border-radius: 999px; background: rgba(255,255,255,.06); font-size: 12px; color: var(--muted); }
    @media (max-width: 720px) { .skill { grid-column: span 12; } }

    /* ========================
       PROJECTS
    =========================*/
    .projects { display: grid; grid-template-columns: repeat(12, 1fr); gap: 16px; }
    .project { grid-column: span 4; overflow: hidden; }
    .project .thumb { aspect-ratio: 16/10; background: linear-gradient(135deg, rgba(255,255,255,.08), rgba(255,255,255,.02)); border-bottom: 1px solid var(--stroke); display: grid; place-items: center; color: var(--muted); }
    .project .meta { padding: 14px 14px 16px; }
    .project h3 { margin: 0 0 4px; font-size: 18px; }
    .project p { margin: 0; color: var(--muted); font-size: 14px; }
    .project .meta .links { margin-top: 10px; display: flex; gap: 8px; }
    @media (max-width: 960px) { .project { grid-column: span 6; } }
    @media (max-width: 680px) { .project { grid-column: span 12; } }

    /* ========================
       TIMELINE
    =========================*/
    .timeline { position: relative; padding-left: 22px; }
    .timeline::before { content: ""; position: absolute; left: 8px; top: 4px; bottom: 4px; width: 2px; background: linear-gradient(180deg, rgba(255,255,255,.2), rgba(255,255,255,.05)); border-radius: 999px; }
    .timeline .item { position: relative; padding: 14px 16px 14px 18px; margin-bottom: 12px; }
    .timeline .item::before { content: ""; position: absolute; left: -15px; top: 18px; width: 10px; height: 10px; border-radius: 999px; background: hsl(var(--accent)); box-shadow: 0 0 0 3px rgba(255,255,255,.08); }
    .timeline small { color: var(--muted); }

    /* ========================
       CONTACT
    =========================*/
    .contact-wrap { display: grid; grid-template-columns: .9fr 1.1fr; gap: 18px; }
    .contact .list { padding: 16px; }
    .contact .row { display: grid; grid-template-columns: 28px 1fr auto; gap: 10px; align-items: center; padding: 10px 0; border-bottom: 1px dashed var(--stroke); }
    .contact .row:last-child { border-bottom: 0; }
    .contact form { padding: 16px; display: grid; gap: 10px; }
    .field { display: grid; gap: 6px; }
    .input, textarea { width: 100%; padding: 12px 14px; border-radius: 12px; border: 1px solid var(--stroke); background: rgba(255,255,255,.06); color: var(--text); outline: none; }
    textarea { min-height: 120px; resize: vertical; }
    .note { color: var(--muted); font-size: 13px; }
    @media (max-width: 960px) { .contact-wrap { grid-template-columns: 1fr; } }

    /* ========================
       FOOTER
    =========================*/
    footer { padding: 28px 0 60px; color: var(--muted); text-align: center; }

    /* Back to top */
    .to-top { position: fixed; right: 16px; bottom: 16px; z-index: 40; opacity: 0; pointer-events: none; transform: translateY(10px); transition: .25s ease; }
    .to-top.show { opacity: 1; pointer-events: auto; transform: translateY(0); }

    /* Utility */
    .row { display: flex; gap: 10px; align-items: center; }
    .spacer { height: 1px; background: var(--stroke); margin: 18px 0; }
  </style>
</head>
<body>
  <div class="orbs" aria-hidden="true"></div>

  <!-- NAVBAR -->
  <nav class="nav">
    <div class="container nav-inner">
      <div class="brand"><span class="dot"></span> <span id="brandName">Nama Anda</span></div>
      <button class="btn burger" aria-label="Toggle Menu" id="burger">☰</button>
      <div class="menu" id="menu">
        <a href="#home">Home</a>
        <a href="#about">Tentang</a>
        <a href="#skills">Keahlian</a>
        <a href="#projects">Proyek</a>
        <a href="#experience">Pengalaman</a>
        <a href="#contact">Kontak</a>
      </div>
      <div class="nav-actions">
        <button class="btn" id="themeBtn" title="Ganti tema">🌓</button>
        <a class="btn primary" href="#contact">Hire Me</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header id="home" class="hero container">
    <div class="hero-wrap">
      <div>
        <span class="kicker">👋 Halo, saya</span>
        <h1>{{$name}} — <span style="background:linear-gradient(90deg,hsl(var(--accent)),hsl(var(--accent-2)));-webkit-background-clip:text;background-clip:text;color:transparent">{{$specialist}}</span></h1>
        <p>Saya membangun antarmuka modern, cepat, dan aman. Fokus pada pengalaman pengguna, aksesibilitas, dan performa. Tersedia untuk freelance & kolaborasi.</p>
        <div class="actions">
          <a class="btn primary" href="#projects">Lihat Proyek</a>
          <a class="btn" href="resume.pdf" download>⬇️ Download CV</a>
          <button class="btn" id="copyEmail">📧 Salin Email</button>
        </div>
      </div>
      <div class="avatar card" aria-label="Avatar">
        <div class="ring"></div>
        <div class="img">Ganti dengan foto profil Anda (1:1).<br/>Taruh file foto dengan CSS background-image jika perlu.</div>
      </div>
    </div>
  </header>

  <!-- ABOUT -->
  <section id="about" class="pad container">
    <div class="grid about">
      <div class="card" style="padding:18px;">
        <h2 class="title">Tentang Saya</h2>
        <p>Saya seorang developer yang menyukai arsitektur bersih, automasi, dan desain yang ramah pengguna. Terbiasa dengan <b>Laravel</b>, <b>Vue/React</b>, <b>Flutter</b>, dan <b>DevOps</b> ringan. Saya percaya pada kolaborasi, dokumentasi yang baik, dan pengiriman bertahap.</p>
        <div class="tags" style="margin-top:14px;">
          <span class="pill">⚡ Performa</span>
          <span class="pill">🔒 Keamanan</span>
          <span class="pill">🧪 Testing</span>
          <span class="pill">🎨 UI/UX</span>
        </div>
        <div class="spacer"></div>
        <div class="grid" style="grid-template-columns: repeat(3,1fr); gap:12px;">
          <div class="card stat"><b>5+</b><span>tahun pengalaman</span></div>
          <div class="card stat"><b>40+</b><span>proyek dikirim</span></div>
          <div class="card stat"><b>∞</b><span>rasa ingin tahu</span></div>
        </div>
      </div>
      <div class="card" style="padding:18px;">
        <h2 class="title">Layanan</h2>
        <div class="grid" style="grid-template-columns: 1fr; gap:12px;">
          <div class="card" style="padding:14px;">
            <div class="row"><b>Website Modern</b><span class="pill">SPA/MPA</span></div>
            <p class="subtitle">Dari landing page cepat hingga dashboard kompleks.</p>
          </div>
          <div class="card" style="padding:14px;">
            <div class="row"><b>Aplikasi Mobile</b><span class="pill">Flutter</span></div>
            <p class="subtitle">Build iOS & Android sekali kode, dengan kualitas native.</p>
          </div>
          <div class="card" style="padding:14px;">
            <div class="row"><b>Integrasi & API</b><span class="pill">REST/GraphQL</span></div>
            <p class="subtitle">Desain, dokumentasi, dan keamanan endpoint.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SKILLS -->
  <section id="skills" class="pad container">
    <h2 class="title">Keahlian</h2>
    <p class="subtitle">Tingkat kemampuan (perkiraan) dan tools favorit.</p>
    <div class="skills">
      <div class="card skill">
        <div class="row"><b>Laravel / PHP</b><span class="pill">Backend</span></div>
        <div class="bar" aria-label="Laravel level"><span style="--val: 88%"></span></div>
        <div class="tags">
          <span class="tag">Filament</span><span class="tag">Livewire</span><span class="tag">Pest</span><span class="tag">MySQL</span>
        </div>
      </div>
      <div class="card skill">
        <div class="row"><b>Flutter</b><span class="pill">Mobile</span></div>
        <div class="bar"><span style="--val: 80%"></span></div>
        <div class="tags"><span class="tag">GetX</span><span class="tag">Dio</span><span class="tag">Hive</span></div>
      </div>
      <div class="card skill">
        <div class="row"><b>JavaScript</b><span class="pill">Front‑End</span></div>
        <div class="bar"><span style="--val: 82%"></span></div>
        <div class="tags"><span class="tag">Vue</span><span class="tag">React</span><span class="tag">Vite</span></div>
      </div>
      <div class="card skill">
        <div class="row"><b>DevOps</b><span class="pill">Ops</span></div>
        <div class="bar"><span style="--val: 65%"></span></div>
        <div class="tags"><span class="tag">Docker</span><span class="tag">Nginx</span><span class="tag">CI/CD</span></div>
      </div>
    </div>
  </section>

  <!-- PROJECTS -->
  <section id="projects" class="pad container">
    <h2 class="title">Proyek Pilihan</h2>
    <p class="subtitle">Beberapa karya publik yang bisa dibuka.</p>
    <div class="projects">
      <article class="card project">
        <div class="thumb">Gambar / Preview</div>
        <div class="meta">
          <h3>Dashboard Koperasi</h3>
          <p>Analitik keuangan real‑time, COA, dan laporan otomatis.</p>
          <div class="links">
            <a class="btn" href="#">Demo</a>
            <a class="btn" href="#">Kode</a>
          </div>
        </div>
      </article>
      <article class="card project">
        <div class="thumb">Gambar / Preview</div>
        <div class="meta">
          <h3>Budgetin App</h3>
          <p>Aplikasi budgeting keluarga dengan voice input.</p>
          <div class="links">
            <a class="btn" href="#">Demo</a>
            <a class="btn" href="#">Kode</a>
          </div>
        </div>
      </article>
      <article class="card project">
        <div class="thumb">Gambar / Preview</div>
        <div class="meta">
          <h3>RSUD ICU Dashboard</h3>
          <p>Monitoring pasien & notifikasi realtime untuk tenaga kesehatan.</p>
          <div class="links">
            <a class="btn" href="#">Demo</a>
            <a class="btn" href="#">Kode</a>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!-- EXPERIENCE / TIMELINE -->
  <section id="experience" class="pad container">
    <h2 class="title">Pengalaman</h2>
    <div class="timeline">
      <div class="card item">
        <b>Senior Full‑Stack Developer — PT HMS</b>
        <div><small>2023 — Sekarang</small></div>
        <p class="subtitle">Memimpin pengembangan platform koperasi, integrasi API, dan pipeline CI/CD.</p>
      </div>
      <div class="card item">
        <b>Mobile Engineer — Freelance</b>
        <div><small>2021 — 2023</small></div>
        <p class="subtitle">Membangun aplikasi Flutter multi‑platform untuk UMKM & edukasi.</p>
      </div>
      <div class="card item">
        <b>Web Developer — Berbagai Klien</b>
        <div><small>2019 — 2021</small></div>
        <p class="subtitle">Landing page, e‑commerce kecil, dan panel admin kustom.</p>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="pad container contact">
    <h2 class="title">Kontak</h2>
    <p class="subtitle">Butuh sesuatu yang cepat? Kirim pesan langsung.</p>
    <div class="contact-wrap">
      <div class="card list">
        <div class="row"><span>📧</span><b id="emailText">email@domain.com</b><button class="btn" data-copy="#emailText">Salin</button></div>
        <div class="row"><span>🔗</span><span>Github</span><a class="btn" href="#">Buka</a></div>
        <div class="row"><span>💼</span><span>LinkedIn</span><a class="btn" href="#">Buka</a></div>
        <div class="row"><span>📍</span><span>Surabaya, ID</span><span class="pill">Remote OK</span></div>
      </div>
      <form class="card" onsubmit="sendMail(event)">
        <div class="field">
          <label>Nama</label>
          <input class="input" id="fName" required placeholder="Nama Anda" />
        </div>
        <div class="field">
          <label>Email</label>
          <input class="input" id="fEmail" type="email" required placeholder="email@domain.com" />
        </div>
        <div class="field">
          <label>Pesan</label>
          <textarea id="fMsg" required placeholder="Tulis pesan Anda..."></textarea>
        </div>
        <div class="row" style="justify-content: space-between;">
          <button class="btn primary" type="submit" style="width: 60px;">Kirim</button>
        </div>
      </form>
    </div>
  </section>

  <footer>
    © <span id="year"></span> Nama Anda — Dibuat dengan ❤️, HTML/CSS/JS.
  </footer>

  <button class="btn to-top" id="toTop" aria-label="Kembali ke atas">↑</button>

  <script>
    // ========================
    // Helpers
    // ========================
    const $ = (q, el=document) => el.querySelector(q);
    const $$ = (q, el=document) => [...el.querySelectorAll(q)];

    // Sticky active link (scroll spy)
    const menuLinks = $$('#menu a');
    const sections = menuLinks.map(a => $(a.getAttribute('href'))).filter(Boolean);
    const io = new IntersectionObserver((entries) => {
      entries.forEach(ent => {
        if (ent.isIntersecting) {
          const id = '#' + ent.target.id;
          menuLinks.forEach(a => a.removeAttribute('aria-current'));
          const active = menuLinks.find(a => a.getAttribute('href') === id);
          if (active) active.setAttribute('aria-current', 'page');
        }
      });
    }, { rootMargin: '-60% 0px -35% 0px', threshold: 0 });
    sections.forEach(s => io.observe(s));

    // Smooth anchor
    $$('#menu a, .actions a').forEach(a => a.addEventListener('click', e => {
      const href = a.getAttribute('href');
      if (href.startsWith('#')) {
        e.preventDefault();
        $(href).scrollIntoView({ behavior: 'smooth' });
        $('#menu').classList.remove('open');
      }
    }));

    // Burger
    $('#burger').addEventListener('click', () => $('#menu').classList.toggle('open'));

    // Theme toggle
    const themeBtn = $('#themeBtn');
    const root = document.documentElement;
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) document.documentElement.setAttribute('data-theme', savedTheme);
    themeBtn.addEventListener('click', () => {
      const cur = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
      root.setAttribute('data-theme', cur);
      localStorage.setItem('theme', cur);
    });

    // Back to top
    const toTop = $('#toTop');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 600) toTop.classList.add('show'); else toTop.classList.remove('show');
    });
    toTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Copy email
    const copy = (el) => {
      const text = typeof el === 'string' ? $(el).textContent.trim() : el.textContent.trim();
      navigator.clipboard.writeText(text).then(() => {
        const old = themeBtn.textContent; themeBtn.textContent = '✅ Disalin'; setTimeout(()=> themeBtn.textContent = '🌓', 1200);
      });
    };
    $('#copyEmail').addEventListener('click', () => copy('#emailText'));
    $$('[data-copy]').forEach(btn => btn.addEventListener('click', () => copy(btn.getAttribute('data-copy'))));

    // Mailto form (no backend)
    function sendMail(e){
      e.preventDefault();
      const name = encodeURIComponent($('#fName').value);
      const email = encodeURIComponent($('#fEmail').value);
      const msg = encodeURIComponent($('#fMsg').value);
      const subject = `Halo, saya ${name}`;
      const body = `Nama: ${name}%0AEmail: ${email}%0A%0A${msg}`;
      window.location.href = `mailto:email@domain.com?subject=${subject}&body=${body}`;
    }

    // Year & example brand from <title>
    $('#year').textContent = new Date().getFullYear();
    const docTitle = document.title.split('—')[0].trim();
    if (docTitle) $('#brandName').textContent = docTitle.replace('Profil', '');
  </script>
</body>
</html>