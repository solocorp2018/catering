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
            <!-- Table Html -->
            <div class="card">
               <div class="card-body">
                  <div class="table-responsive m-t-40">
                     <div id="myTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row m-b-40">

                           <div class="col-sm-12 col-md-6">
                              <div class="dataTables_length" id="myTable_length">
                                 <label>Show </label>
                                    <select name="pageLength" id="pageLength" aria-controls="myTable" class="form-control form-control-sm" on-change="searchFun()">
                                       <option value="10" {{SELECT('pageLength',10)}}>10</option>
                                       <option value="25" {{SELECT('pageLength',25)}}>25</option>
                                       <option value="50" {{SELECT('pageLength',50)}}>50</option>
                                       <option value="100" {{SELECT('pageLength',100)}}>100</option>
                                    </select>
                                    <label> </label>

                              </div>
                           </div>

                           <div class="col-sm-12 col-md-6">
                              <div  class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="myTable" id="keyword" value="{{request('keyword')}}"></label></div>
                           </div>
                           <input type="hidden" name="sortfield" id="sortfield" value="{{request('sortfield')}}"/>
                           <input type="hidden" name="sorttype" id="sorttype" value="{{request('sorttype')}}"/>


                        </div>

                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-hover">
                                 <thead>
                                    <tr>

                                       <th><a class="sort" data-column="order_no"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order No.</a></th>
                                       <th><a class="sort" data-column="date"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order Date</a></th>
                                       <th><a class="sort" data-column="amount"><i class="fa fa-sort" aria-hidden="true"></i> &nbsp;Order Amount</a></th>
                                       <th>Total Items</th>                   
                                       <th>Payment Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>


                                  @if(!empty($results) && $results->count())
                                  @foreach($results as $result)
                                    <tr>

                                       <td>#{{$result->order_unique_id ?? '--'}}</td>
                                       <td>{{showDate($result->order_date,'d/M/Y') ?? ''}}</td>
                                       <td>{{$result->total_amount ?? 0}}</td>
                                       <td>{{$result->orderItems->count() ?? 0}}</td>
                                       <td>@if($result->payment_status == 1) Paid @else Pending @endif</td>
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
                           </div>
                        </div>
                        <div class="row m-b-40">
                           <div class="col-sm-12 col-md-6">
                              <div>
                                   @if(!empty($results) && $results->count())
                                        Showing {{$results->firstItem()}} to {{$results->lastItem()}} of {{ $results->total() }} entries

                                    @endif
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate">
                                @if(!empty($results))
                                 {{ $results->appends(request()->except(['page', '_token']))->links() }}
                                 @endif
                              </div>
                           </div>
                        </div>
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
</script>
@endsection
