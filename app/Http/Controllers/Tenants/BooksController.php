<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    public function index()
    {

        return view('tenants.books.index');
    }

    public function show(Books $book)
    {
        // Ensure the file exists before generating a temporary URL
        if (Storage::exists($book->file)) {
            // Generate a temporary URL that expires in 5 minutes
            $url = Storage::temporaryUrl(
                $book->file, now()->addMinutes(5)
            );
        } else {
            // Handle the case where the file does not exist
            $url = null;
        }

        // Pass the book and the temporary URL to the view
        return view('tenants.books.show', compact('book', 'url'));
    }
}
