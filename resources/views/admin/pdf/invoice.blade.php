
<!DOCTYPE html>
<html lang="en">
<head>
<title>M.R Grandson Caters</title>
<link href="{{public_path('website/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{public_path('website/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{public_path('website/vendor/icofont/icofont.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{public_path('website/css/osahan.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
  <style type="text/css">
  .fa {
    display: inline;
    font-style: normal;
    font-variant: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 1;
    font-family: FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }
  </style>
</head>
<body>
<section class="section pt-5 pb-5">
         <div class="container">
            <div class="row">
               <div class="col-md-8 mx-auto">
                  <div class="p-5 osahan-invoice bg-white shadow-sm">
                     <div class="row">
                     	<div class="col-md-4">
                           <p class="mb-1 text-black"><strong>M.R.Grandson Caters</strong></p>
                           <p class="mb-1 text-black">Order No: <strong>{{$result->order_unique_id ?? ''}}</strong></p>
                           <p class="mb-1">Order placed at: <strong>{{date('d/m/Y, H:i A', strtotime($result->order_date)) ?? '' }}</strong></p>
                           <p class="mb-4 mt-2">
                              <a class="text-primary font-weight-bold" onClick="window.print()" href="#"><i class="fa fa-download"></i> PRINT</a>
                           </p>
                        </div>
                     	<div class="col-md-4" style="text-align:right">
                           <p class="mb-1">Ordered From :</p>
                           <h6 class="mb-1 text-black">{{$result->processedBy->name ?? ''}}</h6>
                           <p class="mb-1">{{$result->deliveredAddress->address_line_1 ?? ''}},  {{$result->deliveredAddress->address_line_2 ?? ''}},</p>
                           <p class="mb-1">{{$result->deliveredAddress->city ?? ''}}, {{$result->deliveredAddress->pincode ?? ''}}</p>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-md-12">
                           <table class="table mt-1 mb-0">
                              <thead class="thead-light">
                                 <tr>
                                    <th class="text-black" scope="col">Item Name</th>
                                    <th class="text-right text-black" scope="col">Quantity</th>
                                    <th class="text-right text-black" scope="col">Price</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @if(isset($result->orderItems) && !empty($result->orderItems))
                                @foreach($result->orderItems as $key => $orderItems)
                                 <tr>
                                    <td>{{$orderItems->menuItems->Items->name ?? ''}}</td>
                                    <td class="text-right">{{$orderItems->quantity ?? ''}}</td>
                                    <td class="text-right">${{$orderItems->total_amount}}</td>
                                 </tr>
                                 @endforeach
                                 <tr>
                                    <td class="text-right" colspan="2">Item Total:</td>
                                    <td class="text-right">${{$result->total_amount}}</td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</body>
</html>
