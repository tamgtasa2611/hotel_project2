<title>Quên mật khẩu - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
                {{--               login form--}}
                <form method="post" action="{{route('guest.forgotPassword.checkCode')}}" enctype="multipart/form-data"
                      class="bg-white p-5 border rounded-3 shadow-sm  col-md-8 col-lg-6 col-xl-4">
                    @csrf
                    @method('POST')
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Nhập mã</h6>
                    </div>
                    <!-- Email input -->
                    <div class="mb-4">
                        <div>
                            <label for="reset_code" class="form-label">Nhập mã trong email của bạn: </label>
                            <input type="text" class="form-control" id="reset_code" name="reset_code"
                                   value="" required placeholder="Mã 6 ký tự">
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

                    {{--                        register--}}
                    <div class="text-center">
                        <p>Chưa nhận được mã? <a href="{{route('guest.forgotPassword')}}">Gửi lại</a></p>
                    </div>
                </form>
                <div class="d-flex d-none justify-content-center align-items-center fixed-top w-100 tran-3"
                     id="spinner"
                     style="z-index: 999; height: 100dvh; background-color: rgba(0,0,0,0.2)">
                    <div class="bg-white   p-4 d-flex justify-content-center align-items-center">
                        <div class="spinner- text-primary tran-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="text-primary ms-3">
                            Sending email...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $(".spinner-btn").click(function () {
                $("#spinner").removeClass("d-none");
            });
        });
    </script>
</x-guestLayout>
