<title>Login - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center
             load-hidden fade-in position-relative">
                {{--               login form--}}
                <form method="post" action="{{route('guest.loginProcess')}}" enctype="multipart/form-data"
                      class="bg-white p-5 rounded-4 shadow-lg border col-md-8 col-lg-6 col-xl-4">
                    @csrf
                    @method('POST')
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Login</h6>
                    </div>
                    <!-- Email input -->
                    <div class="mb-4">
                        <div>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                   value="{{old('email')}}" required
                                   aria-describedby="emailHelp" placeholder="Enter email">
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
                                   placeholder="Password" autocomplete="off"
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
                    <button class="btn btn-primary tran-2 w-100 mb-4 rounded-pill">
                        Sign in
                    </button>

                    {{--                        reset password--}}
                    <div class="text-center mb-3">
                        <a href="{{route('guest.forgotPassword')}}">Forgot password?</a>
                    </div>

                    {{--                        register--}}
                    <div class="text-center">
                        <p>Not a member? <a href="{{route('guest.register')}}">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-guestLayout>
