<?php

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

Route::namespace('App\Http\Livewire')->group(function () {
    //? Routes that can be accessed only when logging in
    Route::middleware(['verified'])->group(function () {
        //? Route for dashboard page
        Route::prefix('/dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {
            //? Route for admin dashboard page
            Route::prefix('/admin')->namespace('Admin')->middleware('role:admin')->name('admin.')->group(function () {
                //? Displays data statistics and to set up page about
                Route::get('/', Index::class)->name('index');

                //? To set gallery section
                Route::get('/galeries', Galery\Index::class)->name('galeries');

                //? To manage hotel facility data
                Route::prefix('/facilities')->namespace('Facility')->name('facilities.')->group(function () {
                    Route::get('/', Index::class)->name('index');
                    Route::get('/create', Create::class)->name('create');
                    Route::get('/{facility:code}/edit', Edit::class)->name('edit');
                });

                //? To manage hotel room data
                Route::prefix('/rooms')->namespace('Room')->name('rooms.')->group(function () {
                    Route::get('/', Index::class)->name('index');
                    Route::get('/create', Create::class)->name('create');
                    Route::get('/{room:code}/edit', Edit::class)->name('edit');
                });
            });

            //? Route for user dashboard page
            Route::prefix('/user')->namespace('User')->middleware('role:user')->name('user.')->group(function () {
                //? Displays data statistics
                Route::get('/', Index::class)->name('index');

                Route::prefix('/reservation')->namespace('Reservation')->name('reservations.')->group(function () {
                    Route::get('/', Index::class)->name('index');
                });
            });
        });
    });

    //? Routes that can be accessed by logging in or without logging in
    Route::get('/', Index::class)->name('index');
    Route::get('/about', About::class)->name('about');

    Route::prefix('/facilities')->namespace('Facility')->name('facilities.')->group(function () {
        Route::get('/{facility:code}', Index::class)->name('index');
    });

    Route::prefix('/rooms')->namespace('Room')->name('rooms.')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/{room:code}', Show::class)->name('show');
    });
});

require __DIR__ . '/auth.php';
