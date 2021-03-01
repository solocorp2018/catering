@extends('admin.layouts.layout')
@section('title', 'List Items')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Session Menu</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Session Menu</li>
               </ol>
               <a class="btn btn-info d-none d-lg-block m-l-15" href="{{route('sessionMenus.create')}}"><i class="fa fa-plus-circle"></i> Create New</a>
            </div>
         </div>
      </div>
      <div class="card">
         <div class="card-body">
            <div class="table-responsive m-t-40">
               <div id="myTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">                 
                  <div class="dataTables_filter" aria-controls="myTable_wrapper">
                     <label>Show </label>
                     <select name="pageLength" id="pageLength" aria-controls="myTable" on-change="searchFun()">
                     <option value="10" {{SELECT('10',request('pageLength',10))}}>10</option>
                     <option value="25" {{SELECT('25',request('pageLength',25))}}>25</option>
                     <option value="50" {{SELECT('50',request('pageLength',50))}}>50</option>
                     <option value="100" {{SELECT('100',request('pageLength',100))}}>100</option>
                     </select>
                  </div>
                  <div class="dataTables_filter"  aria-controls="myTable_wrapper">
                     <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="myTable" id="keyword" value="{{request('keyword')}}"></label>
                     <input type="hidden" name="sortfield" id="sortfield" value="{{request('sortfield')}}"/>
                     <input type="hidden" name="sorttype" id="sorttype" value="{{request('sorttype')}}"/>
                  </div>
                  

                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>Session Type</th>
                                 <th>
                                    <a class="sort" data-column="code">
                                       <i class="fa fa-sort" aria-hidden="true"></i>&nbsp;Session Code
                                 </th>
                                 <th>Item(s)</th>
                                 <th><a class="sort" data-column="open"><i class="fa fa-sort" aria-hidden="true"></i>&nbsp;Opening Time</a></th>
                                 <th><a class="sort" data-column="close"><i class="fa fa-sort" aria-hidden="true"></i>&nbsp;Closing Time</a></th>                                        
                                 <th>Live Status</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($results) && $results->count())
                              @foreach($results as $result)
                              <tr>
                                 <td>{{$result->sessionType->type_name ?? ''}}</td>
                                 <td>{{$result->session_code ?? ''}}</td>
                                 <td>{{$result->sessionItem->count() ?? 0}}</td>
                                 <td>{{dateOf($result->opening_time) ?? ''}}</td>
                                 <td>{{dateOf($result->closing_time) ?? ''}}</td>                                 
                                 <td>
                                    @if(isOpenForOrder($result->opening_time,$result->closing_time) == 1)
                                    <a href="{{url('/')}}" target="_blank"><span class="text-success">Open</span></a>
                                    @elseif(isOpenForOrder($result->opening_time,$result->closing_time) == 2)
                                    <span class="text-warning">Upcoming</span>
                                    @else
                                    <span class="text-danger">Closed</span>
                                    @endif
                                 </td>
                                 <td>
                                    @if(isset($result->status) && $result->status == 1)
                                    <span class="text-success">Active</span>
                                    @else
                                    <span class="text-danger">In Active</span>
                                    @endif
                                 </td>
                                 <td>
                                    <a class="waves-effect waves-dark" href="{{route('sessionMenus.show',$result->id)}}"><i class="fa fa-eye"></i></a>
                                    <a class="waves-effect waves-dark" href="{{route('sessionMenus.edit',$result->id)}}"><i class="fa fa-edit"></i></a>
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
         <!-- Table Html -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
     setPageUrl('/sessionMenus?');
   });
</script>
@endsection