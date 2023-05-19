<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Verse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class TranslationsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Translation/Index', [
            'translations' => Translation::query()
                ->orderBy('name')
                ->with(['language'])
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($request->input('perPage') ?? 10)
                ->withQueryString(),
            'filters' => $request->only(['search', 'perPage'])
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('translations', 'name')],
            'abbreviation' => ['required', 'string', 'max:5', Rule::unique('translations', 'abbreviation')],
            'language_id' => ['required', Rule::exists('languages', 'id')],
            'file' => ['file', 'required', 'mimetypes:application/json,text/plain']
        ]);

        $file = $request->file('file');
        if ($file->isReadable()) {
            $contents = $file->getContent();
            $json = json_decode($contents, true);

            $translation = Translation::create([
                'name' => $request->name,
                'abbreviation' => $request->abbreviation,
                'language_id' => $request->language_id,
            ]);

            foreach ($json as $book) {
                $b = Book::where('name', $book['name'])->first();
                if (!$b) {
                    $b = Book::create([
                        'name' => $book['name'],
                        'number' => $book['number'],
                    ]);
                }
                foreach ($book['chapters'] as $index => $chapter) {
                    $cNumber = $index + 1;
                    $c = Chapter::where('number', $cNumber)->where('book_id', $b->id)->first();

                    if (!$c) {
                        $c = Chapter::create([
                            'book_id' => $b->id,
                            'number' => $cNumber,
                        ]);
                    }
                    foreach ($chapter as $verseIndex => $verse) {
                        Verse::create([
                            'number' => $verseIndex + 1,
                            'text' => $verse,
                            'translation_id' => $translation->id,
                            'book_id' => $b->id,
                            'chapter_id' => $c->id,
                        ]);
                    }
                }
            }
        }
        return redirect()->route('translations.index');
    }

    public function create()
    {
        return Inertia::render('Translation/Create', [
            'languages' => Language::all()
        ]);
    }

    public function show(Translation $translation)
    {
        return Inertia::render('Translation/Show', ['translation' => $translation]);
    }

    public function edit(Translation $translation)
    {
        return Inertia::render('Translation/Edit', [
            'translation' => $translation,
            'languages' => Language::all()
        ]);
    }

    public function update(Request $request, Translation $translation)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('translations', 'name')->ignore($translation->id)],
            'abbreviation' => ['required', 'string', 'max:5', Rule::unique('translations', 'abbreviation')->ignore($translation->id)],
            'language_id' => ['required', Rule::exists('languages', 'id')],
        ]);

        $translation->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'language_id' => $request->language_id,
        ]);
        $translation->save();
        return redirect()->route('translations.index');
    }

    public function destroy(Translation $translation)
    {
        $translation->delete();
        return redirect()->route('translations.index');
    }
}
