<?php

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

//send data
Route::get('/product/aliexpress/{item}','ProductShowController@aliExpress')->name('product.aliexpress.item');
Route::get('/product/','ProductShowController@detectShop')->name('detect.shop');



Route::get('/', function () {
    return view('users.index');

});

//saving product to cart
Route::post('/product/cart','ProductShowController@saveProductToCart');

//car view
Route::get('/cart','CartController@cart')->name('product.cart');

//remove from cart
Route::post('remove/cart/{id}','CartController@remove')->name('cart.remove');

//checkout
Route::get('/checkout','CheckoutController@index')->name('checkout');
