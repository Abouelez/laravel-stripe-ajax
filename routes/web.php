<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\web\WebProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [WebProductController::class, 'index']);
    Route::get('/create_product', [WebProductController::class, 'create']);
    Route::post('/products', [WebProductController::class, 'store'])->name('products.store');
    Route::get('/edit/{product}', [WebProductController::class, 'edit'])->name('product.edit');
    Route::delete('/delete/{product}', [WebProductController::class, 'delete'])->name('product.delete');

    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('/success', [PaymentController::class, 'success'])->name('success');
});





require __DIR__ . '/auth.php';
