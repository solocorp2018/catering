@extends('admin.layouts.layout')
@section('title', 'View Session Menu')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Session</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('sessionMenus.index')}}">Session Menu</a></li>
                </ol>
            </div>
        </div>
    </div>
      <div class="row">
         <div class="col-lg-12 card">
           <div class="card-body">
             <div class="row">
                 <div class="col-md-3 col-xs-6 b-r"> <strong>Session Type</strong>
                     <br>
                     <p class="text-muted">{{$result->sessionType->type_name ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6 b-r"> <strong>Session Date</strong>
                     <br>
                     <p class="text-muted">{{dateOf($result->session_date) ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6 b-r"> <strong>Opening Time</strong>
                     <br>
                     <p class="text-muted">{{$result->opening_time ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Closing Time</strong>
                     <br>
                     <p class="text-muted">{{$result->closing_time ?? ''}}</p>
                 </div>
                 <div class="col-md-3 col-xs-6"> <strong>Status</strong>
                     <br>
                    @if(isset($result->status) && $result->status == 1)
                      <p class="text-muted">Active</p>
                    @else
                      <p class="text-muted">InActive</p>
                    @endif
                 </div>

               </div>
                <div class="row">
                 <div class="col-md-12 col-xs-12"> <h4><strong>Items</strong></h4>
                     @if(isset($result->menuItem) && !empty($result->menuItem)  )
                     <table class="table table-hover">
                       <thead>
                         <tr>
                           <th>Item Name</th>
                           <th>Complimentaries</th>
                           <th>Quantity Type</th>
                           <th>Quantity</th>
                           <th>Price</th>
                           <th>Status</th>
                         </tr>
                        <tbody>
                     @foreach($result->menuItem as $menu)
                     <tr>
                      <td>{{$menu->Items->name ?? ''}}</td>
                      <td>
                        @if(isset($menu->menuComplimentaries) && !empty($menu->menuComplimentaries)  )
                        @foreach($menu->menuComplimentaries as $menuComplimentary)
                         {{$menuComplimentary->complimentaries->name ?? ''}} ,
                         @endforeach
                         @endif
                       </td>
                      <td> {{$menu->quantityType->name ?? ''}}</td>
                      <td> {{$menu->quantity ?? ''}}</td>
                      <td> {{$menu->price ?? 0 }}</td>
                      <td>@if(isset($menu->status) && $menu->status == 1) Active
                      @else InActive @endif</td>
                    </tr>
                      @endforeach
                    </tbody>
                  </table>
                      @endif

                 </div>
                 <hr>
                   <form action="{{route('sessionMenus.clone',$result->id)}}" method="post">
                     {{csrf_field()}}
                     <button type="submit" name="use" class="btn btn-success waves-effect waves-light m-r-10" id="cloneSession">Clone</button>
                   </form>
               </div>

             </div>
         </div>
         </div>
      </div>
   </div>
</div>
@endsection
