<title>Sửa phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý phòng</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{-- ------------- MAIN ------------ --}}
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Sửa phòng
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data"
            class="m-0">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- name input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="name">Tên phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $room->name }}" required />
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- status input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="status">Trạng thái phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <select type="text" id="status" name="status" class="form-select">
                                    <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Khả dụng</option>
                                    <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Không khả dụng
                                    </option>
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('status'))
                            @foreach ($errors->get('status') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- type input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="room_type_id">Loại phòng</label>
                            </div>
                            <div class="col-8">
                                <select class="form-select" name="room_type_id" id="room_type_id" aria-label="room_type"
                                    required {{ count($roomTypes) == 0 ? 'disabled' : '' }}>
                                    @if (count($roomTypes) == 0)
                                        <option selected>Không có loại phòng khả dụng</option>
                                    @else
                                        @foreach ($roomTypes as $roomType)
                                            <option value="{{ $roomType->id }}"
                                                {{ $room->room_type_id == $roomType->id ? 'selected' : '' }}>
                                                {{ $roomType->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('room_type_id'))
                            @foreach ($errors->get('room_type_id') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class=" d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.rooms') }}" class="btn btn-secondary  tran-3 me-3">
                    Quay lại
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    Cập nhật
                </button>
            </div>
        </form>
        <!-- Delete All Images Modal -->
        <div class="modal fade" id="deleteAll" tabindex="-1" aria-labelledby="deleteAllLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="get" action="{{ route('admin.rooms.update.destroyAllImages', $room) }}">
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
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
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
        <div class="modal fade" id="deleteOne" tabindex="-1" aria-labelledby="deleteOneLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="get" action="{{ route('admin.rooms.update.destroyImage', $room) }}">
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
                            <input id="id" name="id" hidden class="visually-hidden" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
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
