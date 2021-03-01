@extends('admin.layouts.layout')
@section('title', 'Create Complimentary')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Session Menu</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('complimentaries.index')}}">Session Menu</a></li>
                    <li class="breadcrumb-item active">Create Session</li>
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
                        <form action="{{route('sessionMenus.store')}}" enctype="multipart/form-data" method="post">
                            {{csrf_field()}}

                            <div class="row pt-3">
                                <div class="form-group col-sm-4 col-xs-4">
                                    <label for="name" class="required">Session Type</label>
                                    <select name="session_type" class="form-control">
                                        @foreach($sessionTypes as $session)
                                        <option value="{{$session->id}}" {{SELECT($session->id,old('session_type'))}}>{{$session->type_name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Pick Session Type for Menu</small>
                                </div>

                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="opening_time" class="required">Session Opening Time</label>
                                    <input type="datetime-local" class="form-control input-small" name="opening_time" value="{{old('opening_time')}}">
                                     <small class="form-text text-muted">Please Pick a Valid Date</small>

                                </div>
                                   
                              

                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="closing_time">Session Closing Time </label>
                                    <input type="datetime-local" class="form-control input-small" name="closing_time" value="{{old('closing_time')}}">
                                    <small class="form-text text-muted">Closing Date Time should be after Opening Time</small>
                                </div>
                            </div>
                            <div class="row pt-3">
                             
                              <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                  <label for="closing_time">Expected Delivery Time </label>
                                  <input type="datetime-local" class="form-control input-small" name="delivery_time" value="{{old('delivery_time')}}">
                                  <small class="form-text text-muted">Delivery Date Time should be after Opening Time</small>
                              </div>
                              <div class="form-group col-sm-4 col-xs-4">
                                    <label for="status" class="required">Status </label>
                                    <select name="status" class="form-control">
                                        @foreach($statuses as $key => $value)
                                        <option value="{{$value}}" {{SELECT($value,old('status'))}}>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <table class="table table-hover items mt-5 color-table muted-table" id="MyTable">
                              <thead>
                                <tr>
                                  <th>S.no</th>
                                  <th class="required">Item</th>
                                  <th class="required">Quantity</th>
                                  <th class="required">Quantity Type</th>
                                  <th>Complimentaries</th>
                                  <th class="required">Price</th>
                                  <th>Status</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                              @for($i = 1; $i <= $allowedItemCount; $i++)
                              
                                <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    <select class="form-control select2 pickItem" Placeholder="Select Item" name="menu_items[{{$i}}][item_id]">
                                        <option value=""> -- Item -- </option>
                                      @foreach($menuItems as $key => $menuItem)
                                      <option value="{{$menuItem->id}}" {{SELECT($menuItem,old("menu_items[$i][item_id]"))}}>{{$menuItem->name}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <input type="number" name="menu_items[{{$i}}][quantity]" class="form-control itemQuantity" Placeholder="Enter Quantity" value="{{old('menu_items[$i][quantity]')}}">
                                  </td>
                                  <td>
                                      <select class="form-control quantity_type_id" name="menu_items[{{$i}}][quantity_type_id]">
                                        <option value=""> -- Quantity -- </option>
                                      @foreach($quantityTypes as $quantity)
                                      <option value="{{$quantity->id}}" {{SELECT($quantity->id,old('menu_items[$i][quantity_type_id]'))}}>{{$quantity->name}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-control select2" multiple="multiple" Placeholder="Select Complimentaries" name="menu_items[{{$i}}][complimentaries][]">
                                      @foreach($complimentaries as $key => $complimentary)
                                      <option value="{{$complimentary->id}}" {{SELECT($complimentary,old('menu_items[$i][complimentaries][]'))}}>{{$complimentary->name}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                  	<input type="hidden" class="hidden_actual_price" value="0"/>
                                      <input type="text" name="menu_items[{{$i}}][price]" class="form-control price" placeholder="Enter Price" value="{{old('menu_items[$i][price]')}}">
                                  </td>
                                  <td>
                                    <input type="checkbox" name="menu_items[{{$i}}][status]" value="1" class="custom-checkbox status" {{CHECKBOX(old('menu_items[$i][status]'))}}>
                                  </td>

                                </tr>
                              @endfor
                              </tbody>
                            </table>
                            <hr>
                            <center>
                            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                            <button type="reset" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
   </div>
</div>

@endsection
