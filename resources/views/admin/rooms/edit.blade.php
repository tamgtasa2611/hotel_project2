<title>Edit room information - Skyrim Hotel</title>
<x-adminLayout>
    {{--------------- MAIN --------------}}
    <div class="p-3 bg-white rounded shadow-3 mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Rooms Management</h4>
        </div>
    </div>

    <div class="bg-white rounded shadow-3 overflow-hidden">
        <div
            class="p-3 rounded-top border-bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit room
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <div class="row flex-column flex-lg-row">
                <div class="col-12 col-lg-6 col-xl-4">
                    <!-- name input -->
                    <div class="p-3 col-12">
                        <div data-mdb-input-init class="form-outline">
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ $room->name }}" required/>
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- capacity input -->
                    <div class="p-3 pt-0">
                        <div data-mdb-input-init class="form-outline">
                            <input type="number" id="capacity" name="capacity" class="form-control"
                                   value="{{ $room->capacity }}" min="1" max="10"
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
                    <div class="p-3 pt-0">
                        <select class="form-select" name="room_type_id" aria-label="room_type"
                                required {{count($roomTypes) == 0 ? 'disabled' : ''}}>
                            @if(count($roomTypes) == 0)
                                <option selected>No room type available</option>
                            @else
                                @foreach($roomTypes as $roomType)
                                    <option
                                        value="{{$roomType->id}}"
                                        {{$room->room_type_id == $roomType->id ? 'selected' : ''}}>
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
                    <div class="p-3 pt-0">
                        <label class="form-label" for="customFile">Add room images</label>
                        <input type="file" class="form-control" name="images[]"
                               accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp"
                               multiple/>
                        @if ($errors->has('images[]'))
                            @foreach ($errors->get('images[]') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-8">
                    {{--                    neu co anh --}}
                    @if(count($roomImages) != 0)
                        <div class="border m-3 rounded">
                            <div class="border-bottom p-3 d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="bi bi-image me-2"></i>Current room images
                                </div>
                                <div>
                                    <a data-mdb-ripple-init
                                       data-mdb-modal-init href="#deleteModal">
                                        <i class="bi bi-trash3-fill text-danger ps-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="p-3 pt-0 row row-cols-1 row-cols-md-2 row-cols-xl-4">
                                @foreach($roomImages as $image)
                                    <div class="overflow-hidden rounded pt-3 h-100 room-img position-relative">
                                        <img src="{{asset('storage/admin/rooms/' . $image->path)}}"
                                             class="w-100 h-100 object-fit-cover border rounded "
                                             alt="room_img">
                                        <a data-id="{{$image->id}}"
                                           data-mdb-ripple-init
                                           data-mdb-modal-init href="#delete1Modal"
                                           class="dlt-btn position-absolute end-0 me-3 mt-1 bg-danger overflow-hidden p-0 rounded-circle">
                                            <i class="bi bi-x text-white p-0 fs-5"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class=" d-flex justify-content-between justify-content-md-start border-top p-3">
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
                    <button data-mdb-ripple-init type="submit"
                            class="btn btn-primary rounded tran-2">
                        Update
                    </button>
                @endif
            </div>
        </form>
        <!-- Delete All Images Modal -->
        <div class="modal slideUp" id="deleteModal" tabindex="-1"
             aria-labelledby="deleteModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">
                            <i class="bi bi-x-circle me-2"></i>Are you sure?
                        </h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init
                                data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Do you want to delete <span class="fw-bold">all images</span> of this room?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded"
                                data-mdb-ripple-init
                                data-mdb-dismiss="modal">Cancel
                        </button>
                        <form method="get"
                              action="{{route('admin.rooms.update.destroyAllImages', $room)}}">
                            @csrf
                            <button class="btn btn-danger rounded" data-mdb-ripple-init>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete 1 Image Modal -->
        <div class="modal slideUp" id="delete1Modal" tabindex="-1"
             aria-labelledby="delete1ModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="delete1ModalLabel">
                            <i class="bi bi-x-circle me-2"></i>Are you sure?
                        </h5>
                        <button type="button" class="btn-close" data-mdb-ripple-init
                                data-mdb-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Do you want to delete this image?</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded"
                                data-mdb-ripple-init
                                data-mdb-dismiss="modal">Cancel
                        </button>
                        <form method="get"
                              action="{{route('admin.rooms.update.destroyImage', $room)}}">
                            @csrf
                            <input id="id" name="id" hidden class="visually-hidden"
                                   value="">
                            <button class="btn btn-danger rounded" data-mdb-ripple-init>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-adminLayout>
