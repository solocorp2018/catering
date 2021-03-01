@extends('admin.layouts.layout')
@section('title', env('APP_GLOBAL_NAME'))
@section('content')
<link href="{{asset('packa/theme/dist/css/pages/dashboard4.css')}}" rel="stylesheet">

<style type="text/css">
   .round-custom {
   line-height: 48px;
   color: #736060;
   width: 50px;
   height: 50px;
   display: inline-block;
   text-align: center;
   font-size: 40px;
   }
   .round-custom i {
   color: #342e4c;
   }
</style>
<div class="page-wrapper">
   <!-- ============================================================== -->
   <!-- Container fluid  -->
   <!-- ============================================================== -->
   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      @if(session()->has('success'))
      <div class="alert alert-success alert-rounded">
            {{session()->get('success')}}
      </div>
      @endif

      <div class="row">
         <div class="col-lg-12">
            <div class="row">
                <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Active Customers</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-primary"><i class="icon-emotsmile"></i></span>
                           <a href="{{url('customers')}}" class="link display-5 ml-auto">{{$activeCustomerCount}}</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
               <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-info"><i class="icon-handbag"></i></span>
                           <a href="{{url('orders')}}" class="link display-5 ml-auto">{{$totalOrderCount}}</a>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Today Orders</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-purple"><i class="icon-basket"></i></span>
                           <a href="{{url('orders')}}" class="link display-5 ml-auto">{{$todayOrderCount}}</a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Current Active Menus</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-purple"><i class="icon-cup"></i></span>
                           <a href="{{url('sessionMenus')}}" class="link display-5 ml-auto">{{$activeMenusNow}}</a>
                        </div>
                     </div>
                  </div>
               </div>
              
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Today Total Order Amount</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-success"><i class="icon-wallet"></i></span>
                           <a href="{{url('orders')}}" class="link display-5 ml-auto">{{$todayOrderAmount}}</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
                 <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Today Order Amount Recieved</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-success"><i class="icon-credit-card"></i></span>
                           <a href="{{url('orders')}}" class="link display-5 ml-auto">{{$todayRecievedOrderAmount}}</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
                 <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Today Order Amount Pending</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-danger"><i class="icon-hourglass"></i></span>
                           <a href="{{url('orders')}}" class="link display-5 ml-auto">{{$todayPendingOrderAmount}}</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
            </div>
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- End PAge Content -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->                
   </div>
   <!-- ============================================================== -->
   <!-- End Container fluid  -->
   <!-- ============================================================== -->
</div>
<script src="{{asset('packa/theme/assets/node_modules/skycons/skycons.js')}}"></script>
@endsection