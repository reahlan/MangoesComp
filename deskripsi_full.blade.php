<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our Member Information - Mangos Company</title>
    
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Style Profesional (Hitam, Merah, Kuning & Berbayang) -->
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
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
        }
        .navbar-brand {
            color: #ffc107 !important;
            font-weight: 700;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-brand img {
            width: 35px;
            height: 35px;
            object-fit: contain;
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
        /* Border/Garis bawah estetik dengan kombinasi merah & kuning */
        .section-title-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, #dc3545, #ffc107);
            border-radius: 2px;
        }

        /* Kartu Profesional berbayang */
        .card {
            background-color: #171717; /* Hitam arang */
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.9), 0 0 20px rgba(220, 53, 69, 0.1) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-6px);
            border-color: #dc3545; /* Garis tepi menyala merah tipis saat hover */
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.95), 0 0 25px rgba(255, 193, 7, 0.25) !important;
        }

        .card-img-top {
            border-bottom: 2px solid #222;
        }

        .card-title {
            color: #ffc107; /* Kuning Emas */
            font-weight: 700;
            font-size: 1.6rem; /* Ukuran judul diperbesar */
            margin-bottom: 15px;
        }

        .card-text {
            color: #c7cbd1; /* Abu-abu terang agar sangat nyaman dibaca */
            line-height: 1.8;
            font-size: 1.12rem; /* Ukuran teks paragraf diperbesar */
        }

        /* Tombol "Info Kontak" dengan tema Merah & Kuning */
        .btn-custom {
            background: linear-gradient(135deg, #dc3545, #b02a37); /* Gradasi Merah Profesional */
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 12px;
            border-radius: 8px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #c82333, #bd2130);
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.5); /* Kilau kuning terang saat di-hover */
            color: #ffc107;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- Header / Navbar Atas -->
    <nav class="navbar-custom d-flex justify-content-between align-items-center">
        <!-- Logo Mangga & Nama Perusahaan di Kiri -->
        <a class="navbar-brand" href="#">
            <span>🥭</span> Mangos Company
        </a>
        <!-- Menu Navigasi di Kanan -->
        <div class="nav-links">
            <a href="index.blade.php">Back to home?</a>
            <a href="kelola_akomodasi.php">Pemesanan jasa</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container-fluid px-5 mt-5 mb-5">
        <div class="row">
            <div class="col-12 text-center section-title-wrapper">
                <h3 class="section-title">About Our Member Information</h3>
            </div>
        </div>
        
        <!-- Baris untuk kartu member -->
        <div class="row">
            <!-- Kartu 1 -->
            <div class="col-md-10 mx-auto mb-5">
                <div class="card h-100">
                    <img src="image/adrian.jpeg" class="card-img-top" style="height: 800px; object-fit: cover;" alt="Kadek">
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Kadek Adrian Daniel</h5>
                        <p class="card-text">Kadek is a professional programmer who enjoys a flexible working arrangement and has been working for over 25 years with Mangos Comp. Throughout his extensive career, he has developed a deep expertise in complex software architecture, cloud computing, and full-stack development. Known for his exceptional problem-solving skills and innovative thinking, Kadek has successfully led numerous high-stakes projects from initial concept to final deployment. Beyond his technical prowess, he is highly regarded as a dedicated mentor who passionately guides junior developers and actively contributes to the global open-source community.</p>
                        
                        <!-- Tombol Info Kontak -->
                        <a href="deskripsi_pendek.php" class="btn btn-custom mt-auto w-100">Info Kontak</a>
                    </div>
                </div>
            </div>
            
            <!-- Kartu 2 -->
            <div class="col-md-10 mx-auto mb-5">
                <div class="card h-100">
                    <img src="image/rian.jpeg" class="card-img-top" style="height: 800px; object-fit: cover;" alt="Rizkyansyah Muhammad">
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Rizkyansyah Muhammad</h5>
                        <p class="card-text">Rizkyansyah, affectionately known as Rian, is a visionary "vibe coder" who has mastered the art of blending logic with creativity. With a strong background in informatics, he seamlessly navigates through Python, PHP, SQL, and HTML/CSS to build robust and scalable applications. Rian has spent years honing his craft, developing intuitive user interfaces and complex database architectures that drive modern digital solutions. His unique approach to coding—where rhythm and flow meet rigorous problem-solving—allows him to tackle challenging development projects with unparalleled enthusiasm. Whether he is normalizing databases or designing sleek layouts, Rian constantly pushes the boundaries of technology while maintaining a calm, focused energy that inspires his entire team.</p>
                        
                        <!-- Tombol Info Kontak -->
                        <a href="deskripsi_pendek.php" class="btn btn-custom mt-auto w-100">Info Kontak</a>
                    </div>
                </div>
            </div>
            
            <!-- Kartu 3 -->
            <div class="col-md-10 mx-auto mb-5">
                <div class="card h-100">
                    <img src="image/rizal.jpeg" class="card-img-top" style="height: 800px; object-fit: cover;" alt="Yulanus Risaldus Jehaman">
                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title">Yulanus Risaldus Jehaman</h5>
                        <p class="card-text">Yulanus Risaldus Jehaman, widely known as Rizal, is a highly charismatic and confident professional who brings a remarkable presence to every project he undertakes. Known not only for his striking professional demeanor but also for his sharp analytical mind, Rizal has successfully spearheaded numerous strategic initiatives across global markets. He possesses an innate ability to communicate complex ideas with clarity and charm, making him a natural leader and a highly sought-after project manager. With a relentless drive for excellence and a keen eye for detail, Rizal consistently delivers outstanding results, elevating the standards of his team and leaving a lasting, positive impression on clients and colleagues alike.</p>
                        
                        <!-- Tombol Info Kontak -->
                        <a href="deskripsi_pendek.php" class="btn btn-custom mt-auto w-100">Info Kontak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>