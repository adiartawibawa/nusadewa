<?php

use App\Http\Controllers\NewsletterController;
use App\Livewire\Posts\InnovationsIndex;
use App\Livewire\Posts\InnovationsShow;
use App\Livewire\Posts\PostsIndex;
use App\Livewire\Posts\PostsShow;
use App\Livewire\Posts\ProductIndex;
use App\Livewire\Posts\ProductShow;
use App\Livewire\ProductsSection;
use App\Support\LocaleManager;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    // Livewire will know to use this endpoint for all component updates
    // https://livewire.laravel.com/docs/installation#configuring-livewires-update-endpoint
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

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

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', ProductIndex::class)->name('index');
        Route::get('{post:slug}', ProductShow::class)->name('show');
        Route::get('category/{category:slug}', ProductsSection::class)->name('category');
    });

    // Newsletter routes
    Route::get('/newsletter/confirm/{token}', [NewsletterController::class, 'confirm'])
        ->name('newsletter.confirm');
    Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
        ->name('newsletter.unsubscribe');
});
