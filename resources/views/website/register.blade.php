<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="add-address">Register</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="register-form">
                    <div id="errors" style="margin-left: -40px;"></div>
                      <div class="form-label-group">
                         <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
                         <label for="name" class="required">Name</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="contact_number" name="contact_number" class="form-control" placeholder="Enter Mobile Number">
                         <label for="contact_number" class="required">Mobile Number</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP">
                         <input type="hidden" id="otpVerified" name="otpVerified" class="form-control" value="">
                         <label for="otp" class="required">OTP</label>
                      </div>
                      <div class="form-label-group">
                         <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Address">
                         <label for="email">Email Address</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="address_line_1" name="address_line_1" class="form-control" placeholder="Enter Address Line 1">
                         <label for="address_line_1" class="required">Address Line 1</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="address_line_2" name="address_line_2" class="form-control" placeholder="Enter Address Line 2">
                         <label for="address_line_2">Address Line 2</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="city" name="city" class="form-control" placeholder="City">
                         <label for="city" class="required">City</label>
                      </div>
                      <div class="form-label-group">
                         <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode">
                         <label for="pincode" class="required">Pincode</label>
                      </div>
                      <div class="text-center pt-3 mb-2">
                         Do you have account already? <a class="font-weight-bold openLoginModal" data-toggle="modal" data-target="#login-modal" href="#">Login</a>
                      </div>
                      <div class="modal-footer">
                         <button type="button" class="btn d-flex w-50 text-center justify-content-center btn-outline-primary" data-dismiss="modal">CANCEL
                         </button>
                         <button type="submit" class="btn d-flex w-50 text-center justify-content-center btn-primary">SUBMIT</button>
                      </div>
                   </form>
               </div>
            </div>
         </div>
      </div>
