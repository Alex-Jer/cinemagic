<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// TODO: temp
Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
// TODO:


Route::get('/', function () {
    return view('home');
});

/**
 * Film routes
 */
Route::controller(FilmController::class)->group(function () {
    Route::get('films', 'index')
        ->name('films.index');

    Route::get('films/{film}', 'show')
        ->name('films.show');
});

/**
 * Shopping Cart routes
 */
Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'index')
        ->name('cart.index');

    Route::post('cart', 'add')
        ->name('cart.add');

    Route::delete('cart/film/{film}', 'remove')
        ->name('cart.remove');
});


Route::get('receipts', [ReceiptController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('receipts.index');

Route::get('profile', [RegisteredUserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profile.index');

Route::get('users', [UserController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('users.index');

require __DIR__ . '/auth.php';
