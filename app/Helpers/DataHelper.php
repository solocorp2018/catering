<?php

function intakeYear() {
	return [
		2019,2020,2021,2022,2023,2024,2025
	];
}


function paymentStatuses() {

	return [
		['id' => 1, 'name'=>'Pending'],
		['id' => 2, 'name'=>'Paid'],	
	];
}


function findPaymentStatus($id) {

	$statusArr = paymentStatuses();		
	return collect($statusArr)->where('id',$id)->first()['name'] ?? '';
}

function orderStatuses() {
	return [
		['id' => 1, 'name'=>'Placed'],
		['id' => 2, 'name'=>'Confirmed'],	
		['id' => 3, 'name'=>'Packed & Dispatched'],	
		['id' => 4, 'name'=>'Delivered'],	
		['id' => 5, 'name'=>'Cancelled'],	
	];
}

function findOrderStatus($id) {
	$statusArr = orderStatuses();
	return collect($statusArr)->where('id',$id)->first()['name'] ?? '';
}


function paymentModes() {

	return [
		['id' => 1, 'name'=>'Gpay'],
		['id' => 2, 'name'=>'Phonepay'],	
		['id' => 3, 'name'=>'Account Transfer'],	
		['id' => 4, 'name'=>'Cash'],	
	];
}


function findPaymentMode($id) {
	$paymentModeArr = paymentModes();
	return collect($paymentModeArr)->where('id',$id)->first()['name'] ?? '';
}
