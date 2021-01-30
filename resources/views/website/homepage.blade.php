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

                  <div class="col-md-4">
                     <div class="restaurant-detailed-header-right text-right">
                        <button class="btn btn-info" type="button"><i class="icofont-clock-time"></i> Order Opens Till 12:30 PM
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </section>

      <section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  
                  <ul class="nav" id="pills-tab" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">BREAKFAST
                           <span class="badge badge-success">open</span>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a class="nav-link" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">LUNCH
                           <span class="badge badge-danger">closed</span>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a class="nav-link" id="pills-order-online-tab" data-toggle="pill" href="#pills-order-online" role="tab" aria-controls="pills-order-online" aria-selected="true">DINNER
                           <span class="badge badge-danger">closed</span>
                        </a>
                     </li>

                     <!-- <li class="nav-item">
                        <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill" href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info" aria-selected="false">SELF PICKUP</a>
                     </li> -->
                     
                  </ul>
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
                        <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">                         
                           <div class="row">
                              <h5 class="mb-4 mt-3 col-md-12">Morning Menu List <small class="h6 text-black-50">3 ITEMS</small></h5>
                              <div class="col-md-12">
                                 <div class="bg-white rounded border shadow-sm mb-4">
                                    <div class="gold-members p-3 border-bottom">
                                       <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Idly <small>( Sambar, Chutny )</small></h6>

                                             <p class="text-gray mb-0">10 INR</p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="gold-members p-3 border-bottom">
                                       <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>

                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Pongal <small>( 1 Vadai, Sambar, Chutny )</small></h6>
                                             <p class="text-gray mb-0">30 INR</p>
                                          </div>
                                       </div>

                                    </div>
                                    <div class="gold-members p-3">
                                       <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                          <div class="media-body">
                                             <h6 class="mb-1">Ghee Roast <small>( Sambar, Chutny )</small></h6>
                                             <p class="text-gray mb-0">50 INR</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                        
                        <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                           <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                              <div class="address-map float-right ml-5">
                                 <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                                 </div>
                              </div>
                              <h5 class="mb-4">Restaurant Info</h5>
                              <p class="mb-3">Jagjit Nagar, Near Railway Crossing,
                                 <br> Near Model Town, Ludhiana, PUNJAB
                              </p>
                              <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> +91 01234-56789, +91 01234-56789</p>
                              <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i> <a href="#" class="__cf_email__" data-cfemail="">[email&#160;protected]</a>, <a href="#" class="__cf_email__" data-cfemail="">[email&#160;protected]</a></p>
                              <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i> Today 11am – 5pm, 6pm – 11pm
                                 <span class="badge badge-success"> OPEN NOW </span>
                              </p>
                              <hr class="clearfix">
                              <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p>
                              <hr class="clearfix">
                              <h5 class="mt-4 mb-4">More Info</h5>
                              <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali, Laccha Paratha, Butter Naan</p>
                              <div class="border-btn-main mb-4">
                                 <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                 <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                 <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                 <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                                 <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                 <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                 <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                              </div>
                           </div>
                        </div>

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