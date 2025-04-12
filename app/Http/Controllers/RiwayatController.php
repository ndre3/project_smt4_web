<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayatBerita(){
        $berita = Berita::paginate(10);
        return view ('pages.riwayat.riwayat-berita.index', compact('berita'));
    }

}
