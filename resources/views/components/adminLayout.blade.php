<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo_1.png') }}">
    {{--    jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    {{--    datatable AJAX --}}
    <link href="{{asset('plugins/DataTables/datatables.css')}}" rel="stylesheet">
    <script src="{{asset('plugins/DataTables/datatables.js')}}"></script>
    {{--    scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    {{--    bootstrap css + js --}}
    {{--    CSS--}}
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    <link rel="stylesheet" href="{{asset('plugins/bootstrap_theme/bootstrap.css')}}">

    {{--    file css tuy chinh --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    <title>Project 2 - Tam</title>
</head>

<body class="overflow-x-hidden overflow-y-auto bg-light cabin-regular">
<div class="row h-100">
    <div class="d-none d-lg-block col-lg-3 col-xl-2 pe-0 shadow-3 bg-white">
        @include('partials.admin.adminSidenav')
    </div>
    <div class="col-12 col-lg-9 col-xl-10 ps-lg-0 d-flex flex-column justify-content-between">
        <div class="p-3 pb-0">
            <div class="position-relative">
                {{-- alert --}}
                <div class="slideDown">
                    @if (session('success'))
                        @include('partials.flashMsgSuccess')
                    @endif
                    @if (session('failed'))
                        @include('partials.failed')
                    @endif
                </div>
                {{--------------- MAIN --------------}}
                {{$slot}}
                {{--------------- END MAIN --------------}}
            </div>
        </div>
        @include('partials.admin.adminFooter')
    </div>
</div>

<script>
    import * as bootstrap from 'bootstrap'
</script>
<script type="text/javascript" src="{{ asset('plugins/js/script.js') }}"></script>
</body>
</html>
