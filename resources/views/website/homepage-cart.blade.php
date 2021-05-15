
                  <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                     <h5 class="mb-1 text-white">Your Cart</h5>
                     <p class="mb-4 text-white">{{$cart->count()}} ITEMS</p>
                     <div class="bg-white rounded shadow-sm mb-2">
                        @if(!empty($cart))
                        @foreach($cart as $cartItem)
                        <div class="gold-members p-2 border-bottom">
                           <p class="text-gray mb-0 float-right ml-2">{{$cartItem->quantity_price}} INR</p>
                           <span class="count-number float-right">
                           <button class="btn btn-outline-secondary  btn-sm left dec" onclick="updateItemToCart({{$cartItem->item_id}},{{$cartItem->session_id}},0)"> <i class="icofont-minus"></i> </button>
                           <input class="count-number-input" type="text" value="{{$cartItem->quantity}}" readonly="">
                           <button class="btn btn-outline-secondary btn-sm right inc" onclick="updateItemToCart({{$cartItem->item_id}},{{$cartItem->session_id}},1)"> <i class="icofont-plus"></i> </button>
                           </span>
                           <div class="media">
                              <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                              <div class="media-body">
                              	 @php
                              		$menuItem = collect();
                              		if(isset($orderData->sessionMenu->menuItem)) {
                              			$menuItem = $orderData->sessionMenu->menuItem->where('item_id',$cartItem->item_id)->first();
                              		}                                 	
                                 @endphp
                                 <p class="mt-1 mb-0 text-black"> {{$cartItem->item->name}}</p>
                                 @if(!empty($menuItem->toArray()))
                                 <p class="mt-1 mb-0 text-black">
                                 	{{$menuItem->quantity ?? ''}} {{$menuItem->quantityType->name ?? ''}} | {{$menuItem->price ?? ''}} INR
                                 </p>
                                  <p class="mt-1 mb-0 text-black">
                                 	Added : {{$menuItem->quantity ?? ''}} {{$menuItem->quantityType->name ?? ''}} x {{$cartItem->quantity}}
                                  </p>                                  
                                @endif      
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endif
                     </div>
                     <div class="mb-2 bg-white rounded p-2 clearfix">
                        <img class="img-fluid float-left" src="{{asset('website/img/wallet-icon.png')}}">
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-success">{{$cart->sum('quantity_price')}} INR</span></h6>                        
                        <p class="seven-color mb-1 text-right">Delivery charges applicable</p>
                        <!-- <p class="text-black mb-0 text-right">You have saved $955 on the bill</p> -->
                     </div>

                     @if(!empty($showCheckout) && $showCheckout == 1)
                      <div class="mb-2 bg-white rounded p-2 clearfix">
                           <p class="seven-color mb-3 text-left">Preferred Payment method</p>
                           
                           @foreach(paymentModes() as $paymentMode)
                           <button class="btn btn-default btn-outline-info btn-sm payment_method {{($paymentMode['id'] == 1)?'active':''}}" type="button" data-method="{{$paymentMode['id']}}"><i class="icofont-card"></i> {{$paymentMode['name']}}</button> &nbsp;                  
                        @endforeach
                     </div>
                     @endif

                     @if(!empty($cart) && $cart->count() > 0)
                     @if(!empty($showCheckout) && $showCheckout == 1)

                     @php
                     $currentAddressId = $userData->userAddress->where('is_current',1)->first()->id;
                     @endphp
                     <form action="{{route('place.order')}}" method="post">
                        @csrf                        
                        <input type="hidden" name="payment_method" id="payment_method" value="1"/>
                        <input type="hidden" name="delivery_address_id" id="delivery_address_id" value="{{$currentAddressId}}"/>
                        <button type="Submit" class="btn btn-success btn-block btn-lg">Place Order <i class="icofont-long-arrow-right"></i></a>
                     </form>
                     @else
                     <a href="{{url('checkout')}}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
                     @endif
                     @endif
                  </div>