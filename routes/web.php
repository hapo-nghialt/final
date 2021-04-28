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

Route::get('/', function () {
    return view('ecommerce.home');
})->name('home');

Route::get('/detail', function () {
    return view('ecommerce.detail');
});

Route::get('/cart', function () {
    return view('ecommerce.cart');
})->name('user.cart');

Route::get('/about-us', function () {
    return view('ecommerce.about-us');
})->name('user.about-us');

Route::get('/shop', function () {
    return view('ecommerce.shop');
})->name('user.shop');

Route::get('/checkout', function () {
    return view('ecommerce.checkout');
})->name('user.checkout');

Route::get('/contact-us', function () {
    return view('ecommerce.contact-us');
})->name('user.contact-us');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
