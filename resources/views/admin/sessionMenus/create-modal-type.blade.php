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
                                    <label for="opening_time" class="required">Session Opening Time</label>
                                    <input type="time" class="form-control input-small" name="opening_time">
                                    <small class="form-text text-muted">Opening Time For the date : {{date('d/m/Y')}}</small>
                                </div>

                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="closing_time">Session Closing Time </label>
                                    <input type="time" class="form-control input-small" name="closing_time">
                                    <small class="form-text text-muted">Closing Time For the date : {{date('d/m/Y')}}</small>
                                </div>
                            </div>
                            <div class="row pt-3">
                              <div class="form-group col-sm-4 col-xs-4">
                                  <label for="session_date">Menu Applicable Date</label>
                                  <input type="date" class="form-control" name="session_date">
                              </div>
                              <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                  <label for="closing_time">Expected Delivery Time </label>
                                  <input type="time" class="form-control input-small" name="delivery_time">
                              </div>
                              <div class="form-group col-sm-4 col-xs-4">
                                    <label for="status" class="required">Status </label>
                                    <select name="status" id="status" class="form-control">
                                        @foreach($statuses as $key => $value)
                                        <option value="{{$value}}" {{SELECT($value,old('status'))}}>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <hr>                           

                            <table class="table table-hover items mt-5 color-table primary-table" id="MyTable">
                              <thead>
                                <tr>
                                  <th>Menu Item</th>
                                  <th>Quantity Type</th>
                                  <th>Quantity</th>
                                  <th>Complimentaries</th>
                                  <th>Price</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                            </table>

                            <hr>
                            <button type="button" class="btn btn-success waves-effect waves-light" id="additem" style="float:right">Add item</button>
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:1000px!important;">
        <div class="modal-content">
            <div class="modal-header card-header bg-info">
              <h4 class="modal-title">Add Item<span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
              <div class="row pt-3">
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="lang1_description">Menu Items </label><br/>
                        <select class="form-control select2" id="modal_menu_items">
                          @foreach($menuItems as $key => $menuItem)
                          <option value="{{$menuItem->id}}" {{SELECT($menuItem,old('menuItem'))}}>{{$menuItem->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="quantity" class="required">Quantity Type</label>
                        <select id="modal_quantity_type" class="form-control">
                          @foreach($quantityTypes as $quantity)
                          <option value="{{$quantity->id}}" {{SELECT($quantity->id,old('quantity_type'))}}>{{$quantity->name}}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="quantity_type" class="required">Quantity</label>
                        <input type="number" class="form-control" id="modalQuantity" value="{{old('quantity')}}">
                      </div>
                    </div>
                      <div class="row pt-3">
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="lang1_description">Complimentaries </label><br/>
                        <select class="form-control select2" id="modalcomplimentaries" multiple>
                          @foreach($complimentaries as $key => $complimentary)
                          <option value="{{$complimentary->id}}" {{SELECT($complimentary,old('menuItems'))}}>{{$complimentary->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="price" class="required">Price </label>
                        <input type="text" class="form-control" id="modalprice" placeholder="Enter Price" value="{{old('price')}}">
                      </div>
                    </div>
                  <button class="btn btn-success waves-effect waves-light m-r-10" type="button" id="submitadd">Submit</button>

                <br /><br />
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var quantityCount = 0;
$(function() {
  $('#additem').click(function() {
    $('#myModal').modal('toggle');
  });

$('#submitadd').click(function() {
  $('#myModal').modal('toggle');
  //$('#modal_menu_items').val();
  var menuitems = $( "#modal_menu_items option:selected" ).text();
  var menuItemsVal  = $( "#modal_menu_items option:selected" ).val();
  var quantity_type = $('#modal_quantity_type option:selected').text();
  var quantity_type_val = $('#modal_quantity_type option:selected').val();
  var quantity = $('#modalQuantity').val();
  var complimentaries = $('#modalcomplimentaries option:selected').text();
  var complimentariesVal = $('#modalcomplimentaries').val();
  var price = $('#modalprice').val();
  markup = "<tr><td>"
          + menuitems + "</td><td>"+quantity_type+"</td><td>"+quantity+"</td><td>"+complimentaries+"</td><td>"+price+"</td><td><button type='button' id='quantityCount_"+quantityCount+"' class='DeleteButton'>Remove</button><input type='hidden' name='menu_items[]' value="+menuItemsVal+"><input type='hidden' name='quantity_type[]' value="+quantity_type_val+"><input type='hidden' name='quantity[]' value="+quantity+"><input type='hidden' name='complimentaries_"+quantityCount+"[]' value="+complimentariesVal+"><input type='hidden' name='price[]' value="+price+"></td></tr>";
      tableBody = $("table#MyTable tbody");
      tableBody.append(markup);
      quantityCount++;
});

    $("#MyTable").on("click", ".DeleteButton", function() {
      $(this).closest("tr").remove();
      quantityCount--;
    });
});

</script>
@endsection
