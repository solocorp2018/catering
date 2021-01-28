@extends('admin.layouts.layout')
@section('title', 'Create Item')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Item</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('items.index')}}">Item</a></li>
                    <li class="breadcrumb-item active">Create Item</li>
                </ol>                
            </div>
        </div>
    </div>
      <div class="row">
                    <div class="col-md-12">
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
                                    <form action="{{route('items.store')}}" enctype="multipart/form-data" method="post">
                                        {{csrf_field()}}

                                        <div class="row pt-3">
                                            <div class="form-group col-sm-6 col-xs-6">
                                                <label for="name" class="required">Item Name</label>
                                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Item Name" value="{{old('name')}}">
                                            </div> 

                                            <div class="form-group col-sm-6 col-xs-6">
                                                <label for="lang1_name" class="required">Item Name (Lang 1)</label>
                                                <input type="text" name="lang1_name" class="form-control" id="lang1_name" placeholder="Enter Item Name (Lang 1)" value="{{old('lang1_name')}}"> 
                                            </div>     
                                        </div>


                                        <div class="row pt-3">
                                            <div class="form-group col-sm-6 col-xs-6">
                                                <label for="description">Description </label>
                                                <textarea class="form-control" name="description" rows="5">{{old('description')}}</textarea>
                                            </div>      

                                            <div class="form-group col-sm-6 col-xs-6">
                                                <label for="lang1_description">Description ( Lang 1) </label>
                                                <textarea class="form-control" name="lang1_description" rows="5">{{old('lang1_description')}}</textarea>
                                            </div>      
                                        </div>

                                        <div class="row pt-3">
                                            <div class="form-group col-sm-3 col-xs-3">
                                                <label for="image" class="">Image </label>
                                                <input type="file" name="image" class="form-control" id="formField3" aria-describedby="fileHelp">
                                            </div> 
                                            <div class="form-group col-sm-3 col-xs-3">
                                                <label for="quantity_type" class="required">Quantity Type </label>
                                                <select name="quantity_type" id="quantity_type" class="form-control">
                                                    @foreach($quantityTypes as $quantity)
                                                    <option value="{{$quantity->id}}">{{$quantity->name}}</option>
                                                    @endforeach                
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-3 col-xs-3">
                                                <label for="image" class="required">Price </label>
                                                <input type="text" name="price" class="form-control" id="price" placeholder="Enter Item Price" value="{{old('price')}}">
                                            </div> 
                                            <div class="form-group col-sm-3 col-xs-3">
                                                <label for="status" class="required">Status </label>
                                                <select name="status" id="status" class="form-control">
                                                    @foreach($statuses as $key => $value)
                                                    <option value="{{$value}}">{{$key}}</option>
                                                    @endforeach                
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <hr>                
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