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
    Route::get('admin/removeAdmin',[AdminController::class, 'admin'])->name('removeAdmin');
    Route::post('admin/removeAdmin', [AdminController::class, 'removeAdmin'])->name('removeAdmin');
});

//Admin Function
Route::post('/admin/update/{id}', [AdminController::class, 'updateKegiatan'])->name('admin.updateKegiatan');

Route::get('admin/delete/{id}', [AdminController::class, 'deleteKegiatan'])->name('admin.deleteKegiatan');

Route::post('admin/createKegiatan', [AdminController::class, 'createKegiatan'])->name('admin.createKegiatan');

Route::post('/admin/updateProfil/{id}', [AdminController::class, 'updateProfil'])->name('admin.updateProfil');

Route::post('/admin/updateAboutUs', [AdminController::class, 'updateAboutUs'])->name('admin.updateAboutUs');

//Route untuk Perangkat Kecamatan
Route::post('admin/createPerangkat', [AdminController::class], 'createPerangkat')->name('admin.createPerangkat');
Route::post('/admin/updatePerangkat/{id}', [AdminController::class, 'updatePerangkat'])->name('admin.updatePerangkat');
Route::get('admin/removePerangkat/{id}', [AdminController::class], 'removePerangkat')->name('admin.removePerangkat');