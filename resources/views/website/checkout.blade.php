@extends('website.layout.layout')
@section('content')
@section('title','Checkout')

<div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Delivery Area</label>
                           <div class="input-group">
                              <input type="text" class="form-control" placeholder="Delivery Area">
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Complete Address
                           </label>
                           <input type="text" class="form-control" placeholder="Complete Address e.g. house number, street name, landmark">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Delivery Instructions
                           </label>
                           <input type="text" class="form-control" placeholder="Delivery Instructions e.g. Opposite Gold Souk Mall">
                        </div>
                        <div class="form-group mb-0 col-md-12">
                           <label for="inputPassword4">Nickname
                           </label>
                           <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons">
                              <label class="btn btn-info active">
                              <input type="radio" name="options" id="option1" autocomplete="off" checked> Home
                              </label>
                              <label class="btn btn-info">
                              <input type="radio" name="options" id="option2" autocomplete="off"> Work
                              </label>
                              <label class="btn btn-info">
                              <input type="radio" name="options" id="option3" autocomplete="off"> Other
                              </label>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
               </div>
            </div>
         </div>
      </div>


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
                           <div class="col-md-6">
                              <div class="bg-white card addresses-item mb-4 border border-success">
                                 <div class="gold-members p-4">
                                    <div class="media">
                                       <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                       <div class="media-body">
                                          <h6 class="mb-1 text-black">Home</h6>
                                          <p class="text-black">Avinashi Road, Coimbatore -641414</p>
                                          <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-success mr-2" href="#"> DELIVER HERE</a>
                                             <span>30MIN</span>
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="bg-white card addresses-item mb-4">
                                 <div class="gold-members p-4">
                                    <div class="media">
                                       <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                       <div class="media-body">
                                          <h6 class="mb-1 text-secondary">Work</h6>
                                          <p>Tidel Park, Coimbatore - 641141</p>
                                          <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-secondary mr-2" href="#"> DELIVER HERE</a>
                                             <span>40MIN</span>
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="bg-white card addresses-item">
                                 <div class="gold-members p-4">
                                    <div class="media">
                                       <div class="mr-3"><i class="icofont-location-pin icofont-3x"></i></div>
                                       <div class="media-body">
                                          <h6 class="mb-1 text-secondary">Other</h6>
                                          <p>Railway Station, Coimbatore- 641467</p>
                                          <p class="mb-0 text-black font-weight-bold"><a class="btn btn-sm btn-secondary mr-2" href="#"> DELIVER HERE</a>
                                             <span>45MIN</span>
                                          </p>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
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

               <div class="col-md-4">
                  <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">                     
                     <h5 class="mb-1 text-white">Your Cart</h5>
                     <p class="mb-4 text-white">2 ITEMS</p>
                     <div class="bg-white rounded shadow-sm mb-2">
                        <div class="gold-members p-2 border-bottom">
                           <p class="text-gray mb-0 float-right ml-2"> 50 INR</p>
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
                     <?php /*
                     <div class="mb-2 bg-white rounded p-2 clearfix">
                        <div class="input-group input-group-sm mb-2">
                           <input type="text" class="form-control" placeholder="Enter promo code">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="button" id="button-addon2"><i class="icofont-sale-discount"></i> APPLY</button>
                           </div>
                        </div>
                        <div class="input-group mb-0">
                           <div class="input-group-prepend">
                              <span class="input-group-text"><i class="icofont-comment"></i></span>
                           </div>
                           <textarea class="form-control" placeholder="Any suggestions? We will pass it on..." aria-label="With textarea"></textarea>
                        </div>
                     </div>
                     */?>
                     <div class="mb-2 bg-white rounded p-2 clearfix">
                        <p class="mb-1">Item Total <span class="float-right text-dark">150 INR</span></p>
                        <p class="mb-1">Packing Charges <span class="float-right text-dark">0 INR</span></p>
                        <!-- <p class="mb-1">Delivery Fee <span class="text-info" data-toggle="tooltip" data-placement="top" title="Total discount breakup">
                           <i class="icofont-info-circle"></i>
                           </span> <span class="float-right text-dark">20 INR</span>
                        </p> -->
                        <!-- <p class="mb-1 text-success">Total Discount
                           <span class="float-right text-success">0 INR</span>
                        </p> -->
                        <hr />
                        <h6 class="font-weight-bold mb-0">TO PAY <span class="float-right">150 INR</span></h6>
                     </div>
                     <a href="{{url('thankyou')}}" class="btn btn-success btn-block btn-lg">PLACE ORDER
                     <i class="icofont-long-arrow-right"></i></a>
                  </div>
                 
               </div>
            </div>
         </div>
      </section>

@endsection