<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Include all routes that should log out a logged user when they are blocked
Route::middleware('block')->group(
    function () {
        // TODO: temp
        Route::get('/dashboard', function () {
            return view('dashboard');
        })
            ->middleware(['auth', 'verified'])
            ->name('dashboard');
        // TODO

        Route::get('/', function () {
            return view('home');
        });

        /**
         * User routes
         */
        Route::get('profile', [RegisteredUserController::class, 'index'])
            ->middleware(['auth', 'verified'])
            ->name('profile.index');

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
         * Screening routes
         */
        Route::controller(ScreeningController::class)->group(function () {
            Route::get('screening/{screening}', 'show')
                ->name('screenings.show');
            //TODO: ->middleware('can:buy,screening');
        });

        /**
         * Receipt routes
         */
        Route::controller(ReceiptController::class)->middleware(['auth', 'verified'])->group(function () {
            Route::get('receipts', 'index')
                ->name('receipts.index');

            Route::get('receipts/{receipt}', 'show')
                ->name('receipts.show');

            Route::get('receipts/{receipt}/pdf', 'get_pdf')
                ->name('receipts.get_pdf');
        });

        /**
         * Ticket routes
         */
        Route::controller(TicketController::class)->group(function () {
            Route::get('tickets', 'index')
                ->name('tickets.index');

            Route::get('tickets/{ticket}', 'show')
                ->name('tickets.show');

            Route::get('tickets/{ticket}/pdf', 'get_pdf')
                ->name('tickets.get_pdf');

            Route::post('cart', 'store')
                ->name('tickets.store')
                ->middleware('can:buy,screening');

            // TODO: temp?
            Route::post('email/mailable', 'send_email_with_mailable')
                ->name('email.send_with_mailable');
        });

        /**
         * Shopping Cart routes
         */
        Route::controller(CartController::class)->middleware('client')->group(function () {
            Route::get('cart', 'index')
                ->name('cart.index');

            Route::post('screening/{screening}/{seat}', 'store')
                ->name('cart.store');
            // TODO: ->middleware('can:buy,screening');

            Route::delete('cart/{key}', 'destroy')
                ->name('cart.destroy');
        });

        /**
         * Admin routes
         */
        Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

            Route::controller(UserController::class)->group(function () {
                Route::get('users', 'index')
                    ->name('users.index')
                    ->middleware('can:viewAny,App\Models\User');

                Route::get('users/{user}/view', 'show')
                    ->name('users.show')
                    ->middleware('can:view,user');

                Route::get('users/{user}/edit', 'edit')
                    ->name('users.edit')
                    ->middleware('can:update,user');

                Route::put('users/{user}', 'update')
                    ->name('users.update')
                    ->middleware('can:update,user');

                Route::delete('users/{user}', 'destroy')
                    ->name('users.destroy')
                    ->middleware('can:delete,user');

                Route::put('users/{user}/toggleblock', 'toggleblock')
                    ->name('users.toggleblock')
                    ->middleware('can:block,user');

                Route::get('users/create', 'create')
                    ->name('users.create')
                    ->middleware('can:create,App\Models\User');

                Route::post('users/create', 'store')
                    ->name('users.store')
                    ->middleware('can:create,App\Models\User');
            });

            Route::get('screen', [ScreenController::class, 'index'])
                ->name('screen.index')->middleware('can:viewAny,App\Models\Screen');

            Route::get('config', [ConfigurationController::class, 'index'])
                ->name('config.index');

            Route::put('config', [ConfigurationController::class, 'update'])
                ->name('config.update');
        });
    }
);

require __DIR__ . '/auth.php';
