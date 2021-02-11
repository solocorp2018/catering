

   <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="fas fa-shopping-basket"></i> Cart
   <span class="badge badge-info">{{$cart->count()}}</span>
   </a>
   @if(!empty($cart->toArray()))      
   <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
    
      <div class="dropdown-cart-top-body border-top p-4">
      
      @foreach($cart as $cartItem)     
         <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> {{$cartItem->quantity}} * {{$cartItem->item->name}} <span class="float-right text-secondary">{{$cartItem->quantity_price}} INR</span></p>      
      @endforeach
      </div>          
      
      <div class="dropdown-cart-top-footer border-top p-4">
         <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">{{$cart->sum('quantity_price')}} INR</span></p>
         <small class="text-info">Delivery charges may apply</small>
      </div>
      <div class="dropdown-cart-top-footer border-top p-2">
         <a class="btn btn-success btn-block btn-lg" href="{{url('checkout')}}"> Checkout</a>
      </div>      
      
   </div>
   @endif