<title>Edit admin information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-dark  shadow-lg  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Admins Management</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="bg-dark   shadow-lg  overflow-hidden">
        <div
            class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit Admin
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.admins.update', $admin) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <div class="d-flex flex-column flex-lg-row">
                <div class="col-12 col-lg-6 col-xl-4">
                    <!-- name input -->
                    <div class="p-4">
                        <div class="">
                            <label class="form-label" for="first_name">First name <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                   value="{{ $admin->first_name }}" required/>
                        </div>
                        @if ($errors->has('first_name'))
                            @foreach ($errors->get('first_name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- description Number input -->
                    <div class="p-4 pt-0">
                        <div class="">
                            <label class="form-label" for="last_name">Last name <span
                                    class="text-danger">*</span></label>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                   value="{{ $admin->last_name }}" required/>
                        </div>
                        @if ($errors->has('last_name'))
                            @foreach ($errors->get('last_name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- email input -->
                    <div class="p-4 pt-0">
                        <div class="">
                            <label class="form-label" for="email">Email address <span
                                    class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $admin->email }}"
                                   required/>
                        </div>
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--            phone number--}}
                    <div class="p-4 pt-0">
                        <div class="">
                            <label class="form-label" for="phone">Phone number <span
                                    class="text-danger">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="{{ $admin->phone_number }}"
                                   maxlength="20" required/>
                        </div>
                        @if ($errors->has('phone'))
                            @foreach ($errors->get('phone') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--            status --}}
                    <div class="p-4 pt-0">
                        <div class="d-flex flex-column align-items-center justify-content-between flex-md-row">
                            <div class="mb-3 mb-md-0 form-label">
                                Level
                            </div>
                            @if($admin->level == 0)
                                <a class="badge bg-dark ">Owner</a>
                            @else
                                <a class="badge bg-dark  shadow-lg">Employee</a>
                            @endif
                        </div>
                        @if ($errors->has('level'))
                            @foreach ($errors->get('level') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    {{--            image input--}}
                    <div class="p-4 pt-0 pt-lg-4">
                        <label for="image" class="form-label">Avatar</label>
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div>
                    <div class="p-4 pt-0 w-75">
                        <img
                            src="{{ $admin->image != "" ? asset('storage/admin/admins/' . $admin->image) : asset('images/noavt.jpg') }}"
                            alt="guest_image"
                            class="img-fluid   shadow-lg">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.admins') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
