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