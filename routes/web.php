<?php

use App\Http\Controllers\BibleController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\TranslationsController;
use App\Models\Language;
use App\Models\Translation;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/', 'Home')->name('home');

Route::post('/contact/submit', function() {
   return true;
})->name('send-contact-form');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/community', [CommunityController::class, 'index'])->name('community.index');

    // Bible Routes
    Route::get('/bible', [BibleController::class, 'index'])->name('bible');
    Route::get('/bible/book/{book}', [BibleController::class, 'book'])->name('bible.book');
    Route::get('/bible/book/{book}/chapter/{chapter}', [BibleController::class, 'chapter'])->name('bible.chapter');

    // Language Routes
    Route::get('/languages', [LanguagesController::class, 'index'])->can('viewAny', Language::class)->name('languages.index');
    Route::post('/languages', [LanguagesController::class, 'store'])->can('create', Language::class)->name('languages.store');
    Route::get('/languages/create', [LanguagesController::class, 'create'])->can('create', Language::class)->name('languages.create');
    Route::get('/languages/{language}', [LanguagesController::class, 'show'])->can('view', Language::class)->name('languages.show');
    Route::put('/languages/{language}', [LanguagesController::class, 'update'])->can('update', Language::class)->name('languages.update');
    Route::delete('/languages/{language}', [LanguagesController::class, 'destroy'])->can('delete', Language::class)->name('languages.delete');
    Route::get('/languages/{language}/edit', [LanguagesController::class, 'edit'])->can('update', Language::class)->name('languages.edit');

    // Translation Routes
    Route::get('/translations', [TranslationsController::class, 'index'])->can('viewAny', Translation::class)->name('translations.index');
    Route::post('/translations', [TranslationsController::class, 'store'])->can('create', Translation::class)->name('translations.store');
    Route::get('/translations/create', [TranslationsController::class, 'create'])->can('create', Translation::class)->name('translations.create');
    Route::get('/translations/{translation}', [TranslationsController::class, 'show'])->can('view', Translation::class)->name('translations.show');
    Route::put('/translations/{translation}', [TranslationsController::class, 'update'])->can('update', Translation::class)->name('translations.update');
    Route::delete('/translations/{translation}', [TranslationsController::class, 'destroy'])->can('delete', Translation::class)->name('translations.delete');
    Route::get('/translations/{translation}/edit', [TranslationsController::class, 'edit'])->can('update', Translation::class)->name('translations.edit');
});
