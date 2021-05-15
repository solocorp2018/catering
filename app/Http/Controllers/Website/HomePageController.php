<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\SessionMenu;
use App\Models\UserAddress;
use App\Models\Order;
use Auth;   

use App\Services\TextLocalSmsGateway;

class HomePageController extends Controller
{

    protected $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function homepage(Request $request) {

    	$sessionMenu = new SessionMenu();
    	$todaysMenu = $sessionMenu->getTodayMenu();
        
        
        $cart = $userData = collect();
        if(Auth::user()){
            $userData = $this->userModel->getUserData(Auth::user()->id);                
            $cart = Cart::getCurrentUserCart();
        }        
    	
    	return view('website.homepage',compact('todaysMenu','cart','userData'));   
    }

     public function createAccount() {

        $sessionMenu = new SessionMenu();
        $todaysMenu = $sessionMenu->getTodayMenu();       
        
        $cart = $userData = collect();
        if(Auth::user()){
            $userData = $this->userModel->getUserData(Auth::user()->id);                
            $cart = Cart::getCurrentUserCart();
        }        
        
        session()->flash('create-account','Account Creation Temp Session');
        
        return view('website.homepage',compact('todaysMenu','cart','userData'));   
    }

    public function userDashboard(Request $request) {

        $userData = $this->userModel->getUserData(Auth::user()->id);
        $cart = collect();
        $userOrders = collect();

        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
            $userOrders = User::currentUserOrder();
        }
    	return view('website.user-dashboard',compact('userData','cart','userOrders'));
    }

    public function checkout(Request $request) {

        $userData = $this->userModel->getUserData(Auth::user()->id);                

        $cart = Cart::getCurrentUserCart();
        
    	return view('website.checkout',compact('cart','userData'));
    }

    
    public function addAddress(Request $request) {

        
        $rules = [            
            'address_line_1' => 'required|min:2|max:100',
            'address_line_2' => 'sometimes|min:2|max:100',
            'city' => 'required|min:2|max:50',
            'pincode' => 'required|min:5|max:8'
        ];
        $this->validate($request,$rules);

        $userAddressData = [
            'user_id' => Auth::user()->id,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'pincode' => $request->pincode,
            'state_id' => 1,
            'country_id' => 1,
            'is_current' => _inactive(),
            'created_by'=> Auth::user()->id,
            'status' => _active(),
        ];

        UserAddress::create($userAddressData);

        updatedResponse("New Address Added Successfully !");

        return redirect()->back();
    }

    public function placeOrder(Request $request) {       

        $rules = [            
            'delivery_address_id' => 'required|integer',
            'payment_method' => 'required|integer'
        ];
        $this->validate($request,$rules);        

        $order = new Order();

        $orderUniqueId = $order->placeOrder($request->delivery_address_id,$request->payment_method);

        $mobileNumber = Auth::user()->contact_number;

        $message = "Thank you for placing order with M R Grandson Caters, your order will be processed soon.";

        if($mobileNumber) {
        	TextLocalSmsGateway::sendSms($mobileNumber,$message);	
        }        
        
        updatedResponse("Order Placed Successfully !");

        return redirect('thankyou/'.$orderUniqueId);   
    }

    public function thankyou($orderUniqueId) {

        $cart = collect();
        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
        }        
    	return view('website.thankyou',compact('cart','orderUniqueId'));
    }

    public function trackOrder($orderUniqueId) {

        $cart = collect();
        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
        }        

        $order = new Order();

        $orderData= $order->getOrderData($orderUniqueId);        

    	return view('website.track-order',compact('cart','orderUniqueId','orderData'));
    }   

    public function invoice(Request $request) {
        $cart = collect();
        if(Auth::user()){
            $cart = Cart::getCurrentUserCart();
        }        
    	return view('website.invoice',compact('cart'));
    }
}
