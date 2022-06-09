<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('films', [FilmController::class, 'index'])
    ->name('films.index');

Route::get('films/{film}', [FilmController::class, 'show'])
    ->name('films.show');

Route::get('cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('film/{film}', [CartController::class, 'add'])
    ->name('cart.add');

Route::delete('cart/film/{film}', [CartController::class, 'remove'])
    ->name('cart.remove');

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
