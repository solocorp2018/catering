<!doctype html>
<html lang="en">
   <!-- Mirrored from askbootstrap.com/preview/osahan-eat/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Jan 2021 10:11:13 GMT -->
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="GrandSon">
      <meta name="author" content="GrandSon">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <meta name="base-url" content="{{ url('/') }}" />
      <title>M R GrandSon Caters - @yield('title')</title>
      <link rel="icon" type="image/png" href="{{asset('website/img/logo/favicon.png')}}">
      <link href="{{asset('website/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('website/vendor/fontawesome/css/all.min.css')}}" rel="stylesheet">
      <link href="{{asset('website/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
      <link href="{{asset('website/vendor/select2/css/select2.min.css')}}" rel="stylesheet">
      <link href="{{asset('website/css/osahan.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('website/vendor/owl-carousel/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{asset('website/vendor/owl-carousel/owl.theme.css')}}">
      <link rel="stylesheet" href="{{asset('css/custom.css')}}">


      <script src="{{asset('js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
      <!-- <script src="{{asset('website/vendor/jquery/jquery-3.3.1.slim.min.js')}}" type="text/javascript"></script> -->
      <script src="{{asset('website/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

   </head>  
   <body>
      @include('website.layout.top-navbar')

      @yield('content')

      @include('website.layout.quick-links')

      @include('website.layout.footer')

      @include('website.login')
      @include('website.register')

      

      <script src="{{asset('website/vendor/select2/js/select2.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('website/js/jquery.validate.min.js')}}"></script>  
      <script src="{{asset('website/vendor/owl-carousel/owl.carousel.js')}}" type="text/javascript"></script>
      <script src="{{asset('website/js/custom.js')}}" type="text/javascript"></script>
      <script src="{{asset('website/js/custom.js')}}" type="text/javascript"></script>
      <script src="{{asset('js/website.js')}}" type="text/javascript"></script>
      
   </body>
</html>