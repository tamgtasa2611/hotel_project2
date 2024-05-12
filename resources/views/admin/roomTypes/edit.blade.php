<title>Edit room type information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-dark  shadow  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Room Types Management</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-dark  shadow  overflow-hidden">
        <div
            class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit room type
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.roomTypes.update', $roomType) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <!-- name input -->
            <div class="p-4 col-12  col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="name">Type name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ $roomType->name }}" required/>
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->get('name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- description Number input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="base_price">Base price per night ($) <span
                            class="text-danger">*</span></label>
                    <input type="number" id="base_price" name="base_price" class="form-control"
                           value="{{ $roomType->base_price }}" step="0.01" min="0"
                           required/>
                </div>
                @if ($errors->has('base_price'))
                    @foreach ($errors->get('base_price') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <div class="d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.roomTypes') }}"
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
