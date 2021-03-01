<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\SessionMenu;

class DashboardController extends Controller
{
    public function dashboard(){    

    	$totalOrderCount = Order::count();
    	$todayOrderCount = Order::where('order_date',today())->count();    	
    	$activeCustomerCount = User::where('user_type_id',2)->where('status',1)->count();
    	$todayOrderAmount = Order::where('order_date',today())->sum('total_amount');
    	$todayRecievedOrderAmount = Order::where('order_date',today())->has('payment')->sum('total_amount');
    	$todayPendingOrderAmount = Order::where('order_date',today())->doesnthave('payment')->sum('total_amount');
    	$activeMenusNow = SessionMenu::where('opening_time','<=',now())
                    					->where('closing_time','>=',now()
                    					->addHours(2))  
                    					->count();
    	

    	return view('admin.dashboard',compact('totalOrderCount','todayOrderCount','todayOrderAmount','activeCustomerCount','todayRecievedOrderAmount','todayPendingOrderAmount','activeMenusNow'));
    }
}
