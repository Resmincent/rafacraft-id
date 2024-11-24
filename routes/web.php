<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomBucketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\CheckoutController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Policy Routes
Route::view('/terms-of-service', 'policy.terms')->name('terms.show');
Route::view('/privacy-policy', 'policy.privacy')->name('policy.show');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Routes for Admin
    Route::resource('categories', CategoryController::class);
    Route::resource('bouquets', BouquetController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class)->only([
        'index',
        'create',
        'store',
        'show',
        'destroy',
    ]);


    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    // Custom Bucket Routes
    Route::resource('custom-buckets', CustomBucketController::class);
    Route::post('/custom-buckets/{customBucket}/add-to-cart', [CustomBucketController::class, 'addToCart'])
        ->name('custom-buckets.add-to-cart');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{cartItem}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('cart.update');

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    });

    // Landing Page Routes
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing');
    Route::get('/detail-product/{id}', [LandingPageController::class, 'detail'])->name('detailProduct');
});
