<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
  <title>{{ Config('app.name') }}</title>

  <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/metisMenu.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/morris.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/dataTables.responsive.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/admin-rtl.css') }}">
  <link type="text/css" rel="stylesheet" href="{{ asset('css/select2.min.css') }}">

</head>
<body>
<div id="wrapper">
  @include('dashboard.layout.header')
  @yield('content')
  @include('dashboard.layout.footer')
</div>

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/metisMenu.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/raphael.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/morris.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/morris-data.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.responsive.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSM9Cm6DKEv9o8jDTCECJ_yfTS1YonB9k&callback=initMap"
        async defer></script>
<script type="text/javascript" src="{{ asset('js/sb-admin-2.js') }}"></script>

@yield('js')
</body>
</html>