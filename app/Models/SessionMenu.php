<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMenu extends Model
{

  protected $fillable = ['session_type_id', 'session_date', 'opening_time', 'closing_time', 'expected_delivery_time', 'created_by','status'];

  public function scopeFilter($query) {

       if($keyword = request('keyword')) {
           $query->whereHas('sessionType',function($querySub) use($keyword){
                $querySub->where('type_name','like',"%{$keyword}%");
           });
       }
       return $query;
   }

   public function getTodayMenu(){

      $result = $this->with(['sessionType','menuItem'])
                    ->whereDate('session_date',today("+05:30"))
                    ->orderBy('opening_time')
                    ->get();
        
        return $result;
   }

   public static function getQueriedResult() {

    $page_length = getPagelength();

    list($sortfield,$sorttype) = getSorting('opening_time');

    $result = static::with(['sessionType'])->filter();

    //$sortfield = ($sortfield == 'order_id')?'order_id':$sortfield;

    return $result->orderBy($sortfield,$sorttype)->paginate($page_length);

   }

   public function sessionType() {
    return $this->belongsTo('App\Models\SessionType','session_type_id');
   }

   public function menuItem() {
    return $this->hasMany('App\Models\MenuItem')->with(['Items','quantityType','menuComplimentaries']);
   }

   public function menuItemComplimentary() {
    return $this->hasMany('App\Models\menuItemComplimentary','menu_id')->with('complimentaries');
   }

}
