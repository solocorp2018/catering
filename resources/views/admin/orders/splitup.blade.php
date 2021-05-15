@extends('admin.layouts.layout')
@section('title', 'List Orders')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
      <div class="row page-titles">
         <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Orders</h4>
         </div>
         <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Order Splitup</li>
               </ol>
            </div>
         </div>
      </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                    <div class="col-lg-2">
                        <label>Session Type 
                            <select name="session" class="form-control form-control-line searchable" onchange="searchFun()"> 
                              <option value="" >-- Select -- </option>
                               @foreach($sessionType as $session)
                                <option value="{{$session->id}}" {{SELECT($session->id,request('session'))}}>{{$session->type_name}}</option>
                                @endforeach
                            </select>  
                            </label>
                     </div>
                      <div class="col-lg-2">
                        <label>Order Date
                        <input type="date" placeholder="Order Date" name="order_date" class="form-control form-control-line searchable" aria-controls="myTable" value="{{request('order_date')}}">
                        </label>
                     </div>
                      <div class="col-lg-1 mt-4">
                        <button type="button" class="btn btn-info d-none d-lg-block" onClick="searchFun()"> Search</button>
                     </div>
                      <div class="col-lg-1 mt-4">
                        <button type="button" class="btn btn-info d-none d-lg-block resetSearch" onClick="resetSearch()"> <i class="fas fa-refresh"></i>&nbsp;Reset</button>
                     </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($results))
    @foreach($results as $sessionMenu)
    <div class="row">
        <div class="col-lg-12">
            
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"> <span class="text-danger">{{$sessionMenu['session_type_name']}}  </span> Of  {{dateOf(request('order_date'),'d/M/Y')}}</h4>                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>                                    
                                    <th>Item</th>
                                    <th>Complimentaries</th>
                                    <th>Total Order Received</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($sessionMenu['menu_items'] as $menuItem)
                                <tr>                                    
                                    <td>{{ $menuItem['item_name'] }}</td>
                                    <td>{{ $menuItem['complimentaries'] ?? '--' }}</td>
                                    <td><span class="text-danger">{{$menuItem['menu_item_order_quantity'] ?? 0}} {{ $menuItem['menu_quantity_type_name'] }}</span></td>
                                    
                                </tr>                       
                                @endforeach   

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @endforeach
    @else
    <div class="row">
        <div class="col-lg-12">            
            <div class="card">
                <div class="card-body">
                    <span class="text-danger">No Order's Found !</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>
</div>

<script type="text/javascript">
    
    $(document).ready(function(){
      setPageUrl('/orders-splitup?');
    });
</script>
@endsection