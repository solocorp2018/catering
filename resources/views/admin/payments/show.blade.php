@extends('admin.layouts.layout')
@section('title', 'View Payment')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">

            <h4 class="text-themecolor">Payment</h4>

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
             
             <div class="row">
                 <div class="col-md-3 col-xs-6 b-r"> <strong>Order ID</strong>
                     <br>
                     <p class="text-muted">{{$result->order_id ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6 b-r"> <strong>Amount</strong>
                     <br>
                     <p class="text-muted">{{$result->amount ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Payment mode</strong>
                     <br>
                     
                       <p class="text-muted">{{findPaymentMode($result->payment_mode)}}</p>
                     
                 </div>
                 <!-- <div class="col-md-3 col-xs-6"> <strong>Recieved By</strong>
                     <br>
                     <p class="text-muted">{{$result->recievedBy[0]->name ?? '--'}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Paid By</strong>
                     <br>
                     <p class="text-muted">{{$result->paidBy[0]->name ?? '--'}}</p>
                 </div> -->
                 <div class="col-md-3 col-xs-6"> <strong>Payment Status</strong>
                     <br>
                    
                      <p class="text-muted">{{findPaymentStatus($result->payment_status)}}</p>
                    
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Payment date</strong>
                     <br>
                     <p class="text-muted">{{dateOf($result->payment_date) ?? ''}}</p>
                 </div>
             </div>
         </div>

         </div>
      </div>
   </div>
</div>
@endsection
