<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\SessionMenu;
use Auth;   

class HomePageController extends Controller
{

    protected $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function homepage(Request $request) {

    	$sessionMenu = new SessionMenu();
    	$todaysMenu = $sessionMenu->getTodayMenu();
        $cart = collect();

        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
        }        
    	
    	return view('website.homepage',compact('todaysMenu','cart'));   
    }


    public function userDashboard(Request $request) {

        $userData = $this->userModel->getUserData(Auth::user()->id);
        $cart = collect();

        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
        }
    	return view('website.user-dashboard',compact('userData','cart'));
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
