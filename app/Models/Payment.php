<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'amount', 'payment_mode', 'recieved_by', 'payment_date', 'paid_by','payment_status'];

    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('order_id','like','%'.$keyword.'%');
         }
         return $query;
     }


     public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::filter();

     	$sortfield = ($sortfield == 'order_id')?'order_id':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

     public function orderDet() {
     	return $this->belongsTo('App\Models\Order','order_id');
     }

     public function recievedBy() {
     	return $this->belongsTo('App\Models\User','recieved_by');
     }

     public function paidBy() {
     	return $this->belongsTo('App\Models\User','paid_by');
     }
}
