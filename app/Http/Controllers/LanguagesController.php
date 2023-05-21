<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class LanguagesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Language/Index', [
            'languages' => Language::query()
                ->orderBy('name')
                ->with(['translations'])
                ->paginate(10),
            'can' => [
                'viewAny' => $request->user()->isAdmin,
                'create' => $request->user()->isAdmin,
                'view' => $request->user()->isAdmin,
                'update' => $request->user()->isAdmin,
                'delete' => $request->user()->isAdmin,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('languages', 'name')]
        ]);

        $language = Language::create($request->all());
        return redirect()->route('languages.index')->with('message', ['type' => 'success', 'message' => 'Language Created!']);
    }

    public function create()
    {
        return Inertia::render('Language/Create');
    }

    public function show(Language $language)
    {
        return Inertia::render('Language/Show', [
            'language' => $language,
        ]);
    }

    public function edit(Language $language)
    {
        return Inertia::render('Language/Edit', [
            'language' => $language,
        ]);
    }

    public function update(Request $request, Language $language)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('languages', 'name')->ignore($language->id)]
        ]);

        $language->update($request->all());
        $language->save();

        return redirect()->route('languages.index');
    }

    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('languages.index')->with('message', ['type' => 'success', 'message' => 'Language Deleted!']);
    }
}
