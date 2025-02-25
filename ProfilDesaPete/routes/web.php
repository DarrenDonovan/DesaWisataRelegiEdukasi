<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
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

//Navbar Pages
$pages = [
    '404', 'about', 'blog', 'booking', 'contact', 
    'destination', 'gallery', 'guides', 'packages', 'infografis', 
    'testimonial', 'tour', 'login'
];

foreach ($pages as $page) {
    Route::view($page, $page);
}

//Admin Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);

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
});

//Admin Function
Route::post('/admin/update/{id}', [AdminController::class, 'updateKegiatan'])->name('admin.updateKegiatan');

Route::get('admin/delete/{id}', [AdminController::class, 'deleteKegiatan'])->name('admin.deleteKegiatan');

Route::post('admin/createKegiatan', [AdminController::class, 'createKegiatan'])->name('admin.createKegiatan');

Route::post('/admin/updateProfil/{id}', [AdminController::class, 'updateProfil'])->name('admin.updateProfil');

// Route::post('admin/removeAdmin', [AdminController::class, 'removeAdmin'])->name('removeAdmin');