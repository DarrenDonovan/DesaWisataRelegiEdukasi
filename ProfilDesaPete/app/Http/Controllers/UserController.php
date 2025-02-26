<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function about(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('about', compact('wilayah'));
    }

    public function berita(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('berita', compact('wilayah'));
    }

    public function infografis(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('infografis', compact('wilayah'));
    }

    public function maps(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('maps', compact('wilayah'));
    }

    public function profilDesa(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('profilDesa', compact('wilayah'));
    }
}