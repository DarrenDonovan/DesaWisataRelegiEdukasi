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

        //Mengambil masing-masing penduduk laki-laki dan perempuan untuk kecamatan
        if($user->role == 'superadmin'){
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
        }
        else{
            //Mengambil masing-masing penduduk laki-laki dan perempuan per wilayah
            $data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
                ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'jenis_kelamin_per_wilayah.updated_by', '=', 'users.id')
                ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
                ->where('jenis_kelamin_per_wilayah.id_wilayah', $user->id_wilayah)
                ->select([
                    'jenis_kelamin_per_wilayah.id_wilayah',
                    'wilayah.nama_wilayah',
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan'),
                    'users.name',
                    'jenis_kelamin_per_wilayah.updated_at'
                    ])
                    ->groupBy('jenis_kelamin_per_wilayah.id_wilayah', 'wilayah.nama_wilayah', 'users.name', 'jenis_kelamin_per_wilayah.updated_at')
                    ->first();
                    $rasio_jenis_kelamin = [
                        'Laki-Laki' => $data_jenis_kelamin->penduduk_laki,
                        'Perempuan' => $data_jenis_kelamin->penduduk_perempuan,
                    ];
            }
        
        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();
        

        //Penduduk laki-laki + perempuan untuk per wilayah
        $jumlah_penduduk_per_wilayah = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select('wilayah.nama_wilayah', DB::raw('(jenis_kelamin_per_wilayah.penduduk_laki + jenis_kelamin_per_wilayah.penduduk_perempuan) as jumlah_penduduk'))
            ->where('jenis_kelamin_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        //Jumlah penduduk bersadarkan kelompok umur
        $kel_umur_penduduk = DB::table('kel_umur_per_wilayah')
            ->leftJoin('users', 'kel_umur_per_wilayah.updated_by', '=', 'users.id')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('kel_umur_per_wilayah.id', 'kel_umur_per_wilayah.kelompok_umur', 'kel_umur_per_wilayah.jumlah_orang', 'kel_umur_per_wilayah.updated_by', 'kel_umur_per_wilayah.updated_at', 'users.name')
            ->where('kel_umur_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        //Penduduk laki-laki + perempuan untuk kecamatan
        $jumlah_penduduk = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select('wilayah.nama_wilayah', DB::raw('(jenis_kelamin_per_wilayah.penduduk_laki + jenis_kelamin_per_wilayah.penduduk_perempuan) as jumlah_penduduk'))
            ->get();

        $total_data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select([
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan')
            ])
            ->first();
        
                    
        return view('admin.dashboard', compact('jumlah_penduduk_per_wilayah', 'kel_umur_penduduk','jumlah_penduduk', 'data_jenis_kelamin', 'rasio_jenis_kelamin', 'total_data_jenis_kelamin', 'users'));
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
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $berita = DB::table('berita')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah')
            ->orderBy('id_berita', 'desc')
            ->limit(3)
            ->get();

        return view('public.index', compact('kegiatanterbaru', 'kegiatan', 'jenis_kegiatan', 'wilayah', 'berita', 'wilayahNoKec'));
    }


    public function kegiatan(){
        $user = Auth::user();

        //Kegiatan Terbaru
        if($user->role == 'superadmin'){
            $kegiatanterbaru = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'kegiatan.updated_by', '=', 'users.id')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah', 'kegiatan.tanggal_kegiatan', 'kegiatan.updated_at', 'kegiatan.updated_by', 'users.name')
                ->orderBy('id_kegiatan', 'desc')
                ->first();
        }
        else{
            $kegiatanterbaru = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'kegiatan.updated_by', '=', 'users.id')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah', 'kegiatan.tanggal_kegiatan', 'kegiatan.updated_at', 'kegiatan.updated_by', 'users.name')
                ->where('kegiatan.id_wilayah', $user->id_wilayah)
                ->orderBy('id_kegiatan', 'desc')
                ->first();
        }

        //Daftar Kegiatan
        if($user->role == 'superadmin'){
            $kegiatan = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah','=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'kegiatan.updated_by', '=', 'users.id')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah', 'kegiatan.tanggal_kegiatan', 'kegiatan.updated_at', 'kegiatan.updated_by', 'users.name')
                ->orderBy('id_kegiatan', 'desc')
                ->paginate(5);
        }
        else{
            $kegiatan = DB::table('kegiatan')
                ->join('jenis_kegiatan', 'kegiatan.id_jenis_kegiatan', '=', 'jenis_kegiatan.id_jenis_kegiatan')
                ->join('wilayah', 'kegiatan.id_wilayah','=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'kegiatan.updated_by', '=', 'users.id')
                ->select('kegiatan.id_kegiatan', 'kegiatan.nama_kegiatan', 'kegiatan.id_jenis_kegiatan', 'kegiatan.keterangan', 'kegiatan.gambar_kegiatan', 'jenis_kegiatan.nama_jenis_kegiatan', 'kegiatan.id_wilayah', 'wilayah.nama_wilayah', 'kegiatan.tanggal_kegiatan', 'kegiatan.updated_at', 'kegiatan.updated_by', 'users.name')
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
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->get();

        return view('admin.kegiatanAdmin', compact('kegiatan', 'kegiatanterbaru', 'users', 'jenis_kegiatan', 'wilayah'));
    }


    public function profilWilayah(){
        $user = Auth::user();

        //perngkat kecamatan
        if($user->role == 'superadmin'){
            $perangkat_kecamatan = DB::table('perangkat_kecamatan')
                ->leftJoin('users', 'perangkat_kecamatan.updated_by', '=', 'users.id')
                ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat', 'perangkat_kecamatan.updated_by', 'perangkat_kecamatan.updated_at', 'users.name')
                ->get();
        }
        else{
            $perangkat_kecamatan = DB::table('perangkat_kecamatan')
                ->leftJoin('users', 'perangkat_kecamatan.updated_by', '=', 'users.id')
                ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat', 'perangkat_kecamatan.updated_by', 'perangkat_kecamatan.updated_at', 'users.name')
                ->where('perangkat_kecamatan.id_wilayah', $user->id_wilayah)
                ->get();
        }

        //Mengambil masing-masing penduduk laki-laki dan perempuan untuk kecamatan
        if($user->role == 'superadmin'){
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
        }
        else{
            //Mengambil masing-masing penduduk laki-laki dan perempuan per wilayah
            $data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
                ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'jenis_kelamin_per_wilayah.updated_by', '=', 'users.id')
                ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
                ->where('jenis_kelamin_per_wilayah.id_wilayah', $user->id_wilayah)
                ->select([
                    'jenis_kelamin_per_wilayah.id_wilayah',
                    'wilayah.nama_wilayah',
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan'),
                    'users.name',
                    'jenis_kelamin_per_wilayah.updated_at'
                    ])
                    ->groupBy('jenis_kelamin_per_wilayah.id_wilayah', 'wilayah.nama_wilayah', 'users.name', 'jenis_kelamin_per_wilayah.updated_at')
                    ->first();
                    $rasio_jenis_kelamin = [
                        'Laki-Laki' => $data_jenis_kelamin->penduduk_laki,
                        'Perempuan' => $data_jenis_kelamin->penduduk_perempuan,
                    ];
            }

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->get();

        $wilayaheach = DB::table('wilayah')
            ->leftJoin('users', 'wilayah.updated_by', '=', 'users.id')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah', 'wilayah.batas_utara', 'wilayah.batas_barat', 'wilayah.batas_timur', 'wilayah.batas_selatan', 'wilayah.updated_by', 'wilayah.updated_at', 'users.name') 
            ->where('wilayah.id_wilayah', $user->id_wilayah)
            ->first();

        $about = DB::table('about_us')
            ->join('wilayah', 'wilayah.id_wilayah', '=', 'about_us.id_wilayah')
            ->leftJoin('users', 'about_us.updated_by', '=', 'users.id')
            ->select('about_us.id_about', 'about_us.id_wilayah', 'about_us.visi', 'about_us.misi', 'about_us.gambar_about', 'about_us.bagan_organisasi', 'wilayah.nama_wilayah', 'about_us.updated_at', 'about_us.updated_by', 'users.name')
            ->first();
            

        return view('admin.profilWilayah', compact('perangkat_kecamatan', 'data_jenis_kelamin', 'user', 'users', 'rasio_jenis_kelamin', 'wilayah', 'wilayaheach', 'about'));

    }


    public function berita(){
        $user = Auth::user();

        //berita
        if($user->role == 'superadmin'){
            $berita = DB::table('berita')
                ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'berita.updated_by', '=', 'users.id')
                ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah', 'berita.updated_at', 'berita.updated_by', 'users.name')
                ->orderBy('id_berita', 'desc')
                ->paginate(5);
        }
        else{
            $berita = DB::table('berita')
                ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'berita.updated_by', '=', 'users.id')
                ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah', 'berita.updated_at', 'berita.updated_by', 'users.name')
                ->where('berita.id_wilayah', $user->id_wilayah)
                ->orderBy('id_berita', 'desc')
                ->paginate(5);
        }

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        return view('admin.beritaAdmin', compact('berita', 'user', 'users', 'wilayah'));
    }

    public function infografis(){
        $user = Auth::user();

         //Mengambil masing-masing penduduk laki-laki dan perempuan untuk kecamatan
         if($user->role == 'superadmin'){
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
        }
        else{
            //Mengambil masing-masing penduduk laki-laki dan perempuan per wilayah
            $data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
                ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'jenis_kelamin_per_wilayah.updated_by', '=', 'users.id')
                ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
                ->where('jenis_kelamin_per_wilayah.id_wilayah', $user->id_wilayah)
                ->select([
                    'jenis_kelamin_per_wilayah.id_wilayah',
                    'wilayah.nama_wilayah',
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                    DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan'),
                    'users.name',
                    'jenis_kelamin_per_wilayah.updated_at'
                    ])
                    ->groupBy('jenis_kelamin_per_wilayah.id_wilayah', 'wilayah.nama_wilayah', 'users.name', 'jenis_kelamin_per_wilayah.updated_at')
                    ->first();
                    $rasio_jenis_kelamin = [
                        'Laki-Laki' => $data_jenis_kelamin->penduduk_laki,
                        'Perempuan' => $data_jenis_kelamin->penduduk_perempuan,
                    ];
            }

        $wilayaheach = DB::table('wilayah')
            ->leftJoin('users', 'wilayah.updated_by', '=', 'users.id')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah', 'wilayah.batas_utara', 'wilayah.batas_barat', 'wilayah.batas_timur', 'wilayah.batas_selatan', 'wilayah.updated_by', 'wilayah.updated_at', 'users.name') 
            ->where('wilayah.id_wilayah', $user->id_wilayah)
            ->first();

             //Jumlah penduduk bersadarkan kelompok umur
        $kel_umur_penduduk = DB::table('kel_umur_per_wilayah')
            ->leftJoin('users', 'kel_umur_per_wilayah.updated_by', '=', 'users.id')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('kel_umur_per_wilayah.id', 'kel_umur_per_wilayah.kelompok_umur', 'kel_umur_per_wilayah.jumlah_orang', 'kel_umur_per_wilayah.updated_by', 'kel_umur_per_wilayah.updated_at', 'users.name')
            ->where('kel_umur_per_wilayah.id_wilayah', $user->id_wilayah)
            ->get();

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get(); 

        return view('admin.infografisAdmin', compact('user', 'data_jenis_kelamin', 'wilayaheach', 'kel_umur_penduduk', 'users', 'rasio_jenis_kelamin'));
        
    }

    public function wisata(){
        $user = Auth::user();

        //Daftar Wisata
        if($user->role == 'superadmin'){
            $wisata = DB::table('wisata')
                ->join('wilayah', 'wisata.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'wisata.updated_by', '=', 'users.id')
                ->select('wisata.id_wisata', 'wisata.id_wilayah', 'wilayah.nama_wilayah', 'wisata.nama_tempat', 'wisata.keterangan', 'wisata.gambar_wisata', 'wisata.latitude', 'wisata.longitude', 'users.name', 'wisata.updated_by', 'wisata.updated_at')
                ->orderBy('wisata.id_wilayah', 'asc')
                ->paginate(5);
        }
        else{
            $wisata = DB::table('wisata')
                ->join('wilayah', 'wisata.id_wilayah', '=', 'wilayah.id_wilayah')
                ->leftJoin('users', 'wisata.updated_by', '=', 'users.id')
                ->select('wisata.id_wisata', 'wisata.id_wilayah', 'wilayah.nama_wilayah', 'wisata.nama_tempat', 'wisata.keterangan', 'wisata.gambar_wisata', 'wisata.latitude', 'wisata.longitude', 'users.name', 'wisata.updated_at', 'wisata.updated_by')
                ->where('wisata.id_wilayah', $user->id_wilayah)
                ->orderBy('wisata.id_wilayah', 'asc')
                ->paginate(5);   
        }

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->get();

        return view('admin.wisataAdmin', compact('user', 'users', 'wisata', 'wilayahNoKec', 'wilayah'));
    }


    public function umkm(){
        $user = Auth::user();

        //Daftar UMKM
        if($user->role == 'superadmin'){
            $umkm = DB::table('umkm')
                ->join('wilayah', 'umkm.id_wilayah', '=', 'wilayah.id_wilayah')
                ->join('jenis_umkm', 'umkm.id_jenis_umkm', '=', 'jenis_umkm.id_jenis_umkm')
                ->leftJoin('users', 'umkm.updated_by', '=', 'users.id')
                ->select('umkm.id_umkm', 'umkm.id_wilayah', 'umkm.id_jenis_umkm', 'jenis_umkm.jenis_umkm', 'wilayah.nama_wilayah', 'umkm.nama_tempat', 'umkm.keterangan', 'umkm.gambar_umkm', 'umkm.latitude', 'umkm.longitude', 'users.name', 'umkm.updated_by', 'umkm.updated_at')
                ->orderBy('wisata.id_wilayah', 'asc')
                ->paginate(5);
        }
        else{
            $umkm = DB::table('umkm')
                ->join('wilayah', 'umkm.id_wilayah', '=', 'wilayah.id_wilayah')
                ->join('jenis_umkm', 'umkm.id_jenis_umkm', '=', 'jenis_umkm.id_jenis_umkm')
                ->leftJoin('users', 'umkm.updated_by', '=', 'users.id')
                ->select('umkm.id_umkm', 'umkm.id_wilayah', 'umkm.id_jenis_umkm', 'jenis_umkm.jenis_umkm', 'wilayah.nama_wilayah', 'umkm.nama_tempat', 'umkm.keterangan', 'umkm.gambar_umkm', 'umkm.latitude', 'umkm.longitude', 'users.name', 'umkm.updated_by', 'umkm.updated_at')
                ->where('umkm.id_wilayah', $user->id_wilayah)
                ->orderBy('umkm.id_wilayah', 'asc')
                ->paginate(5);
        }
        
        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.gambar_wilayah')
            ->get();

        $jenis_umkm = DB::table('jenis_umkm')
            ->select('jenis_umkm.id_jenis_umkm', 'jenis_umkm.jenis_umkm')
            ->get();

        return view('admin.umkm', compact('user','users', 'umkm', 'wilayahNoKec', 'wilayah', 'jenis_umkm'));
    }

    public function penduduk(){
        $user = Auth::user();


        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();

        if($user->role == 'superadmin'){
            $penduduk = DB::table('penduduk')
                ->join('wilayah', 'penduduk.id_wilayah', '=', 'wilayah.id_wilayah')
                ->join('agama', 'penduduk.id_agama', '=', 'agama.id_agama')
                ->join('pendidikan', 'penduduk.id_pendidikan', 'pendidikan.id_pendidikan')
                ->join('pekerjaan', 'penduduk.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
                ->join('status', 'penduduk.id_status', '=', 'status.id_status')
                ->select('penduduk.*', 'agama.*', 'pendidikan.*', 'pekerjaan.*', 'wilayah.*', 'status.*', DB::raw('FLOOR(DATEDIFF(CURDATE(), penduduk.tanggal_lahir) / 365) as umur'))
                ->orderBy('penduduk.nik', 'asc')
                ->paginate(50);
        }
        else{
            $penduduk = DB::table('penduduk')
                ->join('wilayah', 'penduduk.id_wilayah', '=', 'wilayah.id_wilayah')
                ->join('agama', 'penduduk.id_agama', '=', 'agama.id_agama')
                ->join('pendidikan', 'penduduk.id_pendidikan', 'pendidikan.id_pendidikan')
                ->join('pekerjaan', 'penduduk.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
                ->join('status', 'penduduk.id_status', '=', 'status.id_status')
                ->select('penduduk.*', 'agama.*', 'pendidikan.*', 'pekerjaan.*', 'wilayah.*', 'status.*', DB::raw('FLOOR(DATEDIFF(CURDATE(), penduduk.tanggal_lahir) / 365) as umur'))
                ->where('wilayah.id_wilayah', $user->id_wilayah)
                ->orderBy('penduduk.nik', 'asc')
                ->paginate(50);
        }



        return view('admin.penduduk', compact('user', 'users', 'penduduk'));
    }

    public function editPenduduk($id){
        $user = Auth::user();

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();
        
        $penduduk = DB::table('penduduk')
            ->join('wilayah', 'penduduk.id_wilayah', '=', 'wilayah.id_wilayah')
            ->join('agama', 'penduduk.id_agama', '=', 'agama.id_agama')
            ->join('pendidikan', 'penduduk.id_pendidikan', 'pendidikan.id_pendidikan')
            ->join('pekerjaan', 'penduduk.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('status', 'penduduk.id_status', '=', 'status.id_status')
            ->select('penduduk.*', 'agama.*', 'pendidikan.*', 'pekerjaan.*', 'wilayah.*', 'status.*', DB::raw('FLOOR(DATEDIFF(CURDATE(), penduduk.tanggal_lahir) / 365) as umur'))
            ->where('penduduk.id_penduduk', $id)
            ->get();

        return view('admin.editPenduduk', compact('user', 'users', 'penduduk'));
    }

    public function tambahPenduduk(){
        $user = Auth::user();

        $users = DB::table('users')
            ->select('users.id', 'users.name')
            ->where('users.id', '>', 1)
            ->get();
        
        $penduduk = DB::table('penduduk')
            ->join('wilayah', 'penduduk.id_wilayah', '=', 'wilayah.id_wilayah')
            ->join('agama', 'penduduk.id_agama', '=', 'agama.id_agama')
            ->join('pendidikan', 'penduduk.id_pendidikan', 'pendidikan.id_pendidikan')
            ->join('pekerjaan', 'penduduk.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('status', 'penduduk.id_status', '=', 'status.id_status')
            ->select('penduduk.*', 'agama.*', 'pendidikan.*', 'pekerjaan.*', 'wilayah.*', 'status.*', DB::raw('FLOOR(DATEDIFF(CURDATE(), penduduk.tanggal_lahir) / 365) as umur'))
            ->get();

        return view('admin.tambahPenduduk', compact('user', 'users', 'penduduk'));
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

        return view('admin.createadmin', compact('users','wilayah'));
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
        return redirect()->route('admin.kegiatan');
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
        return redirect()->route('admin.profilWilayah');
    }

    public function createBerita(Request $request){
        $request->validate([
            'judul_berita' => 'required|string',
            'penulis_berita' => 'required|string',
            'tanggal_berita' => 'required|date',
            'nama_wilayah' => 'required|integer',
            'gambar_berita' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'add_konten_berita' => 'required|string'
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
            'konten_berita' => $request->add_konten_berita
        ]);

        Session::flash('message', 'Data Berhasil Ditambahkan!');
        return redirect()->route('admin.berita');
    }

    public function createWisata(Request $request){
        
        
        return redirect()->route('admin.wisata');
    }

    public function createUMKM(Request $request){
        
        
        return redirect()->route('admin.umkm');
    }



    //Data Update
    public function updateKegiatan(Request $request, $id){

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|integer', //Sama dengan option name
            'nama_wilayah' => 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $kegiatan = DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->first();
        
        if (!$kegiatan) {
            return redirect()->route('admin.profilWilayah')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama_kegiatan' => $request->nama_kegiatan,
            'id_jenis_kegiatan' => $request->jenis_kegiatan,  //nama kolom ditable => name di option
            'id_wilayah' => $request->nama_wilayah,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
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
        return redirect()->route('admin.kegiatan')->with('success', 'Data berhasil diperbarui.');
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
            return redirect()->route('admin.profilWilayah')->with('error', 'Data tidak ditemukan.');
        }   

        $updateData = [
            'visi' => $request->visi,
            'misi' => $request->misi,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
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
        return redirect()->route('admin.profilWilayah')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateProfil(Request $request, $id){
        $request->validate([
            'gambar_wilayah' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $wilayah = DB::table('wilayah')
            ->where('id_wilayah', $id)
            ->first();
        
        if (!$wilayah) {
            return redirect()->route('admin.profilWilayah')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        if ($request->hasFile('gambar_wilayah')) {
            if ($wilayah->gambar_wilayah) {
                Storage::disk('public')->delete($wilayah->gambar_wilayah);
            }

            $imagePath = $request->file('gambar_wilayah')->store('profilwilayah', 'public');
            $updateData['gambar_wilayah'] = $imagePath;
        }

        DB::table('wilayah')->where('id_wilayah', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin.profilWilayah')->with('success', 'Data berhasil diperbarui.');
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
            return redirect()->route('admin.profilWilayah')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
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
        return redirect()->route('admin.profilWilayah')->with('success', 'Data berhasil diperbarui.');
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
            return redirect()->route('admin.berita')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'judul_berita' => $request->judul_berita,
            'penulis_berita' => $request->penulis_berita,
            'tanggal_berita' => $request->tanggal_berita,
            'id_wilayah' => $request->nama_wilayah,
            'konten_berita' => $request->konten_berita,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
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
        return redirect()->route('admin.berita')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateWisata(Request $request, $id){
        $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'nama_wilayah' => 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $wisata = DB::table('wisata')
            ->where('id_wisata', $id)
            ->first();
        
        if (!$wisata) {
            return redirect()->route('admin.wisata')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama_tempat' => $request->nama_tempat,
            'id_wilayah' => $request->nama_wilayah,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        if ($request->hasFile('gambar_wisata')) {
            if ($wisata->gambar_wisata) {
                Storage::disk('public')->delete($wisata->gambar_wisata);
            }

            $imagePath = $request->file('gambar_wisata')->store('wisata', 'public');
            $updateData['gambar_wisata'] = $imagePath;
        }

        DB::table('wisata')->where('id_wisata', $id)->update($updateData);
        
        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin.wisata')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateUMKM(Request $request, $id){
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'nama_wilayah' => 'required|integer',
            'jenis_umkm'=> 'required|integer', 
            'keterangan' => 'required|string',
            'gambar_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $umkm = DB::table('umkm')
            ->where('id_umkm', $id)
            ->first();
        
        if (!$umkm) {
            return redirect()->route('admin.umkm')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'nama_umkm' => $request->nama_umkm,
            'id_wilayah' => $request->nama_wilayah,
            'id_jenis_umkm' => $request->jenis_umkm,
            'keterangan' => $request->keterangan,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        if ($request->hasFile('gambar_umkm')) {
            if ($umkm->gambar_umkm) {
                Storage::disk('public')->delete($umkm->gambar_umkm);
            }

            $imagePath = $request->file('gambar_umkm')->store('umkm', 'public');
            $updateData['gambar_umkm'] = $imagePath;
        }

        DB::table('umkm')->where('id_umkm', $id)->update($updateData);
        
        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin.umkm')->with('success', 'Data berhasil diperbarui.');
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
            return redirect()->route('admin.infografis')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'jumlah_orang' => $request->jumlah_penduduk,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        DB::table('kel_umur_per_wilayah')->where('id', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin.infografis')->with('success', 'Data berhasil diperbarui.');
    }

    public function updateJenisKelaminWilayah(Request $request, $id){
        $request -> validate([
            'penduduk_laki' => 'integer',
            'penduduk_perempuan' => 'integer'
        ]);

        $jenis_kelamin_wilayah = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->where('jenis_kelamin_per_wilayah.id_wilayah', $id)
            ->get();
        
        if(!$jenis_kelamin_wilayah){
            return redirect()->route('admin.infografis')->with('error', 'Data tidak ditemukan.');
        }

        $updateData = [
            'penduduk_laki' => $request->penduduk_laki,
            'penduduk_perempuan' => $request->penduduk_perempuan,
            'updated_by' => Auth::user()->id,
            'updated_at' => now(),
        ];

        DB::table('jenis_kelamin_per_wilayah')->where('id_wilayah', $id)->update($updateData);

        Session::flash('message', 'Data Berhasil Diupdate!');
        return redirect()->route('admin.infografis')->with('success', 'Data berhasil diperbarui.');
    }




    //Delete Data
    public function deleteKegiatan($id){
        $kegiatan = DB::table('kegiatan')
            ->where('id_kegiatan', $id)
            ->first();

        DB::table('kegiatan')->where('id_kegiatan', $id)->delete();
        Storage::disk('public')->delete($kegiatan->gambar_kegiatan);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin.kegiatan');
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
        return redirect()->route('admin.profilWilayah');
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
        return redirect()->route('admin.berita');
    }

    public function deleteWisata($id){
        $wisata = DB::table('wisata')
            ->where('id_wisata', $id)
            ->first();

        DB::table('wisata')->where('id_wisata', $id)->delete();
        Storage::disk('public')->delete($wisata->gambar_wisata);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin.wisata');
    }

    public function deleteUMKM($id){
        $umkm = DB::table('umkm')
            ->where('id_umkm', $id)
            ->first();

        DB::table('umkm')->where('id_umkm', $id)->delete();
        Storage::disk('public')->delete($umkm->gambar_umkm);

        Session::flash('message', 'Data Berhasil Dihapus!');
        return redirect()->route('admin.umkm');
    }

}