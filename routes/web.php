<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/', [
    'uses' => 'App\Http\Controllers\ProductController@getIndex',
    'as' => 'product.index'
]);

Route::get('/add-to-cart/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@getAddToCart',
    'as' => 'product.addToCart'
]);

Route::get('/shopping-cart', [
    'uses' => 'App\Http\Controllers\ProductController@getCart',
    'as' => 'product.shoppingCart'
]);

Route::get('/reduce/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@getReduceByOne',
    'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}', [
    'uses' => 'App\Http\Controllers\ProductController@getRemoveItem',
    'as' => 'product.remove'
]);

Route::get('/moncash/checkout', [
    'uses' => 'App\Http\Controllers\MoncashController@getCheckoutByMoncash',
    'as' => 'moncash.checkout',
    'middleware' => 'auth'
]);
Route::post('/moncash/checkout', [
    'uses' => 'App\Http\Controllers\MoncashController@postCheckoutByMoncash',
    'as' => 'moncash.checkout',
    'middleware' => 'auth'
]);

Route::get('/moncash/payment/details', [
    'uses' => 'App\Http\Controllers\MoncashController@getPaymentDetails',
    'as' => 'moncash.payment.details',
    'middleware' => 'auth'
]);

Route::get('/stripe/checkout', [
    'uses' => 'App\Http\Controllers\ProductController@getCheckoutByStripe',
    'as' => 'stripe.checkout',
    'middleware' => 'auth'
]);
Route::post('/stripe/checkout', [
    'uses' => 'App\Http\Controllers\ProductController@postCheckoutByStripe',
    'as' => 'stripe.checkout',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'user'], function() {
    Route::group(['middleware' => 'guest'], function() {
        Route::get('/signup', [
            'uses' => 'App\Http\Controllers\UserController@getSignup',
            'as' => 'user.signup'
        ]);

        Route::post('/signup', [
            'uses' => 'App\Http\Controllers\UserController@postSignup',
            'as' => 'user.signup'
        ]);

        Route::get('/signin', [
            'uses' => 'App\Http\Controllers\UserController@getSignin',
            'as' => 'user.signin'
        ]);

        Route::post('/signin', [
            'uses' => 'App\Http\Controllers\UserController@postSignin',
            'as' => 'user.signin'
        ]);
    });

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/profile', [
            'uses' => 'App\Http\Controllers\UserController@getProfile',
            'as' => 'user.profile'
        ]);

        Route::get('/logout', [
            'uses' => 'App\Http\Controllers\UserController@getLogout',
            'as' => 'user.logout'
        ]);
    });
});
