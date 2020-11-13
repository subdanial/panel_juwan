<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('node_modules/autonumeric/dist/autoNumeric.min.js')}}"></script>

</head>
{{-- @auth --}}
@include('layout.nav')
{{-- @endauth --}}

    
<body class="bg-light">
@yield('content')


<footer class="position-fixed w-100 border text-left" style="bottom:0">

</footer>

<script src="{{asset('js/app.js')}}"></script>
@yield('product_create_js')
@yield('product_edit_js')
@yield('order_create_js')

</body>

</html>
