<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Language;
use App\Models\Translation;
use App\Policies\LanguagePolicy;
use App\Policies\TranslationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Translation::class => TranslationPolicy::class,
        Language::class => LanguagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
