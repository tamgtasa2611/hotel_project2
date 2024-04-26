<title>Edit admin information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-3 mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Admins Management</h4>
        </div>
    </div>

    <div class="bg-white rounded shadow-3 overflow-hidden">
        <div
            class="p-3 rounded-top border-bottom">
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
                    <div class="p-3">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                   value="{{ $admin->first_name }}" required/>
                            <label class="form-label" for="first_name">First name <span
                                    class="text-danger">*</span></label>
                        </div>
                        @if ($errors->has('first_name'))
                            @foreach ($errors->get('first_name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- description Number input -->
                    <div class="p-3 pt-0">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                   value="{{ $admin->last_name }}" required/>
                            <label class="form-label" for="last_name">Last name <span
                                    class="text-danger">*</span></label>
                        </div>
                        @if ($errors->has('last_name'))
                            @foreach ($errors->get('last_name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- email input -->
                    <div class="p-3 pt-0">
                        <div data-mdb-input-init class="form-outline">
                            <input type="email" id="email" name="email" class="form-control" value="{{ $admin->email }}"
                                   required/>
                            <label class="form-label" for="email">Email address <span
                                    class="text-danger">*</span></label>
                        </div>
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--            phone number--}}
                    <div class="p-3 pt-0">
                        <div data-mdb-input-init class="form-outline">
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="{{ $admin->phone_number }}"
                                   maxlength="20" required/>
                            <label class="form-label" for="phone">Phone number <span
                                    class="text-danger">*</span></label>
                        </div>
                        @if ($errors->has('phone'))
                            @foreach ($errors->get('phone') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--            status --}}
                    <div class="p-3 pt-0">
                        <div class="d-flex flex-column align-items-center justify-content-between flex-md-row">
                            <div class="mb-3 mb-md-0">
                                Level
                            </div>
                            @if($admin->level == 0)
                                <a class="badge badge-primary">Owner</a>
                            @else
                                <a class="badge badge-warning">Employee</a>
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
                    <div class="p-3 pt-0 pt-lg-3">
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div>
                    <div class="p-3 pt-0 w-50">
                        <img
                            src="{{ $admin->image != "" ? asset('storage/admin/admins/' . $admin->image) : asset('images/noavt.jpg') }}"
                            alt="guest_image"
                            class="img-fluid rounded border">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between justify-content-md-start border-top p-3">
                <a data-mdb-ripple-init href="{{ route('admin.admins') }}"
                   class="btn btn-secondary rounded tran-2 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary rounded tran-2">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
