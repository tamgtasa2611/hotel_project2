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
    {{--    scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    {{--    bootstrap css + js --}}
    {{--    CSS--}}
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    <link rel="stylesheet" href="{{asset('plugins/bootstrap_theme/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap-icons/font/bootstrap-icons.css')}}">

    {{--    file css tuy chinh --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    {{--    file css tuy chinh--}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    <title>Trang quản trị - Skyrim Hotel</title>
</head>
<body class="overflow-x-hidden overflow-y-auto">
{{--alert logout--}}
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert login fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
<section class="mt-3">
    <div class="container-fluid h-ok">
        <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
            {{--               login form--}}
            <form method="post" action="{{route('admin.loginProcess')}}" enctype="multipart/form-data"
                  class="bg-white p-5 border rounded-3 shadow-sm col-10 col-md-6 col-lg-4">
                @csrf
                {{--                    heading--}}
                <div class="d-flex justify-content-center flex-column align-items-center mb-4">
                    <h6 class="text-primary fw-bold">Trang quản trị</h6>
                    <h6 class="display-6 text-primary fw-bold">Đăng nhập</h6>
                </div>
                <!-- Email input -->
                <div class="mb-4">
                    <div>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               value="{{old('email')}}" required
                               aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    @if ($errors->has('email'))
                        @foreach ($errors->get('email') as $error)
                            <span class="text-danger fs-7">{{ $error }}</span>
                        @endforeach
                    @endif
                </div>

                <!-- Password input -->
                <div class="mb-4">
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control" id="exampleInputPassword1"
                               placeholder="Mật khẩu" autocomplete="off"
                               name="password" required minlength="6">
                        <a href="#" class="input-group-text">
                            <i class="bi bi-eye-slash" aria-hidden="true"></i>
                        </a>
                    </div>
                    @if ($errors->has('password'))
                        @foreach ($errors->get('password') as $error)
                            <span class="text-danger fs-7">{{ $error }}</span>
                        @endforeach
                    @endif
                </div>

                <!-- Submit button -->
                <button type="submit"
                        class="btn btn-primary w-100 mb-4  tran-3">
                    Đăng nhập
                </button>

                <div class="text-center">
                    <a href="">Quên mật khẩu</a>
                </div>
            </form>
        </div>
    </div>
</section>
<script
    type="text/javascript"
    src="{{asset('plugins/js/script.js')}}"
></script>
</body>
</html>

