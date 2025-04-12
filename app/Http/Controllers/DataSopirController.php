<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class DataSopirController extends Controller
{
    public function index(){
        $sopirs = User::where('role', 'sopir')->get();
        return view ('pages.data-master.data-sopir.index', compact('sopirs'));
    }
}
