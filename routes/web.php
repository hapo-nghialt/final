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
\Illuminate\Support\Facades\Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\EcommerceController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.admin'], function() {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('home');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::patch('/products/update-status/{id}', [App\Http\Controllers\Admin\ProductController::class, 'updateStatus'])->name('products.update-status');
});
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('orders', App\Http\Controllers\OrderController::class);
Route::get('/cart', [App\Http\Controllers\UserController::class, 'showCart'])->name('users.show-cart');
Route::post('/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
Route::delete('/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');

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
