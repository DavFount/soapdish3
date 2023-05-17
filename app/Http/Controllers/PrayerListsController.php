<?php

namespace App\Http\Controllers;

use App\Models\PrayerList;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PrayerListsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('PrayerList/Index', [
            'prayerLists' => PrayerList::query()
                ->orderBy('created_at')
                ->when($request->input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate($request->input('perPage') ?? 10)
                ->withQueryString(),
            'filters' => $request->only(['search', 'perPage'])
        ]);
    }

    public function create()
    {
        return Inertia::render('PrayerList/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string']
        ]);

        PrayerList::create($request->all());

        return redirect()->route('prayerlist.index');
    }

    public function show(PrayerList $prayerList)
    {
    }

    public function edit(PrayerList $prayerList)
    {
        return Inertia::render('PrayerList/Edit', [
            'prayerList'  => $prayerList
        ]);
    }

    public function update(Request $request, PrayerList $prayerList)
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string']
        ]);

        $prayerList->update($request->all());
        $prayerList->save();

        return redirect()->route('prayerlist.index');
    }

    public function destroy(PrayerList $prayerList)
    {
        $prayerList->delete();
        return redirect()->route('prayerlist.index');
    }
}
