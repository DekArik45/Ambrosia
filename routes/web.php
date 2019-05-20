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

// Route::get('/home', function () {
//     return view('layouts.app');
// });

Auth::routes();

Route::get('/','Frontend\HomeController@index')->name('customer.home');
Route::get('/home','Frontend\HomeController@index')->name('customer.home');
Route::get('/menu','Frontend\MenuController@index');
Route::get('/about','Frontend\AboutController@index');

Route::get('/cart','Frontend\CartController@cart');
Route::post('/add_item','Frontend\CartController@addItem');
Route::get('/get_item','Frontend\CartController@getItem');
Route::get('/delete_item/{id}','Frontend\CartController@deleteItem');

Route::get('/product/{id}','Frontend\ProductController@product');

Route::get('/checkout','Frontend\CheckoutController@checkout');
Route::post('/checkedout','Frontend\CheckoutController@checkedout');
Route::post('/shipping','Frontend\CheckoutController@shipping');

Route::get('/profile','Frontend\ProfileController@index');
Route::put('/upload_bukti/{id}','Frontend\ProfileController@uploadBukti');

Route::get('/review/{id}','Frontend\ProductReviewController@productReview');
Route::post('/review','Frontend\ProductReviewController@store');

Route::prefix('customer')->group(function() {
    Route::get('/login', 'Auth\CustomerLoginController@showLoginForm')->name('customer.login');
    Route::post('/login', 'Auth\CustomerLoginController@login')->name('customer.login.submit');
    Route::get('/logout', 'Auth\CustomerLoginController@logout')->name('customer.logout');
    Route::get('/','Frontend\HomeController@index')->name('customer.home');
    // Route::get('/dashboard', function () {
    //     return view('layouts.app');
    // });
});


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/register', 'Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@create')->name('admin.register.submit');

    Route::get('/', 'Backend\AdminController@index')->name('admin.home');
    
    Route::get('/transaksi','Backend\TransaksiController@index');
    Route::put('/transaksi/{id}','Backend\TransaksiController@updateStatus');

    //crud
    Route::resource('/product','Backend\ProductController');
    Route::resource('/courier','Backend\CourierController');
    Route::resource('/product_category','Backend\ProductCategoryController');
    Route::resource('/discount','Backend\DiscountController');

    //delete image
    Route::get('/delete-image/{id}','Backend\ProductController@deleteImage');

    //delete category
    Route::get('/delete-category/{id}','Backend\ProductController@deleteCategory');

    //add image
    Route::put('/input-image/{id}','Backend\ProductController@inputImage');

    //add category
    Route::put('/input-category/{id}','Backend\ProductController@inputCategory');

    //response
    Route::get('/response','Backend\ResponseController@index');
    Route::get('/detail-response/{id}','Backend\ResponseController@showDetail');
    Route::post('/response','Backend\ResponseController@store');
    Route::get('/detail-already-response/{id}','Backend\ResponseController@showAlreadyResponse');
});

