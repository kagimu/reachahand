<?php

namespace App\Helpers;

use Carbon\Carbon;

class Utils{

	public function getCurrentDate(){

		$timestamp = Carbon::now('Africa/Kampala');

		// $day = $timestamp->locale('en')->isoFormat('ddd D MMM Y');
		$day = $timestamp->locale('en')->isoFormat('ddd, D MMM');
	  	$time = $timestamp->format('h:ia');

	  	return $day . ' ' . $time;
	}
}