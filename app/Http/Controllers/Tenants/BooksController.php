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
        $filePath = $book->file; // This should be something like 'books/xyz.pdf'
        $url = $this->generateBlobUrl($filePath);
        return view('tenants.books.show', compact('book', 'url'));
    }

    private function generateBlobUrl($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            $fileContent = Storage::disk('public')->get($filePath);
            $blobUrl = 'data:application/pdf;base64,' . base64_encode($fileContent);
            return $blobUrl;
        }

        return null;
    }
}
