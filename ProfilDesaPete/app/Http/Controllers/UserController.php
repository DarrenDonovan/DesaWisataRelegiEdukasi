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

        return view('about', compact('wilayah', 'about_us', 'camat', 'sekretaris', 'kasi', 'kepala_desa'));
    }

    public function berita(){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
            ->get();

        $berita = DB::table('berita')
            ->join('wilayah', 'berita.id_wilayah', '=', 'wilayah.id_wilayah')
            ->select('berita.id_berita', 'berita.judul_berita', 'berita.konten_berita', 'berita.gambar_berita', 'berita.penulis_berita', 'berita.tanggal_berita', 'berita.id_wilayah', 'wilayah.nama_wilayah')
            ->paginate(6);

        return view('berita', compact('wilayah', 'berita'));
    }

    public function detailberita($id){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah')
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
        
        return view('detailberita', compact('wilayah', 'berita', 'beritaterbaru'));
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

    public function profilDesa($id){
        $wilayah = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.jenis_wilayah')
            ->get();

        $wilayaheach = DB::table('wilayah')
            ->select('wilayah.id_wilayah', 'wilayah.nama_wilayah', 'wilayah.jenis_wilayah')
            ->where('wilayah.id_wilayah', $id)
            ->get();

        return view('profildesa', compact('wilayah', 'wilayaheach'));
    }
}
