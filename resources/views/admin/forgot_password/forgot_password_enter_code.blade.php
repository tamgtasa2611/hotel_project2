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
    <script src="{{ asset('plugins/jquery/jquery-3.7.1.min.js') }}"></script>
    {{--    scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    {{--    bootstrap css + js --}}
    {{--    CSS --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap_theme/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-icons/font/bootstrap-icons.css') }}">

    {{--    file css tuy chinh --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    {{--    file css tuy chinh --}}
    <link rel="stylesheet" href="{{ asset('plugins/css/main.css') }}" type="text/css">
    <title>Trang quản trị - Skyrim Hotel</title>
</head>

<body class="overflow-hidden" style="background: url('{{ asset('images/bg_admin.avif') }}'); background-size: contain">
    {{-- alert logout --}}
    @if (session('success'))
        @include('partials.flashMsgSuccess')
    @endif
    {{-- alert login fail --}}
    @if (session('failed'))
        @include('partials.flashMsgFail')
    @endif
    <section class="mt-3">
        <div class="container h-ok">
            <div
                class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
                {{--               login form --}}
                <form method="post" action="{{ route('admin.forgotPassword.checkCode') }}"
                    enctype="multipart/form-data"
                    class="bg-white p-5 border rounded-3 shadow-sm  col-md-8 col-lg-6 col-xl-4">
                    @csrf
                    @method('POST')
                    {{--                    heading --}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Nhập mã</h6>
                    </div>
                    <!-- Email input -->
                    <div class="mb-4">
                        <div>
                            <label for="reset_code" class="form-label">Nhập mã trong email của bạn: </label>
                            <input type="text" class="form-control" id="reset_code" name="reset_code" value=""
                                required placeholder="Mã 6 ký tự">
                        </div>
                        @if ($errors->has('reset_code'))
                            @foreach ($errors->get('reset_code') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Submit button -->
                    <button class="btn btn-primary tran-3 w-100 mb-4 ">
                        Xác nhận
                    </button>

                    {{--                        register --}}
                    <div class="text-center">
                        <p>Chưa nhận được mã? <a href="{{ route('admin.forgotPassword') }}">Gửi lại</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="{{ asset('plugins/js/script.js') }}"></script>
</body>

</html>
