<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //home
    public function index()
    {
        return view('guest.index');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function about()
    {
        return view('guest.about');
    }
}
