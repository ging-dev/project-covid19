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
    ->prefix('login')
    ->group(function () {
        Route::get('/', 'index')
            ->name('auth.login');
        Route::get('logout', 'logout')
            ->name('auth.logout');
        Route::post('callback', 'callback')
            ->name('auth.callback');
    });
