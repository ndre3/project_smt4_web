<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;

class VisualisasiController extends Controller
{
    public function index(){
        return view('pages.visualisasi');
    }

    public function pengguna()
    {
        $data = [
            'admin' => User::where('role', 'admin')->count(),
            'sopir' => User::where('role', 'sopir')->count(),
            'user'  => User::where('role', 'masyarakat')->count(),
        ];

        return view('pages.visualisasi_pengguna', compact('data'));
    }

    public function laporan()
    {
        //
    }

    public function sampah()
    {
        //
    }

}