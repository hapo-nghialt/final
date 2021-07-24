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
Route::resource('orders', App\Http\Controllers\OrderController::class)->middleware('auth.user');
Route::resource('messages', App\Http\Controllers\MessageController::class)->middleware('auth.user');
Route::post('/message', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('send-message');
Route::get('/cart', [App\Http\Controllers\UserController::class, 'showCart'])->middleware('auth.user')->name('users.show-cart');
Route::get('/{id}/orders', [App\Http\Controllers\UserController::class, 'manageOrders'])->middleware('auth.user')->name('users.manage-orders');
Route::post('/follow', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
Route::delete('/unfollow', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'showProduct'])->name('show-products');
Route::get('/all-products', [App\Http\Controllers\EcommerceController::class, 'seeAllProducts'])->name('see-all-products');
Route::get('/search-product', [App\Http\Controllers\ProductController::class, 'searchProduct'])->name('search-product');
Route::post('/follow-product', [App\Http\Controllers\UserController::class, 'followProduct'])->name('user.follow-product');
Route::post('/buy-product', [App\Http\Controllers\UserController::class, 'buyProduct'])->name('user.buy-product');
Route::resource('notifications', App\Http\Controllers\NotificationController::class);
Route::post('/category/{id}', [App\Http\Controllers\ProductController::class, 'filterProduct'])->name('filter-product');
Route::post('/all-products', [App\Http\Controllers\EcommerceController::class, 'filterProductAll'])->name('filter-product-all');
Route::get('/cart-empty', function () {
    return view('ecommerce.cart-empty');
})->name('user.cart-empty');
