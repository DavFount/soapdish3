<?php

use App\Http\Controllers\BibleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\PrayerListsController;
use App\Http\Controllers\PrayerRequestsController;
use App\Http\Controllers\StudiesController;
use App\Http\Controllers\TranslationsController;
use App\Models\Category;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Home')->name('home');

Route::post('/contact/submit', function () {
    return true;
})->name('send-contact-form');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('/dashboard')->group(function () {

        // Team Route - Shows Current Team Members (May rework later)
        Route::get('/community', [CommunityController::class, 'index'])->name('community.index');

        // Bible Routes
        Route::get('/bible/{translation?}/{book?}/{chapter?}', [BibleController::class, 'index'])->name('bible');
        Route::post('/bible/translation/{translation}/book/{book}/chapter/{chapter}', [BibleController::class, 'saveVerse'])->name('bible.save-verse');

        // Language Routes
        Route::get('/languages', [LanguagesController::class, 'index'])->can('viewAny', Language::class)->name('languages.index');
        Route::get('/languages/create', [LanguagesController::class, 'create'])->can('create', Language::class)->name('languages.create');
        Route::post('/languages', [LanguagesController::class, 'store'])->can('create', Language::class)->name('languages.store');
        Route::get('/languages/{language}', [LanguagesController::class, 'show'])->can('view', Language::class)->name('languages.show');
        Route::put('/languages/{language}', [LanguagesController::class, 'update'])->can('update', Language::class)->name('languages.update');
        Route::delete('/languages/{language}', [LanguagesController::class, 'destroy'])->can('delete', Language::class)->name('languages.delete');
        Route::get('/languages/{language}/edit', [LanguagesController::class, 'edit'])->can('update', Language::class)->name('languages.edit');


        // Translation Routes
        Route::get('/translations', [TranslationsController::class, 'index'])->can('viewAny', Translation::class)->name('translations.index');
        Route::get('/translations/create', [TranslationsController::class, 'create'])->can('create', Translation::class)->name('translations.create');
        Route::post('/translations', [TranslationsController::class, 'store'])->can('create', Translation::class)->name('translations.store');
        Route::get('/translations/{translation}', [TranslationsController::class, 'show'])->can('view', Translation::class)->name('translations.show');
        Route::put('/translations/{translation}', [TranslationsController::class, 'update'])->can('update', Translation::class)->name('translations.update');
        Route::delete('/translations/{translation}', [TranslationsController::class, 'destroy'])->can('delete', Translation::class)->name('translations.delete');
        Route::get('/translations/{translation}/edit', [TranslationsController::class, 'edit'])->can('update', Translation::class)->name('translations.edit');


        // Prayer List Routes
        Route::get('/prayerlists', [PrayerListsController::class, 'index'])->name('prayerlist.index');
        Route::get('/prayerlists/create', [PrayerListsController::class, 'create'])->name('prayerlist.create');
        Route::post('/prayerlists', [PrayerListsController::class, 'store'])->name('prayerlist.store');
        Route::put('/prayerlists/{prayerList}', [PrayerListsController::class, 'update'])->can('update', 'prayerList')->name('prayerlist.update');
        Route::delete('/prayerlists/{prayerList}', [PrayerListsController::class, 'destroy'])->can('delete', 'prayerList')->name('prayerlist.delete');
        Route::get('/prayerlists/{prayerList}/edit', [PrayerListsController::class, 'edit'])->can('update', 'prayerList')->name('prayerlist.edit');

        // Study Routes
        Route::get('/studies', [StudiesController::class, 'index'])->name('studies.index');
        Route::get('/studies/create', [StudiesController::class, 'create'])->name('studies.create');
        Route::post('/studies', [StudiesController::class, 'store'])->name('studies.store');
        Route::get('/studies/{study}', [StudiesController::class, 'show'])->can('view', 'study')->name('studies.show');
        Route::put('/studies/{study}', [StudiesController::class, 'update'])->can('update', 'study')->name('studies.update');
        Route::delete('/studies/{study}', [StudiesController::class, 'destroy'])->can('delete', 'study')->name('studies.delete');
        Route::get('/studies/{study}/edit', [StudiesController::class, 'edit'])->can('update', 'study')->name('studies.edit');

        // Prayer Request Routes
        Route::get('/prayer_requests', [PrayerRequestsController::class, 'index'])->name('prayerrequests.index');
        Route::get('/prayer_requests/create', [PrayerRequestsController::class, 'create'])->name('prayerrequests.create');
        Route::post('/prayer_requests', [PrayerRequestsController::class, 'store'])->name('prayerrequests.store');
        Route::put('/prayer_requests/{prayerRequest}', [PrayerRequestsController::class, 'update'])->can('update', 'prayerRequest')->name('prayerrequests.update');
        Route::delete('/prayer_requests/{prayerRequest}', [PrayerRequestsController::class, 'destroy'])->can('delete', 'prayerRequest')->name('prayerrequests.delete');
        Route::get('/prayer_requests/{prayerRequest}/edit', [PrayerRequestsController::class, 'edit'])->can('update', 'prayerRequest')->name('prayerrequests.edit');

        // Category Routes
        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoriesController::class, 'create'])->can('create', Category::class)->name('categories.create');
        Route::post('/categories', [CategoriesController::class, 'store'])->can('create', Category::class)->name('categories.store');
        Route::put('/categories/{category}', [CategoriesController::class, 'update'])->can('update', 'category')->name('categories.update');
        Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->can('delete', 'category')->name('categories.delete');
        Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->can('update', 'category')->name('categories.edit');
    });
});
