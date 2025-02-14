<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function admin(){
        $kegiatanterbaru = DB::table('kegiatan')->orderBy('id_kegiatan', 'desc')->first();

        $kegiatan = DB::table('kegiatan')->get();
        return view('admin', compact('kegiatanterbaru', 'kegiatan'));
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();

        if (!$kegiatan) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        // Data untuk update
        $updateData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('gambar_kegiatan')) {
            if ($kegiatan->gambar_kegiatan) {
                Storage::delete('storage/' . $kegiatan->gambar_kegiatan);
            }

            $imagePath = $request->file('gambar_kegiatan')->store('keterangan', 'public');
            $updateData['gambar_kegiatan'] = $imagePath;
        }

        DB::table('kegiatan')->where('id_kegiatan', $id)->update($updateData);

        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

}
