<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PrayerRequestsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('PrayerRequests/Index', [
            'prayerRequests' => PrayerRequest::query()
                ->where('team_id', $request->user()->current_team_id)
                ->paginate()
                ->withQueryString()
                ->through(function ($prayerRequest) {
                    return [
                        'id' => $prayerRequest->id,
                        'body' => $prayerRequest->body,
                        'can' => [
                            'view' => Auth::user()->can('view', $prayerRequest),
                            'edit' => Auth::user()->can('update', $prayerRequest),
                            'delete' => Auth::user()->can('delete', $prayerRequest),
                        ]
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('PrayerRequests/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => ['required', 'string', 'min:10', 'max:200'],
        ]);

        $request->user()->prayerRequest()->create([
            'body' => $request->body,
            'team_id' => $request->user()->current_team_id,
        ]);

        return redirect()->route('prayerrequests.index')->with('message', ['type' => 'success', 'message' => 'Prayer Request Created']);
    }

    public function edit(PrayerRequest $prayerRequest)
    {
        return Inertia::render('PrayerRequests/Edit', [
            'prayerRequest' => $prayerRequest,
        ]);
    }

    public function update(Request $request, PrayerRequest $prayerRequest)
    {
        $request->validate([
            'body' => ['required', 'string', 'min:10', 'max:200'],
        ]);

        $prayerRequest->update($request->all());

        return redirect()->route('prayerrequests.index')->with('message', ['type' => 'success', 'message' => 'Prayer Request Updated']);
    }

    public function destroy(PrayerRequest $prayerRequest)
    {
        $prayerRequest->delete();

        return redirect()->route('prayerrequests.index')->with('message', ['type' => 'danger', 'message' => 'Prayer Request Deleted']);
    }
}
