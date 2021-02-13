@extends('admin.layouts.layout')
@section('title', 'View Order')
@section('content')
<div class="page-wrapper">
<div class="container-fluid">
<div class="row page-titles">
   <div class="col-md-5 align-self-center">
      <h4 class="text-themecolor">View Order</h4>
   </div>
   <div class="col-md-7 align-self-center text-right">
      <div class="d-flex justify-content-end align-items-center">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{route('orders.index')}}">Order</a></li>
         </ol>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-lg-12 card">
      <div class="card-body">
         <div class="row">
            <div class="col-md-3 col-xs-6 b-r">
               <strong>Order ID</strong>
               <br>
               <a class="" href="{{route('order.invoice',$result->id)}}">#{{$result->order_unique_id ?? ''}}</a>
            </div>
            <div class="col-md-3 col-xs-6 b-r">
               <strong>Amount</strong>
               <br>
               <p class="text-muted">{{$result->total_amount ?? ''}}</p>
            </div>
            @if(!empty($result->payment))                        
            <div class="col-md-3 col-xs-6">
               <strong>Payment mode</strong>
               <br>
               @if($result->payment->payment_mode && $result->payment->payment_mode == 1)
               <p class="text-muted">Gpay</p>
               @else
               <p class="text-muted">Cash</p>
               @endif
            </div>                        
            <div class="col-md-3 col-xs-6">
               <strong>Payment Status</strong>
               <br>
               @if($result->payment->payment_status == 1)
               <p class="text-muted">Paid</p>
               @else
               <p class="text-muted">Pending</p>
               @endif
            </div>            
            <div class="col-md-3 col-xs-6">
               <strong>Payment date</strong>
               <br>
               <p class="text-muted">{{showDate($result->payment->payment_date,'d/M/Y') ?? ''}}</p>
            </div>
            @else
            <div class="col-md-3 col-xs-6">
               <strong>Payment Status</strong>
               <br>               
               <p class="text-muted">Pending</p>               
            </div>
            @endif
         </div>
         <hr>
         <div class="row">
            <div class="col-md-12 col-xs-6">
               
               <table class="table table-hover color-table muted-table">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Menu Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(isset($result->orderItems) && !empty($result->orderItems))
                     @foreach($result->orderItems as $key => $orderItems)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$orderItems->item->name ?? ''}}</td>
                        <td >{{$orderItems->quantity ?? ''}}</td>
                        <td >{{$orderItems->amount_per_item}} INR</td>
                        <td >{{$orderItems->total_amount}} INR</td>
                     </tr>
                     @endforeach

                     <tr>
                        <td colspan="3"></td>
                        <td > <strong>Item Total : </strong></td>
                        <td > <strong>{{$result->orderItems->sum('total_amount')}} INR </strong></td>
                     </tr>
                     @endif
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
@endsection
