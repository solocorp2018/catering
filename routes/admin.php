<?php

Auth::routes();

Route::get('/orderInvoice/{id}','Admin\OrderController@invoiceDownload')->name('order.invoice');

Route::middleware(['admin'])->group(function () {
	Route::get('/dashboard','Admin\DashboardController@dashboard')->name('admin.dashboard');

	Route::get('/change-password','Admin\PasswordController@managePassword')->name('password.manage');
	Route::post('/update-password','Admin\PasswordController@updatePassword')->name('password.update');

	Route::post('/bulk-invoice-download','Admin\OrderController@bulkInvoiceDownload')->name('order.bulk-invoice');
	Route::post('send-invitation','Admin\UserController@sendInvitation');


	Route::resource('/items','Admin\ItemController');
	Route::post('/pick-item-detail','Admin\ItemController@getItemDetail');

	Route::resource('/complimentaries','Admin\ComplimentaryController');

	Route::resource('/customers','Admin\UserController');
	Route::get('/customers-export','Admin\UserController@export')->name('customers.export');

	Route::resource('/orders','Admin\OrderController');
	Route::get('/orders-export','Admin\OrderController@export')->name('orders.export');

	Route::get('/payments','Admin\PaymentController@index')->name('payments.index');
	Route::get('/payments/{id}','Admin\PaymentController@show')->name('payments.show');
	Route::get('/payments-export','Admin\PaymentController@export')->name('payments.export');
	Route::get('/paymentInvoice/{id}','Admin\PaymentController@paymentInvoice')->name('payments.invoice');

	Route::post('/paymentUpdateStatus/{id}','Admin\OrderController@updateStatus')->name('payment.updateStatus');
	Route::post('/update-payment-status','Admin\OrderController@updatePaymentStatuses');

	Route::post('/updateAddress/{id}','Admin\UserController@updateAddress')->name('users.updateAddress');

	Route::resource('/sessionMenus','Admin\MenuController');
	Route::get('/send-notification/{id}','Admin\MenuController@sendNotification');

	Route::post('/clone/{id}','Admin\MenuController@cloneSession')->name('sessionMenus.clone');
});
