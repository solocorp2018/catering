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
	return collect($statusArr)->where('id',$id)->name ?? '';
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
	return collect($statusArr)->where('id',$id)->name ?? '';
}