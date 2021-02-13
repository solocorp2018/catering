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
	    				     // ->where('session_id',$currentSessionId)
	    				     ->get();

	   	return $cartItems;
    }

    public function updateCartItem($itemId,$currentSessionId,$processType){

    		$userId = Auth::user()->id;

    		$item = Item::find($itemId);

	    	$cartItem = $this->where('item_id',$itemId)
	    				     ->where('user_id',$userId)
	    				     ->where('session_id',$currentSessionId)
	    				     ->first();

	  		  	$count = (!empty($cartItem) && isset($cartItem->quantity))?$cartItem->quantity: 0;	    	

	    		$count = ($processType == 1)?$count+1:$count-1;

		    	if($processType == 1) {
		    		$whereArray = $cart = array();
		    		$whereArray['user_id'] = Auth::user()->id;
		    		$whereArray['item_id'] = $itemId;
		    		$whereArray['session_id'] = $currentSessionId;

		    		$cart['user_id'] = Auth::user()->id;
		    		$cart['item_id'] = $itemId;
		    		$cart['session_id'] = $currentSessionId;
		    		$cart['quantity'] = $count;
		    		$cart['unit_price'] = $item->price ?? 0;
		    		$cart['quantity_price'] = $cart['unit_price'] * $count;
		    		$cart['cart_date'] = today();

		    		$this->updateOrCreate($whereArray,$cart);	

		    		return 1;
		    	}


		    	if(!empty($cartItem) && $processType == 0) {

		    		if($cartItem->quantity <= 1) {
		    			$cartItem->delete();
		    		} else {

		    			$whereArray = $cart = array();
			    		$whereArray['user_id'] = Auth::user()->id;
			    		$whereArray['item_id'] = $itemId;
			    		$whereArray['session_id'] = $currentSessionId;

			    		$cart['user_id'] = Auth::user()->id;
			    		$cart['item_id'] = $itemId;
			    		$cart['session_id'] = $currentSessionId;
			    		$cart['quantity'] = $count;
			    		$cart['unit_price'] = $item->price ?? 0;
			    		$cart['quantity_price'] = $cart['unit_price'] * $count;
			    		$cart['cart_date'] = today();

			    		$this->updateOrCreate($whereArray,$cart);		
		    		}
		    		

		    		return 1;
		    	}

		    	

		    	return 0;
	    		

    	
    }

    public function item() {
    	return $this->belongsTo('App\Models\Item','item_id');
    }
}
