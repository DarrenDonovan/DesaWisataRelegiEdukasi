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

Route::get('/', function () {
    return view('index');
});

$pages = [
    'index', '404', 'about', 'blog', 'booking', 'contact', 
    'destination', 'gallery', 'guides', 'packages', 'infografis', 
    'testimonial', 'tour', 'login', 'admin2'
];

foreach ($pages as $page) {
    Route::view($page, $page);
}

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);

Route::get('admin', function(){
    return view('admin');
})->middleware('auth');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('admin/createadmin', function(){
    return view('createadmin');
});

Route::middleware(['auth', SuperAdminMiddleware::class])->group(function(){
    Route::get('admin/createadmin', [AdminController::class, 'create']);
    Route::post('admin/storeadmin', [AdminController::class, 'store']);
});