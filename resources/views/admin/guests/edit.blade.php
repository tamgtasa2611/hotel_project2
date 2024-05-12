<title>Edit guest information - Skyrim Hotel</title>
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
                <i class="bi bi-pencil-square me-2"></i>Edit Guest
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.guests.update', $guest) }}" enctype="multipart/form-data"
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
                                   value="{{ $guest->first_name }}" required/>
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
                                   value="{{ $guest->last_name }}" required/>
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
                            <input type="email" id="email" name="email" class="form-control" value="{{ $guest->email }}"
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
                                   value="{{ $guest->phone_number }}"
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
                        <div class="d-flex flex-column align-items-center flex-md-row">
                            <div class="mb-3 mb-md-0 d-flex">
                                Status <span class="text-danger">*</span>
                            </div>
                            <div class="w-100 d-flex justify-content-between justify-content-md-end">
                                <div class="me-3">
                                    <input class="btn-check tran-3" type="radio" name="status" value="1"
                                           id="active" {{ $guest->status == 1 ? 'checked' : '' }} />
                                    <label class="btn btn-outline-light  tran-3 text-success fw-bold"
                                           for="active">Active</label>
                                </div>

                                <div>
                                    <input class="btn-check tran-3" type="radio" name="status" value="0"
                                           id="locked" {{ $guest->status == 0 ? 'checked' : '' }} />
                                    <label class="btn btn-outline-light  tran-3 text-danger fw-bold"
                                           for="locked">Locked</label>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('status'))
                            @foreach ($errors->get('status') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-4">
                    {{--            image input--}}
                    <div class="p-4 pt-0 pt-lg-4">
                        <label class="form-label" for="phone">Avatar</label>
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div>
                    <div class="p-4 pt-0 w-75">
                        <img
                            src="{{ $guest->image != "" ? asset('storage/admin/guests/' . $guest->image) : asset('images/noavt.jpg') }}"
                            alt="guest_image"
                            class="img-fluid  ">
                    </div>
                </div>
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
