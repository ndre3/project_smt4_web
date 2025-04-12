<?php

namespace App\Http\Controllers;
use App\Models\Berita;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')->take(2)->get();
        return view('pages.dashboard', compact('beritaTerbaru'));
    }
}
