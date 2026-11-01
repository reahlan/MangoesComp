<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 1. Halaman awal (menampilkan versi Laravel dan tombol masuk)
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Utama (mengarah ke index.blade.php)
Route::get('/halaman-utama', function () {
    return view('index'); 
})->name('halaman.utama');

// 3. Halaman Deskripsi Singkat (mengarah ke deskripsi_singkat.blade.php)
Route::get('/deskripsi-singkat', function () {
    return view('deskripsi_pendek'); 
})->name('deskripsi.singkat');

// 4. Halaman Deskripsi Full (mengarah ke deskripsi_full.blade.php)
Route::get('/deskripsi-full', function () {
    return view('deskripsi_full'); 
})->name('deskripsi.full');

// 5. Halaman How To / Reservation (mengarah ke howto.blade.php)
Route::get('/howto', function () {
    return view('howto'); 
})->name('howto');

// 6. Halaman Order (mengarah ke order.blade.php)
Route::get('/order', function () {
    return view('order'); 
})->name('order');

// Contoh Route dengan Parameter Wajib & Angka (Sesuai PPT)
Route::get('/product/{id}', function ($id) {
    return "Product detail with ID: " . $id;
})->whereNumber('id');

// Contoh Route dengan Parameter Opsional (Sesuai PPT)
Route::get('/category/{name?}', function ($name = 'general') {
    return "Category: " . $name;
});

// Contoh Route ke Controller (Sesuai PPT)
// Pastikan kamu sudah membuat controller via terminal: php artisan make:controller ProductController
Route::get('/catalog', [App\Http\Controllers\ProductController::class, 'index']);