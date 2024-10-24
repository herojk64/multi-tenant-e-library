<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\SearchLog;
use Illuminate\Http\Request;

class TenantHomeController extends Controller
{
    public function index()
    {
        // Fetch a limited number of recommended books (can be adjusted based on your needs)
        $books = Books::with('rating')
            ->get();

        $topRatedBooks = $this->getTopRatedBooks($books);
        $popularBooks = $this->getPopularBooks();
        $recomendedBooks = $this->getRecomendedBooks();

        $randomBooks = $books->count() >20?$books->random(20):$books ;


        return view('tenants.index',[
            'books' => $randomBooks,
            'topRatedBooks' => $topRatedBooks,
            'popularBooks' => $popularBooks,
            'recomendedBooks' => $recomendedBooks,
        ]);
    }

    public function getTopRatedBooks($books)
    {
        return $books->sortByDesc(function ($book) {
            return $book->bayesianRating();
        })
            ->take(5);
    }

    public function getPopularBooks(int $limit = 5)
    {
        // Step 1: Fetch all popular search terms
        $popularSearchTerms = SearchLog::calculatePopularSearches();

        if (empty($popularSearchTerms)) {
            return collect(); // Return an empty collection instead of null
        }

        // Step 2: Fetch books in one query, matching the popular search terms and including view counts
        return Books::withCount('views') // Fetch view count only once
        ->where(function ($query) use ($popularSearchTerms) {
            foreach ($popularSearchTerms as $term) {
                if ($term) {
                    $query->orWhere('title', 'like', '%' . $term . '%'); // Match any search term
                }
            }
        })
            ->limit($limit)
            ->get(); // Fetch the books
    }

    public function getRecomendedBooks(int $limit = 5)
    {
        // Step 1: Fetch all popular search terms for the authenticated user or based on their IP
        $popularSearchTerms = SearchLog::calculateUserPopularSearches();

        if (empty($popularSearchTerms)) {
            return collect(); // Return an empty collection instead of null
        }

        // Step 2: Fetch books in one query, matching the popular search terms and including view counts
        return Books::withCount('views') // Fetch view count only once
        ->where(function ($query) use ($popularSearchTerms) {
            foreach ($popularSearchTerms as $term) {
                if ($term) {
                    $query->orWhere('title', 'like', '%' . $term . '%'); // Match any search term
                }
            }
        })
            ->limit($limit)
            ->get(); // Fetch the books
    }

}
