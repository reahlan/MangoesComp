<?php
// Mulai session
session_start();

// ===== PENGATURAN TOMBOL =====
$url_home  = './';                                  // tombol "Back to home?"
$url_login = 'form_tiket.php?action=register';      // tombol Login / Register

// Tombol Order Now menggunakan rute Laravel
$url_order = route('order'); 
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How To Order - Mangoes Company</title>

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
        body { background: var(--ink); color: var(--cream); font-family: 'Manrope', 'Segoe UI', sans-serif; line-height: 1.75; overflow-x: hidden; }
        h1, h2, h3, h4, .navbar-brand { font-family: 'Fraunces', Georgia, serif; }
        a:focus-visible, button:focus-visible, summary:focus-visible { outline: 2px solid var(--mango); outline-offset: 3px; }

        /* Navbar */
        .navbar-custom { position: sticky; top: 0; z-index: 50; background: rgba(14, 11, 8, 0.82); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border-bottom: 1px solid var(--line); padding: 14px 0; }
        .navbar-brand { color: var(--mango) !important; font-weight: 700; font-size: 1.4rem; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; align-items: center; gap: 1.4rem; }
        .nav-links a { color: var(--muted); text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease, background-color 0.2s ease; }
        .nav-links a:hover { color: var(--mango); }
        .nav-links a.nav-pill { color: var(--mango); border: 1px solid rgba(242, 182, 50, 0.5); border-radius: 999px; padding: 0.35rem 1.05rem; }
        .nav-links a.nav-pill:hover { background: var(--mango); color: #1a1206; }

        /* Tombol */
        .btn-custom { display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--mango), var(--mango-deep)); color: #1a1206; font-weight: 700; padding: 0.8rem 1.8rem; border: 0; border-radius: 999px; text-decoration: none; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .btn-custom:hover { color: #1a1206; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(242, 182, 50, 0.35); }
        .btn-ghost { display: inline-flex; align-items: center; justify-content: center; border: 1px solid rgba(242, 182, 50, 0.5); color: var(--mango); font-weight: 700; text-decoration: none; padding: 0.8rem 1.8rem; border-radius: 999px; transition: background-color 0.2s ease, color 0.2s ease; }
        .btn-ghost:hover { background: var(--mango); color: #1a1206; }

        /* Hero: satu urutan animasi saat halaman dimuat */
        .hero { padding: 80px 0 70px; background: radial-gradient(700px 400px at 85% 15%, rgba(242, 182, 50, 0.14), transparent 70%); }
        .in { opacity: 0; transform: translateY(16px); animation: rise 0.8s ease forwards; animation-delay: calc(var(--i) * 0.12s); }
        @keyframes rise { to { opacity: 1; transform: none; } }
        .hero h1 { font-size: clamp(3rem, 8vw, 6rem); font-weight: 800; line-height: 0.98; letter-spacing: -0.03em; margin: 0 0 0.8rem; background: linear-gradient(180deg, #fff8e6 30%, var(--mango) 130%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-sub { font-family: 'Fraunces', Georgia, serif; font-style: italic; font-size: 1.45rem; color: var(--mango); margin-bottom: 1.3rem; }
        .hero-text { color: var(--muted); max-width: 56ch; margin-bottom: 1rem; }
        .tag { display: inline-block; border: 1px solid var(--line); background: rgba(255, 255, 255, 0.04); border-radius: 999px; padding: 0.3rem 0.95rem; font-size: 0.85rem; margin: 0.3rem 0.4rem 0.3rem 0; }

        /* Tiket dekoratif */
        .ticket { position: relative; max-width: 360px; margin: 0 auto; padding: 1.8rem; background: linear-gradient(160deg, #271d10, var(--panel)); border: 1px solid rgba(242, 182, 50, 0.4); border-radius: 22px; transform: rotate(-4deg); box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6); }
        .ticket .brand { font-family: 'Fraunces', Georgia, serif; color: var(--mango); font-weight: 700; font-size: 1.15rem; }
        .ticket .big { font-family: 'Fraunces', Georgia, serif; font-style: italic; font-size: 2.3rem; line-height: 1.1; margin: 1.1rem 0 0.4rem; }
        .ticket p { color: var(--muted); margin: 0; font-size: 0.92rem; }
        .perf { position: relative; border-top: 2px dashed rgba(242, 182, 50, 0.35); margin: 1.4rem -1.8rem; }
        .perf::before, .perf::after { content: ""; position: absolute; top: -14px; width: 26px; height: 26px; border-radius: 50%; background: var(--ink); border: 1px solid rgba(242, 182, 50, 0.4); }
        .perf::before { left: -14px; }
        .perf::after { right: -14px; }

        /* Judul bagian */
        .sec { padding: 60px 0 10px; }
        .sec-title { font-size: clamp(1.9rem, 3.6vw, 2.8rem); font-weight: 700; margin-bottom: 0.8rem; }
        .sec-title::after { content: ""; display: block; width: 56px; height: 3px; border-radius: 2px; background: var(--mango); margin-top: 14px; }
        .sec-lead { color: var(--muted); max-width: 62ch; margin-bottom: 2rem; }

        /* Kartu */
        .tile { height: 100%; padding: 1.8rem; background: linear-gradient(160deg, #1b150f, var(--panel)); border: 1px solid var(--line); border-radius: 22px; transition: border-color 0.25s ease; }
        .tile:hover { border-color: rgba(242, 182, 50, 0.55); }
        .ico { width: 52px; height: 52px; display: grid; place-items: center; font-size: 1.5rem; border-radius: 14px; background: rgba(242, 182, 50, 0.12); border: 1px solid rgba(242, 182, 50, 0.3); margin-bottom: 1rem; }
        .tile h3 { font-size: 1.45rem; font-weight: 700; margin-bottom: 0.6rem; }
        .tile p { color: var(--muted); font-size: 0.96rem; margin: 0; }

        /* Garis waktu langkah-langkah */
        .timeline { position: relative; padding-left: 3.4rem; margin-top: 1rem; }
        .timeline::before, .timeline::after { content: ""; position: absolute; left: calc(1.1rem + 1px); top: 0; bottom: 0; width: 2px; background: var(--line); }
        .timeline::after { background: linear-gradient(var(--mango), var(--mango-deep)); transform: scaleY(0); transform-origin: top; transition: transform 2.6s ease; }
        .timeline.on::after { transform: scaleY(1); }
        .t-step { position: relative; padding-bottom: 1.6rem; }
        .t-step .dot { position: absolute; left: -3.4rem; top: 0.3rem; width: 2.2rem; height: 2.2rem; display: grid; place-items: center; border-radius: 50%; background: var(--ink); border: 2px solid var(--mango); color: var(--mango); font-weight: 700; z-index: 1; }
        .t-card { padding: 1.5rem 1.7rem; background: var(--panel); border: 1px solid var(--line); border-radius: 18px; }
        .t-card h3 { font-size: 1.4rem; font-weight: 700; margin-bottom: 0.5rem; }
        .t-card p { color: var(--muted); margin-bottom: 0.9rem; }
        .tip { font-size: 0.9rem; color: var(--cream); border-left: 3px solid var(--mango); padding-left: 0.9rem; margin: 0 0 0.2rem; }
        .t-card .btn-custom, .t-card .btn-ghost { margin-top: 0.9rem; padding: 0.6rem 1.4rem; }

        /* FAQ */
        .faq details { border-top: 1px solid var(--line); padding: 1.1rem 0; }
        .faq details:last-child { border-bottom: 1px solid var(--line); }
        .faq summary { cursor: pointer; list-style: none; display: flex; justify-content: space-between; align-items: center; gap: 1rem; font-weight: 700; font-size: 1.05rem; }
        .faq summary::-webkit-details-marker { display: none; }
        .faq summary::after { content: "+"; flex: none; font-size: 1.6rem; line-height: 1; color: var(--mango); transition: transform 0.25s ease; }
        .faq details[open] summary::after { transform: rotate(45deg); }
        .faq details p { color: var(--muted); margin: 0.7rem 0 0; max-width: 70ch; }

        /* Ajakan penutup */
        .cta-box { margin: 80px 0 90px; padding: clamp(2.4rem, 6vw, 4.2rem) 1.5rem; text-align: center; border: 1px solid rgba(242, 182, 50, 0.35); border-radius: 28px; background: radial-gradient(560px 240px at 50% 0%, rgba(242, 182, 50, 0.18), transparent 70%), var(--panel); }
        .cta-box h2 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; }
        .cta-box p { color: var(--muted); max-width: 52ch; margin: 0.6rem auto 1.7rem; }
        .cta-box .btn-custom, .cta-box .btn-ghost { margin: 0.3rem; }

        /* Footer */
        .site-footer { border-top: 1px solid var(--line); background: #0a0805; color: var(--muted); padding: 28px 0; font-size: 0.92rem; }
        .site-footer .foot-brand { font-family: 'Fraunces', Georgia, serif; color: var(--mango); font-weight: 700; font-size: 1.1rem; }

        @media (max-width: 991px) {
            .hero { padding-top: 48px; }
            .ticket { margin-top: 1rem; }
        }
        @media (max-width: 575px) {
            .timeline { padding-left: 2.8rem; }
            .t-step .dot { left: -2.8rem; width: 2rem; height: 2rem; }
            .timeline::before, .timeline::after { left: calc(1rem + 1px); }
            .t-card { padding: 1.2rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .in { animation: none; opacity: 1; transform: none; }
            .timeline::after { transition: none; transform: scaleY(1); }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container px-3 px-lg-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <a class="navbar-brand" href="#">
                <span>🥭</span> Mangoes Company
            </a>
            <div class="nav-links">
                <a href="<?php echo htmlspecialchars($url_home); ?>">Back to home?</a>
                <a href="<?php echo htmlspecialchars($url_order); ?>" class="nav-pill">Order Now</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <header class="hero">
        <div class="container px-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <h1 class="in" style="--i:0">How to order</h1>
                    <p class="hero-sub in" style="--i:1">Your trip, booked in six simple steps</p>
                    <p class="hero-text in" style="--i:2">Ordering with Mangoes Company is designed to be quick, clear, and stress-free. Whether you need tickets for your next adventure or a comfortable place to stay, our ticketing and accommodation portal guides you from your first click to your final confirmation.</p>
                    <p class="hero-text in" style="--i:3">This page walks you through every step, explains what each part of the order means, and answers the questions we hear most often. Take a few minutes to read it once, and your first order will feel effortless.</p>
                    <div class="in mb-4" style="--i:4">
                        <span class="tag">Tickets</span><span class="tag">Accommodation</span><span class="tag">Professional support</span>
                    </div>
                    <div class="in d-flex flex-wrap gap-3" style="--i:5">
                        <a href="<?php echo htmlspecialchars($url_order); ?>" class="btn-custom">Order Now</a>
                        <a href="#steps" class="btn-ghost">See the steps</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="in" style="--i:3">
                        <div class="ticket">
                            <div class="brand">🥭 Mangoes Company</div>
                            <div class="big">Your next adventure</div>
                            <p>Digital &amp; Travel Solution</p>
                            <div class="perf"></div>
                            <p>Order in six simple steps: account, service, details, review, order, and confirmation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Langkah-langkah -->
    <section class="sec" id="steps">
        <div class="container px-4">
            <h2 class="sec-title">Step-by-step guide</h2>
            <p class="sec-lead">Follow these six steps in order. Each one is short, and our team is ready to help if you ever feel stuck.</p>

            <div class="timeline" id="timeline">
                <div class="t-step">
                    <span class="dot">1</span>
                    <div class="t-card">
                        <h3>Create your account</h3>
                        <p>Open the home page and choose Login / Register. Fill in your name and contact details, then submit the form. If you already have an account, just log in and continue to the next step.</p>
                        <p class="tip">Use an email address you check often, so confirmations always reach you.</p>
                        <a href="<?php echo htmlspecialchars($url_login); ?>" class="btn-ghost">Login / Register</a>
                    </div>
                </div>
                <div class="t-step">
                    <span class="dot">2</span>
                    <div class="t-card">
                        <h3>Choose your service</h3>
                        <p>Decide whether you want a ticket, accommodation, or both. Each service has its own details, so choosing first keeps the rest of the order short and relevant to you.</p>
                        <p class="tip">Not sure what fits? Read the “What you can order” section above.</p>
                    </div>
                </div>
                <div class="t-step">
                    <span class="dot">3</span>
                    <div class="t-card">
                        <h3>Fill in your order details</h3>
                        <p>Enter the traveler names, your dates, and the number of guests. Add any special request in the notes so our team can prepare everything in advance.</p>
                        <p class="tip">Double-check spelling. Names should match each traveler’s identification.</p>
                    </div>
                </div>
                <div class="t-step">
                    <span class="dot">4</span>
                    <div class="t-card">
                        <h3>Review your order</h3>
                        <p>Before sending anything, read through the summary once more. Make sure the dates, quantities, and personal details are correct, and fix anything that looks off.</p>
                        <p class="tip">One minute of review now saves a lot of changes later.</p>
                    </div>
                </div>
                <div class="t-step">
                    <span class="dot">5</span>
                    <div class="t-card">
                        <h3>Place your order</h3>
                        <p>When everything looks right, press the Order button. Your request is sent to our team right away and recorded safely in our system.</p>
                        <p class="tip">Press the button once and wait a moment while your submission is confirmed.</p>
                        <a href="<?php echo htmlspecialchars($url_order); ?>" class="btn-custom">Order</a>
                    </div>
                </div>
                <div class="t-step">
                    <span class="dot">6</span>
                    <div class="t-card">
                        <h3>Receive your confirmation</h3>
                        <p>Our team checks your order and confirms it. From there you can follow your reservation, and our support team stays available if you need to ask a question or adjust anything.</p>
                        <p class="tip">Keep your confirmation handy on the day of your trip.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ajakan penutup -->
    <section class="container px-4">
        <div class="cta-box">
            <h2>Ready to place your order?</h2>
            <p>It only takes a few minutes. Create your account, choose your service, and let our team take care of the rest.</p>
            <a href="<?php echo htmlspecialchars($url_order); ?>" class="btn-custom">Order Now</a>
            <a href="<?php echo htmlspecialchars($url_home); ?>" class="btn-ghost">Back to home?</a>
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
        // Garis langkah-langkah menyala saat bagian ini terlihat di layar
        var tl = document.getElementById('timeline');
        if (tl && 'IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting) {
                    tl.classList.add('on');
                    io.disconnect();
                }
            }, { threshold: 0.15 });
            io.observe(tl);
        } else if (tl) {
            tl.classList.add('on');
        }
    </script>
</body>
</html>