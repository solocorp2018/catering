<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemComplimentary extends Model
{
    protected $fillable = ['menu_id', 'menu_item_id', 'complimentary_id','quantity_type_id', 'quantity', 'status'];

    public function sessionMenus() {
     return $this->belongsTo('App\Models\SessionMenu','menu_id');
    }

    public function menuItems() {
     return $this->belongsTo('App\Models\MenuItem','menu_item_id');
    }

    public function complimentaries() {
     return $this->belongsTo('App\Models\Complimentary','complimentary_id');
    }

    public function quantityType() {
    	return $this->belongsTo('App\Models\QuantityType','quantity_type_id');
    }


}
