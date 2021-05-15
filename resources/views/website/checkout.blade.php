@extends('website.layout.layout')
@section('content')
@section('title','Checkout')

      @include('website.addresses-modal')

      <style>
         .border-success {
            border:2px solid !important;
            border-color: #3ecf8e !important;
         }
      </style>

       <section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
         <div class="container">
            <div class="row">
               <div class="col-md-8">
                  <div class="offer-dedicated-body-left">                     
                     <div class="pt-2"></div>
                     <div class="bg-white rounded shadow-sm p-4 mb-4">
                        <h4 class="mb-1">Choose a delivery address</h4>
                        <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>                        
                        <div class="row">
                           @if(!empty($userData->userAddress))                           
                           @foreach($userData->userAddress as $address)
                           <div class="col-md-6 mt-2">
                              <div class="bg-white card addresses-item border shadow {{($address->is_current == 1)?'border-success':''}}">
                                 <input type="hidden" value="{{$address->id}}" class="deliver_to"/>
                                 <div class="gold-members p-4">
                                    <div class="media">
                                       <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                       <div class="media-body">
                                          <h6 class="mb-1 text-secondary">{{Auth::user()->name}}</h6>
                                          <p>{{$address->address_line_1}} 
                                          @if(!empty($address->address_line_2)) 
                                          , {{$address->address_line_1}}
                                          @endif
                                          </p>
                                          <p>{{$address->city}} - {{$address->pincode}}</p>                                         
                                          <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-secondary mr-2  deliver-here {{($address->is_current == 1)?'btn-success':''}}" href="#"> DELIVER HERE</a>
                                             <!-- <span>45MIN</span> -->
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           @endif
                           <div class="col-md-6 mt-2">
                              <div class="bg-white card addresses-item">
                                 <div class="gold-members p-4">
                                    <div class="media">
                                       <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                       <div class="media-body">
                                          <h6 class="mb-1 text-secondary">Other</h6>
                                          <p>New Address Location</p>
                                          <p class="mb-0 text-black font-weight-bold"><a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2" href="#"> ADD NEW ADDRESS</a></p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  </div>

               </div>

               <div class="col-md-4" id="home-cart">
                  @php
                     $showCheckout = 1;
                  @endphp
                  @include('website.homepage-cart')                 
               </div>
            </div>
         </div>
      </section>

@endsection