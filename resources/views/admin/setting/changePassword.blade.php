<title>Edit admin information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Cài đặt tài khoản</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="bg-white   shadow-sm border rounded-3 overflow-hidden">
        <div class="p-4 ">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-primary">
                    <i class="bi bi-shield-lock me-2"></i>Đổi mật khẩu
                </div>
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        @php
            $admin = \Illuminate\Support\Facades\Auth::guard('admin')->user();
        @endphp
        <form method="post" action="{{ route('admin.updatePassword') }}" enctype="multipart/form-data" class="mb-0 ">
            @csrf
            @method('PUT')

            <div class="col-12 col-lg-6 p-4 ">
                <!-- Old Password input -->
                <div class="mb-4">
                    <label class="form-label" for="old_password">Mật khẩu cũ</label>
                    <input type="password" class="form-control" id="old_password" autocomplete="off" name="old_password"
                        required minlength="6">
                </div>
                @if ($errors->has('old_password'))
                    @foreach ($errors->get('old_password') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif

                <!-- New Password input -->
                <div class="mb-4">
                    <label class="form-label" for="exampleInputPassword1">Mật khẩu mới</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="off"
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
                <div class="">
                    <label class="form-label" for="confirm_new_password">Nhập lại mật khẩu mới</label>
                    <input type="password" class="form-control" id="confirm_new_password" autocomplete="off"
                        name="confirm_new_password" required minlength="6">
                </div>
                @if ($errors->has('confirm_new_password'))
                    @foreach ($errors->get('confirm_new_password') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
            <hr class="m-0">
            <!-- Submit button -->
            <div
                class="p-4 d-flex flex-column-reverse flex-lg-row justify-content-between justify-content-md-start align-items-center">
                <a data-mdb-ripple-init href="{{ route('admin.settings') }}"
                    class="btn btn-secondary col-12 col-lg-auto me-lg-3  tran-3">
                    Hủy
                </a>
                <button data-mdb-ripple-init type="submit"
                    class="btn btn-primary  col-12 col-lg-auto mb-3 px-4 mb-lg-0  tran-3">
                    Lưu
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
