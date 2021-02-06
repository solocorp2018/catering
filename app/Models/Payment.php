<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'order_id', 'payment_unique_id','amount', 'payment_mode', 'recieved_by', 'payment_date', 'paid_by', 'payment_status'];


    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('payment_unique_id','like','%'.$keyword.'%');
             $query->orWhere('amount','like','%'.$keyword.'%');
         }
         return $query;
    }


    public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::with(['order','paidBy:id,name,contact_number','receivedBy:id,name,contact_number'])->filter();

     	$sortfield = ($sortfield == 'payment_no')?'payment_unique_id':$sortfield;
     	$sortfield = ($sortfield == 'date')?'order_date':$sortfield;
     	$sortfield = ($sortfield == 'amount')?'total_amount':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

    /*Below Are Relationship*/

    public function order() {
    	return $this->belongsTo('App\Models\Order','order_id');
    }

    public function paidBy() {
    	return $this->belongsTo('App\Models\User','paid_by');
    }


    public function receivedBy() {
    	return $this->belongsTo('App\Models\User','recieved_by');
    }

}
