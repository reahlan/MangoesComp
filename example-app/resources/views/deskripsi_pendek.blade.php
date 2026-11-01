<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Of Mangoes Company</title>

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
        h1, h2, h3, h4, h5, .navbar-brand { font-family: 'Fraunces', Georgia, serif; }
        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--mango);
            outline-offset: 3px;
        }

        /* Navbar */
        .navbar-custom {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(14, 11, 8, 0.82);
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
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.4rem;
        }
        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease, background-color 0.2s ease;
        }
        .nav-links a:hover { color: var(--mango); }
        .nav-links a.nav-pill {
            color: var(--mango);
            border: 1px solid rgba(242, 182, 50, 0.5);
            border-radius: 999px;
            padding: 0.35rem 1.05rem;
        }
        .nav-links a.nav-pill:hover {
            background: var(--mango);
            color: #1a1206;
        }

        /* Judul halaman: satu momen animasi saat halaman dimuat */
        .page-head {
            text-align: center;
            padding: 64px 0 40px;
            background: radial-gradient(700px 360px at 50% 0%, rgba(242, 182, 50, 0.13), transparent 70%);
        }
        .in {
            opacity: 0;
            transform: translateY(16px);
            animation: rise 0.8s ease forwards;
            animation-delay: calc(var(--i) * 0.12s);
        }
        @keyframes rise {
            to { opacity: 1; transform: none; }
        }
        .section-title {
            font-size: clamp(2.2rem, 5vw, 3.6rem);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin-bottom: 0;
        }
        .section-title-wrapper::after {
            content: "";
            display: block;
            width: 140px;
            height: 4px;
            margin: 22px auto 0;
            border-radius: 2px;
            background: linear-gradient(90deg, transparent, var(--mango), var(--mango-deep), transparent);
        }
        .section-lead {
            color: var(--muted);
            max-width: 62ch;
            margin: 1.2rem auto 0;
        }

        /* Kartu member */
        .members { padding: 20px 0 40px; }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-top: 3px solid var(--mango);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.55);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .card:hover {
            border-color: rgba(242, 182, 50, 0.6);
            box-shadow: 0 24px 50px rgba(0, 0, 0, 0.7), 0 0 28px rgba(242, 182, 50, 0.14);
        }

        /* Efek foto menonjol maju saat kursor mendekat */
        .img-hover-zoom {
            position: relative;
            overflow: hidden;
        }
        .img-hover-zoom img {
            display: block;
            width: 100%;
            height: 340px;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.6s ease;
        }
        .img-hover-zoom::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 45%;
            background: linear-gradient(to top, var(--panel), transparent);
            pointer-events: none;
        }
        .card:hover .img-hover-zoom img { transform: scale(1.08); }

        .card-body {
            position: relative;
            margin-top: -1.4rem;
        }
        .card-title {
            font-family: 'Fraunces', Georgia, serif;
            color: var(--mango);
            font-weight: 700;
            font-size: 1.45rem;
            margin-bottom: 0.8rem;
        }
        .card-text {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.75;
        }

        /* Tombol */
        .btn-custom {
            background: linear-gradient(135deg, var(--mango), var(--mango-deep));
            border: 0;
            color: #1a1206;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 999px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-custom:hover,
        .btn-custom:active {
            background: linear-gradient(135deg, var(--mango), var(--mango-deep));
            color: #1a1206;
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(242, 182, 50, 0.35);
        }

        /* More about Mangoes Company */
        .about-more { padding: 40px 0 90px; }
        .about-title { font-size: clamp(1.9rem, 3.6vw, 2.8rem); font-weight: 700; margin-bottom: 0.8rem; }
        .about-title::after {
            content: "";
            display: block;
            width: 56px;
            height: 3px;
            border-radius: 2px;
            background: var(--mango);
            margin-top: 14px;
        }
        .about-lead { color: var(--muted); max-width: 62ch; margin-bottom: 2.4rem; }
        .bento { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
        .bento .feature { grid-row: span 2; }
        .bento .wide { grid-column: 1 / -1; }
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
        .tile-title { font-size: 1.6rem; font-weight: 700; margin-bottom: 0.9rem; }
        .tile-text { color: var(--muted); font-size: 0.97rem; }
        .tagline {
            font-family: 'Fraunces', Georgia, serif;
            font-style: italic;
            font-size: clamp(1.5rem, 2.6vw, 2.1rem);
            line-height: 1.25;
            color: var(--mango);
            margin: 1.4rem 0 0;
            padding-top: 1.2rem;
            border-top: 1px solid var(--line);
        }
        .service { display: flex; gap: 1rem; padding: 0.9rem 0; border-top: 1px solid var(--line); }
        .service .ico {
            flex: none;
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            font-size: 1.3rem;
            border-radius: 12px;
            background: rgba(242, 182, 50, 0.12);
            border: 1px solid rgba(242, 182, 50, 0.3);
        }
        .service strong { display: block; line-height: 1.3; }
        .service span { display: block; color: var(--muted); font-size: 0.9rem; line-height: 1.5; }
        .tag {
            display: inline-block;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.04);
            border-radius: 999px;
            padding: 0.3rem 0.95rem;
            font-size: 0.85rem;
            margin: 0.3rem 0.4rem 0.3rem 0;
        }
        .steps {
            position: relative;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-top: 1.4rem;
            padding-top: 2.6rem;
        }
        .steps::before, .steps::after {
            content: "";
            position: absolute;
            top: 1.1rem;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--line);
        }
        .steps::after {
            background: linear-gradient(90deg, var(--mango), var(--mango-deep));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 1.8s ease;
        }
        .steps.on::after { transform: scaleX(1); }
        .step { position: relative; }
        .step .dot {
            position: absolute;
            top: -2.55rem;
            left: 0;
            width: 2.1rem;
            height: 2.1rem;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: var(--ink);
            border: 2px solid var(--mango);
            color: var(--mango);
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 1;
        }
        .step h4 { font-size: 1.25rem; margin-bottom: 0.4rem; }
        .step p { color: var(--muted); font-size: 0.93rem; margin: 0; }
        .cta-tile { flex-direction: row; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.2rem; }
        .cta-tile h3 { font-size: 1.5rem; margin: 0 0 0.2rem; }
        .cta-tile p { color: var(--muted); margin: 0; }
        @media (max-width: 991px) {
            .bento { grid-template-columns: 1fr; }
            .bento .feature { grid-row: auto; }
            .tile { padding: 1.6rem; }
            .steps { grid-template-columns: 1fr 1fr; padding-top: 0; }
            .steps::before, .steps::after { display: none; }
            .step .dot { position: static; margin-bottom: 0.6rem; }
        }
        @media (max-width: 575px) { .steps { grid-template-columns: 1fr; } }
        @media (prefers-reduced-motion: reduce) {
            .steps::after { transition: none; transform: scaleX(1); }
        }

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

        @media (max-width: 767px) {
            .page-head { padding-top: 44px; }
            .img-hover-zoom img { height: 300px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .in { animation: none; opacity: 1; transform: none; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body>

    <!-- Header / Navbar Atas -->
    <nav class="navbar-custom">
        <div class="container px-3 px-lg-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <a class="navbar-brand" href="#">
                <span>🥭</span> Mangoes Company
            </a>
            <div class="nav-links">
                <a href="{{ route('halaman.utama') }}">Back to home?</a>
                <a href="howto.php" class="nav-pill">Info Pemesanan</a>
            </div>
        </div>
    </nav>

    <!-- Judul Halaman -->
    <header class="page-head">
        <div class="container px-4">
            <div class="section-title-wrapper">
                <h1 class="section-title in" style="--i:0">Member Of Mangoes Company</h1>
            </div>
            <p class="section-lead in" style="--i:1">Get to know the three people behind Mangoes Company. Each of them brings a different strength to the team, from software architecture and full-stack development to project management and clear communication.</p>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="members">
        <div class="container px-4">

            <!-- Baris untuk kartu member (Grid 3 Kolom Kesamping) -->
            <div class="row">
                <!-- Kartu 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 in" style="--i:2">
                        <div class="img-hover-zoom">
                            <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                            <img src="{{ asset('image/adrian.jpeg') }}" alt="Foto Adrian">
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title">Kadek : Progamer</h5>
                            <p class="card-text flex-grow-1">Kadek is a professional programmer with over 25 years of experience at Mangos Comp, specializing in complex software architecture, cloud computing, and full-stack development.</p>

                            <a href="{{ route('deskripsi.full') }}" class="btn btn-custom mt-3 text-center text-decoration-none">See More Info</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 in" style="--i:3">
                        <div class="img-hover-zoom">
                            <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                            <img src="{{ asset('image/rian.jpg') }}" alt="Foto rian">
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title">Rian : Vibe Coder</h5>
                            <p class="card-text flex-grow-1">Rizkyansyah (Rian) is a visionary "vibe coder" with a strong background in informatics, seamlessly navigating Python, PHP, SQL, and HTML/CSS. He blends logic with creativity.</p>

                            <a href="{{ route('deskripsi.full') }}" class="btn btn-custom mt-3 text-center text-decoration-none">See More Info</a>
                        </div>
                    </div>
                </div>

                <!-- Kartu 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 in" style="--i:4">
                        <div class="img-hover-zoom">
                            <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                            <img src="{{ asset('image/rizal.jpeg') }}" alt="Foto rizal">
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title">Rizal : Profesional Web Maker</h5>
                            <p class="card-text flex-grow-1">Yulanus Risaldus Jehaman (Rizal) is a charismatic and confident professional with a sharp analytical mind. He excels in strategic initiatives and communication as a project manager.</p>

                            <a href="{{ route('deskripsi.full') }}" class="btn btn-custom mt-3 text-center text-decoration-none">See More Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- More about Mangoes Company -->
    <section class="about-more" id="about-company">
        <div class="container px-4">
            <h2 class="about-title">More About Mangoes Company</h2>
            <p class="about-lead">Behind every page we build is a team that cares about clean code, thoughtful design, and honest collaboration. Here is a closer look at who we are, what we do, and how we work together.</p>

            <div class="bento">
                <!-- Who we are -->
                <div class="tile feature spot">
                    <h3 class="tile-title">Who we are</h3>
                    <p class="tile-text">Mangoes Company is a digital and technology enterprise that brings programmers, developers, and project managers together under one roof. Our team is led by Kadek, a software architect with more than 25 years of experience, and driven by Rian, a full-stack developer fluent in Python, PHP, SQL, and HTML/CSS, and Rizal, a project manager who keeps every initiative focused and every conversation clear.</p>
                    <p class="tile-text">We specialize in robust web architecture, software engineering, and modern tourism management platforms, including a ticketing and accommodation portal that helps travelers book with confidence. Whatever the project, we combine rigorous technical logic with creative brilliance to deliver digital experiences that feel effortless to use.</p>
                    <p class="tagline mt-auto">From the first sketch to the final deployment.</p>
                </div>

                <!-- What we do -->
                <div class="tile spot">
                    <h3 class="tile-title">What we do</h3>
                    <div class="service"><div class="ico">🏗️</div><div><strong>Web architecture</strong><span>Scalable, secure foundations built with clean code and well-designed databases.</span></div></div>
                    <div class="service"><div class="ico">💻</div><div><strong>Software engineering</strong><span>Custom applications, from complex back-end logic to sleek, intuitive interfaces.</span></div></div>
                    <div class="service"><div class="ico">🧳</div><div><strong>Tourism platforms</strong><span>Ticketing and accommodation portals that keep every reservation organized.</span></div></div>
                </div>

                <!-- Our toolkit -->
                <div class="tile spot">
                    <h3 class="tile-title">Our toolkit</h3>
                    <p class="tile-text">We choose proven tools and use them with care, so every project stays fast, secure, and easy to maintain.</p>
                    <div>
                        <span class="tag">Python</span><span class="tag">PHP</span><span class="tag">SQL</span><span class="tag">HTML/CSS</span><span class="tag">Bootstrap</span><span class="tag">Cloud Computing</span><span class="tag">Software Architecture</span><span class="tag">Database Design</span>
                    </div>
                </div>

                <!-- How we work -->
                <div class="tile wide spot">
                    <h3 class="tile-title">How we work</h3>
                    <p class="tile-text mb-0">Every project follows the same four steps, with clear communication along the way.</p>
                    <div class="steps">
                        <div class="step"><span class="dot">1</span><h4>Sketch</h4><p>We turn your idea into a clear plan and a first design you can react to.</p></div>
                        <div class="step"><span class="dot">2</span><h4>Build</h4><p>Our developers write clean, structured code and shape the database behind it.</p></div>
                        <div class="step"><span class="dot">3</span><h4>Test</h4><p>Every feature is checked carefully for performance and security before it goes live.</p></div>
                        <div class="step"><span class="dot">4</span><h4>Deploy</h4><p>We launch the final product and stay in touch, so you always know where things stand.</p></div>
                    </div>
                </div>

                <!-- Ajakan -->
                <div class="tile wide cta-tile spot">
                    <div>
                        <h3>Curious how ordering works?</h3>
                        <p>Find out how to book your tickets and accommodation with our team.</p>
                    </div>
                    <a href="howto.php" class="btn btn-custom text-center text-decoration-none">Info Pemesanan</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span class="foot-brand">🥭 Mangoes Company</span>
            <span>&copy; 2026 Mangos Company. All Rights Reserved.</span>
        </div>
    </footer>

    <script>
        // Cahaya emas yang mengikuti kursor pada kartu
        document.querySelectorAll('.spot').forEach(function (el) {
            el.addEventListener('pointermove', function (e) {
                var r = el.getBoundingClientRect();
                el.style.setProperty('--x', (e.clientX - r.left) + 'px');
                el.style.setProperty('--y', (e.clientY - r.top) + 'px');
            });
        });

        // Garis tahapan "How we work" menyala saat terlihat di layar
        var steps = document.querySelector('.steps');
        if (steps && 'IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting) {
                    steps.classList.add('on');
                    io.disconnect();
                }
            }, { threshold: 0.4 });
            io.observe(steps);
        } else if (steps) {
            steps.classList.add('on');
        }
    </script>
</body>
</html>