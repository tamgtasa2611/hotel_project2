<title>Forgot password - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in position-relative">
                {{--               login form--}}
                <form method="post" action="{{route('guest.forgotPassword.sendEmail')}}" enctype="multipart/form-data"
                      class="bg-white p-5 border rounded-3 shadow-sm  col-md-8 col-lg-6 col-xl-5">
                    @csrf
                    @method('POST')
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Quên mật khẩu</h6>
                    </div>
                    <!-- Email input -->
                    <div class="mb-4">
                        <div>
                            <label for="exampleInputEmail1" class="form-label">Vui lòng nhập email của bạn: </label>
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

                    <!-- Submit button -->
                    <button class="btn btn-primary tran-3 w-100 mb-4">
                        Gửi mã đặt lại mật khẩu
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-guestLayout>
