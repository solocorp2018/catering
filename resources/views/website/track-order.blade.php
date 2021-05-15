@extends('website.layout.layout')
@section('content')
@section('title','Track Order')
	
	      <section class="section bg-white osahan-track-order-page position-relative">

         <!-- <iframe class="position-absolute" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13696.650704896498!2d75.82434255!3d30.8821099!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1555184720550!5m2!1sen!2sin" width="100%" height="676" frameborder="0" style="border:0" allowfullscreen></iframe>
 -->
         <div class="container pt-5 pb-5">
            <div class="row d-flex align-items-center">
               <!-- <div class="col-md-6 text-center pb-4">
                  <div class="osahan-point mx-auto"></div>
               </div> -->
               <div class="col-md-12">
                  <div class="bg-white p-4 shadow-lg mb-2">
                     <div class="mb-2"><small>Order #{{$orderUniqueId}}<a class="float-right font-weight-bold" href="tel:{{supportnumber()}}"><i class="icofont-headphone-alt"></i> HELP</a></small></div>
                     <h6 class="mb-1 mt-1"><a href="{{url('/')}}" class="text-black">M R Grandson Caters
                        </a>
                     </h6>
                     <p class="text-gray mb-0">{{$orderData->orderItems->count()}} Items | {{$orderData->total_amount}} INR</p>
                  </div>
                  <div class="bg-white p-4 shadow-lg">
                     <div class="osahan-track-order-detail po">
                        <h5 class="mt-0 mb-3">Order Details</h5>
                        <div class="row">
                           <div class="col-md-5">
                              <small>FROM</small>
                              <h6 class="mb-1 mt-1"><a href="detail.html" class="text-black"><i class="icofont-food-cart"></i> M.R Grandson Caters
                                 </a>
                              </h6>
                              <p class="text-gray mb-5"><i class="icofont-location-pin"></i>
                           NO 6B, Site Somu Avenue, LIC Colony, Selvapuram, Coimbatore - 641039</p>
                              <small>DELIVER TO</small>
                              <h6 class="mb-1 mt-1"><span class="text-black"><i class="icofont-map-pins"></i> 
                                 {{Auth::user()->name}}
                                 </span>
                                 
                              </h6>
                              <p class="text-gray mb-0">{{$orderData->address->address_line_1}}

                              @if(!empty($orderData->address->address_line_2))
                              {{$orderData->address->address_line_2}}
                              @endif
                              </p>
                                 <p>
                              {{$orderData->address->city}} - {{$orderData->address->pincode}}


                              </p>
                           </div>
                           <div class="col-md-7">
                              <div class="mb-2"><small><i class="icofont-list"></i> {{$orderData->orderItems->count()}} ITEMS</small></div>

                              @if(!empty($orderData->orderItems))
                              @foreach($orderData->orderItems as $orderItems)

                              	@php
                              		$menuItem = collect();
                              		if(isset($orderData->sessionMenu->menuItem)) {
                              			$menuItem = $orderData->sessionMenu->menuItem->where('item_id',$orderItems->menu_item_id)->first();
                              		}                                 	
                                 @endphp

                                 <p class="mt-1 mb-0 text-black "><i class="icofont-ui-press text-success food-item"></i> &nbsp; {{$orderItems->item->name}} 
                                 	@if(!empty($menuItem))
                                 	<small> ({{$menuItem->quantity ?? ''}} {{$menuItem->quantityType->name ?? ''}} | {{$menuItem->price ?? ''}} INR) </small> x

                                 	@endif

                                 	{{$orderItems->quantity}}

                                 	<span class="float-right text-secondary">{{$orderItems->total_amount}} INR</span>
                                 </p>
                                 @endforeach
                              @endif
                              <br>
                              <p class="mb-0 font-weight-bold text-black">TOTAL BILL <span class="float-right text-secondary">{{$orderData->total_amount}} INR</span></p>
                              <p class="mb-0 text-info"><small>Payment Mode : {{ findPaymentMode($orderData->payment_mode) }}
                                 <!-- <span class="float-right text-danger">$620 OFF</span> -->
                             </small>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="bg-white p-4 shadow-lg mt-2">
                     <div class="row text-center">
                        <div class="col">
                           <i class="icofont-tasks icofont-3x text-info"></i>
                           <p class="mt-1 font-weight-bold text-dark mb-0">Order Received</p>
                           <small class="text-info mb-0">NOW</small>
                        </div>
                        <div class="col">
                           <i class="icofont-check-circled icofont-3x text-success"></i>
                           <p class="mt-1 font-weight-bold text-dark mb-0">Order Confirmed</p>
                           <small class="text-success mb-0">NEXT</small>
                        </div>
                        <div class="col">
                           <i class="icofont-delivery-time icofont-3x text-primary"></i>
                           <p class="mt-1 font-weight-bold text-dark mb-0">Order Delivered</p>
                           <small class="text-primary mb-0">Soon  </small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection