<<<<<<< HEAD
@extends('layouts.layout')
@section('title', 'View Category')
=======
@extends('admin.layouts.layout')
@section('title', 'View Payment')
>>>>>>> renuka02
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
                     @if(isset($result->payment_mode) && $result->payment_mode == 1)
                       <p class="text-muted">Cash</p>
                     @else
                       <p class="text-muted">ATM Card</p>
                     @endif
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Recieved By</strong>
                     <br>
                     <p class="text-muted">{{$result->recievedBy[0]->name ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Paid By</strong>
                     <br>
                     <p class="text-muted">{{$result->paidBy[0]->name ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Payment Status</strong>
                     <br>
                    @if(isset($result->payment_status) && $result->payment_status == 1)
                      <p class="text-muted">Paid</p>
                    @else
                      <p class="text-muted">Pendig</p>
                    @endif
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
