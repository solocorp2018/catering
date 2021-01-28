<?php
use Illuminate\Support\Str;
use Carbon\Carbon;	
	
	function dateOf($date) {

		$carbonDate = new Carbon($date);
     $carbonDate->timezone = 'Asia/Kolkata';
     return $carbonDate->toDayDateTimeString();
	}
	function showDate($time, $date_time_format='', $timezone='') {
		if(!$time) {
			return '--';
		}

		$timezone = ($timezone)?$timezone:config('constant.custom_timezone');

		if ((is_string($time))) {
			$time = \Carbon\Carbon::createFromFormat('Y-m-d', $time);
		}
		
		$time = $time->setTimezone($timezone);

		$date_time_format = ($date_time_format)?$date_time_format:config('constant.view_date_time_format');

        $custom_date_time = $time->format($date_time_format);

		return $custom_date_time;
	}

	function stringLength($string, $length = ''){

		$stringLimited = Str::limit($string,($length)?$length:config('constant.default_string_length'), '...');
		
        return $stringLimited;
	}

	function slugger($string,$glue='') {

		$glue = ($glue)?$glue:'-';

		return Str::slug($string,$glue);
	}


	function pageTitle($title) {
		return trans($title);
	}

	function saltFileName($filename) {

		/*this function will added the current time within the filename*/

		$filename_exploded = explode('.', $filename);

		return time().'_'.Str::slug($filename_exploded[0], '_').'.'.$filename_exploded[1];				
	}


	function checkAjax() {

		if(!request()->ajax()) {

			echo 'Bad Request.';
			exit;

		}
		return true;
	}

	function _status($status){
		return ($status == 1 || $status == true)?'Active':'False';
	}






