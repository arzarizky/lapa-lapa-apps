<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\superadmin\DashboardController as superadminDashboardController;
use App\Http\Controllers\superadmin\DatakomoditasController as superadminDatakomoditasController;
use App\Http\Controllers\superadmin\InflasiController;
use App\Http\Controllers\superadmin\KritikdansaranController;
use App\Http\Controllers\superadmin\ManajemenuserController;
use App\Http\Controllers\superadmin\PertumbuhanEkonomiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('/data-komuditas', function () {
//     return view('admin.data-komuditas.kategori-komuditas');
// });

// Route::get('/data-komuditas/bawang-merah', function () {
//     return view('admin.data-komuditas.sub-kategori-komuditas');
// });

// Route::get('/data-komuditas/bawang-merah/informasi-bawang-merah-tipe-a', function () {
//     return view('admin.data-komuditas.informasi-komuditas');
// });
Route::get('home', [HomeController::class, 'index']);

Route::middleware(['auth'])->prefix('/superadmin')->name('superadmin.')->group(function () {
    Route::get('updatekota/{id}', [superadminDashboardController::class, 'update_kota'])->name('updatekota');
    Route::get('/dashboard', [superadminDashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard', [superadminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/data-komuditas', [superadminDatakomoditasController::class, 'index'])->name('data-komoditas.index');
    Route::get('/data-komuditas/{nama}', [superadminDatakomoditasController::class, 'subkategori'])->name('data-komoditas.subkategori');
    Route::get('/data-komuditas/detail/{nama}/{pasar}', [superadminDatakomoditasController::class, 'detailsubkategori'])->name('data-komoditas.detailsubkategori');
    Route::post('/data-komuditas/detail/harga', [superadminDatakomoditasController::class, 'harga'])->name('data-komoditas.detailsubkategori.harga');
    Route::post('/data-komuditas/detail/hargatanggal', [superadminDatakomoditasController::class, 'hargatanggal'])->name('data-komoditas.detailsubkategori.hargatanggal');
    Route::post('/data-komuditas/detail/updateharga', [superadminDatakomoditasController::class, 'updateharga'])->name('data-komoditas.detailsubkategori.updateharga');
    Route::get('/data-komuditas/detail-delete/delete/{id}', [superadminDatakomoditasController::class, 'deleterekaphargaid'])->name('data-komoditas.detailsubkategori.delete');

    Route::get('kritik-dan-saran', [KritikdansaranController::class, 'index'])->name('kritikdansaran.index');
    Route::put('kritik-dan-saran', [KritikdansaranController::class, 'updatestatus'])->name('kritikdansaran.update');
    Route::get('kritik-dan-saran/delete/{id}', [KritikdansaranController::class, 'deletepesan'])->name('kritikdansaran.delete');

    Route::middleware(['role:Super Admin'])->group(function () {
        Route::get('/manajemen-user', [ManajemenuserController::class, 'index'])->name('manajemen-user.index');
        Route::post('/manajemen-user', [ManajemenuserController::class, 'post'])->name('manajemen-user.post');
        Route::put('/manajemen-user/edit', [ManajemenuserController::class, 'edit'])->name('manajemen-user.edit');
        Route::get('/manajemen-user/delete/{id}', [ManajemenuserController::class, 'delete'])->name('manajemen-user.delete');

        Route::get('/data-inflasi', [InflasiController::class, 'index'])->name('inflasi.index');
        Route::post('/data-inflasi/create', [InflasiController::class, 'create'])->name('inflasi.create');
        Route::get('/data-inflasi/delete/{id}', [InflasiController::class, 'delete'])->name('inflasi.delete');

        Route::get('/data-pertumbuhan-ekonomi', [PertumbuhanEkonomiController::class, 'index'])->name('pertumbuhan-ekonomi.index');
        Route::post('/data-pertumbuhan-ekonomi/create', [PertumbuhanEkonomiController::class, 'create'])->name('pertumbuhan-ekonomi.create');
        Route::get('/data-pertumbuhan-ekonomi/delete/{id}', [PertumbuhanEkonomiController::class, 'delete'])->name('pertumbuhan-ekonomi.delete');
    });
});

Route::middleware(['auth', 'role:Admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('updatekota/{id}', [superadminDashboardController::class, 'update_kota'])->name('updatekota');
    Route::get('/dashboard', [superadminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/data-komuditas', [superadminDatakomoditasController::class, 'index'])->name('data-komoditas.index');
    Route::get('/data-komuditas/{nama}', [superadminDatakomoditasController::class, 'subkategori'])->name('data-komoditas.subkategori');
    Route::get('/data-komuditas/detail/{nama}/{pasar}', [superadminDatakomoditasController::class, 'detailsubkategori'])->name('data-komoditas.detailsubkategori');
    Route::post('/data-komuditas/detail/harga', [superadminDatakomoditasController::class, 'harga'])->name('data-komoditas.detailsubkategori.harga');
    Route::post('/data-komuditas/detail/updateharga', [superadminDatakomoditasController::class, 'updateharga'])->name('data-komoditas.detailsubkategori.updateharga');

    Route::get('kritik-dan-saran', [KritikdansaranController::class, 'index'])->name('kritikdansaran.index');
    Route::put('kritik-dan-saran', [KritikdansaranController::class, 'updatestatus'])->name('kritikdansaran.update');
    Route::get('kritik-dan-saran/delete/{id}', [KritikdansaranController::class, 'deletepesan'])->name('kritikdansaran.delete');
});

Route::get('/profile', function () {
    return view('profile');
});
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/superadmin/kota/kritik-dan-saran', function () {
    return view('admin.kritik-dan-saran.index');
});

// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::get('/manajemen-data', function () {
    return view('admin.manajemen-data.index');
});

Route::get('/manajemen-user', function () {
    return view('super-admin.manajemen-user.index');
});

Route::get('/', [DashboardController::class, 'index']);
Route::post('/', [DashboardController::class, 'indexpost'])->name('dashboard.post');
Route::post('/indexpostbawah', [DashboardController::class, 'indexpostbawah'])->name('dashboard.postbawah');
Route::post('/semuakota', [DashboardController::class, 'semuakota']);
Route::post('/ratarata', [DashboardController::class, 'margin']);

Route::get('/data-inflasi', function () {
    return view('admin.data-inflasi.index');
});

Route::get('/data-pertumbuhan-ekonomi', function () {
    return view('admin.data-pertumbuhan-ekonomi.index');
});
