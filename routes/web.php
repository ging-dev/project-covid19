<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::controller(AuthController::class)
    ->prefix('auth')
    ->group(function () {
        Route::middleware('guest')
            ->group(function () {
                Route::get('login', 'index')
                    ->name('auth.login');
                Route::post('callback', 'callback')
                    ->name('auth.callback');
            });

        Route::middleware('auth')
            ->get('logout', 'logout')
            ->name('auth.logout');
    });
