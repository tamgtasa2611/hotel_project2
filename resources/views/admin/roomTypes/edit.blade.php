<title>Quản lý loại phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý loại phòng</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4  -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Sửa loại phòng
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.roomTypes.update', $roomType) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- name input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="name">Tên loại phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ $roomType->name }}"
                                       required/>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!--  Number input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="base_price">Giá (1 đêm) <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="number" id="price" name="price" class="form-control"
                                       value="{{ $roomType->price }}" step="0.01" min="1000"
                                       required/>
                            </div>
                        </div>
                        @if ($errors->has('price'))
                            @foreach ($errors->get('price') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!--  Number input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="max_capacity">Sức chứa tối đa <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="number" id="max_capacity" name="max_capacity" class="form-control"
                                       value="{{ $roomType->max_capacity }}" step="1" min="0"
                                       required/>
                            </div>
                        </div>
                        @if ($errors->has('max_capacity'))
                            @foreach ($errors->get('max_capacity') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!-- description input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="description">Chú thích <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <textarea id="description" name="description"
                                          class="form-control">{{ trim($roomType->description) }}</textarea>
                            </div>
                        </div>
                        @if ($errors->has('description'))
                            @foreach ($errors->get('description') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <!--  choose room input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="max_capacity">Chọn phòng</label>
                            </div>
                            <div class="col-8">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                Danh sách phòng
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                             aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @if(count($rooms) != 0)
                                                    @foreach($rooms as $room)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   value="{{$room->id}}"
                                                                   name="rooms[]"
                                                                   id="checkbox_{{$room->id}}"
                                                                {{$room->room_type_id == $roomType->id  ? 'checked' : ''}}>
                                                            <label class="form-check-label"
                                                                   for="checkbox_{{$room->id}}">
                                                                {{$room->name}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    Danh sách phòng trống!
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('room[]'))
                            @foreach ($errors->get('room[]') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="p-4 row">
                        <div class="col-4">
                            <label class="form-label" for="avt">Ảnh</label>
                        </div>
                        <div class="col-8">
                            <input type="file" class="form-control" multiple name="images[]"
                                   accept=".jpg, .jpeg, .png, .bmp, .gif, .svg, .webp"/>
                            @if ($errors->has('images[]'))
                                @foreach ($errors->get('images[]') as $error)
                                    <span class="text-danger fs-7">{{ $error }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="p-4 row col-12 g-4">
                        @if(count($roomImages) != 0)
                            @foreach($roomImages as $image)
                                <div class="col-12 col-md-6">
                                    <div class="position-relative">
                                        <div class=" ratio ratio-16x9 ">
                                            <img src="{{asset('storage/rooms/' . $image->path)}}"
                                                 class="object-fit-cover rounded-3 border shadow-sm"
                                                 alt="room_img">
                                        </div>
                                        <a data-id="{{$image->id}}"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteOne"
                                           href="#!"
                                           class="dlt-btn position-absolute end-0 top-0 shadow-sm bg-danger badge rounded-3 mt-1 me-1 overflow-hidden">
                                            <i class="bi bi-x text-white p-0"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <hr class="m-0">
            <div class="d-flex justify-content-between justify-content-md-start -top p-4">
                <a href="{{ route('admin.roomTypes') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    Quay lại
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
    <!-- Delete 1 Image Modal -->
    <div class="modal fade" id="deleteOne" tabindex="-1"
         aria-labelledby="deleteOneLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="get" action="{{route('admin.roomTypes.destroyImage', $room)}}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="deleteOneLabel">
                            <i class="bi bi-x-circle me-2"></i>Xóa ảnh
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Bạn có chắc muốn xóa ảnh này?
                        <input id="id" name="id" hidden class="visually-hidden"
                               value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">
                            Quay lại
                        </button>
                        <button type="submit" class="btn btn-danger ">
                            Xóa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminLayout>
