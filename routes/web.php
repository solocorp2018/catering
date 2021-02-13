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


Route::get('/','Website\HomePageController@homepage');
Route::get('/checkout','Website\HomePageController@checkout');
Route::get('/thankyou/{orderUniqueId}','Website\HomePageController@thankyou');
Route::get('/track-order/{orderUniqueId}','Website\HomePageController@trackOrder');
Route::post('/update-cart','Website\CartController@updateToCart');
Route::post('/update-cart','Website\CartController@updateToCart');
Route::post('/refresh-cart','Website\CartController@refreshCart');
Route::post('/add-address','Website\HomePageController@addAddress')->name('add.address');
Route::get('/delete-address/{id}','Website\HomePageController@deleteAddress')->name('delete.address');
Route::post('/place/order','Website\HomePageController@placeOrder')->name('place.order');

Route::post('customer/login','Auth\LoginController@customerLogin');
Route::get('/user-dashboard','Website\HomePageController@userDashboard');
Route::get('/invoice','Website\HomePageController@invoice');

Route::post('trigger-otp','Auth\LoginController@triggerOtp');
Route::post('validate-otp','Auth\LoginController@validateOtp');
Route::post('register-user','Auth\RegisterController@registerUser'); 
Route::post('login','Auth\LoginController@login')->name('login');


