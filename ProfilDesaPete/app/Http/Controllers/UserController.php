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

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();
        
        $about_us = DB::table('about_us')
            ->join('wilayah', 'about_us.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('about_us.id_about', 'about_us.id_wilayah', 'about_us.visi', 'about_us.misi', 'about_us.gambar_about', 'about_us.bagan_organisasi', 'wilayah.nama_wilayah')
            ->first();
        
        $camat = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->where('perangkat_kecamatan.jabatan', 'Camat')
            ->first();
        
        $sekretaris = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->where('perangkat_kecamatan.jabatan', 'Sekretaris Kecamatan')
            ->first();

        $kasi = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->where('perangkat_kecamatan.jabatan', 'LIKE', 'Kasi%')
            ->get();

        $kepala_desa = DB::table('perangkat_kecamatan')
            ->select('perangkat_kecamatan.id_perangkat', 'perangkat_kecamatan.nama', 'perangkat_kecamatan.jabatan', 'perangkat_kecamatan.link_facebook', 'perangkat_kecamatan.link_instagram', 'perangkat_kecamatan.link_tiktok', 'perangkat_kecamatan.gambar_perangkat')
            ->where('perangkat_kecamatan.jabatan', 'LIKE', 'Kepala Desa%')
            ->get();
            
        $wilayahkecamatan = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk')
            ->where('wilayah.nama_wilayah', 'Kecamatan Tigaraksa')
            ->first();

        $jumlah_penduduk = DB::table('wilayah')
            ->whereIn('jenis_wilayah', ['Desa', 'Kelurahan'])
            ->sum('jumlah_penduduk');

        return view('about', compact('wilayah', 'wilayahNoKec', 'about_us', 'camat', 'sekretaris', 'kasi', 'kepala_desa', 'wilayahkecamatan', 'jumlah_penduduk'));
    }

    public function berita(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $berita = DB::table('berita')
            ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
            ->paginate(6);

        return view('berita', compact('wilayah', 'berita', 'wilayahNoKec'));
    }

    public function detailberita($id){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $berita = DB::table('berita')
            ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
            ->where('berita.id_berita', '=', $id)
            ->first();

        $beritaterbaru = DB::table('berita')
            ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
            ->orderBy('berita.id_berita', 'desc')
            ->limit(5)
            ->get();
        
        return view('detailberita', compact('wilayah', 'berita', 'beritaterbaru', 'wilayahNoKec'));
    }

    public function infografis(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();
        
        $jumlah_penduduk = DB::table('wilayah')
            ->select('wilayah.nama_wilayah', 'wilayah.jumlah_penduduk')
            ->whereIn('jenis_wilayah', ['Desa', 'Kelurahan'])
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

        $agama_kecamatan = DB::table('agama_per_wilayah')
            ->join('agama', 'agama_per_wilayah.id_agama','=', 'agama.id_agama')
            ->join('wilayah', 'agama_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('agama_per_wilayah.id_agama', 'agama.agama', 'agama_per_wilayah.jumlah_penganut')
            ->where('jenis_wilayah', 'Kecamatan')
            ->get();

        $kel_umur_kecamatan = DB::table('kel_umur_per_wilayah')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('kel_umur_per_wilayah.kelompok_umur', 'kel_umur_per_wilayah.jumlah_orang')
            ->where('jenis_wilayah', 'Kecamatan')
            ->get();

        $pekerjaan_kecamatan = DB::table('pekerjaan_per_wilayah')
            ->join('pekerjaan', 'pekerjaan_per_wilayah.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('wilayah', 'pekerjaan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pekerjaan_per_wilayah.id_pekerjaan', 'pekerjaan.pekerjaan', 'pekerjaan_per_wilayah.jumlah_pekerja')
            ->where('jenis_wilayah', 'Kecamatan')
            ->get();

        $pendidikan_kecamatan = DB::table('pendidikan_per_wilayah')
            ->join('pendidikan', 'pendidikan_per_wilayah.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('wilayah', 'pendidikan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pendidikan_per_wilayah.id_pendidikan', 'pendidikan.pendidikan', 'pendidikan_per_wilayah.jumlah_orang')
            ->where('jenis_wilayah', 'Kecamatan')
            ->get();

        return view('infografis', compact('wilayah', 'jumlah_penduduk', 'agama_kecamatan', 'wilayahNoKec', 'kel_umur_kecamatan', 'pekerjaan_kecamatan', 'pendidikan_kecamatan', 'jenis_kelamin', 'rasio_jenis_kelamin'));
    }

    public function maps(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah', 'wilayah.longitude', 'wilayah.latitude')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $lokasi_wilayah = DB::table('wilayah')
            ->select(['nama_wilayah', 'latitude', 'longitude', 'jenis_wilayah'])
            ->where('jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        return view('maps', compact('wilayah', 'wilayahNoKec', 'lokasi_wilayah'));
    }

    public function profilDesa($id){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.jenis_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->get();

        $wilayahNoKec = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.jenis_wilayah', '!=', 'Kecamatan')
            ->get();

        $wilayaheach = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.jenis_wilayah', 'wilayah.luas_wilayah', 'wilayah.jumlah_penduduk', 'wilayah.gambar_wilayah')
            ->where('wilayah.id_wilayah', $id)
            ->get();

        $data_jenis_kelamin = DB::table('jenis_kelamin_per_wilayah')
            ->join('wilayah', 'jenis_kelamin_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->whereIn('wilayah.jenis_wilayah', ['Desa', 'Kelurahan'])
            ->select([
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_laki) as penduduk_laki'),
                DB::raw('SUM(jenis_kelamin_per_wilayah.penduduk_perempuan) as penduduk_perempuan')
            ])
            ->where('jenis_kelamin_per_wilayah.id_wilayah', $id)
            ->first();
        $rasio_jenis_kelamin = [
            'Laki-Laki' => $data_jenis_kelamin->penduduk_laki,
            'Perempuan' => $data_jenis_kelamin->penduduk_perempuan,];
            
        $kel_umur_penduduk = DB::table('kel_umur_per_wilayah')
            ->join('wilayah', 'kel_umur_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('kel_umur_per_wilayah.id', 'kel_umur_per_wilayah.kelompok_umur', 'kel_umur_per_wilayah.jumlah_orang')
            ->where('kel_umur_per_wilayah.id_wilayah', $id)
            ->get();

        $pekerjaan_penduduk = DB::table('pekerjaan_per_wilayah')
            ->join('pekerjaan', 'pekerjaan_per_wilayah.id_pekerjaan', '=', 'pekerjaan.id_pekerjaan')
            ->join('wilayah', 'pekerjaan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pekerjaan_per_wilayah.id', 'pekerjaan_per_wilayah.id_pekerjaan', 'pekerjaan.pekerjaan', 'pekerjaan_per_wilayah.jumlah_pekerja')
            ->where('pekerjaan_per_wilayah.id_wilayah', $id)
            ->get();

        $agama_penduduk = DB::table('agama_per_wilayah')
            ->join('agama', 'agama_per_wilayah.id_agama','=', 'agama.id_agama')
            ->join('wilayah', 'agama_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('agama_per_wilayah.id', 'agama_per_wilayah.id_agama', 'agama.agama', 'agama_per_wilayah.jumlah_penganut')
            ->where('agama_per_wilayah.id_wilayah', $id)
            ->get();

        $pendidikan_penduduk = DB::table('pendidikan_per_wilayah')
            ->join('pendidikan', 'pendidikan_per_wilayah.id_pendidikan', '=', 'pendidikan.id_pendidikan')
            ->join('wilayah', 'pendidikan_per_wilayah.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('pendidikan_per_wilayah.id', 'pendidikan_per_wilayah.id_pendidikan', 'pendidikan.pendidikan', 'pendidikan_per_wilayah.jumlah_orang')
            ->where('pendidikan_per_wilayah.id_wilayah', $id)
            ->get();

        return view('profildesa', compact('wilayah', 'wilayaheach', 'wilayahNoKec', 'kel_umur_penduduk', 'pekerjaan_penduduk', 'agama_penduduk', 'pendidikan_penduduk', 'rasio_jenis_kelamin'));
    }

    public function wisata(){

        return view('wisata');
    }

    public function rute(){
        
        return view('rute');
    }
}
