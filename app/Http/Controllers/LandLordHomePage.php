<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandLordHomePage extends Controller
{
    public function index()
    {
        return view('landlord.index');
    }
}
