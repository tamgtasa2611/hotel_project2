<title>Forgot password - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in fade-bottom position-relative">
                {{--                    form--}}
                <form method="post" action="{{route('guest.forgotPassword.resetPasswordProcess')}}"
                      enctype="multipart/form-data"
                      class="bg-white p-5 border rounded-3 shadow-sm  col-md-8 col-lg-6 col-xl-5 mb-0">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        {{--                    heading--}}
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h6 class="display-6 text-primary fw-bold mb-0">Đặt lại mật khẩu</h6>
                        </div>
                        <!-- New Password input -->
                        <div class="mb-4">
                            <label class="form-label" for="exampleInputPassword1">Mật khẩu mới</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" class="form-control" id="exampleInputPassword1"
                                       autocomplete="off"
                                       name="new_password" required minlength="6">
                                <a href="#" class="input-group-text">
                                    <i class="bi bi-eye-slash" aria-hidden="true"></i>
                                </a>
                            </div>
                            @if ($errors->has('new_password'))
                                @foreach ($errors->get('new_password') as $error)
                                    <span class="text-danger fs-7">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>

                        <!-- confirm_new_password input -->
                        <div class="mb-4">
                            <label class="form-label" for="confirm_new_password">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="confirm_new_password"
                                   autocomplete="off"
                                   name="confirm_new_password" required minlength="6">
                        </div>
                        @if ($errors->has('confirm_new_password'))
                            @foreach ($errors->get('confirm_new_password') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <!-- Submit button -->
                    <button class="btn btn-primary tran-3 w-100 mb-4 ">
                        Đặt lại mật khẩu
                    </button>
                </form>
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
