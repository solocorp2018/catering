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

	Route::get('/payments','Admin\PaymentController@index')->name('payments.index');
	Route::get('/payments/{id}','Admin\PaymentController@show')->name('payments.show');
	Route::get('/payments-export','Admin\PaymentController@export')->name('payments.export');

	Route::post('/paymentUpdateStatus/{id}','Admin\OrderController@updateStatus')->name('payment.updateStatus');

	Route::post('/updateAddress/{id}','Admin\UserController@updateAddress')->name('users.updateAddress');

	Route::get('/leads','Admin\LeadController@index')->name('leads.index');
	Route::get('/leads/{id}','Admin\LeadController@show')->name('leads.show');

	Route::resource('/sessionMenus','Admin\MenuController');

	Route::post('/clone/{id}','Admin\MenuController@cloneSession')->name('sessionMenus.clone');
});
