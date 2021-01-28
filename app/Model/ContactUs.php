<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
   protected $fillable = ['name', 'email', 'phone', 'message', 'status', 'assigned_to'];


   public function scopeFilter($query) {

        if($keyword = request('keyword')) {
            $query->where('name','like','%'.$keyword.'%');
            $query->orWhere('email','like','%'.$keyword.'%');
            $query->orWhere('phone','like','%'.$keyword.'%');
            $query->orWhere('message','like','%'.$keyword.'%');
        } 
        return $query;
    }


   public static function getQueriedResult() {    	
    	
    	$page_length = getPagelength();

    	list($sortfield,$sorttype) = getSorting();

    	$result = static::filter();
    	
    	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
    }
}
