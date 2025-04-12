<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function withoutMenu()
    {
        return view('pages.layouts.without-menu');
    }

    public function withoutNavbar()
    {
        return view('pages.layouts.without-navbar');
    }

    public function container()
    {
        return view('pages.layouts.container');
    }

    public function fluid()
    {
        return view('pages.layouts.fluid');
    }

    public function blank()
    {
        return view('pages.layouts.blank');
    }
}