<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\PublicController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/cart', 'cart')->name('cart');
    Route::post('/add-to-cart/{id}', 'addToCart')->name('cart.add');
});

Route::middleware('auth')->group(function () {

    Route::controller(PublicController::class)->group(function () {
        Route::patch('/update-cart', 'updateCart')->name('cart.update');
        Route::delete('/remove-from-cart', 'removeFromCart')->name('cart.remove');
        Route::get('/checkout', 'checkout')->name('checkout.index');
        Route::post('/checkout', 'processCheckout')->name('checkout.process');
        Route::get('/checkout/success/{order_number}', 'success')->name('checkout.success');
        Route::get('/order-history', 'orderHistory')->name('orders.history');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('admin.products');
        Route::get('/add', 'create')->name('admin.create');
        Route::post('/', 'store')->name('admin.store');
        Route::get('/{product}/edit', 'edit')->name('admin.edit');
        Route::put('/{product}', 'update')->name('admin.update');
        Route::delete('/{product}', 'destroy')->name('admin.deestroy');
    });

    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('admin.orders');
        Route::get('/{id}', 'show')->name('admin.orders.show');
        Route::patch('/{id}/status', 'updateStatus')->name('admin.orders.updateStatus');
    });

    Route::prefix('reports')->group(function () {
        Route::get('/revenue', [ReportController::class, 'revenue'])->name('reports.revenue');
    });
});

require __DIR__ . '/auth.php';