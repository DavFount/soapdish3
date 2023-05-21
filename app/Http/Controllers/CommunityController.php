<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Community/Index', [
            'users' => $request->user()->currentTeam->allUsers()
                ->sortBy('name', SORT_NATURAL)
                ->filter(function ($item) use ($request) {
                    return str_contains(strtolower($item), strtolower($request->search)) ? $item : false;
                }),
            'filters' => $request->only(['search'])
        ]);
    }
}
