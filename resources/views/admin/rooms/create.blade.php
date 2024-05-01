<title>Add new room - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white rounded-4 shadow-lg border mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Rooms Management</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white rounded-4 shadow-lg border  overflow-hidden">
        <div
            class="p-4 rounded-top border-bottom">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Add new room
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            <!-- name input -->
            <div class="p-4 col-12  col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="name">Room name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                           required/>
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->get('name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- capacity input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <div class="">
                    <label class="form-label" for="capacity">Capacity <span class="text-danger">*</span></label>
                    <input type="number" id="capacity" name="capacity" class="form-control"
                           value="{{ old('capacity') }}" min="1" max="10"
                           required/>
                </div>
                @if ($errors->has('capacity'))
                    @foreach ($errors->get('capacity') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- room type input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <label class="form-label" for="room_type_id">Room type <span class="text-danger">*</span></label>
                <select class="form-select" name="room_type_id" id="room_type_id" aria-label="room_type"
                        required {{count($roomTypes) == 0 ? 'disabled' : ''}}>
                    @if(count($roomTypes) == 0)
                        <option selected>No room type available</option>
                    @else
                        @foreach($roomTypes as $roomType)
                            <option value="{{$roomType->id}}">
                                {{$roomType->name}}
                            </option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('room_type_id'))
                    @foreach ($errors->get('room_type_id') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- image input -->
            <div class="p-4 pt-0 col-12 col-lg-6 col-xl-4">
                <label class="form-label" for="customFile">Room images (choose one or multiple)</label>
                <input type="file" class="form-control" multiple name="images[]"
                       accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp"/>
                @if ($errors->has('images[]'))
                    @foreach ($errors->get('images[]') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start border-top p-4">
                <a href="{{ route('admin.rooms') }}"
                   class="btn btn-secondary rounded-pill tran-2 me-3">
                    Back
                </a>
                @if(count($roomTypes) == 0)
                    <a href="{{ route('admin.roomTypes.create') }}"
                       class="btn btn-primary rounded-pill tran-2 me-3">
                        Add Room Type
                    </a>
                @else
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary rounded-pill tran-2">
                        Save
                    </button>
                @endif
            </div>
        </form>
    </div>
</x-adminLayout>
