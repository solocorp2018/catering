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
Route::get('/thankyou','Website\HomePageController@thankyou');
Route::get('/track-order','Website\HomePageController@trackOrder');

Route::post('customer/login','Auth\LoginController@customerLogin');
Route::get('/user-dashboard','Website\HomePageController@userDashboard');
Route::get('/invoice','Website\HomePageController@invoice');

