<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller{

    //Declare Database connection to data into admin adn index
    public function admin(){
        $user = Auth::user();

        //Kegiatan Terbaru
        if($user->role == 'superadmin'){
            $kegiatanterbaru = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
                ->orderBy('id_kegiatan', 'desc')
                ->first();
        }
        else{
            $kegiatanterbaru = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
                ->where('kegiatan.id_wilayah', $user->id_wilayah)
                ->orderBy('id_kegiatan', 'desc')
                ->first();
        }

        //Daftar Kegiatan
        if($user->role == 'superadmin'){
            $kegiatan = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah','=', 'wilayah.id_wilayah')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
                ->orderBy('id_kegiatan', 'desc')
                ->paginate(5);
        }
        else{
            $kegiatan = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah','=', 'wilayah.id_wilayah')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
                ->where('kegiatan.id_wilayah', $user->id_wilayah)
                ->orderBy('id_kegiatan', 'desc')
                ->paginate(5);
        }
        
        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        $jenis_kegiatan = DB::table('jenis_kegiatan')
            ->select('jenis_kegiatan.id_jenis_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $profil = DB::table('profil_kecamatan')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil_kecamatan.id_wilayah')
            ->select('profil_kecamatan.id_profil', 'profil_kecamatan.id_wilayah', 'profil_kecamatan.deskripsi', 'profil_kecamatan.logo_wilayah', 'wilayah.nama_wilayah')
            ->where('profil_kecamatan.id_wilayah', $user->id_wilayah)
            ->first();

        $about = DB::table('about_us')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'about_us.id_wilayah')
            ->select('about_us.id_about', 'about_us.id_wilayah', 'about_us.visi', 'about_us.misi', 'about_us.gambar_about', 'about_us.bagan_organisasi', 'wilayah.nama_wilayah')
            ->first();

        $perangkat_kecamatan = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->get();
    
        return view('admin', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah', 'profil', 'users', 'about', 'perangkat_kecamatan'));
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

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $profil = DB::table('profil_kecamatan')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil_kecamatan.id_wilayah')
            ->select('profil_kecamatan.id_profil', 'profil_kecamatan.id_wilayah', 'profil_kecamatan.deskripsi', 'profil_kecamatan.logo_wilayah', 'wilayah.nama_wilayah')
            ->first();

        $profilkecamatan = DB::table('profil_kecamatan')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil_kecamatan.id_wilayah')
            ->select('profil_kecamatan.id_profil', 'profil_kecamatan.id_wilayah', 'profil_kecamatan.deskripsi', 'profil_kecamatan.logo_wilayah', 'wilayah.nama_wilayah')
            ->where('profil_kecamatan.id_wilayah', 13)
            ->first();

        return view('index', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah','profil', 'profilkecamatan'));
    }

    //Create Admin
    public function create(){
        if(Auth::user()->role !== 'superadmin'){
            abort(403, 'Unauthorized Access');
        }

        $users = DB::table('users')
            ->join('wilayah', 'wilayah.id_wilayah', 'users.id_wilayah')
            ->select('users.name', 'users.email', 'users.role', 'users.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        return view('createadmin', compact('users','wilayah'));
    }


    //Store Admin Data
    public function store(Request $request){
        if(Auth::user()->role !== 'superadmin'){
            abort(403, 'Unauthorized Access');
        }
        
         $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'wilayah'=>'required|integer'
         ]);

         User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
            'role'=>'admin',
            'id_wilayah'=>$request->wilayah
         ]);

         return redirect('admin/createadmin')->with('success', 'Admin created successfully!');
    }

    //Create Data
    public function createKegiatan(Request $request){
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_wilayah' => 'required|integer',
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
            'id_wilayah' => $request->nama_wilayah,
            'keterangan' => $request->keterangan,
            'gambar_kegiatan' => $imagePath
        ]);

        Session::flash('message', 'Data Berhasil Ditambahkan!');
        return redirect()->route('admin');
    }

    public function createPerangkat(Request $request){
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'link_facebook' => 'nullable|string',
            'link_instagram' => 'nullable|string',
            'link_tiktok' => 'nullable|string',
            'gambar_perangkat' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if($request->hasFile('gambar_perangkat')){
            $imagePath = $request->file('gambar_perangkat')->store('perangkat_kecamatan', 'public');
        }

        DB::table('perangkat_kecamatan')->insert([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
            'gambar_perangkat' => $imagePath
        ]);

        Session::flash('message', 'Data Berhasil Ditambahkan!');
        return redirect()->route('admin');
    }


    //Data Update
    public function updateKegiatan(Request $request, $id){

        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_wilayah' => 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
       $user = Auth::user();

        $kegiatan = DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->where('kegiatan.id_wilayah', $user->id_wilayah)
            ->first();
        
        dd($kegiatan);

        if (!$kegiatan) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_jenis_kegiatan' => $request->jenis_kegiatan,  //nama kolom ditable => name di option
            'id_wilayah' => $request->nama_wilayah,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('gambar_kegiatan')) {
            if ($kegiatan->gambar_kegiatan) {
                Storage::disk('public')->delete($kegiatan->gambar_kegiatan);
            }

            $imagePath = $request->file('gambar_kegiatan')->store('kegiatan', 'public');
            $updateData['gambar_kegiatan'] = $imagePath;
        }

        DB::enableQueryLog(); // Start query logging
        $affectedRows = DB::table('kegiatan')->where('id_kegiatan', $id)->update($updateData);
        dd(DB::getQueryLog()); // Show the actual SQL query
        
        
        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateProfil(Request $request, $id){
        $request->validate([
            'deskripsi' => 'required|string',
            'logo_wilayah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();

        $profil = DB::table('profil_kecamatan')
            ->where('id_profil', $id)
            ->where('profil_kecamatan.id_wilayah', $user->id_wilayah)
            ->first();

        if (!$profil) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('logo_wilayah')) {
            if ($profil->logo_wilayah) {
                Storage::disk('public')->delete($profil->logo_wilayah);
            }

            $imagePath = $request->file('logo_wilayah')->store('profil', 'public');
            $updateData['logo_wilayah'] = $imagePath;
        }

        DB::table('profil_kecamatan')->where('id_profil', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }


    public function updateAboutUs(Request $request){
        $request -> validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
            'gambar_about' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bagan_organisasi' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $about_us = DB::table('about_us')->first();

        if (!$about_us) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }   

        $updateData = [
            'visi' => $request->visi,
            'misi' => $request->misi
        ];

        if ($request->hasFile('gambar_about')) {
            if ($about_us->gambar_about) {
                Storage::disk('public')->delete($about_us->gambar_about);
            }

            $imagePath = $request->file('gambar_about')->store('about_us', 'public');
            $updateData['gambar_about'] = $imagePath;
        }

        if ($request->hasFile('bagan_organisasi')) {
            if ($about_us->bagan_organisasi) {
                Storage::disk('public')->delete($about_us->bagan_organisasi);
            }

            $imagePath = $request->file('bagan_organisasi')->store('bagan_organisasi', 'public');
            $updateData['bagan_organisasi'] = $imagePath;
        }

        DB::table('about_us')->where('id_about', $about_us->id_about)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }


    public function updatePerangkat(Request $request, $id){
        $request->validate([
            'nama' => 'required|string',
            'jabatan' => 'required|string',
            'link_facebook' => 'nullable|string',
            'link_instagram' => 'nullable|string',
            'link_tiktok' => 'nullable|string',
            'gambar_perangkat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $perangkat = DB::table('perangkat_kecamatan')
            ->where('id_perangkat', $id)
            ->first();
        
        if (!$perangkat) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
        ];

        if ($request->hasFile('gambar_perangkat')) {
            if ($perangkat->gambar_perangkat) {
                Storage::disk('public')->delete($perangkat->gambar_perangkat);
            }

            $imagePath = $request->file('gambar_perangkat')->store('perangkat_kecamatan', 'public');
            $updateData['perangkat_kecamatan'] = $imagePath;
        }

        DB::table('perangkat_kecamatan')->where('id_perangkat', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }


    //Delete Data
    public function deleteKegiatan($id){
        $kegiatan = DB::table('kegiatan')->where('id_kegiatan', $id)->first();

        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        Storage::disk('public')->delete($kegiatan->gambar_kegiatan);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }

    public function removeAdmin(Request $request){
        $request->validate([
            'admin' => 'required|integer'
        ]);

        DB::table('users')->where('id', $request->admin)->delete();
        Session::flash('message', 'Admin Berhasil Dihapus!');
        return redirect()->route('removeAdmin');
    }

    public function removePerangkat($id){
        $perangkat = DB::table('perangkat_kecamatan')->where('id_perangkat', $id)->first();

        DB::table('perangkat_kecamatan')->where('id_perangkat', $id)->delete();
        Storage::disk('public')->delete($perangkat->gambar_perangkat);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }


}
