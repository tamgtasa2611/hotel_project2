<title>Add new room - Skyrim Hotel</title>
<x-adminLayout>
    {{--------------- MAIN --------------}}
    <div class="p-3 bg-white rounded shadow-sm border mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Rooms Management</h4>
        </div>
    </div>

    <div class="bg-white rounded shadow-sm border overflow-hidden">
        <div
            class="p-3 rounded-top border-bottom">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Add new room
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            <!-- name input -->
            <div class="p-3 col-12  col-lg-6 col-xl-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                           required/>
                    <label class="form-label" for="name">Room name <span class="text-danger">*</span></label>
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->get('name') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- capacity input -->
            <div class="p-3 pt-0 col-12 col-lg-6 col-xl-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="number" id="capacity" name="capacity" class="form-control"
                           value="{{ old('capacity') }}" min="1" max="10"
                           required/>
                    <label class="form-label" for="capacity">Capacity <span class="text-danger">*</span></label>
                </div>
                @if ($errors->has('capacity'))
                    @foreach ($errors->get('capacity') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            <!-- room type input -->
            <div class="p-3 pt-0 col-12 col-lg-6 col-xl-4">
                <select class="form-select" name="room_type_id" aria-label="room_type"
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
            <div class="p-3 pt-0 col-12 col-lg-6 col-xl-4">
                <label class="form-label" for="customFile">Room images</label>
                <input type="file" class="form-control" multiple name="images[]"
                       accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp"/>
                @if ($errors->has('images[]'))
                    @foreach ($errors->get('images[]') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start border-top p-3">
                <a data-mdb-ripple-init href="{{ route('admin.rooms') }}"
                   class="btn btn-secondary rounded tran-2 me-3">
                    Back
                </a>
                @if(count($roomTypes) == 0)
                    <a data-mdb-ripple-init href="{{ route('admin.roomTypes.create') }}"
                       class="btn btn-primary rounded tran-2 me-3">
                        Add Room Type
                    </a>
                @else
                    <!-- Submit button -->
                    <button data-mdb-ripple-init type="submit" class="btn btn-primary rounded tran-2">
                        Save
                    </button>
                @endif
            </div>
        </form>
    </div>
</x-adminLayout>
