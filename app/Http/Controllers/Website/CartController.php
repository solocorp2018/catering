<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Validator;

class CartController extends Controller
{	
	public function updateToCart(Request $request) {

		try {

			$validator = Validator::make($request->all(),[
							'itemId'=>'required',
							'sessionId' => 'required',
							'processType' => 'required|boolean'
						]);

		if($validator->fails()) {
			return response()->json(['errors'=>$validator->errors()]);
		}

		$itemId = $request->itemId;
		$sessionId = $request->sessionId;
		$processType = $request->processType ?? 1;

		$response = Cart::updateCartItem($itemId,$sessionId,$processType);

		if($response == 1) {
			return response()->json(['message'=> 'Item Added to Cart !']);	
		}

		} catch(\exception $ex) {
			return response()->json(['exception' => $ex->getMessage(), 'message'=> 'Item Adding to Cart is failured !']);	
		}
		
		
	}    
	
    public function refreshCart(Request $request) {

    	$cart = Cart::getCurrentUserCart();
    	
		$layoutCartview = view('website.layout.navbar-cart',compact('cart'))->render();
		$homeCartview = view('website.homepage-cart')->render();

		return response()->json(['layoutCartview'=>$layoutCartview,'homeCartview'=>$homeCartview]);    	
    }
}
