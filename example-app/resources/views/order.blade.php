<?php
// Mulai session (sama seperti halaman lain) untuk membaca user login & menyimpan pesanan terakhir
session_start();

// ===== PENGATURAN TOMBOL (ubah di sini jika nama file / alamat tujuanmu berbeda) =====
$url_home = './';                // tombol "Back to home?"
$url_how  = 'how_to_order.php';  // tombol "How To Order?"

$services = [
    'tickets'       => 'Tickets',
    'accommodation' => 'Accommodation',
    'both'          => 'Tickets + Accommodation',
];
$meta = [
    'tickets'       => ['🎫', 'Tours, attractions, and journeys.'],
    'accommodation' => ['🏨', 'Comfortable places to stay.'],
    'both'          => ['🧳', 'The complete trip in one order.'],
];

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}

$errors = [];
$old = [
    'service' => 'tickets',
    'name'    => isset($_SESSION['user_nama']) ? $_SESSION['user_nama'] : '',
    'email'   => '',
    'phone'   => '',
    'date_from' => '',
    'date_to'   => '',
    'guests'  => '1',
    'notes'   => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $v) {
        if (isset($_POST[$k])) { $old[$k] = trim((string)$_POST[$k]); }
    }
    $old['notes'] = substr($old['notes'], 0, 500);

    if (!hash_equals($_SESSION['csrf'], (string)(isset($_POST['csrf']) ? $_POST['csrf'] : ''))) {
        $errors[] = 'Your session expired. Please try again.';
    }
    if (!isset($services[$old['service']])) { $errors[] = 'Please choose a service.'; }
    if ($old['name'] === '' || strlen($old['name']) > 80) { $errors[] = 'Please enter your full name.'; }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) { $errors[] = 'Please enter a valid email address.'; }
    if (strlen($old['phone']) > 25) { $errors[] = 'Please enter a shorter phone number.'; }

    $today = new DateTime('today');
    $from = DateTime::createFromFormat('Y-m-d', $old['date_from']);
    if (!$from || $from->format('Y-m-d') !== $old['date_from'] || $from < $today) {
        $errors[] = 'Please choose a travel date that is today or later.';
    }
    if (in_array($old['service'], ['accommodation', 'both'], true)) {
        $to = DateTime::createFromFormat('Y-m-d', $old['date_to']);
        if (!$to || $to->format('Y-m-d') !== $old['date_to'] || ($from && $to <= $from)) {
            $errors[] = 'Please choose a check-out date after your check-in date.';
        }
    } else {
        $old['date_to'] = '';
    }
    $guests = (int)$old['guests'];
    if ($guests < 1 || $guests > 20) { $errors[] = 'Travelers must be between 1 and 20.'; }

    if (!$errors) {
        $_SESSION['last_order'] = [
            'code'      => 'MC-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6)),
            'service'   => $services[$old['service']],
            'name'      => $old['name'],
            'email'     => $old['email'],
            'phone'     => $old['phone'],
            'date_from' => $old['date_from'],
            'date_to'   => $old['date_to'],
            'guests'    => $guests,
            'notes'     => $old['notes'],
        ];
        // TODO: simpan pesanan ke database di sini (INSERT ke tabel pesananmu memakai $_SESSION['last_order'])
        header('Location: ' . $_SERVER['PHP_SELF'] . '?done=1');
        exit();
    }
}
$done = (isset($_GET['done']) && !empty($_SESSION['last_order'])) ? $_SESSION['last_order'] : null;
$fmt = function ($d) { return $d ? date('d M Y', strtotime($d)) : '-'; };
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - Mangoes Company</title>

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
        a:focus-visible, button:focus-visible { outline: 2px solid var(--mango); outline-offset: 3px; }

        /* Navbar */
        .navbar-custom { position: sticky; top: 0; z-index: 50; background: rgba(14, 11, 8, 0.82); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border-bottom: 1px solid var(--line); padding: 14px 0; }
        .navbar-brand { color: var(--mango) !important; font-weight: 700; font-size: 1.4rem; display: flex; align-items: center; gap: 10px; }
        .nav-links { display: flex; align-items: center; gap: 1.4rem; }
        .nav-links a { color: var(--muted); text-decoration: none; font-weight: 600; font-size: 0.95rem; transition: color 0.2s ease, background-color 0.2s ease; }
        .nav-links a:hover { color: var(--mango); }
        .nav-links a.nav-pill { color: var(--mango); border: 1px solid rgba(242, 182, 50, 0.5); border-radius: 999px; padding: 0.35rem 1.05rem; }
        .nav-links a.nav-pill:hover { background: var(--mango); color: #1a1206; }

        /* Tombol */
        .btn-custom { display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--mango), var(--mango-deep)); color: #1a1206; font-weight: 700; padding: 0.9rem 2rem; border: 0; border-radius: 999px; text-decoration: none; cursor: pointer; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .btn-custom:hover { color: #1a1206; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(242, 182, 50, 0.35); }
        .btn-ghost { display: inline-flex; align-items: center; justify-content: center; border: 1px solid rgba(242, 182, 50, 0.5); color: var(--mango); font-weight: 700; text-decoration: none; padding: 0.9rem 2rem; border-radius: 999px; transition: background-color 0.2s ease, color 0.2s ease; }
        .btn-ghost:hover { background: var(--mango); color: #1a1206; }

        /* Judul halaman: satu urutan animasi saat dimuat */
        .hero { padding: 60px 0 30px; text-align: center; background: radial-gradient(700px 340px at 50% 0%, rgba(242, 182, 50, 0.14), transparent 70%); }
        .in { opacity: 0; transform: translateY(16px); animation: rise 0.8s ease forwards; animation-delay: calc(var(--i) * 0.12s); }
        @keyframes rise { to { opacity: 1; transform: none; } }
        .hero h1 { font-size: clamp(2.8rem, 7vw, 5rem); font-weight: 800; line-height: 1; letter-spacing: -0.03em; margin: 0 0 0.9rem; background: linear-gradient(180deg, #fff8e6 30%, var(--mango) 130%); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { color: var(--muted); max-width: 60ch; margin: 0 auto; }

        /* Formulir */
        .order-main { padding: 30px 0 90px; }
        .block { padding: 1.8rem; background: linear-gradient(160deg, #1b150f, var(--panel)); border: 1px solid var(--line); border-radius: 22px; margin-bottom: 1.5rem; }
        .block-title { font-size: 1.45rem; font-weight: 700; margin-bottom: 1.2rem; display: flex; align-items: center; gap: 0.8rem; }
        .n { width: 2rem; height: 2rem; flex: none; display: grid; place-items: center; border-radius: 50%; border: 2px solid var(--mango); color: var(--mango); font: 700 0.9rem 'Manrope', sans-serif; }
        .lbl { display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.3rem; }
        .lbl small { color: var(--muted); font-weight: 400; }
        .field { width: 100%; background: #1d1710; border: 1px solid var(--line); color: #fff; border-radius: 14px; padding: 0.75rem 1rem; color-scheme: dark; font: inherit; }
        .field::placeholder { color: #8d826f; }
        .field:focus { outline: none; border-color: var(--mango); box-shadow: 0 0 0 3px rgba(242, 182, 50, 0.18); }
        textarea.field { resize: vertical; min-height: 110px; }
        .opts { position: relative; display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .opts input { position: absolute; opacity: 0; width: 1px; height: 1px; }
        .opt { display: flex; flex-direction: column; gap: 0.2rem; height: 100%; padding: 1.1rem; border: 1px solid var(--line); border-radius: 18px; background: rgba(255, 255, 255, 0.02); cursor: pointer; transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease; }
        .opt .emo { font-size: 1.7rem; line-height: 1.2; }
        .opt span:last-child { color: var(--muted); font-size: 0.85rem; line-height: 1.45; }
        .opt:hover { border-color: rgba(242, 182, 50, 0.5); }
        .opts input:checked + .opt { border-color: var(--mango); background: rgba(242, 182, 50, 0.1); box-shadow: 0 0 0 3px rgba(242, 182, 50, 0.15); }
        .opts input:focus-visible + .opt { outline: 2px solid var(--mango); outline-offset: 3px; }
        .stepper { display: flex; align-items: center; gap: 0.6rem; }
        .stepper button { width: 46px; height: 46px; flex: none; border-radius: 50%; border: 1px solid rgba(242, 182, 50, 0.5); background: transparent; color: var(--mango); font-size: 1.4rem; font-weight: 700; line-height: 1; transition: background-color 0.2s ease, color 0.2s ease; }
        .stepper button:hover { background: var(--mango); color: #1a1206; }
        .stepper .field { width: 84px; text-align: center; }
        .alert-box { border: 1px solid rgba(220, 53, 69, 0.6); background: rgba(220, 53, 69, 0.1); border-radius: 16px; padding: 1rem 1.2rem; margin-bottom: 1.5rem; }
        .alert-box ul { margin: 0.3rem 0 0; padding-left: 1.2rem; }
        .submit-row { display: flex; flex-wrap: wrap; align-items: center; gap: 1rem; }
        .submit-row small { color: var(--muted); flex-basis: 100%; }

        /* Tiket ringkasan pesanan */
        .sticky-box { position: sticky; top: 96px; }
        .ticket { position: relative; max-width: 420px; margin: 0 auto; padding: 1.8rem; background: linear-gradient(160deg, #271d10, var(--panel)); border: 1px solid rgba(242, 182, 50, 0.4); border-radius: 22px; box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6); }
        .ticket.flat { max-width: 560px; }
        .ticket .brand { font-family: 'Fraunces', Georgia, serif; color: var(--mango); font-weight: 700; font-size: 1.15rem; }
        .perf { position: relative; border-top: 2px dashed rgba(242, 182, 50, 0.35); margin: 1.3rem -1.8rem; }
        .perf::before, .perf::after { content: ""; position: absolute; top: -14px; width: 26px; height: 26px; border-radius: 50%; background: var(--ink); border: 1px solid rgba(242, 182, 50, 0.4); }
        .perf::before { left: -14px; }
        .perf::after { right: -14px; }
        .sum-row { display: flex; justify-content: space-between; gap: 1rem; padding: 0.55rem 0; border-top: 1px solid var(--line); font-size: 0.95rem; }
        .sum-row:first-of-type { border-top: 0; }
        .sum-row span:first-child { color: var(--muted); flex: none; }
        .sum-row span:last-child { text-align: right; font-weight: 600; overflow-wrap: anywhere; }
        .help { text-align: center; color: var(--muted); font-size: 0.92rem; margin-top: 1.2rem; }
        .help a { color: var(--mango); font-weight: 600; }

        /* Halaman konfirmasi */
        .check { width: 72px; height: 72px; margin: 0 auto 1rem; display: grid; place-items: center; border-radius: 50%; font-size: 2rem; color: #1a1206; background: linear-gradient(135deg, var(--mango), var(--mango-deep)); }
        .code { font-family: 'Fraunces', Georgia, serif; font-size: clamp(2.2rem, 7vw, 3.4rem); font-weight: 800; color: var(--mango); letter-spacing: 0.04em; line-height: 1.1; }
        .done-actions { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.8rem; margin-top: 2rem; }

        /* Footer */
        .site-footer { border-top: 1px solid var(--line); background: #0a0805; color: var(--muted); padding: 28px 0; font-size: 0.92rem; }
        .site-footer .foot-brand { font-family: 'Fraunces', Georgia, serif; color: var(--mango); font-weight: 700; font-size: 1.1rem; }

        @media (max-width: 991px) {
            .sticky-box { position: static; margin-top: 0.5rem; }
            .hero { padding-top: 40px; }
        }
        @media (max-width: 575px) {
            .opts { grid-template-columns: 1fr; }
            .block { padding: 1.3rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            .in { animation: none; opacity: 1; transform: none; }
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
                <a href="<?= e($url_home) ?>">Back to home?</a>
                <a href="<?= e($url_how) ?>" class="nav-pill">How To Order?</a>
            </div>
        </div>
    </nav>

<?php if ($done): ?>
    <!-- Konfirmasi pesanan -->
    <header class="hero">
        <div class="container px-4">
            <div class="check in" style="--i:0">✓</div>
            <h1 class="in" style="--i:1">Order received</h1>
            <p class="in" style="--i:2">Thank you, <?= e($done['name']) ?>. Our team will review your order and confirm the details with you shortly. Please keep your order code for any questions.</p>
        </div>
    </header>
    <main class="order-main">
        <div class="container px-4">
            <div class="ticket flat in" style="--i:3">
                <div class="brand">🥭 Mangoes Company</div>
                <p class="text-secondary mb-1 mt-3">Your order code</p>
                <div class="code"><?= e($done['code']) ?></div>
                <div class="perf"></div>
                <div class="sum-row"><span>Service</span><span><?= e($done['service']) ?></span></div>
                <div class="sum-row"><span>Name</span><span><?= e($done['name']) ?></span></div>
                <div class="sum-row"><span>Email</span><span><?= e($done['email']) ?></span></div>
                <?php if ($done['phone'] !== ''): ?><div class="sum-row"><span>Phone</span><span><?= e($done['phone']) ?></span></div><?php endif; ?>
                <div class="sum-row"><span><?= $done['date_to'] !== '' ? 'Check-in' : 'Travel date' ?></span><span><?= e($fmt($done['date_from'])) ?></span></div>
                <?php if ($done['date_to'] !== ''): ?><div class="sum-row"><span>Check-out</span><span><?= e($fmt($done['date_to'])) ?></span></div><?php endif; ?>
                <div class="sum-row"><span>Travelers</span><span><?= e($done['guests']) ?></span></div>
                <?php if ($done['notes'] !== ''): ?><div class="sum-row"><span>Notes</span><span><?= e($done['notes']) ?></span></div><?php endif; ?>
            </div>
            <div class="done-actions">
                <a href="<?= e($url_home) ?>" class="btn-custom">Back to home?</a>
                <a href="<?= e($url_how) ?>" class="btn-ghost">How To Order?</a>
                <a href="<?= e($_SERVER['PHP_SELF']) ?>" class="btn-ghost">Make another order</a>
            </div>
        </div>
    </main>
<?php else: ?>
    <!-- Judul -->
    <header class="hero">
        <div class="container px-4">
            <h1 class="in" style="--i:0">Order now</h1>
            <p class="in" style="--i:1">Choose your service, tell us who is traveling and when, and send your order in under two minutes. Our team will confirm everything with you personally. New here? Read <a href="<?= e($url_how) ?>" class="text-warning">How To Order?</a> first.</p>
        </div>
    </header>

    <main class="order-main">
        <div class="container px-4">
            <div class="row g-4 g-xl-5">
                <!-- Formulir -->
                <div class="col-lg-7">
                    <?php if ($errors): ?>
                        <div class="alert-box" role="alert">
                            <strong>Please check your order:</strong>
                            <ul><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" class="order-form">
                        <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">

                        <div class="block">
                            <h2 class="block-title"><span class="n">1</span>Choose a service</h2>
                            <div class="opts">
                                <?php foreach ($services as $key => $label): ?>
                                    <input type="radio" name="service" id="svc-<?= e($key) ?>" value="<?= e($key) ?>" <?= $old['service'] === $key ? 'checked' : '' ?>>
                                    <label class="opt" for="svc-<?= e($key) ?>">
                                        <span class="emo"><?= $meta[$key][0] ?></span>
                                        <strong><?= e($label) ?></strong>
                                        <span><?= e($meta[$key][1]) ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="block">
                            <h2 class="block-title"><span class="n">2</span>Traveler details</h2>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="lbl" for="name">Full name</label>
                                    <input class="field" type="text" id="name" name="name" maxlength="80" required placeholder="As written on your ID" value="<?= e($old['name']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="lbl" for="email">Email</label>
                                    <input class="field" type="email" id="email" name="email" required placeholder="you@example.com" value="<?= e($old['email']) ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="lbl" for="phone">Phone <small>(optional)</small></label>
                                    <input class="field" type="tel" id="phone" name="phone" maxlength="25" placeholder="+62 ..." value="<?= e($old['phone']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="block">
                            <h2 class="block-title"><span class="n">3</span>Trip details</h2>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="lbl" for="date_from" id="from-label">Travel date</label>
                                    <input class="field" type="date" id="date_from" name="date_from" required min="<?= date('Y-m-d') ?>" value="<?= e($old['date_from']) ?>">
                                </div>
                                <div class="col-md-6" id="to-wrap">
                                    <label class="lbl" for="date_to">Check-out date</label>
                                    <input class="field" type="date" id="date_to" name="date_to" min="<?= date('Y-m-d') ?>" value="<?= e($old['date_to']) ?>">
                                </div>
                                <div class="col-12">
                                    <label class="lbl" for="guests">Travelers</label>
                                    <div class="stepper">
                                        <button type="button" data-step="-1" aria-label="Fewer travelers">&minus;</button>
                                        <input class="field" type="number" id="guests" name="guests" min="1" max="20" required value="<?= e($old['guests']) ?>">
                                        <button type="button" data-step="1" aria-label="More travelers">+</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="lbl" for="notes">Special requests <small>(optional)</small></label>
                                    <textarea class="field" id="notes" name="notes" maxlength="500" placeholder="Timing, accessibility needs, or anything else we should know."><?= e($old['notes']) ?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="submit-row">
                            <button type="submit" class="btn-custom">Place order</button>
                            <a href="<?= e($url_home) ?>" class="btn-ghost">Back to home?</a>
                            <small>By placing this order you agree that our team may contact you to confirm the details.</small>
                        </div>
                    </form>
                </div>

                <!-- Ringkasan langsung -->
                <div class="col-lg-5">
                    <div class="sticky-box">
                        <div class="ticket">
                            <div class="brand">🥭 Mangoes Company</div>
                            <p class="text-secondary mb-0 mt-3">Your order summary</p>
                            <div class="perf"></div>
                            <div class="sum-row"><span>Service</span><span id="s-service">Tickets</span></div>
                            <div class="sum-row"><span>Name</span><span id="s-name">Your name</span></div>
                            <div class="sum-row"><span>Dates</span><span id="s-dates">-</span></div>
                            <div class="sum-row"><span>Travelers</span><span id="s-guests">1</span></div>
                        </div>
                        <p class="help">Not sure about a step? Open <a href="<?= e($url_how) ?>">How To Order?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php endif; ?>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span class="foot-brand">🥭 Mangoes Company</span>
            <span>&copy; 2026 Mangos Company. All Rights Reserved.</span>
        </div>
    </footer>

    <script>
        // Ringkasan pesanan yang ikut berubah saat formulir diisi
        var f = document.querySelector('.order-form');
        if (f) {
            var labels = { tickets: 'Tickets', accommodation: 'Accommodation', both: 'Tickets + Accommodation' };
            var q = function (s) { return document.querySelector(s); };
            var fmt = function (d) {
                if (!d) { return '-'; }
                var p = d.split('-');
                return new Date(p[0], p[1] - 1, p[2]).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            };
            var update = function () {
                var svc = f.querySelector('input[name=service]:checked').value;
                var acc = svc !== 'tickets';
                var a = f.elements['date_from'].value;
                var b = f.elements['date_to'].value;
                q('#to-wrap').style.display = acc ? '' : 'none';
                f.elements['date_to'].required = acc;
                f.elements['date_to'].min = a || f.elements['date_from'].min;
                q('#from-label').textContent = acc ? 'Check-in date' : 'Travel date';
                q('#s-service').textContent = labels[svc];
                q('#s-name').textContent = f.elements['name'].value.trim() || 'Your name';
                q('#s-dates').textContent = (acc && b) ? fmt(a) + ' to ' + fmt(b) : fmt(a);
                q('#s-guests').textContent = f.elements['guests'].value || '1';
            };
            f.addEventListener('input', update);
            f.addEventListener('change', update);
            document.querySelectorAll('[data-step]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var g = f.elements['guests'];
                    var next = (parseInt(g.value, 10) || 1) + parseInt(btn.dataset.step, 10);
                    g.value = Math.min(20, Math.max(1, next));
                    update();
                });
            });
            update();
        }
    </script>
</body>
</html>