@extends('auth.layouts.layout')
@section('content')

 <section id="wrapper" class="login-register login-sidebar" style="background-image:url({{asset('packa/theme/assets/images/background/auth-back.jpg')}});">
        <div class="login-box card">
            <div class="card-body">

                <form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('login') }}">

                    @csrf
                    
                    <a href="javascript:void(0)" class="db"><img src="{{logo()}}" alt="Logo" width="100px" /><br/>
                    


                    @if(count($errors))                    
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <p style="color:red;">These credentials do not match our records</p>             
                        </div>                        
                    </div>
                    @endif

                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" required="" name="email" value="{{old('email')}}" placeholder="{{ __('Username') }}">
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="{{ __('Password') }}">
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember_me" id="customCheck1" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="customCheck1">{{ __('Remember Me') }}</label>
                                </div> 
                                <div class="ml-auto">
                                    <!-- <a href="{{ route('password.request') }}" class="text-muted"><i class="fas fa-lock m-r-5"></i> {{ __('Forgot Your Password?') }}</a> --> 
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">{{ __('Login') }}</button>
                        </div>
                    </div>

                    <!-- <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <button class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fab fa-facebook-f"></i> </button>
                                <button class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fab fa-google-plus-g"></i> </button>
                            </div>
                        </div>
                    </div> -->
                    
                </form>

                <!-- <form class="form-horizontal" id="recoverform" action="">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form> -->
            </div>
        </div>
    </section>
@endsection