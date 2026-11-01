<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our Member Information - Mangos Company</title>

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
            padding: 64px 0 28px;
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
            font-size: clamp(2.1rem, 5vw, 3.5rem);
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
            margin: 1.2rem auto 1.4rem;
        }
        .jump a, .tag {
            display: inline-block;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 0.3rem 0.95rem;
            font-size: 0.85rem;
            color: var(--muted);
            text-decoration: none;
            margin: 0.3rem 0.3rem 0.3rem 0;
        }
        .jump a { margin: 0.3rem; transition: color 0.2s ease, border-color 0.2s ease; }
        .jump a:hover { color: var(--mango); border-color: var(--mango); }

        /* Profil member */
        .profiles { padding: 30px 0 40px; }
        .profile-wrap { scroll-margin-top: 90px; margin-bottom: 2.4rem; }
        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-top: 3px solid var(--mango);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.55);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .card:hover {
            border-color: rgba(242, 182, 50, 0.6);
            box-shadow: 0 24px 50px rgba(0, 0, 0, 0.7), 0 0 28px rgba(242, 182, 50, 0.14);
        }
        .photo {
            position: relative;
            overflow: hidden;
            min-height: 380px;
            height: 100%;
        }
        .card-img-top {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.6s ease;
        }
        .card:hover .card-img-top { transform: scale(1.05); }
        .card-body { padding: 2.2rem 2.4rem; }
        .card-title {
            font-family: 'Fraunces', Georgia, serif;
            color: var(--mango);
            font-weight: 700;
            font-size: 2rem;
            line-height: 1.2;
            margin-bottom: 0.3rem;
        }
        .role {
            font-family: 'Fraunces', Georgia, serif;
            font-style: italic;
            color: var(--cream);
            opacity: 0.85;
            margin-bottom: 0.8rem;
        }
        .card-text {
            color: var(--muted);
            line-height: 1.85;
            font-size: 1.02rem;
            max-width: 68ch;
        }

        /* Tombol */
        .btn-custom {
            background: linear-gradient(135deg, var(--mango), var(--mango-deep));
            border: 0;
            color: #1a1206;
            font-weight: 700;
            padding: 0.75rem 1.6rem;
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
        .btn-ghost {
            display: inline-block;
            border: 1px solid rgba(242, 182, 50, 0.5);
            color: var(--mango);
            font-weight: 700;
            text-decoration: none;
            padding: 0.75rem 1.6rem;
            border-radius: 999px;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .btn-ghost:hover { background: var(--mango); color: #1a1206; }

        /* Ajakan penutup */
        .cta-box {
            border: 1px solid var(--line);
            border-radius: 22px;
            padding: 52px 26px;
            text-align: center;
            background: radial-gradient(520px 220px at 50% 0%, rgba(242, 182, 50, 0.16), transparent 70%), var(--panel);
        }
        .cta-box h2 {
            font-size: clamp(1.7rem, 3.4vw, 2.4rem);
            font-weight: 700;
        }
        .cta-box p {
            color: var(--muted);
            max-width: 56ch;
            margin: 0.6rem auto 1.7rem;
        }
        .cta-box .btn-custom { text-decoration: none; display: inline-block; margin-right: 0.5rem; }

        /* Footer */
        .site-footer {
            margin-top: 80px;
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
            .page-head { padding-top: 44px; }
            .photo { min-height: 360px; }
            .card-body { padding: 1.8rem 1.5rem; }
            .cta-box .btn-custom { margin: 0 0 0.7rem; }
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
            <!-- Logo Mangga & Nama Perusahaan di Kiri -->
            <a class="navbar-brand" href="#">
                <span>🥭</span> Mangos Company
            </a>
            <!-- Menu Navigasi di Kanan -->
            <div class="nav-links">
                <a href="{{ route('halaman.utama') }}">Back to home?</a>
                <a href="howto.php" class="nav-pill">How To Order?</a>
            </div>
        </div>
    </nav>

    <!-- Judul Halaman -->
    <header class="page-head">
        <div class="container px-4">
            <div class="section-title-wrapper">
                <h1 class="section-title in" style="--i:0">About Our Member Information</h1>
            </div>
            <p class="section-lead in" style="--i:1">A closer look at the people behind Mangos Company: their experience, their strengths, and the way each of them contributes to every project we deliver.</p>
            <nav class="jump in" style="--i:2" aria-label="Jump to member">
                <a href="#kadek">Kadek</a>
                <a href="#rian">Rian</a>
                <a href="#rizal">Rizal</a>
            </nav>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="profiles">
        <div class="container px-4">

            <!-- Kartu 1 -->
            <div class="profile-wrap" id="kadek">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <div class="photo">
                                <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                                <img src="{{ asset('image/adrian.jpeg') }}" class="card-img-top" alt="adrian">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Kadek Adrian Daniel Wediantika</h5>
                                <p class="role">Professional Programmer &amp; Software Architect</p>
                                <div class="mb-3">
                                    <span class="tag">Software Architecture</span>
                                    <span class="tag">Cloud Computing</span>
                                    <span class="tag">Full-Stack Development</span>
                                    <span class="tag">Mentoring</span>
                                    <span class="tag">Open Source</span>
                                </div>
                                <p class="card-text flex-grow-1">Kadek is a professional programmer who enjoys a flexible working arrangement and has been working for over 25 years with Mangos Comp. Throughout his extensive career, he has developed a deep expertise in complex software architecture, cloud computing, and full-stack development. Known for his exceptional problem-solving skills and innovative thinking, Kadek has successfully led numerous high-stakes projects from initial concept to final deployment. Beyond his technical prowess, he is highly regarded as a dedicated mentor who passionately guides junior developers and actively contributes to the global open-source community.</p>

                                <!-- Tombol Info Kontak -->
                                <a href="{{ route('deskripsi.singkat') }}" class="btn btn-custom mt-3 text-center text-decoration-none align-self-start">Contact Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu 2 -->
            <div class="profile-wrap" id="rian">
                <div class="card">
                    <div class="row g-0 flex-lg-row-reverse">
                        <div class="col-lg-5">
                            <div class="photo">
                                <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                                <img src="{{ asset('image/rian.jpg') }}" class="card-img-top" alt="rian">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Rizkyansyah Muhammad</h5>
                                <p class="role">Vibe Coder &amp; Full-Stack Developer</p>
                                <div class="mb-3">
                                    <span class="tag">Python</span>
                                    <span class="tag">PHP</span>
                                    <span class="tag">SQL</span>
                                    <span class="tag">HTML/CSS</span>
                                    <span class="tag">Database Design</span>
                                </div>
                                <p class="card-text flex-grow-1">Rizkyansyah, affectionately known as Rian, is a visionary "vibe coder" who has mastered the art of blending logic with creativity. With a strong background in informatics, he seamlessly navigates through Python, PHP, SQL, and HTML/CSS to build robust and scalable applications. Rian has spent years honing his craft, developing intuitive user interfaces and complex database architectures that drive modern digital solutions. His unique approach to coding—where rhythm and flow meet rigorous problem-solving—allows him to tackle challenging development projects with unparalleled enthusiasm. Whether he is normalizing databases or designing sleek layouts, Rian constantly pushes the boundaries of technology while maintaining a calm, focused energy that inspires his entire team.</p>

                                <!-- Tombol Info Kontak -->
                                <a href="{{ route('deskripsi.singkat') }}" class="btn btn-custom mt-3 text-center text-decoration-none align-self-start">Contact Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu 3 -->
            <div class="profile-wrap" id="rizal">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <div class="photo">
                                <!-- PERBAIKAN: Menggunakan folder 'image' (tanpa s) -->
                                <img src="{{ asset('image/rizal.jpeg') }}" class="card-img-top" alt="Yulanus Risaldus Jehaman">
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">Yulanus Risaldus Jehaman</h5>
                                <p class="role">Professional Web Maker &amp; Project Manager</p>
                                <div class="mb-3">
                                    <span class="tag">Project Management</span>
                                    <span class="tag">Strategic Initiatives</span>
                                    <span class="tag">Communication</span>
                                    <span class="tag">Analytical Thinking</span>
                                </div>
                                <p class="card-text flex-grow-1">Yulanus Risaldus Jehaman, widely known as Rizal, is a highly charismatic and confident professional who brings a remarkable presence to every project he undertakes. Known not only for his striking professional demeanor but also for his sharp analytical mind, Rizal has successfully spearheaded numerous strategic initiatives across global markets. He possesses an innate ability to communicate complex ideas with clarity and charm, making him a natural leader and a highly sought-after project manager. With a relentless drive for excellence and a keen eye for detail, Rizal consistently delivers outstanding results, elevating the standards of his team and leaving a lasting, positive impression on clients and colleagues alike.</p>

                                <!-- Tombol Info Kontak -->
                                <a href="{{ route('deskripsi.singkat') }}" class="btn btn-custom mt-3 text-center text-decoration-none align-self-start">Contact Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ajakan penutup -->
            <div class="cta-box">
                <h2>Ready to start your next project or trip?</h2>
                <p>Learn how ordering works, or head back to the home page to see everything Mangos Company has to offer.</p>
                <a href="howto.php" class="btn-custom">How To Order?</a>
                <a href="{{ route('halaman.utama') }}" class="btn-ghost">Back to home</a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span class="foot-brand">🥭 Mangos Company</span>
            <span>&copy; 2026 Mangos Company. All Rights Reserved.</span>
        </div>
    </footer>

</body>
</html>