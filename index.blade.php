<?php
// 1. Mulai session di bagian paling atas agar bisa membaca data user yang login
session_start();

include 'koneksi.php';

// LOGIKA PROSES LOGOUT (Jika user klik tombol logout)
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangos Company - Digital & Travel Solution</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0b0b0b; /* Hitam pekat elegan */
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Profesional */
        .navbar-custom {
            background-color: #141414;
            border-bottom: 2px solid #222;
            padding: 15px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        }
        .navbar-brand {
            color: #ffc107 !important;
            font-weight: 700;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-nav .nav-link {
            color: #d1d5db !important;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active {
            color: #ffc107 !important;
        }

        /* Search input dark styling */
        .form-control-dark {
            background-color: #1a1a1a;
            border: 1px solid #333;
            color: #fff;
        }
        .form-control-dark:focus {
            background-color: #222;
            color: #fff;
            border-color: #ffc107;
            box-shadow: none;
        }

        /* Hero Image Tunggal di Tengah */
        .hero-container {
            margin-top: 40px;
            margin-bottom: 50px;
        }
        .hero-card {
            background-color: #171717;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9), 0 0 25px rgba(220, 53, 69, 0.15);
        }
        .hero-img {
            max-height: 480px;
            object-fit: cover;
            width: 100%;
        }

        /* Styling Judul Section */
        .section-title {
            color: #ffc107;
            font-weight: 800;
            letter-spacing: 1px;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.8);
            margin-bottom: 30px;
        }

        /* Kartu Konten Profesional Berbayang */
        .card {
            background-color: #171717;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9), 0 0 20px rgba(220, 53, 69, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }
        .card:hover {
            transform: translateY(-6px);
            border-color: #dc3545;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.95), 0 0 25px rgba(255, 193, 7, 0.3);
        }
        .card-title {
            color: #ffc107;
            font-weight: 700;
        }
        .card-text {
            color: #c7cbd1;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Tombol Kustom */
        .btn-custom {
            background: linear-gradient(135deg, #dc3545, #b02a37);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.6);
            color: #ffc107;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container-fluid px-0">
        <!-- Navbar Atas -->
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="#">
                    <span>🥭</span> Mangos Company
                </a>
                <button class="navbar-toggler bg-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                    </ul>
                    <!-- Search Bar di Kanan Atas -->
                    <form class="d-flex align-items-center gap-2" role="search">
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

        <!-- Hero Image Tunggal di Tengah -->
        <div class="container hero-container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-card">
                        <img src="image/tiga.jpeg" class="hero-img" alt="Mangoes Company Banner">
                        <div class="p-4 text-center">
                            <h3 class="text-warning fw-bold mb-2">Mangoes Company</h3>
                            <p class="text-secondary mb-0">Welcome to Mangoes Company, an innovative digital enterprise and premier technology hub dedicated to crafting exceptional software solutions, advanced web architectures, and seamless digital experiences. Driven by a passionate team of elite programmers, visionary developers, and strategic project managers, we combine rigorous technical logic with creative brilliance to empower modern businesses and elevate digital standards worldwide.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3 Bagian Utama (Our Member, About Our Company, Order) -->
        <div class="container px-4 mb-5">
            <div class="row text-center">
                <div class="col-12">
                    <h3 class="section-title">Company Overview</h3>
                </div>
            </div>
            
            <div class="row g-4">
                <!-- 1. Our Member -->
                <div class="col-md-4">
                    <div class="card h-100 p-3">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title mb-3">Our Member</h4>
                            <p class="card-text flex-grow-1">
                                Our elite team features world-class professionals dedicated to innovation. Meet <strong>Kadek</strong> (Professional Programmer & Software Architect), <strong>Rizkyansyah / Rian</strong> (Vibe Coder & Full-Stack Developer), and <strong>Rizal</strong> (Professional Web Maker & Project Manager). Together, they deliver state-of-the-art technological solutions.
                            </p>
                            <a href="deskripsi_pendek.php" class="btn btn-custom mt-3 w-100">More Information</a>
                        </div>
                    </div>
                </div>

                <!-- 2. About Our Company -->
                <div class="col-md-4">
                    <div class="card h-100 p-3">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title mb-3">About Our Company</h4>
                            <p class="card-text flex-grow-1">
                                Mangoes Company is a premier digital and technology enterprise specializing in robust web architecture, software engineering, and modern tourism management platforms. We combine analytical precision with creative vision to produce exceptional, high-performance digital experiences for clients worldwide.
                            </p>
                            <a href="deskripsi_pendek.php" class="btn btn-custom mt-3 w-100">More Information</a>
                        </div>
                    </div>
                </div>

                <!-- 3. Order -->
                <div class="col-md-4">
                    <div class="card h-100 p-3">
                        <div class="card-body d-flex flex-column">
                            <h4 class="card-title mb-3">Order</h4>
                            <p class="card-text flex-grow-1">
                                Ready to book your next adventure or explore our exclusive reservation services? Access our seamless ticketing and accommodation management portal right away to secure your bookings securely and efficiently with professional support.
                            </p>
                            <a href="deskripsi_pendek.php" class="btn btn-custom mt-3 w-100">More Information</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-5 mx-0">
            <footer class="text-center text-lg-start bg-dark text-secondary py-3 border-top border-secondary">
                <div class="container text-center">
                    <span>&copy; 2026 Mangos Company. All Rights Reserved.</span>
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>