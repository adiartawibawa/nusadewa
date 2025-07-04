<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Livewire\Posts\InnovationsIndex;
use App\Livewire\Posts\InnovationsShow;
use App\Livewire\Posts\PostsIndex;
use App\Livewire\Posts\PostsShow;
use App\Support\LocaleManager;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/set-locale/{locale}', function ($locale) {
        if (!in_array($locale, LocaleManager::getSupportedLocales())) {
            abort(400); // prevent invalid locale
        }

        session(['locale' => $locale]);

        // Redirect ke URL yang sama tapi dengan prefix baru
        $previous = url()->previous();
        $parsed = parse_url($previous);
        $path = $parsed['path'] ?? '/';
        $newUrl = LaravelLocalization::getLocalizedURL($locale, $path);

        return redirect($newUrl);
    })->name('set-locale');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // News routes
    Route::prefix('news')->name('news.')->group(function () {

        Route::get('/', PostsIndex::class)->name('index');

        Route::get('{post:slug}', PostsShow::class)->name('show');
    });

    // Innovation routes
    Route::prefix('innovations')->name('innovations.')->group(function () {

        Route::get('/', InnovationsIndex::class)->name('index');

        Route::get('{post:slug}', InnovationsShow::class)->name('show');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('{post:slug}', [ProductController::class, 'show'])->name('products.show');
        Route::get('category/{category:slug}', [ProductController::class, 'category'])->name('products.category');
    });

    // Newsletter routes
    Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
        ->name('newsletter.confirm');
    Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
        ->name('newsletter.unsubscribe');
});
