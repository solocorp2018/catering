<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    protected $fillable = ['id', 'session_menu_id','order_unique_id', 'customer_id', 'order_date', 'total_amount', 'order_status', 'confirmed_by', 'order_processed_by', 'delivered_by', 'status'];


    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('order_unique_id','like','%'.$keyword.'%');
             $query->orWhere('total_amount','like','%'.$keyword.'%');
         }
         return $query;
    }


    public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::with(['orderItems','processedBy:id,name','deliveredBy:id,name'])->filter();

     	$sortfield = ($sortfield == 'order_no')?'order_unique_id':$sortfield;
     	$sortfield = ($sortfield == 'date')?'order_date':$sortfield;
     	$sortfield = ($sortfield == 'amount')?'total_amount':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

    /* Below Are Relationships*/
    public function orderItems() {
    	return $this->hasMany('App\Models\OrderDetail','order_id');
    }

    public function processedBy() {
        return $this->belongsTo('App\Models\User','paid_by');
    }


    public function deliveredBy() {
        return $this->belongsTo('App\Models\User','recieved_by');
    }
}
