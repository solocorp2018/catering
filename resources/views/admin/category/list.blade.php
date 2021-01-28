@extends('layouts.layout')
@section('title', 'List Category')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Category</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category</li>
                </ol>
                <a class="btn btn-info d-none d-lg-block m-l-15" href="{{route('category.create')}}"><i class="fa fa-plus-circle"></i> Create New</a>
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
                        <div class="row">

                           <div class="col-sm-12 col-md-6">
                              <div class="dataTables_length" id="myTable_length">
                                 <label>
                                    Show 
                                    <select name="myTable_length" aria-controls="myTable" class="form-control form-control-sm">
                                       <option value="10">10</option>
                                       <option value="25">25</option>
                                       <option value="50">50</option>
                                       <option value="100">100</option>
                                    </select>
                                    entries
                                 </label>
                              </div>
                           </div>

                           <div class="col-sm-12 col-md-6">
                              <div  class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="myTable"></label></div>
                           </div>

                        </div>

                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-hover">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Parent</th>
                                       <th>Image</th>
                                       <th>Status</th>
                                       <th>CreatedAt</th>
                                       <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                  @if(!empty($results) && $results->count())
                                  @foreach($results as $result)
                                    <tr>
                                       <td>{{$result->name}}</td>
                                       <td>{{$result->parent_category->name ?? ''}}</td>
                                       <td>{{$result->category_image->fileUrl ?? ''}}</td>
                                       <td>{{findStatus($result->status)}}</td>
                                       <td>{{$result->created_at}}</td>
                                       <td><i class="fa fa-pencil"></i></td>                                      
                                    </tr>
                                  @endforeach
                                  @else
                                  <tr> 
                                    <td collspan="4">No Records Found..</td>
                                  </tr>
                                  @endif
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-md-6">
                              <div>
                                   @if($results->count())              
                                        Showing {{$results->firstItem()}} to {{$results->lastItem()}} of {{ $results->total() }} entries
                                        
                                    @endif
                              </div>
                           </div>
                           <div class="col-sm-12 col-md-6">
                              <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate">
                                 {{ $results->links() }}
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
@endsection