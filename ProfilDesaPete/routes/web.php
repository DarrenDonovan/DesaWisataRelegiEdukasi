<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\SuperAdminMiddleware;


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

//Index
Route::get('/', function () {
    return view('index');
});

//Admin Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);

//Other Pages
Route::get('about', [UserController::class, 'about'])->name('about');
Route::get('infografis', [UserController::class, 'infografis'])->name('infografis');
Route::get('maps', [UserController::class, 'maps'])->name('maps');
Route::get('berita', [UserController::class, 'berita'])->name('berita');
Route::get('berita/detailberita/{id}', [UserController::class, 'detailberita'])->name('detailberita');
Route::get('profildesa/{id}', [UserController::class, 'profildesa'])->name('profildesa');
Route::get('profildesa/{id_wilayah}/wisata/{id_wisata}', [UserController::class, 'wisata'])->name('wisata');
Route::get('rute/{id}', [UserController::class, 'rute'])->name('rute');

//Admin Dashboard Landpage
Route::get('admin', [AdminController::class, 'admin'])->middleware('auth')->name('admin');
Route::get('/', [AdminController::class, 'index'])->name('index');

// Admin Logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Create Admin
Route::get('admin/createadmin', function(){
    return view('createadmin');
});

Route::middleware(['auth', SuperAdminMiddleware::class])->group(function(){
    Route::get('admin/createadmin', [AdminController::class, 'create']);
    Route::post('admin/storeadmin', [AdminController::class, 'store']);
    Route::get('admin/deleteAdmin',[AdminController::class, 'admin'])->name('removeAdmin');
    Route::post('admin/deleteAdmin', [AdminController::class, 'deleteAdmin'])->name('removeAdmin');
});

//Admin Function
Route::post('/admin/update/{id}', [AdminController::class, 'updateKegiatan'])->name('admin.updateKegiatan');

Route::get('admin/delete/{id}', [AdminController::class, 'deleteKegiatan'])->name('admin.deleteKegiatan');

Route::post('admin/createKegiatan', [AdminController::class, 'createKegiatan'])->name('admin.createKegiatan');

Route::post('/admin/updateAboutUs', [AdminController::class, 'updateAboutUs'])->name('admin.updateAboutUs');

//Route untuk Perangkat Kecamatan
Route::post('admin/createPerangkat', [AdminController::class, 'createPerangkat'])->name('admin.createPerangkat');
Route::post('/admin/updatePerangkat/{id}', [AdminController::class, 'updatePerangkat'])->name('admin.updatePerangkat');
Route::get('admin/deletePerangkat/{id}', [AdminController::class, 'deletePerangkat'])->name('admin.removePerangkat');

//Route untuk berita
Route::post('admin/createBerita', [AdminController::class, 'createBerita'])->name('admin.createBerita');
Route::post('admin/updateBerita/{id}', [AdminController::class, 'updateBerita'])->name('admin.updateBerita');
Route::get('admin/deleteBerita/{id}', [AdminController::class, 'deleteBerita'])->name('admin.deleteBerita');

//Route untuk Profil
Route::post('admin/updateProfil/{id}', [AdminController::class, 'updateProfil'])->name('admin.updateProfil');

//Route untuk Wisata
Route::post('admin/updateWisata/{id}', [AdminController::class, 'updateWisata'])->name('admin.updateWisata');
Route::post('admin/createWisata', [AdminController::class, 'createWisata'])->name('admin.createWisata');
Route::get('admin/deleteWisata/{id}', [AdminController::class, 'deleteWisata'])->name('admin.deleteWisata');

Route::post('admin/updateJumlahPenduduk/{id}', [AdminController::class, 'updateJumlahPenduduk'])->name('admin.updateJumlahPenduduk');

Route::post('admin/updateKelompokUmur/{id}', [AdminController::class, 'updateKelompokUmur'])->name('admin.updateKelompokUmur');

Route::post('admin/updateJenisKelaminWilayah/{id}', [AdminController::class, 'updateJenisKelaminWilayah'])->name('admin.updateJenisKelaminWilayah');

Route::post('admin/updatePekerjaanPenduduk/{id}', [AdminController::class, 'updatePekerjaanPenduduk'])->name('admin.updatePekerjaanPenduduk');

Route::post('admin/updateAgamaPenduduk/{id}', [AdminController::class, 'updateAgamaPenduduk'])->name('admin.updateAgamaPenduduk');

Route::post('admin/updatePendidikanPenduduk/{id}', [AdminController::class, 'updatePendidikanPenduduk'])->name('admin.updatePendidikanPenduduk');


