<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){    

    	$totalOrderCount = Order::count();
    	$todayOrderCount = Order::where('order_date',today())->count();
    	$todayOrderAmount = Order::where('order_date',today())->sum('total_amount');
    	$activeCustomerCount = User::where('user_type_id',2)->where('status',1)->count();

    	return view('admin.dashboard',compact('totalOrderCount','todayOrderCount','todayOrderAmount','activeCustomerCount'));
    }
}
