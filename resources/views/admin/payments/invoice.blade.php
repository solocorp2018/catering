@extends('admin.layouts.layout')
@section('title', 'View Invoice')

@section('content')
<title>M.R Grandson Caters</title>
<link href="{{asset('website/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('website/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
<link href="{{asset('website/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
<link href="{{asset('website/css/osahan.css')}}" rel="stylesheet">
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h4 class="text-themecolor">Invoice</h4>

        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('payments.index')}}">Payment</a></li>
                </ol>
            </div>
        </div>
    </div>

      <div class="row">

         <div class="col-lg-12 card">

           <div class="card-body">


              <section class="section pt-5 pb-5">
              <div class="container">
                <div class="row">
                   <div class="col-md-8 mx-auto">
                      <div class="p-5 osahan-invoice bg-white shadow-sm">
                         <div class="row">
                         	<div class="col-md-6">
                               <p class="mb-1 text-black">M.R.Grandson Caters</strong></p>
                               <p class="mb-1 text-black">Order No: <strong>{{$result->order_unique_id}}</strong></p>
                               <p class="mb-1">Order placed at: <strong>{{$result->order_date}}</strong></p>
                               <p class="mb-4 mt-2">
                                  <a class="text-primary font-weight-bold" onClick="window.print()" href="#"><i class="icofont-print"></i> PRINT</a>
                               </p>
                            </div>
                         	<div class="col-md-6">
                               <p class="mb-1">Ordered From :</p>
                               <h6 class="mb-1 text-black">{{$result->processedBy->name ?? ''}}</h6>
                               <p class="mb-1">{{$result->deliveredAddress->address_line_1 ?? ''}},  {{$result->deliveredAddress->address_line_2 ?? ''}}, {{$result->deliveredAddress->city ?? ''}}, {{$result->deliveredAddress->pincode ?? ''}}</p>
                            </div>
                         </div>
                         <div class="row mt-2">
                            <div class="col-md-12">
                               <table class="table mt-1 mb-0">
                                  <thead class="thead-light">
                                     <tr>
                                        <th class="text-black" scope="col">Item Name</th>
                                        <th class="text-right text-black" scope="col">Quantity</th>
                                        <th class="text-right text-black" scope="col">Price</th>
                                     </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($result->orderItems as $key => $orderItems)
                                     <tr>
                                        <td>{{$orderItems->menuItems->Items->name ?? ''}}</td>
                                        <td class="text-right">{{$orderItems->quantity ?? ''}}</td>
                                        <td class="text-right">${{$orderItems->total_amount}}</td>
                                     </tr>
                                     @endforeach
                                     <tr>
                                        <td class="text-right" colspan="2">Item Total:</td>
                                        <td class="text-right">${{$result->total_amount}}</td>
                                     </tr>
                                  </tbody>
                               </table>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
              </div>
              </section>
            </div>
          </div>
        </div>
    </div>
  </div>
  @endsection
