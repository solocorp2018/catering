@extends('admin.layouts.layout')
@section('title', 'Create Complimentary')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Edit Session Menu</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('sessionMenus.index')}}">Session Menu</a></li>
                    <li class="breadcrumb-item active">Edit Session</li>
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
                        <form action="{{route('sessionMenus.update',$result->id)}}" enctype="multipart/form-data" method="post">
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
                                    <input id="timepicker1" type="text" class="form-control input-small" name="opening_time" value="{{$result->opening_time ?? ''}}">
                                </div>
                                <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                    <label for="closing_time">Closing Time </label>
                                    <input id="timepicker2" type="text" class="form-control input-small" name="closing_time"  value="{{$result->closing_time ?? ''}}">
                                </div>
                            </div>
                            <div class="row pt-3">
                              <div class="form-group col-sm-4 col-xs-4">
                                  <label for="session_date">Date</label>
                                  <input type="text" class="form-control datepicker" name="session_date" value="{{$result->session_date ?? ''}}">
                              </div>
                              <div class="form-group col-sm-4 col-xs-4 bootstrap-timepicker timepicker">
                                  <label for="closing_time">Delivery Time </label>
                                  <input id="timepicker4" type="text" class="form-control input-small" name="delivery_time" value="{{$result->expected_delivery_time ?? '' }}">
                              </div>
                            </div>

                            <div class="row pt-3">
                                <div class="form-group col-sm-3 col-xs-3">
                                    <label for="status" class="required">Status </label>
                                    <select name="status" id="status" class="form-control">
                                        @foreach($statuses as $key => $value)
                                        <option value="{{$value}}" {{SELECT($value,old('status',$result->status))}}>{{$key}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-3">
                              <button type="button" class="btn btn-success waves-effect waves-light m-r-10" style="float:right" id="additem">Add Item</button><br />
                              <br />
                              <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th>Item Name</th>
                                    <th>Complimentaries</th>
                                    <th>Quantity Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @if(!empty($result->menuItem))
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
                                    <td><a class="waves-effect waves-dark" data-getmenu="{{ json_encode($menu)}}" id="editItem{{$menu->id}}" >Edit</a> </td>
                                  </tr>
                                  @endforeach
                                  @endif
                                </tbody>
                              </table>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" style="max-width:1000px!important;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Item<span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
              <form class="form-group" method="post" id="itemsForm" action="{{ route('sessionMenus.updateItems',0) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="row pt-3">
                <input type="hidden" name="session_menu_id" id="session_menu_id" value="{{$result->id}}" />
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="lang1_description">Menu Items </label><br/>
                        <select  class="form-control select2" id="modal_menu_item" name="modal_menu_item">
                          @foreach($menuItems as $key => $menuItem)
                          <option value="{{$menuItem->id}}" {{SELECT($menuItem,old('menuItem'))}}>{{$menuItem->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="quantity" class="required">Quantity Type</label>
                        <select id="modal_quantity_type" class="form-control" name="modal_quantity_type">
                          @foreach($quantityTypes as $quantity)
                          <option value="{{$quantity->id}}" {{SELECT($quantity->id,old('quantity_type'))}}>{{$quantity->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="quantity_type" class="required">Quantity</label>
                        <input type="number" class="form-control" id="modalQuantity" value="{{old('quantity')}}" name="modalQuantity">
                      </div>
                    </div>
                      <div class="row pt-3">
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="lang1_description">Complimentaries </label><br/>
                        <select class="form-control select2" id="modalcomplimentaries" multiple name="modalcomplimentaries">
                          @foreach($complimentaries as $key => $complimentary)
                          <option value="{{$complimentary->id}}" {{SELECT($complimentary,old('menuItems'))}}>{{$complimentary->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col-sm-4 col-xs-4">
                        <label for="price" class="required">Price </label>
                        <input type="text" class="form-control" id="modalprice" name="modalprice" placeholder="Enter Price" value="{{old('price')}}">
                      </div>
                    </div>
                  <button class="btn btn-success waves-effect waves-light m-r-10" type="submit" id="submitadd">Submit</button>
                <br /><br />
              </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var quantityCount = 0;
$(function() {

  $('[id^=editItem]').click(function() {
    $('#myModal').modal('toggle');
     var jsonObject = $(this).data('getmenu');
     $('select[name^="modal_menu_item"] option[value='+jsonObject.items.id+']').attr("selected","selected");
     $('select[name^="modal_quantity_type"] option[value='+jsonObject.quantity_type.id+']').attr("selected","selected");
     $('#modalQuantity').val(jsonObject.quantity);
     $('#modalprice').val(jsonObject.price);
     var selectedVal = [];
     $.each(jsonObject.menu_complimentaries, function(i,e){
       //$("#modalcomplimentaries option[value='" + e.complimentaries.id + "']").prop("selected", true);
       selectedVal.push(e.complimentaries.id);
     });
     $("#modalcomplimentaries").val(selectedVal).trigger('change');
     var url = '{{ route("sessionMenus.updateItems", ":id") }}';
     url = url.replace(':id', jsonObject.id);
     $("#itemsForm").attr('action', url);
  });

  $('#additem').click(function() {
    $('#myModal').modal('toggle');
    var url = '{{ route("sessionMenus.updateItems", ":id") }}';
    $('#modal_menu_item').val();
    $('#modal_quantity_type').val();
    $('#modalQuantity').val();
    $('#modalprice').val();
    $("#modalcomplimentaries").val().trigger('change');
    url = url.replace(':id', 0);
    $("#itemsForm").attr('action', url);
  });

  $("#MyTable").on("click", ".DeleteButton", function() {
    $(this).closest("tr").remove();
    quantityCount--;
  });


});

</script>
@endsection
