<?php

	// function to change data-order to 'asc' / 'desc'
	function sortType() {

	   $sortType = request('sorttype');

	   if(!$sortType || $sortType=='asc') {
	       return 'desc';
	   } else {
	       return 'asc';
	   }
	}

	// get sorttype and sortfield
	function getSorting($sortfield='',$sorttype='') {

		$default_sortfield = 'created_at';
		$default_sorttype = 'desc';

		$sortfield = ($sortfield)?$sortfield:request('sortfield',$default_sortfield);
    	$sorttype = ($sorttype)?$sorttype:request('sorttype',$default_sorttype);

    	return [$sortfield,$sorttype];
	}

	// get pageLength
	function getPageLength() {

		$default = config('constant.default_page_length');

		return (int) request('pageLength',$default);
	}

	// load page length dropdown values
	function getPageLenthArr() {
		return config('constant.page_length_dropdown');
	}

	//
	function SELECT($left,$right) {
		
		if($left && $right && $left == $right) {
			return 'selected';
		} else {
			return '';
		}
	}

	// change checkbox on/off by boolean value from db
	function CHECKBOX($field,$status='') {


		$status = old($field,$status);

		return ($status || $status == 1)?'checked':'';

	}

	// load text for Status as 'Active/InActive' based on boolean value from db
	function STATUS($status) {
		$statusArr = config('constant.status');
		return isset($statusArr[$status])?$statusArr[$status]:'--';
	}

	function iSTATUS($status) {
		$statusArr = config('constant.status');

		if(isset($statusArr[$status]) && $status) {
			return '<div class="chip-wrapper">
                                    <div class="chip mb-0">
                                        <div class="chip-body">
                                            <span class="chip-text"><span class="bullet bullet-success bullet-xs"></span> '.$statusArr[$status].'</span>
                                        </div>
                                    </div>
                                </div>';
		}else if(isset($statusArr[$status]) && !$status) {
			return '<div class="chip-wrapper">
                                    <div class="chip mb-0">
                                        <div class="chip-body">
                                            <span class="chip-text"><span class="bullet bullet-danger bullet-xs"></span> '.$statusArr[$status].'</span>
                                        </div>
                                    </div>
                                </div>';
		}

		return '<div class="chip-wrapper">
                                    <div class="chip mb-0">
                                        <div class="chip-body">
                                            <span class="chip-text"><span class="bullet bullet-warning bullet-xs"></span>---</span>
                                        </div>
                                    </div>
                                </div>';
	}


	function SNO($loop) {
		$count = $loop->iteration;
		return _CURRENT+$loop->iteration;
	}


	function iteration($result) {
		define('_CURRENT',($result->perPage()*($result->currentPage()-1)));
	}

	function getConnection1()
	{
		$connection = env('DB_CONNECTION');
		return $connection;
	}
	function getConnection2()
	{
		$connection = env('DB_CONNECTION_SECOND');
		return $connection;
	}

	function getGender() {
		return config('constant.gender');
	}


	// load recurring dropdown values (refer "Compliances" master)
	function getRecurringArray() {
		return config('constant.recurring_adhoc_dropdown');
	}

	function OrganizationId() {
		return 1;
	}

	function getPaymentStatusArray() {
		return array_flip(config('constant.payment_status'));
	}

	function getPaymentModeArray() {
		return config('constant.payment_mode');
	}
