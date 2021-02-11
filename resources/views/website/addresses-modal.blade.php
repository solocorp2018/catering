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
                  <form action="{{route('add.address')}}" method="post" id="add-address-form">
                     @csrf
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Address Line 1</label>
                           <div class="input-group">
                              <input type="text" name="address_line_1" id="address_line_1" class="form-control" placeholder="Address Line 1">
                              <div class="input-group-append">
                                 <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="icofont-ui-pointer"></i></button>
                              </div>
                           </div>
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Address Line 2
                           </label>
                           <input type="text" name="address_line_2" id="address_line_2" class="form-control" placeholder="Address Line 2">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">City
                           </label>
                           <input type="text" name="city" id="city" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="inputPassword4">Pincode
                           </label>
                           <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode">
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="reset" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                        </button><button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
                     </div>
                  </form>
               </div>
               
            </div>
         </div>
      </div>

      <div class="modal fade" id="delete-address-modal" tabindex="-1" role="dialog" aria-labelledby="delete-address" aria-hidden="true">
         <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="delete-address">Delete</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <p class="mb-0 text-black">Are you sure you want to delete this xxxxx?</p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                  </button><button type="button" class="btn d-flex w-50 text-center justify-content-center btn-primary">DELETE</button>
               </div>
            </div>
         </div>
      </div>