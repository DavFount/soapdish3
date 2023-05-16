<?php

namespace App\Http\Middleware;

use App\Models\Language;
use App\Models\Translation;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'lang' => fn() => Language::orderBy('name')->get(),
            'translation' => function () {
                return Translation::query()
                    ->orderBy('abbreviation')
                    ->when(auth()->user()?->language_id, function ($query) {
                        $query->where('language_id', auth()->user()->language_id);
                    })->get();
            },
            'flash' => fn() => $request->session()->get('message'),
        ]);
    }
}
