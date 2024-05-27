<title>Đăng nhập - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
                {{--               login form--}}
                <form method="post" action="{{route('guest.loginProcess')}}" enctype="multipart/form-data"
                      class="bg-white p-5 border shadow-sm rounded-3 col-md-8 col-lg-6 col-xl-4">
                    @csrf
                    @method('POST')
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <h6 class="display-6 mb-0 fw-bold">Đăng nhập</h6>
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
                    <button class="btn btn-primary tran-3 w-100 mb-4 ">
                        Đăng nhập
                    </button>

                    {{--                        reset password--}}
                    <div class="text-center mb-3">
                        <a href="{{route('guest.forgotPassword')}}">Quên mật khẩu</a>
                    </div>

                    {{--                        register--}}
                    <div class="text-center">
                        <a href="{{route('guest.register')}}">Đăng ký tài khoản mới</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guestLayout>
