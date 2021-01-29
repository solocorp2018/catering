<?php

Auth::routes();

Route::middleware(['admin'])->group(function () {
	Route::get('/dashboard','Admin\DashboardController@dashboard')->name('admin.dashboard');

	Route::get('/change-password','Admin\PasswordController@managePassword')->name('password.manage');
	Route::post('/update-password','Admin\PasswordController@updatePassword')->name('password.update');

	Route::resource('/items','Admin\ItemController');

	Route::resource('/complimentary','Admin\ComplimentaryController');

	Route::get('/leads','Admin\LeadController@index')->name('leads.index');
	Route::get('/leads/{id}','Admin\LeadController@show')->name('leads.show');
});
