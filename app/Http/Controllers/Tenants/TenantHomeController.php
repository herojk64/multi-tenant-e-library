<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class TenantHomeController extends Controller
{
    public function index()
    {
        // Fetch a limited number of recommended books (can be adjusted based on your needs)
        $popularBooks = Books::with('rating')
            ->get()
            ->sortByDesc(function ($book) {
                return $book->bayesianRating();
            })
            ->take(5);

        // Fetch a paginated list of books to display on the home page
        $books = Books::inRandomOrder()->limit(20)->get();

        return view('tenants.index',['books'=>$books,'popularBooks'=>$popularBooks]);
    }
}
