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
                            <h4 class="text-primary fw-bold mb-4 mb-md-0">My profile</h4>
                            <a class="btn btn-outline-danger  tran-3  mb-4 mb-md-0"
                               data-bs-toggle="modal"
                               data-bs-target="#exampleModal"
                               data-id="1">
                                <i class="bi bi-x-circle me-1"></i>Delete account
                            </a>
                        </div>
                        {{--                    form--}}
                        <form method="post" action="{{route('guest.updateAccount')}}"
                              enctype="multipart/form-data"
                              class="mb-0">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4 g-4">
                                <div class="col-12 col-lg-8">
                                    {{--first name--}}
                                    <div class="mb-4">
                                        <div>
                                            <label class="form-label" for="first_name">First name</label>
                                            <input type="text" id="first_name" name="first_name"
                                                   class="form-control"
                                                   value="{{$guest->first_name}}" required/>
                                        </div>
                                        @if ($errors->has('first_name'))
                                            @foreach ($errors->get('first_name') as $error)
                                                <span class="text-danger fs-7">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                    {{-- last name--}}
                                    <div class="mb-4">
                                        <div>
                                            <label class="form-label" for="last_name">Last name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                   value="{{$guest->last_name}}" required/>
                                        </div>
                                        @if ($errors->has('last_name'))
                                            @foreach ($errors->get('last_name') as $error)
                                                <span class="text-danger fs-7">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Email input -->
                                    <div class="mb-4">
                                        <div>
                                            <label class="form-label" for="email">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   value="{{$guest->email}}" required/>
                                        </div>
                                        @if ($errors->has('email'))
                                            @foreach ($errors->get('email') as $error)
                                                <span class="text-danger fs-7">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Phone Number input -->
                                    <div class="">
                                        <div>
                                            <label class="form-label" for="phone">Phone number</label>
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                   value="{{$guest->phone_number}}" maxlength="20" required/>
                                        </div>
                                        @if ($errors->has('phone'))
                                            @foreach ($errors->get('phone') as $error)
                                                <span class="text-danger fs-7">{{ $error }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="col-12 col-lg-4">
                                    <div class="mb-4">
                                        <label class="form-label" for="image">Avatar</label>
                                        <input type="file" class="form-control" id="image" name="image" value=""/>
                                    </div>
                                    <div>
                                        <img
                                            src="{{ $guest->image != "" ? asset('storage/admin/guests/' . $guest->image) : asset('images/noavt.jpg') }}"
                                            alt="guest_image"
                                            class="w-100 h-auto shadow ">
                                    </div>
                                </div>
                            </div>
                            <!-- Submit button -->
                            <div
                                class="d-flex flex-column-reverse flex-lg-row justify-content-between justify-content-md-start align-items-center">
                                <a data-mdb-ripple-init href="{{ route('guest.profile') }}"
                                   class="btn btn-secondary col-12 col-lg-auto me-lg-3  tran-3">
                                    Cancel
                                </a>
                                <button data-mdb-ripple-init type="submit"
                                        class="btn btn-primary  col-12 col-lg-auto mb-3  mb-lg-0  tran-3">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                    {{--                    form--}}
                </div>
            </div>
            {{--                CONTENT--}}
        </div>
        <!-- Delete Account Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ route('guest.deleteAccount') }}">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                                <i class="bi bi-x-circle me-2"></i>Are you sure?
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="deletePassword" class="form-label">
                                Please enter your password:
                            </label>
                            <div>
                                <input type="password" name="deletePassword"
                                       class="form-control" id="deletePassword" required
                                       minlength="6">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary "
                                    data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-danger ">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guestLayout>
