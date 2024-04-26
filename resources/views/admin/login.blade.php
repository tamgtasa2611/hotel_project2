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
    {{--    scroll reveal--}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    {{--    bootstrap css + js--}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{--    css mdb--}}
    <link rel="stylesheet" href="{{ asset('plugins/mdb/css/mdb.min.css') }}">
    {{--    font Inter--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    {{--    font Playfair Display--}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
          rel="stylesheet">
    {{--    file css tuy chinh--}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    <title>Admin login - Skyrim Hotel</title>
</head>
<body class="overflow-x-hidden overflow-y-auto">
<section class="mt-3">
    <div class="container-fluid h-ok">
        <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
            {{--alert logout--}}
            @if (session('success'))
                @include('partials.flashMsgSuccess')
            @endif
            {{--alert login fail--}}
            @if (session('failed'))
                @include('partials.flashMsgFail')
            @endif
            {{--               login form--}}
            <form method="post" action="{{route('admin.loginProcess')}}" enctype="multipart/form-data"
                  class="bg-white p-5 rounded border shadow-sm col-md-8 col-lg-6 col-xl-4">
                @csrf
                <div class="mb-4">
                    <a href="{{route('guest.home')}}" class="bg-image">
                        <img src="{{asset('images/logo.png')}}" class="img-fluid">
                    </a>
                </div>

                {{--                    heading--}}
                <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                    <h4 class="text-primary-emphasis fw-bold">Control Panel Login</h4>
                </div>
                <!-- Email input -->
                <div class="mb-4">
                    <div data-mdb-input-init class="form-outline">
                        <input type="email" id="email" name="email" class="form-control" required
                               value="{{old('email')}}"/>
                        <label class="form-label" for="email">Email address</label>
                    </div>
                    @if ($errors->has('email'))
                        @foreach ($errors->get('email') as $error)
                            <span class="text-danger fs-7">{{ $error }}</span>
                        @endforeach
                    @endif
                </div>

                <!-- Password input -->
                <div class="mb-4">
                    <div data-mdb-input-init class="form-outline input-group"
                         id="show_hide_password">
                        <input type="password" id="pwd" name="password" class="form-control" required
                               minlength="6"/>
                        <a href="#!" class="input-group-text">
                            <i class="bi bi-eye-slash" aria-hidden="true"></i>
                        </a>
                        <label class="form-label" for="pwd">Password</label>
                    </div>
                    @if ($errors->has('password'))
                        @foreach ($errors->get('password') as $error)
                            <span class="text-danger fs-7">{{ $error }}</span>
                        @endforeach
                    @endif
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit"
                        class="btn btn-primary btn-block mb-4 rounded tran-2">
                    Sign in
                </button>

                <div class="text-center">
                    <small class="fs-7 text-muted">Please contact the IT team if you forgot your password</small>
                </div>
            </form>
        </div>
    </div>
</section>
<script
    type="text/javascript"
    src="{{asset('plugins/js/script.js')}}"
></script>
<script
    type="text/javascript"
    src="{{asset('plugins/mdb/js/mdb.umd.min.js')}}"
></script>
<script
    type="text/javascript"
    src="{{asset('plugins/mdb/js/mdb.es.min.js/')}}"
></script>
</body>
</html>

