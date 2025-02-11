<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('index', function(){
    return view('index');
});

Route::get('404', function(){
    return view('404');
});

Route::get('about', function(){
    return view('about');
});

Route::get('blog', function(){
    return view('blog');
});

Route::get('booking', function(){
    return view('booking');
});

Route::get('contact', function(){
    return view('contact');
});

Route::get('destination', function(){
    return view('destination');
});

Route::get('gallery', function(){
    return view('gallery');
});

Route::get('guides', function(){
    return view('guides');
});

Route::get('packages', function(){
    return view('packages');
});

Route::get('infografis', function(){
    return view('infografis');
});

Route::get('testimonial', function(){
    return view('testimonial');
});

Route::get('tour', function(){
    return view('tour');
});

Route::get('login', function(){
    return view('login');
});