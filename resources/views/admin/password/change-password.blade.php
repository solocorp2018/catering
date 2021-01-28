@extends('admin.layouts.layout')
@section('title', env('APP_GLOBAL_NAME'))
@section('content')

<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Manage Password</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Manage Password</li>                    
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
                                    <form action="{{route('password.update')}}" method="post">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <label for="formField2" class="required">New Password</label>
                                            <input type="password" name="password" class="form-control" id="formField1" placeholder="Enter New Password *" value="">
                                        </div>     

                                        <div class="form-group">
                                            <label for="formField2" class="required">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="formField2" placeholder="Enter Confirm Password *" value="">
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