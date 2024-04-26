<title>Edit guest information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-3 mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Guests Management</h4>
        </div>
    </div>

    <div class="bg-white rounded shadow-3 overflow-hidden">
        <div
            class="p-3 rounded-top border-bottom">
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
                    <div class="p-3">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                   value="{{ $guest->first_name }}" required/>
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
                                   value="{{ $guest->last_name }}" required/>
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
                            <input type="email" id="email" name="email" class="form-control" value="{{ $guest->email }}"
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

                    {{--                    <!-- password input -->--}}
                    {{--                    <div class="p-3 pt-0">--}}
                    {{--                        <div data-mdb-input-init class="form-outline input-group" id="show_hide_password">--}}
                    {{--                            <input type="password" id="password" name="password" class="form-control"--}}
                    {{--                                   value="{{ $guest->password }}" required minlength="6"/>--}}
                    {{--                            <a href="#!" class="input-group-text">--}}
                    {{--                                <i class="bi bi-eye-slash" aria-hidden="true"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <label class="form-label" for="password">Password</label>--}}
                    {{--                        </div>--}}
                    {{--                        @if ($errors->has('password'))--}}
                    {{--                            @foreach ($errors->get('password') as $error)--}}
                    {{--                                <span class="text-danger fs-7">{{ $error }}</span>--}}
                    {{--                            @endforeach--}}
                    {{--                        @endif--}}
                    {{--                    </div>--}}

                    {{--            phone number--}}
                    <div class="p-3 pt-0">
                        <div data-mdb-input-init class="form-outline">
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="{{ $guest->phone_number }}"
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
                        <div class="d-flex flex-column align-items-center flex-md-row">
                            <div class="mb-3 mb-md-0">
                                Status
                            </div>
                            <div class="w-100 d-flex justify-content-between justify-content-md-end">
                                <div class="me-3">
                                    <input class="btn-check tran-2" type="radio" name="status" value="1"
                                           id="active" {{ $guest->status == 1 ? 'checked' : '' }} />
                                    <label class="btn btn-outline-light rounded tran-2 text-success fw-bold"
                                           for="active">Active</label>
                                </div>

                                <div>
                                    <input class="btn-check tran-2" type="radio" name="status" value="0"
                                           id="locked" {{ $guest->status == 0 ? 'checked' : '' }} />
                                    <label class="btn btn-outline-light rounded tran-2 text-danger fw-bold"
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
                    <div class="p-3 pt-0 pt-lg-3">
                        <input type="file" class="form-control" id="image" name="image"/>
                    </div>
                    <div class="p-3 pt-0 w-50">
                        <img
                            src="{{ $guest->image != "" ? asset('storage/admin/guests/' . $guest->image) : asset('images/noavt.jpg') }}"
                            alt="guest_image"
                            class="img-fluid rounded border">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between justify-content-md-start border-top p-3">
                <a data-mdb-ripple-init href="{{ route('admin.guests') }}"
                   class="btn btn-secondary rounded tran-2 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary rounded tran-2">
                    Save
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
