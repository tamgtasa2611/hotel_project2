<title>Sign up - Skyrim Hotel</title>
<x-guestLayout>
    <section id="signup-section" class="m-nav">
        <div class="container mh-screen">
            <div
                class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
                <form method="post" action="{{ route('guest.registerProcess') }}" enctype="multipart/form-data"
                      class="bg-white p-5 border rounded-3 shadow-sm  col-md-8 col-lg-6 col-xl-4">
                    @csrf
                    @method('POST')
                    {{--                    heading --}}
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <h6 class="display-6 mb-0 fw-bold">Đăng ký</h6>
                    </div>
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                       value="{{old('first_name')}}" required
                                       placeholder="Tên">
                            </div>
                            @if ($errors->has('first_name'))
                                @foreach ($errors->get('first_name') as $error)
                                    <span class="text-danger fs-7">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                        <div class="col">
                            <div>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                       value="{{old('last_name')}}" required
                                       placeholder="Họ">
                            </div>
                            @if ($errors->has('last_name'))
                                @foreach ($errors->get('last_name') as $error)
                                    <span class="text-danger fs-7">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
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

                    <!-- Phone Number input -->
                    <div class="mb-4">
                        <div>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   value="{{old('phone')}}" required maxlength="20"
                                   placeholder="Số điện thoại">
                        </div>
                        @if ($errors->has('phone'))
                            @foreach ($errors->get('phone') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Submit button -->
                    <button class="btn btn-primary w-100 mb-4 tran-3 ">
                        Đăng ký
                    </button>

                    <!-- Register buttons -->
                    <div class="text-center">
                        <p>Đã có tài khoản? <a href="{{ route('guest.login') }}">Đăng nhập</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guestLayout>
