<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScreenController;
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

    Route::post('cart/screenings/{screening}', 'store')
        ->name('cart.store');

    Route::delete('cart/screenings/{screening}', 'destroy')
        ->name('cart.destroy');
});

Route::get('receipts', [ReceiptController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('receipts.index');

/* User routes */
Route::get('profile', [RegisteredUserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profile.index');

/**
 * Admin routes
 */
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('users', [UserController::class, 'index'])
        ->name('users.index')->middleware('can:viewAny,App\Models\User');

    Route::get('users/{user}/view', [UserController::class, 'show'])
        ->name('users.show')->middleware('can:view,user');

    Route::get('users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')->middleware('can:update,user');

    Route::put('users/{user}', [UserController::class, 'update'])
        ->name('users.update')->middleware('can:update,user');

    Route::delete('users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')->middleware('can:delete,user');

    Route::put('users/{user}/toggleblock', [UserController::class, 'toggleblock'])
        ->name('users.toggleblock')->middleware('can:block,user');

    Route::get('users/create', [UserController::class, 'create'])
        ->name('users.create')->middleware('can:create,App\Models\User');

    Route::post('users/create', [UserController::class, 'store'])
        ->name('users.store')->middleware('can:create,App\Models\User');

    Route::get('screen', [ScreenController::class, 'index'])
        ->name('screen.index')->middleware('can:viewAny,App\Models\Screen');
});

require __DIR__ . '/auth.php';
