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
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- select -->
    <script src="https://unpkg.com/slim-select@latest/dist/slimselect.min.js"></script>
    <link href="https://unpkg.com/slim-select@latest/dist/slimselect.css" rel="stylesheet"></link>
    {{--    datatable AJAX --}}
    <link href="{{asset('plugins/DataTables/datatables.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/DataTables/datatables.js')}}"></script>
    {{--    scroll reveal--}}
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    {{--    CSS--}}
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    <link rel="stylesheet" href="{{asset('plugins/bootstrap_theme/bootstrap.css')}}">

    {{--    mcdatepicker--}}
    <link href="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.js"></script>
    {{--    file css tuy chinh--}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    <title>Project 2 - Tam</title>
</head>
<body class="overflow-x-hidden overflow-y-auto bg-light-subtle">
@include('partials.guest.guestNavbar')
{{$slot}}
@include('partials.guest.guestFooter')

<script
    type="text/javascript"
    src="{{asset('plugins/js/script.js')}}"
></script>

</body>
</html>
