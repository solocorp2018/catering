<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('trigger-otp','Auth\LoginController@triggerOtp');
Route::post('validate-otp','Auth\LoginController@validateOtp');
Route::post('register-user','Auth\RegisterController@registerUser');
// Route::post('login','Auth\LoginController@login');
