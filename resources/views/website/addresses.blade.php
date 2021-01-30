

                           <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                           <div class="row">

                              @if(!empty($userData->userAddress))

                              @foreach($userData->userAddress as $userAddresses)
                              <div class="col-md-6">
                                 <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                    <div class="gold-members p-4">
                                       <div class="media">
                                          <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                          <div class="media-body">
                                             <!-- <h6 class="mb-1 text-secondary">Home</h6> -->
                                             <p class="text-black">{{$userAddresses->address_line_1 ?? ''}} 
                                             </p>
                                             @if($userAddresses->address_line_2) 
                                             <p class="text-black">{{$userAddresses->address_line_2 ?? ''}} 
                                             </p>
                                             @endif
                                             <p class="text-black">{{$userAddresses->city ?? ''}} {{ - $userAddresses->pincode ?? ''}} 
                                             </p>
                                             <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3" data-toggle="modal" data-target="#add-address-modal" href="#"><i class="icofont-ui-edit"></i> EDIT</a> <a class="text-danger" data-toggle="modal" data-target="#delete-address-modal" href="#"><i class="icofont-ui-delete"></i> DELETE</a></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                              @else
                              No Address Found !
                              @endif
                              
                           </div>
                           
                        

                        @include('website.addresses-modal')