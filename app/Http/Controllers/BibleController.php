<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Translation;
use App\Models\Verse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BibleController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Bible/Index', [
            'translations' => Translation::with(['language'])->get(),
            'translation_id' => auth()->user()->translation_id ?? null,
            'books' => Book::all(),
            'chapters' => null,
            'verses' => null,
            'book_id' => null,
            'chapter_id' => null,
        ]);
    }

    public function book(Translation $translation, Book $book)
    {
        return Inertia::render('Bible/Index', [
            'translations' => Translation::with(['language'])->get(),
            'books' => Book::all(),
            'chapters' => $book->chapters,
            'verses' => null,
            'translation_id' => $translation->id,
            'book_id' => $book->id,
            'chapter_id' => null,
        ]);
    }

    public function chapter(Translation $translation, Book $book, Chapter $chapter)
    {
        return Inertia::render('Bible/Index', [
            'translations' => Translation::with(['language'])->get(),
            'books' => Book::all(),
            'chapters' => $book->chapters,
            'verses' => Verse::where('translation_id', $translation->id)->where('book_id', $book->id)->where('chapter_id', $chapter->id)->get(),
            'translation_id' => $translation->id,
            'book_id' => $book->id,
            'chapter_id' => $chapter->id,
        ]);
    }

}
