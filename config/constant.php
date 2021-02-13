<?php
return [


	'status' => [
		0 => 'InActive',
		1 => 'Active',
	],

	'file_storage_disk' => 'catering',

	"page_length_dropdown" => [
			10 => 10,
			25 => 25,
			50 => 50,
			100 => 100,
	],
	"constant_page_length" => 10,

	'default_page_length' => 10,

	//length to show the column text in list page. this will use in string lenght helpers
	'default_string_length' => 20,

	'gender' => [
		1 => 'Male',
		2 => 'Female',
		3 => 'Others',
	],

	'user_type' => [
		1 => 'admin',
		2 => 'user'
	],

	'payment_mode' => [
		1 => 'Cash',
		2 => 'Credit Card',
		3 => 'Debit Card'
	],

	'payment_status' => [
		1 => 'Paid',
		2 => 'Pending'
	]

];
