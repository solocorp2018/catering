@extends('admin.layouts.layout')
@section('title', 'List Payments')

@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Payments</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payments</li>

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


                                       <th><a class="sort" data-column="payment_no"><i class="fa fa-sort" aria-hidden="true"></i>Payment No.</a></th>
                                       <th>Order No.</th>
                                       <th>Total Items</th>
                                       <th>Payment Status</th>
<!--                                        <th>Processed By</th>
                                       <th>Delivered By</th>
 -->
                                       <th>Invoice</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                  @if(!empty($results) && $results->count())
                                  @foreach($results as $result)
                                    <tr>

                                       <td>#{{$result->payment_unique_id ?? '--'}}</td>
                                       <td>{{$result->order->order_unique_id ?? ''}}</td>

                                       <td>{{$result->order->total_amount ?? 0}} INR</td>
                                       
                                       <td>                                        
                                        @if(isset($result->payment_status))
                                        <span class="text-success">{{findPaymentStatus($result->payment_status)}}</span>
                                        @else
                                          <span class="text-danger">Pending</span>
                                        @endif
                                       </td>
                                       <td><a class="" href="{{route('order.invoice',$result->id)}}"><i class="fa fa-download"></i> Invoice</a></td>
                                       <!-- <td>{{$result->processedBy->name ?? "--"}}</td>
                                       <td>{{$result->deliveredBy->name ?? "--"}}</td> -->
                                      <td>
                                        <a class="waves-effect waves-dark" href="{{route('payments.show',$result->id)}}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                                        
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
<script type="text/javascript">
  $(document).ready(function(){

    setPageUrl('/payments?');
  });
</script>
@endsection
