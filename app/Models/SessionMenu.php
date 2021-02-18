<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMenu extends Model
{

  protected $fillable = ['session_type_id','session_code', 'opening_time', 'closing_time', 'expected_delivery_time', 'created_by','status','notify'];

	

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
                    ->orderBy('session_type_id','asc')
                    ->where(function($whereQuery){
                      $whereQuery->where('opening_time','>=',today());
                      $whereQuery->orWhere('closing_time','<=',today());
                    })
                    ->get();
        
      return $result;
   }

   /*Not in Use*/
   public function currentSessionId() {

      $currentTime = Time12To24(now(),'H:i:s');      
      $currentTimeSecond = seconds_from_time($currentTime);

      $results = $this->whereDate('session_date',today())
                    ->whereRaw("TIME_TO_SEC(opening_time) >= $currentTimeSecond")
                    ->whereRaw("TIME_TO_SEC(closing_time) <= $currentTimeSecond")
                    ->orderBy('id','desc')
                    ->select("id")                    
                    ->first();


      dd($results);
        
      return !empty($result)?$result->id:0;
   }

   public static function sessionUniqueId() {

        $prefix="MENU";

        $uniqueCode = static::select('id')->orderBy('id','desc')->first();        

        $menuId = 1;
        if(!empty($uniqueCode)){
          $menuId = $uniqueCode->id+1;
        }

        $menuUniqueCode = sprintf("%05d", $menuId);

        return $prefix.$menuUniqueCode;
  }

   public static function getQueriedResult() {

    $page_length = getPagelength();

    list($sortfield,$sorttype) = getSorting('created_at');

    $result = static::with(['sessionType','sessionItem'])->filter();

    $sortfield = ($sortfield == 'date')?'created_at':$sortfield;
    $sortfield = ($sortfield == 'code')?'session_code':$sortfield;
    $sortfield = ($sortfield == 'open')?'opening_time':$sortfield;
    $sortfield = ($sortfield == 'close')?'closing_time':$sortfield;

    return $result->orderBy($sortfield,$sorttype)->paginate($page_length);

   }

   public function sessionType() {
    return $this->belongsTo('App\Models\SessionType','session_type_id');
   }

   public function sessionItem() {
      return $this->hasMany('App\Models\MenuItem','session_menu_id');
   }
   public function menuItem() {
    return $this->hasMany('App\Models\MenuItem')->with(['Items','quantityType','menuComplimentaries'])->where('status',1);
   }

   public function menuItemComplimentary() {
    return $this->hasMany('App\Models\MenuItemComplimentary','menu_id')->with('complimentaries');
   }

}
