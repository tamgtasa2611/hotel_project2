<title>Add new room type - Skyrim Hotel</title>
<x-adminLayout>
    {{--------------- MAIN --------------}}
    <div class="p-3 bg-dark rounded shadow-sm  mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Room Types Management</h4>
        </div>
    </div>

    <div class="bg-dark rounded shadow-sm  overflow-hidden">
        <div
            class="p-3  -bottom">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Add new room type
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.roomTypes.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            <!-- name input -->
            <div class="p-3 col-12  col-lg-6 col-xl-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                           required/>
                    <label class="form-label" for="name">Type name</label>
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->get('name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- description Number input -->
            <div class="p-3 pt-0 col-12 col-lg-6 col-xl-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="number" id="base_price" name="base_price" class="form-control"
                           value="{{ old('base_price') }}" step="0.01" min="0"
                           required/>
                    <label class="form-label" for="base_price">Base price per night ($)</label>
                </div>
                @if ($errors->has('base_price'))
                    @foreach ($errors->get('base_price') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <div class="d-flex justify-content-between justify-content-md-start -top p-3">
                <a data-mdb-ripple-init href="{{ route('admin.roomTypes') }}"
                   class="btn btn-secondary rounded tran-3 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary rounded tran-3">
                    Save
                </button>
            </div>
        </form>

    </div>

</x-adminLayout>
