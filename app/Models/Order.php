<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Cart;
use App\Models\SessionMenu;
use App\Models\OrderDetail;
use Auth;
use Illuminate\Support\Str;

class Order extends Model
{
	use SoftDeletes;


    protected $fillable = ['id', 'session_menu_id','address_id','order_unique_id', 'customer_id', 'order_date', 'total_amount', 'order_status', 'confirmed_by', 'order_processed_by', 'delivered_by', 'status'];



    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('order_unique_id','like','%'.$keyword.'%');
             $query->orWhere('total_amount','like','%'.$keyword.'%');
         }

         if($fromDate = request('from')) {
             $query->whereDate('order_date','>=',$fromDate);             
         }
         if($toDate = request('to')) {             
              $query->whereDate('order_date','<=',$toDate);
         }

         if($status = request('status')) {             
              if($status == 'Pending') {
                $query->doesntHave('payment');
              }

              if($status == 'Paid') {
                $query->has('payment');
              }
         }

         return $query;
    }


    public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::with(['orderItems','sessionMenu','processedBy:id,name','deliveredBy:id,name','payment','customer'])->filter();

     	$sortfield = ($sortfield == 'order_no')?'order_unique_id':$sortfield;
     	$sortfield = ($sortfield == 'date')?'order_date':$sortfield;
     	$sortfield = ($sortfield == 'amount')?'total_amount':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
    }

    public static function getExportQueriedResult() {        

        list($sortfield,$sorttype) = getSorting();

        $result = static::with(['orderItems.item','sessionMenu','processedBy:id,name','deliveredBy:id,name','payment','customer'])->filter();

        $sortfield = ($sortfield == 'order_no')?'order_unique_id':$sortfield;
        $sortfield = ($sortfield == 'date')?'order_date':$sortfield;
        $sortfield = ($sortfield == 'amount')?'total_amount':$sortfield;

        return $result->orderBy($sortfield,$sorttype);
    }

    public function placeOrder($deliveryId) {

        $cartData = Cart::getCurrentUserCart();
        $sessionMenu = new SessionMenu();

        $lastRowofCartSession = $cartData->last()->session_id ?? 0;

        $order = array();        

        $order['order_unique_id'] = $this->orderUniqueid();
        $order['session_menu_id'] = $lastRowofCartSession;
        $order['customer_id'] = Auth::user()->id;
        $order['address_id'] = $deliveryId;
        $order['order_date'] = today();
        $order['total_amount'] = $cartData->sum('quantity_price');
        $order['order_status'] = _active();
        $order['status'] = _active();

        $orderCollection = $this->create($order);

        foreach ($cartData as $key => $cartItem) {
            
            $orderDetails = array();
            $orderDetails['order_id'] = $orderCollection->id;
            $orderDetails['menu_item_id'] = $cartItem->item_id;
            $orderDetails['quantity_type_id'] = $cartItem->item->quantity_type_id;
            $orderDetails['quantity'] = $cartItem->quantity;
            $orderDetails['amount_per_item'] = $cartItem->unit_price;
            $orderDetails['total_amount'] = $cartItem->quantity_price;
            OrderDetail::create($orderDetails);
        }

        Cart::where('user_id',Auth::user()->id)->delete();

        return $orderCollection->order_unique_id;
    }

    public function getOrderData($orderUniqueid) {

        return $this->with(['orderItems.item','sessionMenu.menuItem','orderItems.quantityType','address','processedBy'])->where('order_unique_id',$orderUniqueid)->first();
    }

    public function orderUniqueid() {

        $prefix="ORD";

        $uniqueCode = $this->select('id')->orderBy('id','desc')->first();        

        $startId = 1;
        if(!empty($uniqueCode)){
          $startId = $uniqueCode->id+1;
        }

        $menuUniqueCode = sprintf("%06d", $startId);

        return $prefix.$menuUniqueCode;
    }

    /* Below Are Relationships*/
    public function orderItems() {
    	return $this->hasMany('App\Models\OrderDetail','order_id');
    }

    public function recievedBy() {
        return $this->belongsTo('App\Models\User','order_processed_by');
    }
    public function processedBy() {
        return $this->belongsTo('App\Models\User','order_processed_by');
    }

    public function address() {
        return $this->belongsTo('App\Models\UserAddress','address_id');
    }

    public function sessionMenu() {
        return $this->belongsTo('App\Models\SessionMenu','session_menu_id');
    }

    public function deliveredBy() {
        return $this->belongsTo('App\Models\User','delivered_by');
    }

    public function customer() {
        return $this->belongsTo('App\Models\User','customer_id');
    }


	public function deliveredAddress() {
		return $this->belongsTo('App\Models\UserAddress','address_id');
	}

    public function payment() {
        return $this->hasOne('App\Models\Payment','order_id');
    }
}
