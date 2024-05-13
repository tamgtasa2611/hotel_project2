<title>Edit room information - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm  mb-4">
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
    <div class="bg-white  shadow-sm  overflow-hidden">
        <div
            class="p-4  -bottom">
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
                    <div class="p-4 col-12">
                        <div class="">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ $room->name }}" required/>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- capacity input -->
                    <div class="p-4 pt-0">
                        <div class="">
                            <label class="form-label" for="capacity">Capacity <span class="text-danger">*</span></label>
                            <input type="number" id="capacity" name="capacity" class="form-control"
                                   value="{{ $room->capacity }}" min="1" max="10"
                                   required/>
                        </div>
                        @if ($errors->has('capacity'))
                            @foreach ($errors->get('capacity') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- room type input -->
                    <div class="p-4 pt-0">
                        <label class="form-label" for="room_type_id">Room type <span
                                class="text-danger">*</span></label>
                        <select class="form-select" name="room_type_id" id="room_type_id" aria-label="room_type"
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
                    <div class="p-4 pt-0">
                        <label class="form-label" for="customFile">Add room images (choose one or multiple)</label>
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
                        <div class="  mt-4 me-4">
                            <div class="-bottom p-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="bi bi-image me-2"></i>Current room images
                                </div>
                                <div>
                                    <a data-bs-toggle="modal"
                                       data-bs-target="#deleteAll"
                                       href="#!">
                                        <i class="bi bi-trash3-fill text-danger ps-2"></i>
                                    </a>
                                </div>
                            </div>
                            <div
                                class="p-4 pt-0 row row-cols-1 row-cols-md-2 row-cols-xl-4">
                                @foreach($roomImages as $image)
                                    <div class="overflow-hidden  pt-3 h-100 room-img position-relative">
                                        <img src="{{asset('storage/admin/rooms/' . $image->path)}}"
                                             class="w-100 h-100 object-fit-cover   "
                                             alt="room_img">
                                        <a data-id="{{$image->id}}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteOne"
                                           href="#!"
                                           class="dlt-btn position-absolute end-0 me-3 mt-1 bg-danger overflow-hidden p-0 ">
                                            <i class="bi bi-x text-white p-0 fs-5"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class=" d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.rooms') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    Back
                </a>
                @if(count($roomTypes) == 0)
                    <a href="{{ route('admin.roomTypes.create') }}"
                       class="btn btn-primary  tran-3 me-3">
                        Add Room Type
                    </a>
                @else
                    <!-- Submit button -->
                    <button type="submit"
                            class="btn btn-primary  tran-3">
                        Update
                    </button>
                @endif
            </div>
        </form>
        <!-- Delete All Images Modal -->
        <div class="modal fade" id="deleteAll" tabindex="-1"
             aria-labelledby="deleteAllLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="get" action="{{route('admin.rooms.update.destroyAllImages', $room)}}">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="deleteAllLabel">
                                <i class="bi bi-x-circle me-2"></i>Are you sure?
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete <span class="fw-bold">all images</span> of this room?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary "
                                    data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-danger ">
                                Delete All
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete 1 Image Modal -->
        <div class="modal fade" id="deleteOne" tabindex="-1"
             aria-labelledby="deleteOneLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="get" action="{{route('admin.rooms.update.destroyImage', $room)}}">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5 text-danger" id="deleteOneLabel">
                                <i class="bi bi-x-circle me-2"></i>Are you sure?
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Do you want to delete this image?
                            <input id="id" name="id" hidden class="visually-hidden"
                                   value="">
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
    </div>
</x-adminLayout>
