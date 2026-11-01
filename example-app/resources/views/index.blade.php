<?php
// 1. Mulai session di bagian paling atas agar bisa membaca data user yang login
session_start();

// LOGIKA PROSES LOGOUT (Jika user klik tombol logout)
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangos Company - Digital & Travel Solution</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font: Fraunces (judul) + Manrope (teks) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700;9..144,800&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #0e0b08;
            --panel: #17120d;
            --line: rgba(255, 236, 200, 0.12);
            --mango: #f2b632;
            --mango-deep: #d98b1c;
            --cream: #f6efe2;
            --muted: #b9ae9c;
        }
        html { scroll-behavior: smooth; }
        body {
            background: var(--ink);
            color: var(--cream);
            font-family: 'Manrope', 'Segoe UI', sans-serif;
            line-height: 1.75;
            overflow-x: hidden;
        }
        h1, h2, h3, h4, .navbar-brand { font-family: 'Fraunces', Georgia, serif; }
        a:focus-visible, button:focus-visible, input:focus-visible {
            outline: 2px solid var(--mango);
            outline-offset: 3px;
        }

        /* Navbar */
        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(14, 11, 8, 0.78);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
            padding: 14px 0;
        }
        .navbar-brand {
            color: var(--mango) !important;
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-nav .nav-link {
            color: var(--muted) !important;
            font-weight: 600;
            position: relative;
            transition: color 0.2s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active { color: var(--mango) !important; }
        .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            left: 0.5rem;
            right: 0.5rem;
            bottom: 2px;
            height: 2px;
            background: var(--mango);
        }
        .form-control-dark {
            background: #1d1710;
            border: 1px solid var(--line);
            color: #fff;
            border-radius: 999px;
            padding-left: 1.1rem;
        }
        .form-control-dark::placeholder { color: #8d826f; }
        .form-control-dark:focus {
            background: #221a11;
            color: #fff;
            border-color: var(--mango);
            box-shadow: 0 0 0 3px rgba(242, 182, 50, 0.18);
        }
        .navbar form .btn { border-radius: 999px; }

        /* Hero sinematik: foto muncul dari kegelapan, satu urutan animasi saat dimuat */
        .hero {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            display: flex;
            align-items: center;
            min-height: min(92vh, 860px);
            padding: 70px 0 110px;
            background: radial-gradient(600px 400px at 15% 25%, rgba(242, 182, 50, 0.10), transparent 70%);
        }
        .hero::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 160px;
            background: linear-gradient(to top, var(--ink), transparent);
            z-index: -1;
        }
        .hero-media {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 70%;
            z-index: -2;
            -webkit-mask-image: linear-gradient(to right, transparent 0, #000 45%);
            mask-image: linear-gradient(to right, transparent 0, #000 45%);
        }
        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 22%;
            transform: scale(1.12);
            animation: settle 22s ease-out forwards;
        }
        @keyframes settle {
            to { transform: scale(1.02); }
        }
        .hero-in {
            opacity: 0;
            transform: translateY(16px);
            animation: rise 0.8s ease forwards;
            animation-delay: calc(var(--i) * 0.12s);
        }
        @keyframes rise {
            to { opacity: 1; transform: none; }
        }
        .hero-copy { max-width: 600px; }
        .hero h1 {
            font-size: clamp(3.2rem, 9vw, 7rem);
            font-weight: 800;
            line-height: 0.95;
            letter-spacing: -0.035em;
            margin: 0 0 0.9rem;
            background: linear-gradient(180deg, #fff8e6 30%, var(--mango) 130%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-sub {
            font-family: 'Fraunces', Georgia, serif;
            font-style: italic;
            font-size: 1.5rem;
            color: var(--mango);
            margin-bottom: 1.3rem;
        }
        .hero p.hero-text {
            color: var(--muted);
            max-width: 52ch;
            margin-bottom: 1.2rem;
        }
        .tag {
            display: inline-block;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.04);
            border-radius: 999px;
            padding: 0.3rem 0.95rem;
            font-size: 0.85rem;
            color: var(--cream);
            margin: 0.3rem 0.4rem 0.3rem 0;
        }

        /* Tombol utama */
        .btn-custom {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--mango), var(--mango-deep));
            color: #1a1206;
            font-weight: 700;
            padding: 0.75rem 1.6rem;
            border: 0;
            border-radius: 999px;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-custom:hover {
            color: #1a1206;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(242, 182, 50, 0.35);
        }

        /* Pernyataan perusahaan */
        .statement { padding: 70px 0 40px; }
        .quote {
            font-family: 'Fraunces', Georgia, serif;
            font-weight: 600;
            font-size: clamp(1.9rem, 3.8vw, 3.1rem);
            line-height: 1.18;
            letter-spacing: -0.015em;
            border-left: 3px solid var(--mango);
            padding-left: 1.5rem;
            margin: 0;
        }
        .quote-sub { color: var(--muted); max-width: 46ch; margin: 0; }

        /* Company Overview: tata letak bento */
        .overview { padding: 50px 0 60px; }
        .section-title {
            font-size: clamp(1.9rem, 3.4vw, 2.6rem);
            font-weight: 700;
            margin-bottom: 0.8rem;
        }
        .section-title::after {
            content: "";
            display: block;
            width: 56px;
            height: 3px;
            border-radius: 2px;
            background: var(--mango);
            margin-top: 14px;
        }
        .section-lead { color: var(--muted); max-width: 62ch; margin-bottom: 2.4rem; }
        .bento {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .bento .feature { grid-row: span 2; }
        .tile {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            background: linear-gradient(160deg, #1b150f, var(--panel));
            border: 1px solid var(--line);
            border-radius: 22px;
            transition: border-color 0.25s ease;
        }
        .tile > * { position: relative; }
        .tile:hover { border-color: rgba(242, 182, 50, 0.55); }
        .tile::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: 0;
            background: radial-gradient(380px circle at var(--x, 50%) var(--y, 0%), rgba(242, 182, 50, 0.16), transparent 60%);
            transition: opacity 0.3s ease;
        }
        .tile:hover::before { opacity: 1; }
        .tile.feature {
            border-color: rgba(242, 182, 50, 0.3);
            background: radial-gradient(420px 260px at 100% 0%, rgba(242, 182, 50, 0.12), transparent 70%), linear-gradient(160deg, #1b150f, var(--panel));
        }
        .icon-box {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            border-radius: 14px;
            background: rgba(242, 182, 50, 0.12);
            border: 1px solid rgba(242, 182, 50, 0.3);
            margin-bottom: 1.1rem;
        }
        .tile-title {
            font-weight: 700;
            font-size: 1.7rem;
            margin-bottom: 0.9rem;
        }
        .tile-text { color: var(--muted); font-size: 0.97rem; }
        .member-list {
            list-style: none;
            padding: 0;
            margin: 0.4rem 0 1.6rem;
        }
        .member-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 0;
            border-top: 1px solid var(--line);
        }
        .avatar {
            width: 56px;
            height: 56px;
            flex: none;
            border-radius: 50%;
            object-fit: cover;
            object-position: center top;
            border: 2px solid var(--mango);
        }
        .member-list strong { display: block; color: var(--cream); line-height: 1.3; }
        .member-list span { display: block; color: var(--muted); font-size: 0.9rem; line-height: 1.4; }

        /* Ajakan penutup */
        .cta-box {
            margin-bottom: 90px;
            padding: clamp(2.4rem, 6vw, 4.2rem) 1.5rem;
            text-align: center;
            border: 1px solid rgba(242, 182, 50, 0.35);
            border-radius: 28px;
            background: radial-gradient(560px 240px at 50% 0%, rgba(242, 182, 50, 0.18), transparent 70%), var(--panel);
        }
        .cta-box h2 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; }
        .cta-box p { color: var(--muted); max-width: 52ch; margin: 0.6rem auto 1.7rem; }

        /* Footer */
        .site-footer {
            border-top: 1px solid var(--line);
            background: #0a0805;
            color: var(--muted);
            padding: 28px 0;
            font-size: 0.92rem;
        }
        .site-footer .foot-brand {
            font-family: 'Fraunces', Georgia, serif;
            color: var(--mango);
            font-weight: 700;
            font-size: 1.1rem;
        }

        @media (max-width: 991px) {
            .hero { min-height: auto; padding: 300px 0 60px; }
            .hero-media {
                width: 100%;
                height: 420px;
                bottom: auto;
                -webkit-mask-image: linear-gradient(to bottom, #000 45%, transparent);
                mask-image: linear-gradient(to bottom, #000 45%, transparent);
            }
            .bento { grid-template-columns: 1fr; }
            .bento .feature { grid-row: auto; }
            .tile { padding: 1.6rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .hero-in { animation: none; opacity: 1; transform: none; }
            .hero-img { animation: none; transform: none; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <!-- Navbar Atas -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container px-3 px-lg-4">
                <a class="navbar-brand" href="#">
                    <span>🥭</span> Mangos Company
                </a>
                <button class="navbar-toggler border-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#overview">Overview</a>
                        </li>
                    </ul>
                    <!-- Search Bar di Kanan Atas -->
                    <form class="d-flex flex-wrap align-items-center gap-2" role="search">
                        <input class="form-control form-control-dark" type="search" placeholder="Search..." aria-label="Search" />
                        <button class="btn btn-outline-warning text-nowrap" type="submit">Search</button>

                        <?php if (isset($_SESSION['user_nama']) || !empty($user_login_aktif)): 
                            $nama_tampil = isset($_SESSION['user_nama']) ? $_SESSION['user_nama'] : $user_login_aktif;
                        ?>
                            <span class="navbar-text ms-2 text-warning fw-bold">Hi, <?php echo htmlspecialchars($nama_tampil); ?> 👋</span>
                            <a href="?action=logout" class="btn btn-danger btn-sm text-nowrap">Keluar</a>
                        <?php else: ?>
                            <a href="form_tiket.php?action=register" class="btn btn-warning btn-sm text-dark fw-bold text-nowrap">Login / Register</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <header class="hero">
            <div class="hero-media">
                <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) sesuai direktori public kamu -->
                <img src="{{ asset('image/index.png') }}" class="hero-img" alt="Foto bertiga">
            </div>
            <div class="container px-4">
                <div class="hero-copy">
                    <h1 class="hero-in" style="--i:0">Mangoes<br>Company</h1>
                    <p class="hero-sub hero-in" style="--i:1">Digital &amp; Travel Solution</p>
                    <p class="hero-text hero-in" style="--i:2">Welcome to Mangoes Company, an innovative digital enterprise and premier technology hub dedicated to crafting exceptional software solutions, advanced web architectures, and seamless digital experiences. Driven by a passionate team of elite programmers, visionary developers, and strategic project managers, we combine rigorous technical logic with creative brilliance to empower modern businesses and elevate digital standards worldwide.</p>
                    <div class="hero-in mb-4" style="--i:3">
                        <span class="tag">Web Architecture</span>
                        <span class="tag">Software Engineering</span>
                        <span class="tag">Tourism Platforms</span>
                    </div>
                    <a href="#overview" class="btn-custom hero-in" style="--i:4">Explore our company</a>
                </div>
            </div>
        </header>

        <!-- Pernyataan perusahaan -->
        <section class="statement">
            <div class="container px-4">
                <div class="row align-items-end g-4">
                    <div class="col-lg-7">
                        <p class="quote">We believe technology should feel effortless for the people who use it.</p>
                    </div>
                    <div class="col-lg-5">
                        <p class="quote-sub">From the first sketch to the final deployment, every project is shaped by clean code, thoughtful design, and transparent collaboration. That is why we care about performance, security, and the small details that turn a good product into a memorable one.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3 Bagian Utama (Our Member, About Our Company, Order) -->
        <section class="overview" id="overview">
            <div class="container px-4">
                <h2 class="section-title">Company Overview</h2>
                <p class="section-lead">Meet the people behind our work, learn what drives the company, and reserve your next trip in just a few simple steps.</p>

                <div class="bento">
                    <!-- 1. Our Member -->
                    <div class="tile feature spot">
                        <div class="icon-box">👥</div>
                        <h3 class="tile-title">Our Member</h3>
                        <p class="tile-text">
                            Our elite team features world-class professionals dedicated to innovation. Each member brings deep expertise and a shared commitment to quality, so together they deliver state-of-the-art technological solutions.
                        </p>
                        <ul class="member-list flex-grow-1">
                            <li>
                                <img src="{{ asset('image/adrian.jpeg') }}" class="avatar" alt="Kadek">
                                <div><strong>Kadek</strong><span>Professional Programmer &amp; Software Architect</span></div>
                            </li>
                            <li>
                                <img src="{{ asset('image/rian.jpg') }}" class="avatar" alt="Rian">
                                <div><strong>Rizkyansyah / Rian</strong><span>Vibe Coder &amp; Full-Stack Developer</span></div>
                            </li>
                            <li>
                                <img src="{{ asset('image/rizal.jpeg') }}" class="avatar" alt="Rizal">
                                <div><strong>Rizal</strong><span>Professional Web Maker &amp; Project Manager</span></div>
                            </li>
                        </ul>
                        <a href="{{ route('deskripsi.singkat') }}" class="btn-custom align-self-start">See Member</a>
                    </div>

                    <!-- 2. About Our Company -->
                    <div class="tile spot">
                        <div class="icon-box">🏢</div>
                        <h3 class="tile-title">About Our Company</h3>
                        <p class="tile-text">
                            Mangoes Company is a premier digital and technology enterprise specializing in robust web architecture, software engineering, and modern tourism management platforms. We combine analytical precision with creative vision to produce exceptional, high-performance digital experiences for clients worldwide.
                        </p>
                        <p class="tile-text flex-grow-1">
                            Every product we build is planned around real users, tested carefully, and delivered with clear communication, so our partners always know where their project stands and where it is heading.
                        </p>
                        <a href="{{ route('deskripsi.singkat') }}" class="btn-custom align-self-start">More About</a>
                    </div>

                    <!-- 3. Order -->
                    <div class="tile spot">
                        <div class="icon-box">🎫</div>
                        <h3 class="tile-title">Order</h3>
                        <p class="tile-text">
                            Ready to book your next adventure or explore our exclusive reservation services? Access our seamless ticketing and accommodation management portal right away to secure your bookings securely and efficiently with professional support.
                        </p>
                        <p class="tile-text flex-grow-1">
                            Our system keeps every reservation organized from start to finish, with clear confirmations and a responsive team ready to help whenever you need it.
                        </p>
                        <a href="{{ route('howto') }}" class="btn-custom align-self-start">Reservation</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Ajakan penutup -->
        <section class="container px-4">
            <div class="cta-box">
                <h2>Ready to book your next adventure?</h2>
                <p>Open our reservation portal and secure your tickets and accommodation with professional support from the first click to the final confirmation.</p>
                <a href="{{ route('deskripsi.singkat') }}" class="btn-custom">Reservation</a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="container px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <span class="foot-brand">🥭 Mangos Company</span>
                <span>&copy; 2026 Mangos Company. All Rights Reserved.</span>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cahaya emas yang mengikuti kursor pada kartu
        document.querySelectorAll('.spot').forEach(function (el) {
            el.addEventListener('pointermove', function (e) {
                var r = el.getBoundingClientRect();
                el.style.setProperty('--x', (e.clientX - r.left) + 'px');
                el.style.setProperty('--y', (e.clientY - r.top) + 'px');
            });
        });
    </script>
</body>
</html>