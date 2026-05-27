<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('shop.index');
});

// Authentication
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======================== PUBLIC SHOP ROUTES ========================
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{book}', [ShopController::class, 'show'])->name('show');
    Route::post('/{book}/add-to-cart', [ShopController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart/view', [ShopController::class, 'cart'])->name('cart');
    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('updateCart');
    Route::post('/cart/remove', [ShopController::class, 'removeFromCart'])->name('removeFromCart');
    Route::middleware('auth')->group(function () {
        Route::get('/checkout/form', [ShopController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/place-order', [ShopController::class, 'placeOrder'])->name('placeOrder');
        Route::get('/order/{order}/confirmation', [ShopController::class, 'orderConfirmation'])->name('orderConfirmation');
    });
});

// ======================== ADMIN ROUTES ========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('shop.index');
    })->name('dashboard');

    Route::resource('books', BookController::class);

    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/database', [AdminController::class, 'database'])->name('database');
        
        // Books
        Route::get('/books', [AdminController::class, 'books'])->name('books.index');
        Route::get('/books/{book}/edit', [AdminController::class, 'editBook'])->name('books.edit');
        Route::post('/books/{book}', [AdminController::class, 'updateBook'])->name('books.update');
        Route::delete('/books/{book}', [AdminController::class, 'deleteBook'])->name('books.destroy');
        
        // Orders
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [AdminController::class, 'orders'])->name('index');
            Route::get('/{order}', [AdminController::class, 'showOrder'])->name('show');
            Route::post('/{order}/update-status', [AdminController::class, 'updateOrderStatus'])->name('updateStatus');
        });
        
        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [AdminController::class, 'users'])->name('index');
            Route::get('/{user}', [AdminController::class, 'showUser'])->name('show');
            Route::delete('/{user}', [AdminController::class, 'deleteUser'])->name('destroy');
        });
    });
});

