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

        //berita
        if($user->role == 'superadmin'){
            $berita = DB::table('berita')
                ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
                ->orderBy('id_berita', 'desc')
                ->paginate(5);
        }
        else{
            $berita = DB::table('berita')
                ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
                ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
                ->where('berita.id_wilayah', $user->id_wilayah)
                ->orderBy('id_berita', 'desc')
                ->paginate(5);
        }

        //perngkat kecamatan
        if($user->role == 'superadmin'){
        $perangkat_kecamatan = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->get();
        }
        else{
            $perangkat_kecamatan = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->where('perangkat_kecamatan.id_wilayah', $user->id_wilayah)
            ->get();
        }
        
        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        $jenis_kegiatan = DB::table('jenis_kegiatan')
            ->select('jenis_kegiatan.id_jenis_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->get();

        $wilayaheach = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.id_wilayah', $user->id_wilayah)
            ->first();

        $profil = DB::table('profil_kecamatan')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil_kecamatan.id_wilayah')
            ->select('profil_kecamatan.id_profil', 'profil_kecamatan.id_wilayah', 'profil_kecamatan.deskripsi', 'profil_kecamatan.logo_wilayah', 'wilayah.nama_wilayah')
            ->where('profil_kecamatan.id_wilayah', $user->id_wilayah)
            ->first();

        $about = DB::table('about_us')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'about_us.id_wilayah')
            ->select('about_us.id_about', 'about_us.id_wilayah', 'about_us.visi', 'about_us.misi', 'about_us.gambar_about', 'about_us.bagan_organisasi', 'wilayah.nama_wilayah')
            ->first();

        

      

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $jumlah_penduduk = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.jumlah_penduduk')
            ->whereIn('jenis_wilayah', ['Desa', 'Kelurahan'])
            ->get();

        $kel_umur_penduduk = DB::table('kel_umur_per_wilayah')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('kel_umur_per_wilayah.id', 'kel_umur_per_wilayah.kelompok_umur', 'kel_umur_per_wilayah.jumlah_orang')
            ->where('kel_umur_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        $jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select('wilayah.nama_wilayah', DB::raw('(jenis_kelamin_per_wilayah.penduduk_laki + jenis_kelamin_per_wilayah.penduduk_perempuan) as jumlah_penduduk'))
            ->get();

        $data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select([
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan')
            ])
            ->first();
        $rasio_jenis_kelamin = [
            'Laki-Laki' => $data_jenis_kelamin->penduduk_laki,
            'Perempuan' => $data_jenis_kelamin->penduduk_perempuan,
        ];

        $pekerjaan_penduduk = DB::table('pekerjaan_per_wilayah')
            ->join('pekerjaan', 'pekerjaan_per_wilayah.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('wilayah', 'pekerjaan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pekerjaan_per_wilayah.id', 'pekerjaan_per_wilayah.id_pekerjaan', 'pekerjaan.pekerjaan', 'pekerjaan_per_wilayah.jumlah_pekerja')
            ->where('pekerjaan_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        $agama_penduduk = DB::table('agama_per_wilayah')
            ->join('agama', 'agama_per_wilayah.id_agama','=', 'agama.id_agama')
            ->join('wilayah', 'agama_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('agama_per_wilayah.id', 'agama_per_wilayah.id_agama', 'agama.agama', 'agama_per_wilayah.jumlah_penganut')
            ->where('agama_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        $pendidikan_penduduk = DB::table('pendidikan_per_wilayah')
            ->join('pendidikan', 'pendidikan_per_wilayah.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('wilayah', 'pendidikan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pendidikan_per_wilayah.id', 'pendidikan_per_wilayah.id_pendidikan', 'pendidikan.pendidikan', 'pendidikan_per_wilayah.jumlah_orang')
            ->where('pendidikan_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();
                    
        return view('admin', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah', 'profil', 'users', 'about', 'perangkat_kecamatan', 'berita', 'wilayahNoKec', 'jumlah_penduduk', 'kel_umur_penduduk', 'pekerjaan_penduduk', 'agama_penduduk', 'pendidikan_penduduk', 'wilayaheach', 'jenis_kelamin', 'data_jenis_kelamin', 'rasio_jenis_kelamin'));
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

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
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

        $berita = DB::table('berita')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah')
            ->orderBy('id_berita', 'desc')
            ->limit(3)
            ->get();

        return view('index', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah','profil', 'profilkecamatan', 'berita', 'wilayahNoKec'));
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

    public function createBerita(Request $request){
        $request->validate([
            'judul_berita' => 'required|string',
            'penulis_berita' => 'required|string',
            'tanggal_berita' => 'required|date',
            'nama_wilayah' => 'required|integer',
            'gambar_berita' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'konten_berita' => 'required|string'
        ]);

        $imagePath = null;
        if($request->hasFile('gambar_berita')){
            $imagePath = $request->file('gambar_berita')->store('berita', 'public');
        }

        DB::table('berita')->insert([
            'judul_berita' => $request->judul_berita,
            'penulis_berita' => $request->penulis_berita,
            'tanggal_berita' => $request->tanggal_berita,
            'id_wilayah' => $request->nama_wilayah,
            'gambar_berita' => $imagePath,
            'konten_berita' => $request->konten_berita
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

    public function updateBerita(Request $request, $id){
        $request -> validate([
            'judul_berita' => 'required|string',
            'penulis_berita' => 'required|string',
            'tanggal_berita' => 'required|date',
            'nama_wilayah'=> 'required|integer',
            'gambar_berita' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'konten_berita' => 'required|string'
        ]);

        $berita = DB::table('berita')
            ->where('berita.id_berita', $id)
            ->first();
        
        if(!$berita){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'judul_berita' => $request->judul_berita,
            'penulis_berita' => $request->penulis_berita,
            'tanggal_berita' => $request->tanggal_berita,
            'id_wilayah' => $request->nama_wilayah,
            'konten_berita' => $request->konten_berita,
        ];

        if ($request->hasFile('gambar_berita')) {
            if ($perangkat->gambar_berita) {
                Storage::disk('public')->delete($berita->gambar_berita);
            }

            $imagePath = $request->file('gambar_berita')->store('berita', 'public');
            $updateData['berita'] = $imagePath;
        }

        DB::table('berita')->where('id_berita', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateJumlahPenduduk(Request $request, $id){
        $request -> validate([
            'jumlah_penduduk' => 'required|integer'
        ]);

        $wilayah = DB::table('wilayah')
            ->where('wilayah.id_wilayah', $id)
            ->first();
        
        if(!$wilayah){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_penduduk' => $request->jumlah_penduduk
        ];

        DB::table('wilayah')->where('id_wilayah', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateKelompokUmur(Request $request, $id){
        $request -> validate([
            'jumlah_penduduk' => 'required|integer'
        ]);

        $kel_umur = DB::table('kel_umur_per_wilayah')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->where('kel_umur_per_wilayah.id', $id)
            ->get();
        
        if(!$kel_umur){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_orang' => $request->jumlah_penduduk
        ];

        DB::table('kel_umur_per_wilayah')->where('id', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updatePekerjaanPenduduk(Request $request, $id){
        $request -> validate([
            'jumlah_pekerja' => 'required|integer'
        ]);

        $pekerjaan_penduduk = DB::table('pekerjaan_per_wilayah')
            ->join('wilayah', 'pekerjaan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->where('pekerjaan_per_wilayah.id', $id)
            ->get();
        
        if(!$pekerjaan_penduduk){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_pekerja' => $request->jumlah_pekerja
        ];

        DB::table('pekerjaan_per_wilayah')->where('id', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateAgamaPenduduk(Request $request, $id){
        $request -> validate([
            'jumlah_penganut' => 'required|integer'
        ]);

        $agama_penduduk = DB::table('agama_per_wilayah')
            ->join('wilayah', 'agama_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->where('agama_per_wilayah.id', $id)
            ->get();
        
        if(!$agama_penduduk){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_penganut' => $request->jumlah_penganut
        ];

        DB::table('agama_per_wilayah')->where('id', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updatePendidikanPenduduk(Request $request, $id){
        $request -> validate([
            'jumlah_penduduk' => 'required|integer'
        ]);

        $pendidikan_penduduk = DB::table('pendidikan_per_wilayah')
            ->join('wilayah', 'pendidikan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->where('pendidikan_per_wilayah.id', $id)
            ->get();
        
        if(!$pendidikan_penduduk){
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_orang' => $request->jumlah_penduduk
        ];

        DB::table('pendidikan_per_wilayah')->where('id', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }



    //Delete Data
    public function deleteKegiatan($id){
        $kegiatan = DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->first();

        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        Storage::disk('public')->delete($kegiatan->gambar_kegiatan);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }

    public function deleteAdmin(Request $request){
        $request->validate([
            'admin' => 'required|integer'
        ]);

        DB::table('users')->where('id', $request->admin)->delete();
        Session::flash('message', 'Admin Berhasil Dihapus!');
        return redirect()->route('removeAdmin');
    }

    public function deletePerangkat($id){
        $perangkat = DB::table('perangkat_kecamatan')
            ->where('id_perangkat', $id)
            ->first();

        DB::table('perangkat_kecamatan')->where('id_perangkat', $id)->delete();
        Storage::disk('public')->delete($perangkat->gambar_perangkat);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }

    public function deleteBerita($id){
        $berita = DB::table('berita')
            ->where('id_berita', $id)
            ->first();

        DB::table('berita')
            ->where('id_berita', $id)
            ->delete();
        Storage::disk('public')->delete($berita->gambar_berita);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin');
    }


}
