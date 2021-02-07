<?php

Auth::routes();

Route::middleware(['admin'])->group(function () {
	Route::get('/dashboard','Admin\DashboardController@dashboard')->name('admin.dashboard');

	Route::get('/change-password','Admin\PasswordController@managePassword')->name('password.manage');
	Route::post('/update-password','Admin\PasswordController@updatePassword')->name('password.update');


	Route::resource('/items','Admin\ItemController');

	Route::resource('/complimentaries','Admin\ComplimentaryController');

	Route::resource('/customers','Admin\UserController');

	Route::get('/payments','Admin\PaymentController@index')->name('payments.index');
	Route::get('/payments/{id}','Admin\PaymentController@show')->name('payments.show');

	Route::post('/updateAddress/{id}','Admin\UserController@updateAddress')->name('users.updateAddress');

	Route::get('/leads','Admin\LeadController@index')->name('leads.index');
	Route::get('/leads/{id}','Admin\LeadController@show')->name('leads.show');

	Route::resource('/sessionMenus','Admin\MenuController');

	Route::post('/updateItems/{id}','Admin\MenuController@updateItems')->name('sessionMenus.updateItems');
});
