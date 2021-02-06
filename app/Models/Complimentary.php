<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complimentary extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'lang1_name', 'description', 'lang1_description', 'status', 'price','image_path','is_visible','quantity_type_id','created_by'];


    public function scopeFilter($query) {

         if($keyword = request('keyword')) {
             $query->where('name','like','%'.$keyword.'%');
             $query->orWhere('description','like','%'.$keyword.'%');
         }
         return $query;
    }


     public static function getQueriedResult() {

     	$page_length = getPagelength();

     	list($sortfield,$sorttype) = getSorting();

     	$result = static::with(['quantityType'])->filter();

     	$sortfield = ($sortfield == 'name')?'name':$sortfield;

     	return $result->orderBy($sortfield,$sorttype)->paginate($page_length);
     }

     public function getActiveRecord() {
       return $this->where('status',_active())->get();
     }

     public function quantityType() {
     	return $this->belongsTo('App\Models\QuantityType','quantity_type_id');
     }

}
