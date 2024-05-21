<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    favicon--}}
    <link rel="icon" type="image/x-icon" href="{{asset('images/logo_1.png')}}">

    {{--    jquery--}}
    <script src="{{asset('plugins/jquery/jquery-3.7.1.min.js')}}"></script>

    {{--    datatable AJAX --}}
    <link href="{{asset('plugins/DataTables/datatables.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/DataTables/datatables.js')}}"></script>

    {{--    scroll reveal--}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    {{--    CSS--}}
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    <link rel="stylesheet" href="{{asset('plugins/bootstrap_theme/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-icons/font/bootstrap-icons.css')}}">

    {{--    mcdatepicker--}}
    <link href="{{asset('plugins/mcdatepicker/mc-calendar.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('plugins/mcdatepicker/mc-calendar.min.js')}}"></script>

    {{--    file css tuy chinh--}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">

    <title>Project 2 - Tam</title>
</head>
<body class="overflow-x-hidden overflow-y-auto"
      style="background: url('{{asset('images/bg_guest.png')}}'); background-size: contain">
@include('partials.guest.guestNavbar')
{{--alert edit success--}}
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
{{$slot}}
@include('partials.guest.guestFooter')

{{--js tuy chinh--}}
<script
    type="text/javascript"
    src="{{asset('plugins/js/script.js')}}"
></script>

</body>
</html>
