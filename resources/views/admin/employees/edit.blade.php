<title>Edit employee information - Skyrim Hotel</title>
<x-adminLayout>
    @if (session('failed'))
        @include('partials.flashMsgFail')
    @endif
    {{-- HEADING --}}
    <div class="text-primary mb-3">
        <h3 class="fw-bold">Employees Management</h3>
    </div>
    {{-- FORM  --}}
    <div class="row d-flex justify-content-center">
        <form method="post" action="{{ route('admin.employees.update', $employee) }}" enctype="multipart/form-data"
              class="bg-white p-5 border rounded-5 shadow-sm col-md-8">
            @csrf
            @method('PUT')
            {{--                    heading --}}
            <div class="d-flex justify-content-center align-items-center mb-5">
                <h4 class="text-primary fw-bold">Edit employee information</h4>
            </div>
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Email input -->
                    <div class="mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="name" id="name" name="name" class="form-control"
                                   value="{{ $employee->name }}" required/>
                            <label class="form-label" for="name">Full name</label>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    <!-- Email input -->
                    <div class="mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="email" id="email" name="email" class="form-control"
                                   value="{{ $employee->email }}" required/>
                            <label class="form-label" for="email">Email address</label>
                        </div>
                        @if ($errors->has('email'))
                            @foreach ($errors->get('email') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Role input -->
                    <div class="mb-4">
                        <select class="form-select" aria-label="role select" name="role" id="role" required>
                            <option value="1" selected>Housekeeper</option>
                            <option value="2">Front Desk Agent</option>
                            <option value="3">Reservation Agent</option>
                            <option value="4">Waiter/Waitress</option>
                            <option value="5">Chef</option>
                            <option value="6">Security officer</option>
                        </select>
                        @if ($errors->has('role'))
                            @foreach ($errors->get('role') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- Phone Number input -->
                    <div class="mb-4">
                        <div data-mdb-input-init class="form-outline">
                            <input type="tel" id="phone" name="phone" class="form-control"
                                   value="{{ $employee->phone_number }}" maxlength="20" required/>
                            <label class="form-label" for="phone">Phone number</label>
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
                        <input type="file" class="form-control" id="image" name="image" value=" "/>
                    </div>
                    <div class="mb-4">
                        <img
                            src="{{ $employee->image != "" ? asset('storage/admin/employee/' . $employee->image) : asset('images/noavt.jpg') }}"
                            alt="employee_image"
                            class="w-100 h-auto">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a data-mdb-ripple-init href="{{ route('admin.employees') }}" class="btn btn-tertiary tran-2">
                    Back
                </a>
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary tran-2">
                    Update
                </button>
            </div>
        </form>
    </div>

</x-adminLayout>
