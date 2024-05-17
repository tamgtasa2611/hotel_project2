<title>Edit admin information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý nhân viên</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="bg-white   shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Sửa thông tin nhân viên
            </div>
        </div>
        <hr class="m-0">

        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.admins.update', $admin) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <!--  last name input -->
            <div class="p-4 col-12 col-lg-10 col-xl-6">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="last_name">Họ <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="last_name" name="last_name" class="form-control"
                               value="{{ $admin->last_name }}" required/>
                    </div>
                </div>
                @if ($errors->has('last_name'))
                    @foreach ($errors->get('last_name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- name input -->
            <div class="p-4 col-12 col-lg-10 col-xl-6">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="first_name">Tên <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-8">
                        <input type="text" id="first_name" name="first_name" class="form-control"
                               value="{{ $admin->first_name }}" required/>
                    </div>
                </div>
                @if ($errors->has('first_name'))
                    @foreach ($errors->get('first_name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- email input -->
            <div class="p-4 col-12  col-lg-10 col-xl-6">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>

                    </div>
                    <div class="col-8">
                        <input type="email" id="email" name="email" class="form-control" value="{{ $admin->email }}"
                               required/>
                    </div>

                </div>
                @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            {{--            phone number--}}
            <div class="p-4  col-12 col-lg-10 col-xl-6 ">
                <div class="row">
                    <div class="col-4">
                        <label class="form-label" for="phone">Số điện thoại <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-8">
                        <input type="tel" id="phone" name="phone" class="form-control"
                               value="{{ $admin->phone_number }}"
                               maxlength="20" required/>
                    </div>
                </div>
                @if ($errors->has('phone'))
                    @foreach ($errors->get('phone') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>
            <hr class="m-0">

            <div class="d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.admins') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    Quay lại
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
