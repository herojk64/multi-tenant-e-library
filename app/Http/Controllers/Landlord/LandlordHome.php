<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandlordHome extends Controller
{
    public function index()
    {
        return view('landlord.home');
    }
}
