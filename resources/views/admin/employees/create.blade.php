<title>Add new employee - Skyrim Hotel</title>
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
        <form method="post" action="{{ route('admin.employees.store') }}" enctype="multipart/form-data"
              class="bg-white p-5 rounded-5 border shadow-sm col-md-8 col-lg-6 col-xl-4">
            @csrf
            {{--                    heading --}}
            <div class="d-flex justify-content-center align-items-center mb-5">
                <h4 class="text-primary fw-bold">Add a new employee</h4>
            </div>
            {{--            Fullname--}}
            <div class="mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                           required/>
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
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                           required/>
                    <label class="form-label" for="email">Email address</label>
                </div>
                @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- Phone Number input -->
            <div class="mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}"
                           maxlength="20" required/>
                    <label class="form-label" for="phone">Phone number</label>
                </div>
                @if ($errors->has('phone'))
                    @foreach ($errors->get('phone') as $error)
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

            {{-- Image --}}
            <div class="mb-4">
                <input type="file" class="form-control" id="image" name="image"/>
            </div>

            <div class="d-flex justify-content-between">
                <a data-mdb-ripple-init href="{{ route('admin.employees') }}" class="btn btn-tertiary tran-2">
                    Back
                </a>
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary tran-2">
                    Add
                </button>
            </div>
        </form>
    </div>

</x-adminLayout>
