@if(!empty($userOrders->orders))
<h4 class="font-weight-bold mt-0 mb-4">Past Orders</h4>

@foreach($userOrders->orders as $order)
<div class="bg-white card mb-4 order-list shadow-sm">
   <div class="gold-members p-4">
      <a href="#">
         <div class="media">
            
            <div class="media-body">
               <span class="float-right text-info">Ordered on : {{dateOf($order->order_date)}} <i class="icofont-check-circled text-success"></i></span>
      
      @if(!empty($order->deliveredAddress))
      <p class="text-gray mb-1"><i class="icofont-location-arrow"></i> 
         {{$order->deliveredAddress->address_line_1}}, 
         @if(!empty($order->deliveredAddress->address_line_2))
         {{$order->deliveredAddress->address_line_2}} ,
         @endif         
         {{$order->deliveredAddress->city}} - {{ $order->deliveredAddress->pincode }}
      </p>
      @endif

      <p class="text-gray mb-3"><i class="icofont-list"></i> ORDER #{{$order->order_unique_id}} </p>

      @if(!empty($order->orderItems))
      <p class="text-dark">         
         @foreach($order->orderItems as $key => $orderItem)
            @if($key > 0) , @endif {{$orderItem->item->name}} x {{$orderItem->quantity}}
         @endforeach         
      </p>
      @endif
      <hr>
      <div class="float-right">
      <a class="btn btn-sm btn-outline-primary" href="tel:{{supportnumber()}}"><i class="icofont-headphone-alt"></i> HELP</a>
      <a class="btn btn-sm btn-outline-info" href="{{route('order.invoice',$order->id)}}"><i class="fa fa-download"></i> Invoice</a>
      </div>      

      <p class="mb-0 text-black text-primary pt-2"><span class="text-black font-weight-bold"> Total Paid:</span> {{$order->total_amount}} INR
      </p>

      </div>
      </div>
      </a>
   </div>
</div>
@endforeach


@else   
   <h4 class="font-weight-bold mt-0 mb-4">No Orders Found !</h4>
@endif
