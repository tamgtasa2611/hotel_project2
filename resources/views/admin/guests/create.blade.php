<title>Add new guest - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-dark  shadow  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Guests Management</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="bg-dark  shadow  overflow-hidden">
        <div
            class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Guest
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.guests.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            <!-- name input -->
            <div class="p-4 col-12  col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="first_name">First name <span class="text-danger">*</span></label>
                    <input type="text" id="first_name" name="first_name" class="form-control"
                           value="{{ old('first_name') }}" required/>
                </div>
                @if ($errors->has('first_name'))
                    @foreach ($errors->get('first_name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- description Number input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="last_name">Last name <span class="text-danger">*</span></label>
                    <input type="text" id="last_name" name="last_name" class="form-control"
                           value="{{ old('last_name') }}" required/>
                </div>
                @if ($errors->has('last_name'))
                    @foreach ($errors->get('last_name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- email input -->
            <div class="p-4 col-12 pt-0 col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="email">Email address <span class="text-danger">*</span></label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                           required/>
                </div>
                @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- password input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                <div class=" input-group" id="show_hide_password">
                    <input type="password" id="password" name="password" class="form-control"
                           value="{{ old('password') }}" required minlength="6"/>
                    <a href="#!" class="input-group-text">
                        <i class="bi bi-eye-slash" aria-hidden="true"></i>
                    </a>
                </div>
                @if ($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            {{--            phone number--}}
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="phone">Phone number <span class="text-danger">*</span></label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                           maxlength="20" required/>
                </div>
                @if ($errors->has('phone'))
                    @foreach ($errors->get('phone') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            {{--            image input--}}
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <label class="form-label" for="password">Avatar</label>
                <input type="file" class="form-control" id="image" name="image"/>
            </div>

            <div class="d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.guests') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
