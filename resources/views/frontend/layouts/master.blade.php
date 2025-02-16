<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    @php
    if(isset($title)){
    $title = $title.' | '.env('APP_NAME');
    } else {
    $title = env('APP_NAME');
    }
    @endphp {{$title}}</title>
  @yield('seo')
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  <!-- custom css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
  <!-- fontwsome css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}" />
  <!-- slick slider css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
  <!-- bootstrap css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
  <!-- animated css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" />
  <!-- toastr.min.css -->
  <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}" />
  <!-- picZoomer css  -->
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery-picZoomer.css') }}" />
  {{-- Share Starts --}}
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=635621359dc3400019b695f3&product=sop' async='async'></script>
  {{-- Share Ends --}}
</head>
@php($bodyClass = isset($bodyClass) ? $bodyClass : '')
@php($loggedinClass = ($user_account != '' || $user_account != NULL) ? 'loggedin' : '')

<body class="{{ $bodyClass }} {{ $loggedinClass }}" data-siteurl="{{ url('/') }}">
  @include('frontend.layouts.header')
  @yield('content')
  @include('frontend.layouts.footer')
</body>
<!-- jquery  -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
<!-- bootstrap  -->
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<!-- slck slider  -->
<script type="text/javascript" src="{{ asset('frontend/js/slick.min.js') }}"></script>
<!-- picZoomer  -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery.picZoomer.js') }}"></script>
<!--wow js  -->
<script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
<!-- way-point js  -->
<script type="text/javascript" src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<!-- toastr.min.js -->
<script type="text/javascript" src="{{ asset('frontend/js/toastr.min.js') }}"></script>
<!-- custom js file  -->
<script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
@yield('script')

</html>