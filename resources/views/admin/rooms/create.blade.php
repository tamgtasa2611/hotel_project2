<title>Thêm phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý phòng</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Thêm phòng
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('POST')
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
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                       required/>
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
                                    <option value="0">Khả dụng</option>
                                    <option value="1">Không khả dụng</option>
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
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
                                        required {{count($roomTypes) == 0 ? 'disabled' : ''}}>
                                    @if(count($roomTypes) == 0)
                                        <option selected>Không có loại phòng khả dụng</option>
                                    @else
                                        @foreach($roomTypes as $roomType)
                                            <option
                                                value="{{$roomType->id}}">
                                                {{$roomType->name}}
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
            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.rooms') }}"
                   class="btn btn-secondary px-3 tran-3 me-3">
                    Quay lại
                </a>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary px-3 tran-3">
                    Thêm
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
