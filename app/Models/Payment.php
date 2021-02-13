<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Payment extends Model
{

    use SoftDeletes;

    protected $fillable = ['id', 'order_id', 'payment_unique_id','amount', 'payment_mode', 'recieved_by', 'payment_date', 'paid_by', 'payment_status','transaction_id','comments'];



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


     	$result = static::with(['order','paidBy:id,name,contact_number','recievedBy:id,name,contact_number'])->filter();

     	$sortfield = ($sortfield == 'payment_no')?'payment_unique_id':$sortfield;
     	$sortfield = ($sortfield == 'date')?'order_date':$sortfield;
     	$sortfield = ($sortfield == 'amount')?'total_amount':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

    
    public function paymentUniqueid() {

        $prefix="PAY";

        $uniqueCode = Str::random(8);

        $is_exist = $this->select('payment_unique_id')->where('payment_unique_id',$prefix.$uniqueCode)->count();

        while ($is_exist > 0) {
          $this->paymentUniqueid();
        }
        return $prefix.$uniqueCode;
    }
    /*Below Are Relationship*/

    public function order() {
    	return $this->belongsTo('App\Models\Order','order_id')->with(['deliveredAddress','orderItems']);
    }

    public function paidBy() {
    	return $this->belongsTo('App\Models\User','paid_by');
    }

    public function recievedBy() {
    	return $this->belongsTo('App\Models\User','recieved_by');
    }

}
