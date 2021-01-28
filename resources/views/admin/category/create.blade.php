@extends('layouts.layout')
@section('title', 'Create Category')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Category</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Category</a></li>
                    <li class="breadcrumb-item active">Create Category</li>
                </ol>                
            </div>
        </div>
    </div>
      <div class="row">
                    <div class="col-md-6">
                        <div class="card card-body">
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                          
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <form action="{{route('category.store')}}" enctype="multipart/form-data" method="post">
                                        {{csrf_field()}}

                                        @if($categories->count())
                                        <div class="form-group">
                                            <label for="formField1">Parent Category </label>
                                            <select class="form-control select2" name="parent_category_id">
                                                @foreach($categories as $key => $name)
                                                    <option value="{{$key}}" {{SELECT(old('parent_category_id'),$key)}}>{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>  
                                        @endif

                                        <div class="form-group">
                                            <label for="formField2" class="required">Category Name</label>
                                            <input type="text" name="name" class="form-control" id="formField2" placeholder="Enter Category Name" value="{{old('name')}}">
                                        </div>     

                                        <div class="form-group">
                                            <label for="formField3" class="required">Image </label>
                                            <input type="file" name="image" class="form-control" id="formField3" aria-describedby="fileHelp">
                                        </div> 

                                        <div class="form-group">
                                            <label for="formField5">Description </label>
                                            <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>
                                        </div>      

                                        <div class="form-group">
                                            <label for="formField5" class="required">Status </label>
                                             <input type="checkbox" name="status" checked value="{{old('status',1)}}" class="js-switch" data-color="#f62d51" data-size="small" />
                                        </div>
                                                                             
                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                                        <button type="reset" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
   </div>
</div>
@endsection