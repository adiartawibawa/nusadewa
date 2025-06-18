<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    // News routes
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('news.index');
        Route::get('{post:slug}', [NewsController::class, 'show'])->name('news.show');

        // Special news sections
        Route::get('genome-editing', [NewsController::class, 'genomeEditing'])->name('news.genome-editing');
        Route::get('snp-resistance', [NewsController::class, 'snpResistance'])->name('news.snp-resistance');
        Route::get('bamboo-disease', [NewsController::class, 'bambooDisease'])->name('news.bamboo-disease');
        Route::get('multilocation', [NewsController::class, 'multilocation'])->name('news.multilocation');
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

    Route::get('/test', function () {
        return view('test');
    })->name('test');
});
