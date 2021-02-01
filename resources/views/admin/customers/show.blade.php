@extends('layouts.layout')
@section('title', 'View Category')
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
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('category.index')}}">Category</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>
        </div>
    </div>
      <div class="row">
         <div class="col-lg-12">
            <!-- page here -->
         </div>
      </div>
   </div>
</div>
@endsection
