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

    //Declare Database connection to data into admin adn index
    public function admin(){
        $user = Auth::user();

        $kegiatanterbaru = DB::table('kegiatan')
            ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
            ->join('wilayah', 'kegiatan.id_wilayah', 'wilayah.id_wilayah')
            ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
            // ->where('kegiatan.id_wilayah', 'wilayah.id_wilayah')
            // ->where('kegiatan.id_wilayah', $user->id_wilayah)
            ->orderBy('id_kegiatan', 'desc')->first();

        $kegiatan = DB::table('kegiatan')
            ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
            ->join('wilayah', 'kegiatan.id_wilayah', 'wilayah.id_wilayah')
            ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah')
          //  ->where('kegiatan.id_wilayah', $user->id_wilayah)
            ->orderBy('id_kegiatan', 'desc')
            ->paginate(5);

        $jenis_kegiatan = DB::table('jenis_kegiatan')
            ->select('jenis_kegiatan.id_jenis_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $profil = DB::table('profil')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil.id_wilayah')
            ->select('profil.id_profil', 'profil.id_wilayah', 'profil.deskripsi', 'profil.logo_wilayah', 'wilayah.nama_wilayah')
            ->where('profil.id_wilayah', $user->id_wilayah)
            ->first();
    
        return view('admin', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah', 'profil'));
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

        $profil = DB::table('profil')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'profil.id_wilayah')
            ->select('profil.id_profil', 'profil.id_wilayah', 'profil.deskripsi', 'profil.logo_wilayah', 'wilayah.nama_wilayah')
            ->first();

        return view('index', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah','profil'));
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


    //Data Update
    public function updateKegiatan(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_wilayah' => 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

       // $user = Auth::user();

        $kegiatan = DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            //->where('kegiatan.id_wilayah', $user->id_wilayah)
            ->first();

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

        DB::table('kegiatan')->where('id_kegiatan', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateProfil(Request $request, $id){
        $request->validate([
            'nama_wilayah' => 'required|integer', 
            'deskripsi' => 'required|string',
            'logo_wilayah' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

       // $user = Auth::user();

        $profil = DB::table('profil')
            ->where('id_profil', $id)
            //->where('profil.id_wilayah', $user->id_wilayah)
            ->first();

        if (!$profil) {
            return redirect()->route('admin')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'id_wilayah' => $request->nama_wilayah,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('logo_wilayah')) {
            if ($profil->logo_wilayah) {
                Storage::disk('public')->delete($profil->logo_wilayah);
            }

            $imagePath = $request->file('logo_wilayah')->store('profil', 'public');
            $updateData['logo_wilayah'] = $imagePath;
        }

        DB::table('profil')->where('id_profil', $id)->update($updateData);

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


}
