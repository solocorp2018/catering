
                  <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                     <h5 class="mb-1 text-white">Your Cart</h5>
                     <p class="mb-4 text-white">{{$cart->count()}} ITEMS</p>
                     <div class="bg-white rounded shadow-sm mb-2">
                        @if(!empty($cart))
                        @foreach($cart as $cartItem)
                        <div class="gold-members p-2 border-bottom">
                           <p class="text-gray mb-0 float-right ml-2">{{$cartItem->quantity_price}} INR</p>
                           <span class="count-number float-right">
                           <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                           <input class="count-number-input" type="text" value="1" readonly="">
                           <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                           </span>
                           <div class="media">
                              <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                              <div class="media-body">
                                 <p class="mt-1 mb-0 text-black">{{$cartItem->quantity}} * {{$cartItem->item->name}}</p>
                              </div>
                           </div>
                        </div>
                        @endforeach
                        @endif
                     </div>
                     <div class="mb-2 bg-white rounded p-2 clearfix">
                        <img class="img-fluid float-left" src="{{asset('website/img/wallet-icon.png')}}">
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-success">{{$cart->sum('quantity_price')}} INR</span></h6>
                        <p class="seven-color mb-1 text-right">Free Delivery</p>
                        <!-- <p class="text-black mb-0 text-right">You have saved $955 on the bill</p> -->
                     </div>
                     <a href="{{url('checkout')}}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
                  </div>