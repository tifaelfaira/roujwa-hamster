<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\MultipleUploadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class,'show']);
Route::get('/matakuliah/{param1}', [MatakuliahController::class,'show']);

Route::get('/about', function () {
    return view('halaman-about');
});

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/pegawai', [PegawaiController::class,'index']);

Route::post('question/store', [QuestionController::class, 'store'])
        ->name('question.store');

// PERBAIKAN: Route dashboard harus punya nama 'dashboard.index'
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('user', UserController::class);

Route::resource('pelanggan', PelangganController::class);
Route::delete('/pelanggan-file/{id}', [PelangganController::class, 'deleteFile'])
    ->name('pelanggan.deleteFile');

// Tambahan untuk multiple upload file
Route::post('/pelanggan/upload', [MultipleUploadController::class, 'store'])
    ->name('pelanggan.upload');
Route::delete('/pelanggan/delete-file/{id}', [MultipleUploadController::class, 'destroy'])
    ->name('pelanggan.deleteFile');

Route::get('auth', [AuthController::class,'index'])->name('auth.index');
Route::post('auth/login', [AuthController::class,'login'])->name('auth.login');
Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');


