<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\\Http\\Controllers\\API'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
    Route::post('verify', 'VerifyController@activate');

    Route::get('category/{parent_id?}', 'CategoryController@get');
    Route::get('city/{district_id?}', 'CityController@get');
    Route::get('color', 'ColorController');
    Route::get('size', 'SizeController');
    Route::get('model', 'ModelController');
    Route::get('filter_lookup', 'ProductController@filter_lookup');
    Route::post('products', 'ProductController@getAllProducts');
    Route::get('product/{id}', 'ProductController@show');

    Route::get('setting', 'SettingController@index');
    Route::get('about_us', 'AboutController@index');

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('user/profile', 'ProfileController@show');
        Route::post('user/update_profile', 'ProfileController@update');

        Route::get('user/addresses', 'AddressController@get');
        Route::post('user/address/store', 'AddressController@store');
        Route::get('user/address/show/{id}', 'AddressController@show');
        Route::post('user/address/update/{id}', 'AddressController@update');
        Route::get('user/address/destroy/{id}', 'AddressController@destroy');

        Route::get('user/favourites', 'FavouriteController@get');
        Route::post('user/favourites/store', 'FavouriteController@store');
        Route::get('user/favourites/destroy/{product_id}', 'FavouriteController@destroy');

        Route::post('basket/store', 'BasketController@store');
        Route::get('basket/show', 'BasketController@getAll');
        Route::get('basket/update_qty/{id}/{quantity}', 'BasketController@updateQty');
        Route::get('basket/destroy/{id}', 'BasketController@destroy');
        Route::get('basket/destroyAll', 'BasketController@destroyAll');

        Route::post('check_coupon', 'CouponController@check_coupon');

        Route::post('order', 'OrderController@order');
        Route::get('myOrders', 'OrderController@my_orders');
        Route::get('order_details/{id}', 'OrderController@order_details');

        Route::post('product_rate', 'ProductController@rate');
        Route::get('product_favourite/{product_id}', 'ProductController@isFavourite');

        Route::post('contact_us', 'ContactUsController@store');
    });
    Route::get('product_search/{filter}', 'ProductController@search');
});
