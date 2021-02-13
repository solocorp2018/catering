<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
	use SoftDeletes;

    protected $fillable = ['id', 'order_id', 'menu_item_id', 'quantity_type_id', 'quantity', 'amount_per_item', 'total_amount'];


    public function item() {
    	return $this->belongsTo('App\Models\Item','menu_item_id');
    }

	public function menuItems() {
    	return $this->belongsTo('App\Models\MenuItem','menu_item_id')->with('Items');
    }

	public function quantityType() {

    	return $this->belongsTo('App\Models\QuantityType','quantity_type_id');
    }
}
