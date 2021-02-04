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
                                    <select name="session_type" id="session_type" class="form-control">
                                        @foreach($sessionTypes as $session)
                                        <option value="{{$session->id}}" {{SELECT($session,old('session_type'))}}>{{$session->type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="opening_time" class="required">Opening Time</label>
                                    <input id="timepicker1" type="text" class="form-control input-small" name="opening_time">
                                </div>
                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="closing_time">Closing Time </label>
                                    <input id="timepicker2" type="text" class="form-control input-small" name="closing_time">
                                </div>
                            </div>
                            <div class="row pt-3">
                              <div class="form-group col-sm-4 col-xs-4 date" data-provide="datepicker">
                                  <label for="session_date">Date</label>
                                  <input type="text" class="form-control" name="session_date">
                              </div>
                              <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                  <label for="closing_time">Delivery Time </label>
                                  <input id="timepicker4" type="text" class="form-control input-small" name="delivery_time">
                              </div>
                            </div>
                            <div class="itemsC">
                              <button type="button" class="btn btn-success waves-effect waves-light" id="additem" style="float:right">Add item</button>
                              <div class="itemDiv">
                                <h5>Item <span id="itemcount_">1</span><button class="btn btn-success waves-light removebtn" style="float:right" id="removebtn">X</button></h5>

                                <div class="row pt-3">
                                  <div class="form-group col-sm-4 col-xs-4">
                                    <label for="lang1_description">Menu Items </label>
                                    <select name="menu_items[]" class="form-control menuSelectBox" id="menuItem">
                                      @foreach($menuItems as $key => $menuItem)
                                      <option value="{{$menuItem->id}}" {{SELECT($menuItem,old('menuItem'))}}>{{$menuItem->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-sm-4 col-xs-4">
                                    <label for="quantity" class="required">Quantity </label>
                                    <select name="quantity_type[]" id="quantity_type" class="form-control">
                                      @foreach($quantityTypes as $quantity)
                                      <option value="{{$quantity->id}}" {{SELECT($quantity->id,old('quantity_type'))}}>{{$quantity->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-sm-4 col-xs-4">
                                    <label for="quantity_type" class="required">Quantity Type </label>
                                    <input type="number" class="form-control" name="quantity[]" value="{{old('quantity')}}">
                                  </div>
                                </div>

                                <div class="row pt-3">
                                  <div class="form-group col-sm-4 col-xs-4">
                                    <label for="lang1_description">Complimentaries </label>
                                    <select name="complimentaries[]" class="form-control menuSelectBox" id="complimentaries" multiple>
                                      @foreach($complimentaries as $key => $complimentary)
                                      <option value="{{$complimentary->id}}" {{SELECT($complimentary,old('menuItems'))}}>{{$complimentary->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                  <div class="form-group col-sm-4 col-xs-4">
                                    <label for="price" class="required">Price </label>
                                    <input type="text" name="price[]" class="form-control" id="price" placeholder="Enter Price" value="{{old('price')}}">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row pt-3">
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
      <div>
   </div>
</div>
<script type="text/javascript">
var quantityCount = 1;
$(function() {
     console.log("create page called");
     setTimeout(function(){ $('.menuSelectBox').select2(); }, 3000);

     $('#additem').click(function() {
       quantityCount++;
       $(".menuSelectBox").select2('destroy');
       let clone = $(".itemDiv").first().clone();

        $(clone).find('select#complimentaries').attr('id',"complimentaries_"+quantityCount);
        $(clone).find('select#quantity_type').attr('id',"quantity_type_"+quantityCount);
        $(clone).find('select#menuItem').attr('id',"menuItem_"+quantityCount);
        $(clone).find('button#removebtn').attr('id',"removebtn_"+quantityCount);
        clone.appendTo('.itemsC');

        $('.menuSelectBox').select2();
    });

    $("[id^=removebtn]").click(function() {
      if (quantityCount == 1) {
        return false;
      }
      $(this).parent().remove();
      //$(".itemDiv").last().remove();
      quantityCount--;
    });
});

</script>
@endsection
