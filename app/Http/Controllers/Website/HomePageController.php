<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function homepage(Request $request) {

    	return view('website.homepage');
    }

    public function userDashboard(Request $request) {

    	return view('website.user-dashboard');
    }

    public function checkout(Request $request) {

    	return view('website.checkout');
    }

    public function thankyou(Request $request) {

    	return view('website.thankyou');
    }

    public function trackOrder(Request $request) {

    	return view('website.track-order');
    }

    public function invoice(Request $request) {

    	return view('website.invoice');
    }
}
