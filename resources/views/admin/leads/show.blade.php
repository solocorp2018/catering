@extends('admin.layouts.layout')
@section('title', 'View Lead')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Lead</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('leads.index')}}">Lead</a></li>
                </ol>                
            </div>
        </div>
    </div>
      <div class="row">
         <div class="col-lg-12 card">
              <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">{{$result->name ?? ''}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">{{$result->phone ?? ''}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">{{$result->email ?? ''}}</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Recieved At</strong>
                                                <br>
                                                <p class="text-muted">{{dateOf($result->created_at) ?? ''}}</p>
                                            </div>
                                        </div>
                                        <hr>

                                        <h4 class="font-medium m-t-30">Lead Message</h4>

                                        <p class="m-t-30">{{$result->message ?? ''}}</p>
                                        
                                        <hr>
                                       
                                    </div>

         </div>
      </div>
   </div>
</div>
@endsection