@extends('website.layout.layout')
@section('content')
@section('title','Home')


      <section class="restaurant-detailed-banner">
         <div class="text-center">
            <!-- <img class="img-fluid cover" src="{{asset('website/img/mall-dedicated-banner.png')}}"> -->
            <img class="img-fluid cover" src="{{asset('website/img/banner-1.png')}}">
         </div>

         <div class="restaurant-detailed-header">
            <div class="container">
               <div class="row d-flex align-items-end">
                  <div class="col-md-8">
                     <div class="restaurant-detailed-header-left">
                        <!-- <img class="img-fluid mr-3 float-left" alt="Mr Grandson caters" src="{{asset('website/img/logo/1.png')}}" height="20px"> -->
                        <h2 class="text-white">M R Grandson Caters</h2>
                        <p class="text-white mb-1">
                           <i class="icofont-location-pin"></i>
                           NO 6B, Site Somu Avenue, LIC Colony, Selvapuram, Coimbatore - 641039
                           </p>
                           <p class="text-white mb-0"><i class="icofont-food-cart"></i> 
                           North Indian, Chinese, Fast Food, South Indian (Pure Veg)
                        </p>
                     </div>
                  </div>

                  <!--<div class="col-md-4">
                     <div class="restaurant-detailed-header-right text-right">
                        <button class="btn btn-info" type="button"><i class="icofont-clock-time"></i> Order Opens Till 12:30 PM
                        </button>
                     </div>
                  </div>-->
               </div>
            </div>
         </div>
         </div>
      </section>

      <section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  @if(!empty($todaysMenu))
                  <ul class="nav" id="pills-tab" role="tablist">
                  	@foreach($todaysMenu as $key => $todayMenu)
                  	@php
                     		$menuCount = $todayMenu->menuItem->count();
                     @endphp

                     @if($menuCount > 0)
                     <li class="nav-item">
                        <a class="nav-link tabNav {{($key == 0)?'active':'' }}" id="pill{{$todayMenu->id}}000-tab" data-toggle="pill" href="#pill{{$todayMenu->id}}000" role="tab" aria-controls="pill{{$todayMenu->id}}000" aria-selected="true">{{$todayMenu->sessionType->type_name ?? '--'}}
                           <span class="badge badge-success">open</span>
                        </a>
                     </li>
                     @endif
                     @endforeach                    
                     
                  </ul>
                  @endif
               </div>
            </div>
         </div>
      </section>

      <section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
         <div class="container">
            <div class="row">
               <div class="{{ (Auth::user())?'col-md-8':'col-md-12'}}">
                  <div class="offer-dedicated-body-left">
                     <div class="tab-content" id="pills-tabContent">

                     	@foreach($todaysMenu as $key1 => $todayMenu)
                     	@php
                     		$menuCount1 = $todayMenu->menuItem->count();
                     	@endphp

                     	@if($menuCount1 > 0)
                        <div class="tab-pane {{($key1 == 0)?'show active':'fade' }}" id="pill{{$todayMenu->id}}000" role="tabpanel" aria-labelledby="pill{{$todayMenu->id}}000-tab">                         
                           <div class="row">
                              <h5 class="mb-4 mt-3 col-md-12">{{$todayMenu->sessionType->type_name ?? '--'}} <small class="h6 text-black-50">{{$menuCount1}} ITEMS</small></h5>
                              <div class="col-md-12">
                                 <div class="bg-white rounded border shadow-sm mb-4">
                                 	@foreach($todayMenu->menuItem as $menuItem)
                                    <div class="gold-members p-3 border-bottom">
                                       <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">{{$menuItem->Items->name}} | {{$menuItem->Items->lang1_name}} 
                                             	
                                             	@if($menuItem->menuComplimentaries->count() > 0)
                                             	<small style="font-size: 70%;font-weight: 500;">(
                                             	@foreach($menuItem->menuComplimentaries as $complimentary)
                                             	
                                             	{{$complimentary->complimentaries->value('name').','}}
                                             	@endforeach

                                             	)</small>
                                             	@endif
                                             	

                                             	</h6>

                                             <p class="text-gray mb-0">{{$menuItem->Items->price ?? 0}} INR</p>
                                          </div>
                                       </div>
                                    </div>                                   
                                    @endforeach
                                    
                                 </div>
                              </div>
                           </div>

                        </div>
                        @endif
                        @endforeach
                        

                     </div>
                  </div>
               </div>

               @if(Auth::user())
               <div class="col-md-4">

                  <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                     <h5 class="mb-1 text-white">Your Cart</h5>
                     <p class="mb-4 text-white">2 ITEMS</p>
                     <div class="bg-white rounded shadow-sm mb-2">
                        <div class="gold-members p-2 border-bottom">
                           <p class="text-gray mb-0 float-right ml-2">50 INR</p>
                           <span class="count-number float-right">
                           <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                           <input class="count-number-input" type="text" value="1" readonly="">
                           <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                           </span>
                           <div class="media">
                              <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                              <div class="media-body">
                                 <p class="mt-1 mb-0 text-black">5 * Idly</p>
                              </div>
                           </div>
                        </div>
                        <div class="gold-members p-2">
                           <p class="text-gray mb-0 float-right ml-2">100 INR</p>
                           <span class="count-number float-right">
                           <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                           <input class="count-number-input" type="text" value="1" readonly="">
                           <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                           </span>
                           <div class="media">
                              <div class="mr-2"><i class="icofont-ui-press text-success food-item"></i></div>
                              <div class="media-body">
                                 <p class="mt-1 mb-0 text-black">2 * Ghee Roast</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="mb-2 bg-white rounded p-2 clearfix">
                        <img class="img-fluid float-left" src="{{asset('website/img/wallet-icon.png')}}">
                        <h6 class="font-weight-bold text-right mb-2">Subtotal : <span class="text-success">150 INR</span></h6>
                        <p class="seven-color mb-1 text-right">Free Delivery</p>
                        <!-- <p class="text-black mb-0 text-right">You have saved $955 on the bill</p> -->
                     </div>
                     <a href="{{url('checkout')}}" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>
                  </div>

               </div>
               @endif
            </div>
         </div>
      </section>

@endsection