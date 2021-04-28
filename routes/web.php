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
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\EcommerceController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.admin'], function() {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

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
