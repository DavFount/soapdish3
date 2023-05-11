<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Request;

class CommunityController extends Controller
{
    public function index()
    {
        return Inertia::render('Community/Index', [
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(9)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->profile_photo_url,
                    'title' => $user->title,
                    'description' => $user->description,
                    'translation' => $user->translation,
                    'socials' => [
                        'facebook' => $user->facebook,
                        'twitter' => $user->twitter,
                        'instagram' => $user->instagram
                    ],
                    'filters' => Request::only(['search']),
                ])
        ]);
    }
}
