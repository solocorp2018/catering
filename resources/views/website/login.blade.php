<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="add-address">Login</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="login-form" action="{{ url('/customer/login') }}" method="post">
                        @csrf
                              <div class="form-label-group">
                                 <input type="number" id="inputEmail" name="contact_number" class="form-control" placeholder="Mobile Number">
                                 <label for="inputEmail">Mobile Number</label>
                              </div>
                              <div class="text-center pt-3">
                                 Don’t have an account? <a class="font-weight-bold openRegisterModal" data-toggle="modal" data-target="#register-modal" href="/register">Register</a>
                              </div>

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
