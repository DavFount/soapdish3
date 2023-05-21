<?php

namespace App\Http\Controllers;

use App\Models\Study;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudiesController extends Controller
{
    public function index()
    {
        return Inertia::render('Studies/Index');
    }

    public function create()
    {
        return Inertia::render('Studies/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'scripture' => ['required', 'string'],
            'observation' => ['required', 'string'],
            'application' => ['required', 'string'],
            'prayer' => ['required', 'string'],
            'status' => [Rule::in(['Planned', 'In-Progress', 'Completed'])],
        ]);

        $request->user()->studies()->create([
            'title' => $request->title,
            'scripture' => $request->scripture,
            'observation' => $request->observation,
            'application' => $request->application,
            'prayer' => $request->prayer,
            'status' => $request->status,
            'team_id' => $request->shareToTeam ? $request->user()->current_team_id : null,
        ]);

        return redirect()->route('studies.index')->with('message', ['type' => 'success', 'message' => 'Study Created']);
    }

    public function show(Study $study)
    {
        return Inertia::render('Studies/Show', [
            'study' => $study
        ]);
    }

    public function edit(Study $study)
    {
        return Inertia::render('Studies/Edit', [
            'study' => $study
        ]);
    }

    public function update(Request $request, Study $study)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'scripture' => ['required', 'string'],
            'observation' => ['required', 'string'],
            'application' => ['required', 'string'],
            'prayer' => ['required', 'string'],
            'status' => [Rule::in(['Planned', 'In-Progress', 'Completed'])],
        ]);

        $study->update([
            'title' => $request->title,
            'scripture' => $request->scripture,
            'observation' => $request->observation,
            'application' => $request->application,
            'prayer' => $request->prayer,
            'status' => $request->status,
            'team_id' => $request->shareToTeam ? $request->user()->current_team_id : null,
        ]);

        return redirect()->route('studies.index')->with('message', ['type' => 'success', 'message' => 'Study Updated']);
    }

    public function destroy(Study $study)
    {
        $study->delete();
        return redirect()->route('studies.index')->with('message', ['type' => 'danger', 'message' => 'Study Deleted']);
    }
}
