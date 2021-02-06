@extends('admin.layouts.layout')
@section('title', 'Edit Customer')
@section('content')
<div class="page-wrapper">
   <div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Edit Customer</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('customers.index')}}">Customer</a></li>
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
                    <form action="{{route('customers.update',$result->id)}}" enctype="multipart/form-data" method="post">
                        {{csrf_field()}}
                        @method('PUT')

                        <div class="row pt-3">
                            <div class="form-group col-sm-4 col-xs-4">
                                <label for="name" class="required">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{old('name',$result->name)}}">
                            </div>

                            <div class="form-group col-sm-4 col-xs-4">
                                <label for="email" class="required">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{old('email',$result->email)}}">
                            </div>
                            <div class="form-group col-sm-4 col-xs-4">
                                <label for="contact_number">Contact Number </label>
                                <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Enter Contact Number" value="{{old('contact_number',$result->contact_number)}}">
                            </div>
                        </div>
                          <div class="row pt-3">
                              <div class="form-group col-sm-4 col-xs-4">
                                  <label for="status" class="required">Status </label>
                                  <select name="status" id="status" class="form-control">
                                      @foreach($statuses as $key => $value)
                                      <option value="{{$value}}" {{SELECT($value,old('status',$result->status))}}>{{$key}}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="row pt-3">
                            <button type="button" class="btn btn-success waves-effect waves-light m-r-10" style="float:right" id="addAddress">Add Address</button><br />
                            <br />
                            <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Address Line 1</th>
                                  <th>Address Line 2</th>
                                  <th>City</th>
                                  <th>Pincode</th>
                                  <th>Status</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @if(!empty($result->userAddress))
                                @foreach($result->userAddress as $address)
                                <tr>
                                  <td>{{$address->address_line_1}} </td>
                                  <td>{{$address->address_line_2}} </td>
                                  <td>{{$address->city}} </td>
                                  <td>{{$address->pincode}} </td>
                                  <td>
                                   @if($address->status == 1)
                                   <span class="text-success">Active</span>
                                   @else
                                     <span class="text-danger">In-Active</span>
                                   @endif
                                 </td>
                                  <td><a class="waves-effect waves-dark" data-getaddress="{{ json_encode($address)}}" id="editAddress{{$address->id}}" >Edit</a> </td>
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
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">User Address<span></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form class="form-group" method="post" id="addressForm" action="{{ route('users.updateAddress',0) }}">
                  <div class="form-label-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" value="{{$result->id}}">
                    <input type="text" name="address_line_1" placeholder="Address Line 1" id="address_line_1" class="form-control">
                  </div>
                  <div class="form-label-group">
                    <input type="text" name="address_line_2" id="address_line_2" placeholder="Address Line 2" class="form-control">
                  </div>
                  <div class="form-label-group">
                    <input type="text" name="city" id="city" placeholder="City" class="form-control">
                  </div>
                  <div class="form-label-group">
                    <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode">
                  </div>
                  <div class="form-label-group">
                      <select name="statusr" id="status_modal" class="form-control">
                          @foreach($statuses as $key => $value)
                          <option value="{{$value}}">{{$key}}</option>
                          @endforeach
                      </select>
                  </div>
                  <button class="btn btn-success waves-effect waves-light m-r-10" type="submit">Submit</button>
                </form>
                <br /><br />
            </div>
        </div>
    </div>
</div>
<script>
  $('[id^=editAddress]').click(function() {
    $('#myModal').modal('toggle');
     var jsonObject = $(this).data('getaddress');
     $('#address_line_1').val(jsonObject.address_line_1);
     $('#address_line_2').val(jsonObject.address_line_2);
     $('#city').val(jsonObject.city);
     $('#pincode').val(jsonObject.pincode);
     $('select[name^="statusr"] option[value='+jsonObject.status+']').attr("selected","selected");
     var url = '{{ route("users.updateAddress", ":id") }}';
     url = url.replace(':id', jsonObject.id);
     $("#addressForm").attr('action', url);
  });

  $('#addAddress').click(function() {
    $('#myModal').modal('toggle');
     var url = '{{ route("users.updateAddress", ":id") }}';
     $('#address_line_1').val();
     $('#address_line_2').val();
     $('#city').val();
     $('#pincode').val();
     url = url.replace(':id', 0);
     $("#addressForm").attr('action', url);
  });
</script>
@endsection
