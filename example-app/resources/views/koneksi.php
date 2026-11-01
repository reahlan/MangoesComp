<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root";
$password = ""; // Kosongkan jika menggunakan XAMPP bawaan
$database = "digitara";

// Membuat koneksi ke database MySQL
$koneksi = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Set charset ke UTF-8 agar pembacaan karakter simbol/emoticon aman
$koneksi->set_charset("utf8mb4");

// Opsi tambahan: Jika ingin memastikan koneksi berhasil saat testing, 
// kamu bisa uncomment baris di bawah ini. Jangan lupa hapus saat website sudah online (production).
echo "Koneksi database berhasil!";
?>