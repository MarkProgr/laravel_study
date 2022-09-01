<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about-us');
    }
}

