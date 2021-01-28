@extends('website.layout.layout')
@section('content')
@section('title','Track Order')
	
	      <section class="section bg-white osahan-track-order-page position-relative">
         <iframe class="position-absolute" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13696.650704896498!2d75.82434255!3d30.8821099!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1555184720550!5m2!1sen!2sin" width="100%" height="676" frameborder="0" style="border:0" allowfullscreen></iframe>
         <div class="container pt-5 pb-5">
            <div class="row d-flex align-items-center">
               <div class="col-md-6 text-center pb-4">
                  <div class="osahan-point mx-auto"></div>
               </div>
               <div class="col-md-6">
                  <div class="bg-white p-4 shadow-lg mb-2">
                     <div class="mb-2"><small>Order #25102589748<a class="float-right font-weight-bold" href="#"><i class="icofont-headphone-alt"></i> HELP</a></small></div>
                     <h6 class="mb-1 mt-1"><a href="{{url('/')}}" class="text-black">M.R Grandson Caters
                        </a>
                     </h6>
                     <p class="text-gray mb-0"><i class="icofont-clock-time"></i> 04:19 PM | 2 Items | 150 INR</p>
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
                              <p class="text-gray mb-5">Avinashi Road, Coimbatore</p>
                              <small>DELIVER TO</small>
                              <h6 class="mb-1 mt-1"><span class="text-black"><i class="icofont-map-pins"></i> Other
                                 </span>
                              </h6>
                              <p class="text-gray mb-0">Work, Tidel Park, Coimbatore- 641141</p>
                           </div>
                           <div class="col-md-7">
                              <div class="mb-2"><small><i class="icofont-list"></i> 2 ITEMS</small></div>
                              <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> 5 * Idly <span class="float-right text-secondary">50 INR</span></p>
                              <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> 2 * Ghee Roast <span class="float-right text-secondary">100 INR</span></p>
                              <hr>
                              <p class="mb-0 font-weight-bold text-black">TOTAL BILL <span class="float-right text-secondary">150 INR</span></p>
                              <p class="mb-0 text-info"><small>Payment On Delivery
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
                           <small class="text-primary mb-0">LATER (ET : 30min)</small>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

@endsection