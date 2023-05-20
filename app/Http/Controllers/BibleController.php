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
    public function index(Translation $translation = null, Book $book = null, Chapter $chapter = null)
    {
        return Inertia::render('Bible/Index', [
            'translations' => Translation::with(['language'])->get(),
            'books' => Book::all(),
            'translation_id' => isset($translation->id) ? $translation->id : auth()->user()->translation_id ?? null,
            'chapters' => $book->chapters ?? null,
            'verses' => $chapter ? Verse::where('translation_id', $translation->id)->where('book_id', $book->id)->where('chapter_id', $chapter->id)->get() : null,
            'book_id' => isset($book->id) ? $book->id : null,
            'chapter_id' => isset($chapter->id) ? $chapter->id : null,
            'saved_verses' => auth()->user()->verses,
        ]);
    }

    public function saveVerse(Request $request, Translation $translation, Book $book, Chapter $chapter)
    {
        $verses = $request->selectedVerses;
        $highlight = $request->highlight;
        $underline = $request->underline;

        foreach ($verses as $verse) {
            if ($request->user()->verses->contains($verse)) {
                $request->user()->verses()->detach($verse);
            }
            if ($underline || $highlight) {
                $request->user()->verses()->attach($verse, [
                    'highlight' => $highlight,
                    'underline' => $underline,
                ]);
            }
        }

        return redirect()->route('bible', [
            'translation' => $translation,
            'book' => $book,
            'chapter' => $chapter
        ])->with('message', ['type' => 'success', 'message' => 'Verses Saved!']);
    }
}
