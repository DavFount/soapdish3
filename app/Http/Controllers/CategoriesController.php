<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Categories/Index', [
            'categories' => Category::where('team_id', $request->user()->current_team_id)->paginate(),
            'can' => [
                'create' => $request->user()->hasTeamPermission($request->user()->currentTeam, 'create'),
                'edit' => $request->user()->hasTeamPermission($request->user()->currentTeam, 'update'),
                'delete' => $request->user()->hasTeamPermission($request->user()->currentTeam, 'delete'),
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', Rule::unique('categories', 'title')],
            'description' => ['nullable', 'string', 'max:150'],
        ]);

        Category::create([
           'title' => $request->title,
           'description' => $request->description,
           'team_id' => $request->user()->current_team_id,
        ]);

        return redirect()->route('categories.index')->with('message', ['type' => 'success', 'message' => 'Category Created']);
    }

    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', Rule::unique('categories', 'title')->ignore($category->id)],
            'description' => ['nullable', 'string', 'max:150'],
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('message', ['type' => 'success', 'message' => 'Category Updated']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('message', ['type' => 'danger', 'message' => 'Category Deleted']);
    }
}
