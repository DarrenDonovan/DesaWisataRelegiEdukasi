<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function admin(){
        $kegiatanterbaru = DB::table('kegiatan')
            ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
            ->join('desa', 'kegiatan.id_desa', 'desa.id_desa')
            ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_desa', 'desa.nama_desa')
            ->orderBy('id_kegiatan', 'desc')->first();

        $kegiatan = DB::table('kegiatan')
            ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
            ->join('desa', 'kegiatan.id_desa', 'desa.id_desa')
            ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_desa', 'desa.nama_desa')
            ->orderBy('id_kegiatan', 'desc')
            ->paginate(5);

        $jenis_kegiatan = DB::table('jenis_kegiatan')
            ->select('jenis_kegiatan.id_jenis_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan')
            ->get();

        $desa = DB::table('desa')
            ->select('desa.id_desa', 'desa.nama_desa')
            ->get();

        $profil_desa = DB::table('profil_desa')
            ->join('desa', 'desa.id_desa', '=', 'profil_desa.id_desa')
            ->select('profil_desa.id_profil', 'profil_desa.judul_profil', 'profil_desa.konten_profil', 'profil_desa.logo_desa', 'profil_desa.id_desa', 'desa.nama_desa')
            ->get();
    
        return view('admin', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'desa', 'profil_desa'));
    }


    public function index(){
        $kegiatanterbaru = DB::table('kegiatan')
        ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
        ->select('kegiatan.*', 'jenis_kegiatan.*')
        ->orderBy('id_kegiatan', 'desc')->first();

        $kegiatan = DB::table('kegiatan')
            ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
            ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan')
            ->orderBy('id_kegiatan', 'desc')
            ->get();

        $jenis_kegiatan = DB::table('jenis_kegiatan')
            ->select('jenis_kegiatan.id_jenis_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'jenis_kegiatan.gambar_jenis_kegiatan')
            ->get();

        $desa = DB::table('desa')
            ->select('desa.id_desa', 'desa.nama_desa')
            ->get();

        $profil_desa = DB::table('profil_desa')
            ->join('desa', 'desa.id_desa', '=', 'profil_desa.id_desa')
            ->select('profil_desa.id_profil', 'profil_desa.judul_profil', 'profil_desa.konten_profil', 'profil_desa.logo_desa', 'profil_desa.id_desa', 'desa.nama_desa')
            ->get();

        return view('index', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'desa', 'profil_desa'));
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


    public function updateKegiatan(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_desa' => 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();

        if (!$kegiatan) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_jenis_kegiatan' => $request->jenis_kegiatan,  //nama kolom ditable => name di option
            'id_desa' => $request->nama_desa,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('gambar_kegiatan')) {
            if ($kegiatan->gambar_kegiatan) {
                Storage::disk('public')->delete($kegiatan->gambar_kegiatan);
            }

            $imagePath = $request->file('gambar_kegiatan')->store('kegiatan', 'public');
            $updateData['gambar_kegiatan'] = $imagePath;
        }

        DB::table('kegiatan')->where('id_kegiatan', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }


    public function deleteKegiatan($id){
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();

        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        Storage::disk('public')->delete($kegiatan->gambar_kegiatan);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }


    public function createKegiatan(Request $request){
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_desa' => 'required|integer',
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if($request->hasFile('gambar_kegiatan')){
            $imagePath = $request->file('gambar_kegiatan')->store('kegiatan', 'public');
        }

        DB::table('kegiatan')->insert([
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_jenis_kegiatan' => $request->jenis_kegiatan, //nama kolom ditable => name di option
            'id_desa' => $request->nama_desa,
            'keterangan' => $request->keterangan,
            'gambar_kegiatan' => $imagePath
        ]);

        Session::flash('message', 'Data Berhasil Ditambahkan!');
        return redirect()->route('admin');
    }

}
