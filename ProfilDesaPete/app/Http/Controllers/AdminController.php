<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function admin(){
        $kegiatanterbaru = DB::table('kegiatan')->orderBy('id_kegiatan', 'desc')->first();
        return view('admin', compact('kegiatanterbaru'));

        $kegiatan = DB::table('kegiatan')->get();
        return view('admin', compact('kegiatan'));
    }

    public function index(){
        $kegiatanterbaru = DB::table('kegiatan')->orderBy('id_kegiatan', 'desc')->first();
        return view('index', compact('kegiatanterbaru'));
    }

    public function create(){
        if(Auth::user()->role !== 'superadmin'){
            abort(403, 'Unauthorized Access');
        }
        return view('createadmin');
    }

    public function store(Request $request){
        if(Auth::user()->role !== 'superadmin'){
            abort(403, 'Unauthorized Access');
        }
         $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required'
         ]);

         User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role'=>'admin',
         ]);

         return redirect('admin/createadmin')->with('success', 'Admin created successfully!');
    }
}
