<?php

use App\Http\Controllers\CartController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(['prefix' => 'cart'], function () {
    Route::get('addToCart/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::get('increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::get('decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::get('remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('removeCart', [CartController::class, 'removeCart'])->name('cart.removeCart');
    Route::get('test', function () {
        return 'test';
    });
});
