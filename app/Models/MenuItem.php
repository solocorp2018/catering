<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{

    protected $fillable = ['session_menu_id', 'item_id', 'quantity_type_id', 'quantity', 'price', 'status'];
    //

    public function Items() {
     return $this->belongsTo('App\Models\Item','item_id');
    }

    public function menuComplimentaries() {
     return $this->hasMany('App\Models\MenuItemComplimentary','menu_item_id')->with('complimentaries');
    }

    public function quantityType() {
    	return $this->belongsTo('App\Models\QuantityType','quantity_type_id');
    }

}
