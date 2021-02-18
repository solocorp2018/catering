@extends('admin.layouts.layout')
@section('title', 'List Orders')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Orders</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Orders</li>
               </ol>
            </div>
         </div>
      </div>

      <div class="row">
         <div class="col-lg-12">

            <div class="card">
               <div class="card-body">
                  <div class="d-flex">
                    <div class="ml-auto">
                        <label>Payment Status 
                            <select name="status" class="form-control form-control-line searchable" onchange="searchFun()">                                   
                                @foreach($paymentStatus as $status)
                            <option value="{{$status['name']}}" {{SELECT($status['name'],request('status',$status['name']))}}>{{$status['name']}}</option>
                            @endforeach
                            </select>  
                            </label>
                     </div>
                      <div class="ml-auto">
                        <label>From Date
                        <input type="date" placeholder="From Date" name="from" class="form-control form-control-line searchable" aria-controls="myTable" value="{{request('from')}}">
                        </label>
                     </div>
                     <div class="ml-auto">
                        <label>To Date
                        <input type="date" placeholder="To Date" name="to" class="form-control form-control-line searchable" aria-controls="myTable" value="{{request('to')}}">
                        </label>
                     </div>
                     <div class="ml-auto">
                        <button type="button" class="btn btn-info d-none d-lg-block" onClick="searchFun()"> <i class="fas fa-search"></i>&nbsp;Search</button>
                     </div>
                      <div class="ml-auto">
                        <button type="button" class="btn btn-info d-none d-lg-block resetSearch" onClick="resetSearch()"> <i class="fas fa-refresh"></i>&nbsp;Reset</button>
                     </div>
                     <div class="ml-auto">
                        <a href="{{url('orders-export')}}" class="btn btn-info d-none d-lg-block"> <i class="fas fa-downlaod"></i>&nbsp;Export</a>
                     </div>
                    
                     <div class="ml-auto">
                        <button type="button" class="btn btn-info d-none d-lg-block capture_payment_button">Capture Payment</button>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card">
               <div class="card-body">
                 
                @include('admin.common.table-filter')               

                  <div class="table-responsive m-t-40">
                     <div id="myTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th><input type="checkbox" id="pickAll"/></th>
                                 <th><a class="sort" data-column="order_no"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order No.</a></th>
                                 <th><a class="sort" data-column="date"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order Date</a></th>
                                 <th><a class="sort" data-column="amount"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order Amount</a></th>
                                 <th>Total Items</th>
                                 <th>Session Code</th>
                                 <th>Payment Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($results) && $results->count())
                              @foreach($results as $result)
                              <tr>
                                 <td><input type="checkbox" name="capture_payment" {{(!empty($result->payment) && $result->payment->payment_status == 2)?'disabled=disabled':'class=capture_payment'}} value="{{$result->id}}" /></td>
                                 <td>#{{$result->order_unique_id ?? '--'}}</td>
                                 <td>{{dateOf($result->order_date) ?? ''}}</td>
                                 <td>{{$result->total_amount ?? 0}}</td>
                                 <td>{{$result->orderItems->count() ?? 0}}</td>
                                 <td>{{$result->sessionMenu->session_code ?? '--'}}</td>
                                 <td>@if(!empty($result->payment) && $result->payment->payment_status == 2) Paid @else Pending @endif</td>
                                 <td>
                                    <a class="waves-effect waves-dark" href="{{route('orders.show',$result->id)}}"><i class="fa fa-eye"></i></a>
                                    &nbsp;&nbsp;&nbsp;                      
                                    <a class="" href="{{route('order.invoice',$result->id)}}"><i class="fa fa-download"></i></a>
                                    @if(empty($result->payment))
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="waves-effect waves-dark" data-id="{{$result->id}}" id="updatePayment{{$result->id}}"><i class="fa fa-file"></i></a>
                                    @endif
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td collspan="6">No Records Found..</td>
                              </tr>
                              @endif
                           </tbody>
                        </table>
                        @include('admin.common.table-footer')
                     </div>
                  </div>
               </div>
            </div>
            <!-- Table Html -->
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
   <div class="modal-dialog modal-dialog-centered" style="max-width:900px!important;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Payment Update<span></span></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form class="form-group" method="post" id="paymentForm" action="{{ route('payment.updateStatus',0) }}">
               <div class="form-label-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <label for="name" class="required">Payment Date</label>
                  <input type="date" name="payment_date" id="payment_date" class="form-control" format="d/m/Y">
               </div>
               <div class="form-label-group">
                  <label for="name">Payment Mode</label>
                  <select name="payment_mode" id="payment_mode" class="form-control">
                  @foreach($paymentMode as $key => $value)
                  <option value="{{$value['id']}}" {{SELECT($value['id'],old('payment_mode'))}}>{{$value['name']}}</option>
                  @endforeach
                  </select>
               </div>
               <div class="form-label-group">
                  <label for="name">Transaction ID </label>
                  <input type="text" name="transaction_id" id="transaction_id" class="form-control">
               </div>
               <div class="form-label-group">
                  <label for="name">Comments</label>
                  <textarea name="comments" id="comments" class="form-control"></textarea>
               </div>
               <button class="btn btn-success waves-effect waves-light m-r-10" type="submit">Submit</button>
            </form>
            <br /><br />
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   var captureArray = [];
   
    $(document).ready(function(){
      setPageUrl('/orders?');
      
   
      $('[id^=updatePayment]').click(function() {
        $('#myModal').modal('toggle');
        var order_id = $(this).data('id');
         $('#payment_date').val();
         $('#payment_mode').val();
         $('#transaction_id').val();
         $('#comments').val();
         $('#payment_status').val();
         var url = '{{ route("payment.updateStatus", ":id") }}';
         url = url.replace(':id', order_id);
         $("#paymentForm").attr('action', url);
      });
    });
    $(document).on('click','#pickAll',function(){
        
    if($(this).is(':checked')) {
        $('.capture_payment').attr('checked',true);
    } else {
        $('.capture_payment').attr('checked',false);
    }       
    });
   
    $(document).on('click','.capture_payment_button',function(){
   
            var captureArray = [];
    $("input:checkbox[name=capture_payment]:checked").each(function(){
            captureArray.push($(this).val());
    });
   
            if(captureArray.length > 0) {
        var formData = {
            _token:feedToken(), 
            captureArray:captureArray,  
        };  
        $.ajax({
            type: "POST",
            url: feedBaseUrl('/update-payment-status'),
            data: formData,
            success: function( data ) {                     
                searchFun();
                alert(data.message);                    
            }
        }); 
    }   else {
        alert('Please Select Atleast One Order to capture Payment.');
    }
    });
    
</script>
@endsection