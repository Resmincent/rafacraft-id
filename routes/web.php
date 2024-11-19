<?php

use App\Http\Controllers\BouquetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomBucketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('custom_buckets', CustomBucketController::class);
    Route::resource('bouqeuts', BouquetController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class)->only([
        'index',
        'create',
        'store',
        'show',
        'destroy',
    ]);
});


Route::view('/terms-of-service', 'policy.terms')->name('terms.show');
Route::view('/privacy-policy', 'policy.privacy')->name('policy.show');
