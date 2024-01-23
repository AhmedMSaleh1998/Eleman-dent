<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers\Admin' , 'middleware' => 'auth:web'], function () {
    Route::group(['as' => 'admin.'], function () {
        Route::resource('banner', 'BannerController');
        Route::resource('brand', 'BrandController');
        Route::resource('category', 'CategoryController');
        Route::resource('product', 'ProductController');
        Route::resource('event', 'EventController');
        Route::resource('color', 'ColorController');
        Route::resource('city', 'CityController');
        Route::resource('setting', 'SettingController');
        Route::resource('paymentmethod', 'PaymentMethodController');
        Route::resource('coupon', 'CouponController');
        Route::resource('contact', 'ContactController');
        Route::resource('about', 'AboutController');
        Route::resource('couponuser', 'CouponUserController');
        Route::resource('user', 'UserController');
        Route::resource('order', 'OrderController');
        Route::resource('cartitem', 'CartItemController');
        Route::resource('productcolor', 'ProductColorController');
        Route::resource('relatedproducts', 'RelatedProductsController');
        Route::resource('smsreminder', 'SmsReminderController');
        Route::resource('type', 'TypeController');
        Route::resource('producttype', 'ProductTypeController');
        Route::resource('delivertime', 'DeliverTimeController');
        /**
         * Global Status Change
         */
        Route::get('status/{status}/{db}/{id}', 'ChangeStatusController@status')->name('changeStatus');
        /**
         * End
         */

        /**
         * Product Images Routes
         */
        Route::get('product/{product_id}/productimages', 'ProductImageController@index')->name('productimage.index');
        Route::get('product/{product_id}/productimage/create', 'ProductImageController@create')->name('productimage.create');
        Route::post('productimage/store', 'ProductImageController@store')->name('productimage.store');
        Route::get('productimage/{product_id}/edit', 'ProductImageController@edit')->name('productimage.edit');
        Route::put('productimage/{product_id}/update', 'ProductImageController@update')->name('productimage.update');
        Route::delete('productimage/{image_id}/delete', 'ProductImageController@destroy')->name('productimage.destroy');
        /**
         * END
         */
        /**
         * User Addresses Routes
         */
        Route::get('user/{product_id}/Addresses', 'AddressController@index')->name('address.index');
        Route::get('user/{product_id}/Addresses/create', 'AddressController@create')->name('address.create');
        Route::post('Address/store', 'AddressController@store')->name('address.store');
        Route::get('Address/shoe/{address_id}', 'AddressController@show')->name('address.show');
        Route::get('Address/{product_id}/edit', 'AddressController@edit')->name('address.edit');
        Route::put('Address/{product_id}/update', 'AddressController@update')->name('address.update');
        Route::delete('Address/{image_id}/destroy', 'AddressController@destroy')->name('address.destroy');
        /**
         * END
         */
        /**
         * Product Images Routes
         */
        Route::get('product/{product_id}/productsizes', 'ProductSizeController@index')->name('productsize.index');
        Route::get('product/{product_id}/productsize/create', 'ProductSizeController@create')->name('productsize.create');
        Route::post('productsize/store', 'ProductSizeController@store')->name('productsize.store');
        Route::get('productsize/{product_id}/edit', 'ProductSizeController@edit')->name('productsize.edit');
        Route::put('productsize/{product_id}/update', 'ProductSizeController@update')->name('productsize.update');
        Route::delete('productsize/{size_id}/delete', 'ProductSizeController@destroy')->name('productsize.destroy');
        /**
         * END
         */
        /**
         * Change Order Status
         */
        Route::get('order/status/{order_id}/{status}', 'OrderController@updateStatus')->name('order.status');
        Route::get('home', 'HomeController@index')->name('home');

        /**
         * End
         **/
    });

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   
});

Auth::routes();


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
