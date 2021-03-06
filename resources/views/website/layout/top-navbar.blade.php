<nav class="navbar navbar-expand-lg navbar-light bg-light osahan-nav shadow-sm">
         <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"><img alt="logo" src="{{asset('website/img/logo/2.png')}}"height="45px"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                     <a class="nav-link" href="{{url('/')}}">Home </a>
                  </li>

                  @if(Auth::user())
                  <li class="nav-item dropdown">

                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img alt="User Image" src="{{asset('website/img/user/no-user.jpg')}}" class="nav-osahan-pic rounded-pill"> {{Auth::user()->name}}
                     </a>                     
                     <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                        <a class="dropdown-item" href="{{url('/user-dashboard#order-history')}}"><i class="icofont-food-cart"></i> Orders</a>
                        <a class="dropdown-item" href="{{url('/user-dashboard#addresses')}}"><i class="icofont-location-pin"></i> Addresses</a>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                                   
                     </div>

                  </li>

                  <li class="nav-item dropdown dropdown-cart">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="fas fa-shopping-basket"></i> Cart
                     <span class="badge badge-info">2</span>
                     </a>
                     <div class="dropdown-menu dropdown-cart-top p-0 dropdown-menu-right shadow-sm border-0">
                        <div class="dropdown-cart-top-body border-top p-4">
                           <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> 5 * Idly <span class="float-right text-secondary">50 INR</span></p>

                           <p class="mb-2"><i class="icofont-ui-press text-success food-item"></i> 2 * Ghee Roast <span class="float-right text-secondary">100 INR</span></p>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-4">
                           <p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">150 INR</span></p>
                           <small class="text-info">Delivery charges may apply</small>
                        </div>
                        <div class="dropdown-cart-top-footer border-top p-2">
                           <a class="btn btn-success btn-block btn-lg" href="{{url('checkout')}}"> Checkout</a>
                        </div>
                     </div>
                  </li>
                  @else
                  <li class="nav-item active">
                     <a class="nav-link openLoginModal" data-toggle="modal" data-target="#login-modal" href="/login">Login </a>
                  </li>
                  @endif
                  
                 

               </ul>
            </div>
         </div>
      </nav>
