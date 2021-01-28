@extends('website.layout.layout')
@section('content')
@section('title','Thank You')
	
	<section class="section pt-5 pb-5 osahan-not-found-page">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center pt-5 pb-5">
                  <img class="img-fluid mb-5" style="margin-top: -80px!important;" src="{{asset('website/img/thanks.png')}}" alt="404">
                  <h1 class="mt-2 mb-2 text-success">Congratulations!</h1>
                  <p class="mb-5">You have successfully placed your order</p>
                  <a class="btn btn-primary btn-lg" href="{{url('track-order')}}">View Order</a>
                  <a class="btn btn-primary btn-lg" href="{{url('/')}}">Home</a>
               </div>
            </div>
         </div>
      </section>

@endsection