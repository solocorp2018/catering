<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Item;

class Cart extends Model
{
    protected $fillable = ['session_id','item_id','user_id','quantity','unit_price','quantity_price','cart_date']; 

    public static function getCurrentUserCart() {

		$currentSessionId = 1;
		$userId = Auth::user()->id;    	
		$cartItems = static::with(['item'])
							->where('user_id',$userId)
	    				     ->where('session_id',$currentSessionId)
	    				     ->get();

	   	return $cartItems;
    }

    public static function updateCartItem($itemId,$currentSessionId,$processType){

    		$userId = Auth::user()->id;

    		$item = Item::find($itemId);


	    	$cartItem = static::where('item_id',$itemId)
	    				     ->where('user_id',$userId)
	    				     ->where('session_id',$currentSessionId)
	    				     ->first();

	    	$count = (!empty($cartItem) && isset($cartItem->quantity))?$cartItem->quantity: 0;

	    	

	    		$count = ($processType == 1)?$count+1:$count-1;

	    		if(!empty($cartItem) && $count <= 1 && $processType == 0) {
		    		$cartItem->delete();
		    	} 

		    	if($processType == 1) {
		    		$whereArray = $cartItem = array();
		    		$where['user_id'] = Auth::user()->id;
		    		$where['item_id'] = $itemId;
		    		$where['session_id'] = $currentSessionId;

		    		$cartItem['user_id'] = Auth::user()->id;
		    		$cartItem['item_id'] = $itemId;
		    		$cartItem['session_id'] = $currentSessionId;
		    		$cartItem['quantity'] = $count;
		    		$cartItem['unit_price'] = $item->price ?? 0;
		    		$cartItem['quantity_price'] = $cartItem['unit_price'] * $count;
		    		$cartItem['cart_date'] = today();

		    		static::updateOrCreate($whereArray,$cartItem);	
		    	}

	    		return 1;

    	
    }

    public function item() {
    	return $this->belongsTo('App\Models\Item','item_id');
    }
}