@extends('admin.layouts.layout')
@section('title', 'Create Item')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Customer</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('items.index')}}">Customer</a></li>
                    <li class="breadcrumb-item active">Create Customer</li>
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
                    <form action="{{route('customers.store')}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}

                    <div class="row pt-3">
                        <div class="form-group col-sm-6 col-xs-6">
                            <label for="name" class="required">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name')}}">
                        </div>

                        <div class="form-group col-sm-6 col-xs-6">
                            <label for="email" class="required">Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email')}}">
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="form-group col-sm-6 col-xs-6">
                            <label for="description">Contact Number </label>
                            <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Enter Contact Number" value="{{old('contact_number')}}">
                        </div>

                    </div>

                    <div class="row pt-3">
                      <div class="form-group col-sm-6 col-xs-6">
                          <label for="address1">Address Line 1 </label>
                          <textarea class="form-control" name="address_line_1" rows="1">{{old('address1')}}</textarea>
                      </div>
                      <div class="form-group col-sm-6 col-xs-6">
                          <label for="address2">Address Line 2 </label>
                          <textarea class="form-control" name="address_line_2" rows="1">{{old('address2')}}</textarea>
                      </div>

                      <div class="row pt-3">
                        <div class="form-group col-sm-6 col-xs-6">
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter City" value="{{old('city')}}">
                        </div>
                        <div class="form-group col-sm-6 col-xs-6">
                            <label for="pincode">Pincode</label>
                            <input type="text" name="pincode" class="form-control" id="pincode" placeholder="Enter Pincode" value="{{old('pincode')}}">
                        </div>

                      </div>

                      <div class="form-group col-sm-3 col-xs-3">
                          <label for="status" class="required">Status </label>
                          <select name="status" id="status" class="form-control">
                              @foreach($statuses as $key => $value)
                              <option value="{{$value}}" {{SELECT($value,old('status'))}}>{{$key}}</option>
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
