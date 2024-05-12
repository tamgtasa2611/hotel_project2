<title>Edit account - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU--}}
                <div class="col-10 col-lg-3">
                    <div class="p-4 shadow   bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU--}}

                {{--                CONTENT--}}
                <div class="col-10 col-lg-9 h-100">
                    <div
                        class="p-4 bg-white shadow   d-flex flex-column justify-content-between h-100">
                        {{--alert edit success--}}
                        @if (session('success'))
                            @include('partials.flashMsgSuccess')
                        @endif
                        {{--alert edit fail--}}
                        @if (session('failed'))
                            @include('partials.flashMsgFail')
                        @endif
                        <div class="d-flex justify-content-between align-items-center mb-0 mb-md-4">
                            <h4 class="text-primary fw-bold mb-4 mb-md-0">Change password</h4>
                        </div>
                        {{--                    form--}}
                        <form method="post" action="{{route('guest.updatePassword')}}"
                              enctype="multipart/form-data"
                              class="mb-0">
                            @csrf
                            @method('PUT')

                            <div class="col-12 col-lg-6">
                                <!-- Old Password input -->
                                <div class="mb-4">
                                    <label class="form-label" for="old_password">Old password</label>
                                    <input type="password" class="form-control" id="old_password"
                                           autocomplete="off"
                                           name="old_password" required minlength="6">
                                </div>
                                @if ($errors->has('old_password'))
                                    @foreach ($errors->get('old_password') as $error)
                                        <span class="text-danger fs-7">{{ $error }}</span>
                                    @endforeach
                                @endif

                                <!-- New Password input -->
                                <div class="mb-4">
                                    <label class="form-label" for="exampleInputPassword1">New password</label>
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
                                    <label class="form-label" for="confirm_new_password">Confirm new
                                        password</label>
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
                            <div
                                class="d-flex flex-column-reverse flex-lg-row justify-content-between justify-content-md-start align-items-center">
                                <a data-mdb-ripple-init href="{{ route('guest.changePassword') }}"
                                   class="btn btn-secondary col-12 col-lg-auto me-lg-3  tran-3">
                                    Cancel
                                </a>
                                <button data-mdb-ripple-init type="submit"
                                        class="btn btn-primary  col-12 col-lg-auto mb-3  mb-lg-0  tran-3">
                                    Change
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                {{--                    form--}}
            </div>
        </div>
    </section>
</x-guestLayout>
