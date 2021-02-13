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

		$time = Carbon::parse($time);
		// if ((is_string($time))) {
		// 	$time = \Carbon\Carbon::createFromFormat('Y-m-d', $time);
		// }
		
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

	function Time24to12($time){
		$time = Carbon::parse($time);
		return $time->format('g:i A');
	}

	function Time12to24($time,$format="H:i"){
		$time = Carbon::parse($time);
		return $time->format($format);
	}

	function convertTimeFormat($time,$format="g:i a") {

		$time = Carbon::parse($time);
		return $time->format($format);	
	}

	function isPastTime($time) {

		$givenTime = Time12to24($time);
		$currentTime = Time12to24(now());
		
		if($currentTime < $givenTime) {
			return false;
		}

		return true;
	}

	function isOpenForOrder($opening,$closing) {

		$currentTime = Time12to24(now());
		$opening = Time12to24($opening);
		$closing = Time12to24($closing);

		if($opening <= $currentTime && $closing >= $currentTime) {
			return 1; //open
		}

		if($opening > $currentTime) {
			return 2; //next
		}

		if($closing < $currentTime) {
			return 0; //closed
		}

		return 3;
	}

	function seconds_from_time($time) {
		list($h, $m, $s) = explode(':', $time);
		return ($h * 3600) + ($m * 60) + $s;
	}




