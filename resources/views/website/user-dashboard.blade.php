@extends('website.layout.layout')
@section('content')
@section('title','Order History')


      
      
	<section class="section pt-4 pb-4 osahan-account-page">
         <div class="container">
            <div class="row">
               <div class="col-md-3">
                  <div class="osahan-account-page-left shadow-sm bg-white h-100">
                     <div class="border-bottom p-4">
                        <div class="osahan-user text-center">
                           <div class="osahan-user-media">
                              <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{asset('website/img/user/no-user.jpg')}}" alt="gurdeep singh osahan">
                              <div class="osahan-user-media-body">
                                 <h6 class="mb-2">User 1</h6>
                                 <p class="mb-1">+91 999999999</p>
                                 <p>user@mailinator.com</p>                                 
                              </div>
                           </div>
                        </div>
                     </div>
                     <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true"><i class="icofont-food-cart"></i> Orders</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="osahan-account-page-right shadow-sm bg-white p-4 h-100">
                     <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                           @include('website.order-history')
                        </div>

                        <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                           @include('website.addresses')
                        </div>

                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection