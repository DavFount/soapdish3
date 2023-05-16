<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Verse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BibleController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Bible/Index', [
            'books' => auth()->user()->translation->books,
            'chapters' => null,
            'verses' => null,
            'book_id' => null,
            'chapter_id' => null,
        ]);
    }

    public function book(Book $book)
    {
        return Inertia::render('Bible/Index', [
            'books' => auth()->user()->translation->books,
            'chapters' => $book->chapters,
            'verses' => null,
            'book_id' => $book->id,
            'chapter_id' => null,
        ]);
    }

    public function chapter(Book $book, Chapter $chapter)
    {
        return Inertia::render('Bible/Index', [
            'books' => auth()->user()->translation->books,
            'chapters' => $book->chapters,
            'verses' => $chapter->verses,
            'book_id' => $book->id,
            'chapter_id' => $chapter->id,
        ]);
    }

}
