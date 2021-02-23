@extends('website.layout.layout')
@section('content')
@section('title','Home')

<style>
.banner {
  display: block;  
  background: url("{{asset('website/img/banner-1.png')}}") no-repeat !important;
  background-size: cover !important;  
  height:424px;
}   
</style>

      <section class="restaurant-detailed-banner">
         <div class="text-center banner"></div>
         

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
                           @php
                              $sessionStatus = isOpenForOrder($todayMenu->opening_time,$todayMenu->closing_time);                              
                           @endphp
                           @if($sessionStatus == 1) 
                           <span class="badge badge-success">open</span>
                           @elseif($sessionStatus == 2)
                           <span class="badge badge-warning">upcoming</span>
                           @else
                           <span class="badge badge-danger">closed</span>
                           @endif

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
                  <div class="offer-dedicated-body-left" >
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
                                       @php
                                          $sessionStatus = isOpenForOrder($todayMenu->opening_time,$todayMenu->closing_time);
                                          
                                       @endphp
                                       @if(Auth::user() && $sessionStatus == 1)
                                       
                                       
                                       <a class="btn btn-outline-secondary btn-sm  float-right" onclick="updateItemToCart({{$menuItem->item_id}},{{$todayMenu->id}},1)">ADD</a>
                                       @endif
                                       
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">{{$menuItem->Items->name}}
                                             	
                                             	@if($menuItem->menuComplimentaries->count() > 0)
                                             	<small style="font-size: 70%;font-weight: 500;">(
                                             	@foreach($menuItem->menuComplimentaries as $key => $complimentary)
                                             	@if($key > 0)
                                                ,
                                                @endif

                                                @if(!empty($complimentary->complimentaries))
                                                   {{$complimentary->complimentaries->name ?? ''}}
                                                @endif
                                             	
                                             	@endforeach

                                             	)</small>
                                             	@endif
                                             	

                                             	</h6>
                                                 <h6 class="mb-1">{{$menuItem->Items->lang1_name}}
                                                
                                                @if($menuItem->menuComplimentaries->count() > 0)
                                                <small style="font-size: 70%;font-weight: 500;">(
                                                @foreach($menuItem->menuComplimentaries as $key => $complimentary)
                                                @if($key > 0)
                                                ,
                                                @endif

                                                @if(!empty($complimentary->complimentaries))
                                                   {{$complimentary->complimentaries->lang1_name ?? ''}}
                                                @endif
                                                
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
               <div class="col-md-4" id="home-cart">
                     @php
                        $showCheckout = 1;
                     @endphp
               		@include('website.homepage-cart')
               </div>
               @endif
            </div>
         </div>
      </section>
<!-- @include('website.layout.quick-links') -->

@endsection