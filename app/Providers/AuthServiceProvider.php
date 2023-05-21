<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Language;
use App\Models\PrayerList;
use App\Models\PrayerRequest;
use App\Models\Study;
use App\Models\Translation;
use App\Policies\CategoryPolicy;
use App\Policies\LanguagePolicy;
use App\Policies\PrayerListPolicy;
use App\Policies\PrayerRequestPolicy;
use App\Policies\StudyPolicy;
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
        PrayerList::class => PrayerListPolicy::class,
        Study::class => StudyPolicy::class,
        Category::class => CategoryPolicy::class,
        PrayerRequest::class => PrayerRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
