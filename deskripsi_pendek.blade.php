<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Of Mangoes Company</title>
    
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Style Profesional (Hitam, Merah, Kuning, Berbayang, dan Efek Foto Menonjol) -->
    <style>
        body {
            background-color: #0b0b0b; /* Hitam pekat elegan */
            color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Profesional di Atas */
        .navbar-custom {
            background-color: #141414;
            border-bottom: 2px solid #222;
            padding: 15px 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        }
        .navbar-brand {
            color: #ffc107 !important;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-links a {
            color: #d1d5db;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: color 0.2s ease;
        }
        .nav-links a:hover {
            color: #dc3545; /* Aksen merah saat disentuh */
        }

        /* Styling Judul dengan Border & Efek Estetik */
        .section-title-wrapper {
            position: relative;
            margin-bottom: 40px;
        }
        .section-title {
            color: #ffc107; /* Kuning Emas */
            font-weight: 800;
            letter-spacing: 1px;
            text-shadow: 0 3px 6px rgba(0, 0, 0, 0.8);
            display: inline-block;
            padding-bottom: 12px;
        }
        .section-title-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 140px;
            height: 4px;
            background: linear-gradient(90deg, #dc3545, #ffc107);
            border-radius: 2px;
        }

        /* Kartu Profesional berbayang */
        .card {
            background-color: #171717; /* Hitam arang */
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9), 0 0 20px rgba(220, 53, 69, 0.15) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-6px);
            border-color: #dc3545;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.95), 0 0 25px rgba(255, 193, 7, 0.3) !important;
        }

        /* Efek foto menonjol maju saat kursor mendekat */
        .img-hover-zoom {
            overflow: hidden;
        }
        .img-hover-zoom img {
            transition: transform 0.5s ease;
        }
        .card:hover .img-hover-zoom img {
            transform: scale(1.08); /* Foto memperbesar/menonjol maju */
        }

        .card-title {
            color: #ffc107; /* Kuning Emas */
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .card-text {
            color: #c7cbd1; /* Abu-abu terang agar nyaman dibaca */
            line-height: 1.6;
            font-size: 0.92rem;
        }

        /* Tombol dengan tema Merah & Kuning */
        .btn-custom {
            background: linear-gradient(135deg, #dc3545, #b02a37);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 10px;
            border-radius: 8px;
            letter-spacing: 0.5px;
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

    <!-- Header / Navbar Atas -->
    <nav class="navbar-custom d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">
            <span>🥭</span> Mangoes Company
        </a>
        <div class="nav-links">
            <a href="index.blade.php">Back to home?</a>
            <a href="kelola_akomodasi.php">Info Pemesanan</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container-fluid px-4 mt-5 mb-5">
        <div class="row">
            <div class="col-12 text-center section-title-wrapper">
                <h3 class="section-title">Member Of Mangoes Company</h3>
            </div>
        </div>
        
        <!-- Baris untuk kartu member (Grid 3 Kolom Kesamping) -->
        <div class="row">
            <!-- Kartu 1 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="image/adrian.jpeg" class="card-img-top" style="height: 700px; object-fit: cover;" alt="Kadek">
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Kadek : Progamer</h5>
                        <p class="card-text">Kadek is a professional programmer with over 25 years of experience at Mangos Comp, specializing in complex software architecture, cloud computing, and full-stack development.</p>
                        
                        <a href="deskripsi_full.php" class="btn btn-custom mt-auto w-100">Info Selengkapnya</a>
                    </div>
                </div>
            </div>
            
            <!-- Kartu 2 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="image/rian.jpeg" class="card-img-top" style="height: 700px; object-fit: cover;" alt="Rian">
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Rian : Vibe Coder</h5>
                        <p class="card-text">Rizkyansyah (Rian) is a visionary "vibe coder" with a strong background in informatics, seamlessly navigating Python, PHP, SQL, and HTML/CSS. He blends logic with creativity.</p>
                        
                        <a href="deskripsi_full.php" class="btn btn-custom mt-auto w-100">Info Selengkapnya</a>
                    </div>
                </div>
            </div>
            
            <!-- Kartu 3 -->
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="img-hover-zoom">
                        <img src="image/rizal.jpeg" class="card-img-top" style="height: 700px; object-fit: cover;" alt="Rizal">
                    </div>
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Rizal : Profesional Web Maker</h5>
                        <p class="card-text">Yulanus Risaldus Jehaman (Rizal) is a charismatic and confident professional with a sharp analytical mind. He excels in strategic initiatives and communication as a project manager.</p>
                        
                        <a href="deskripsi_full.php" class="btn btn-custom mt-auto w-100">Info Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>