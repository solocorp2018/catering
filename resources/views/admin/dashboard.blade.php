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
                        <h5 class="card-title">Total Orders</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-info"><i class="icon-trophy"></i></span>
                           <a href="javscript:void(0)" class="link display-5 ml-auto">100</a>
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
                           <span class="display-5 text-purple"><i class="icon-hourglass"></i></span>
                           <a href="javscript:void(0)" class="link display-5 ml-auto">20</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Today Amount</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-primary"><i class="icon-close"></i></span>
                           <a href="javscript:void(0)" class="link display-5 ml-auto">30</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- column -->
               <div class="col-md-3">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Total Customers</h5>
                        <div class="d-flex m-t-30 m-b-20 no-block align-items-center">
                           <span class="display-5 text-success"><i class="icon-graph"></i></span>
                           <a href="javscript:void(0)" class="link display-5 ml-auto">100</a>
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