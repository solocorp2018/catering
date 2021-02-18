@extends('admin.layouts.layout')
@section('title', 'List Complimentaries')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Complimentaries</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Complimentaries</li>
                </ol>            
                <a class="btn btn-info d-none d-lg-block m-l-15" href="{{route('complimentaries.create')}}"><i class="fa fa-plus-circle"></i> Create New</a>  
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
                           <div class="col-sm-6 col-md-6">
                              <div class="dataTables_length" id="myTable_length">
                                 <label>Show </label>
                                    <select name="pageLength" id="pageLength" aria-controls="myTable" on-change="searchFun()">
                                       <option value="10" {{SELECT('10',request('pageLength',10))}}>10</option>
                                       <option value="25" {{SELECT('25',request('pageLength',25))}}>25</option>
                                       <option value="50" {{SELECT('50',request('pageLength',50))}}>50</option>
                                       <option value="100" {{SELECT('100',request('pageLength',100))}}>100</option>
                                    </select>
                              </div>

	                           <div class="col-sm-6 col-md-6">
	                              <div  class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="myTable" id="keyword" value="{{request('keyword')}}"></label></div>	                              
		                           <input type="hidden" name="sortfield" id="sortfield" value="{{request('sortfield')}}"/>
		                           <input type="hidden" name="sorttype" id="sorttype" value="{{request('sorttype')}}"/>
	                           </div>
                           </div>



                        </div>

                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-hover">
                                 <thead>
                                    <tr>
                                       
                                       <th><a class="sort" data-column="name"><i class="fa fa-sort" aria-hidden="true"></i>Name</a></th>
                                      
                                       <th> Name (Lang 1) </th>          
                                       <th>Quantity Type</th>
                                       <th>Image</th>
                                       <th>Show with Item</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  
                                  @if(!empty($results) && $results->count())
                                  @foreach($results as $result)
                                    <tr>
                                      
                                       <td>{{$result->name ?? ''}}</td>
                                       <td>{{$result->lang1_name ?? ''}}</td>     
                                       
                                       <td>{{$result->quantityType->name ?? ""}}</td>  
                                       <td>
                                            @if(!empty($result->image_path))
                                                <image src="{{showDiskImage($result->image_path)}}" height="50" width="50"/>
                                            @else
                                                --
                                            @endif
                                            
                                        </td>   
                                        <td>
                                      @if(isset($result->is_visible) && $result->is_visible == 1)
                                        <span class="text-success">Active</span>
                                        @else
                                          <span class="text-danger">In-Active</span>
                                        @endif
                                      </td>
                                       <td>
                                        @if(isset($result->status) && $result->status == 1)
                                        <span class="text-success">Active</span>
                                        @else
                                          <span class="text-danger">In-Active</span>
                                        @endif
                                      </td>
                                      <td>
                                        <a class="waves-effect waves-dark" href="{{route('complimentaries.edit',$result->id)}}"><i class="fa fa-edit"></i></a>
                                        
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
<script type="text/javascript">
  $(document).ready(function(){
    setPageUrl('/complimentaries?');  
  }); 
</script>
@endsection