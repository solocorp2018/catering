<?php

Auth::routes();

Route::middleware(['admin'])->group(function () {
	Route::get('/dashboard','Admin\DashboardController@dashboard')->name('admin.dashboard');

	Route::get('/change-password','Admin\PasswordController@managePassword')->name('password.manage');
	Route::post('/update-password','Admin\PasswordController@updatePassword')->name('password.update');


	Route::resource('/items','Admin\ItemController');

	Route::resource('/complimentaries','Admin\ComplimentaryController');

	Route::resource('/customers','Admin\UserController');
	Route::get('/customers-export','Admin\UserController@export')->name('customers.export');

	Route::resource('/orders','Admin\OrderController');
	Route::get('/orders-export','Admin\OrderController@export')->name('orders.export');
	
	Route::resource('/payments','Admin\PaymentController');
	Route::get('/payments-export','Admin\PaymentController@export')->name('payments.export');


	Route::get('/leads','Admin\LeadController@index')->name('leads.index');
	Route::get('/leads/{id}','Admin\LeadController@show')->name('leads.show');
});
