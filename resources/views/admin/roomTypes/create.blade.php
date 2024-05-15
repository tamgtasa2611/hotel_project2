<title>Add new room type - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm  mb-4">
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
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Thêm loại phòng
            </div>
        </div>
        {{-- FORM  --}}
        <hr class="m-0">
        <form method="post" action="{{ route('admin.roomTypes.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('POST')
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

                    <!--  Number input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="base_price">Giá (1 đêm) <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="number" id="price" name="price" class="form-control"
                                       value="{{ old('price') }}" step="0.01" min="1000"
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
                                       value="" step="1" min="0"
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
                                <label class="form-label" for="description">Chú thích</label>
                            </div>
                            <div class="col-8">
                        <textarea id="description" name="description" class="form-control"
                                  value="{{ old('description') }}"></textarea>
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
                                                                   id="checkbox_{{$room->id}}">
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
                        @if ($errors->has('max_capacity'))
                            @foreach ($errors->get('max_capacity') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="p-4 row">
                        <div class="col-4">
                            <label class="form-label" for="avt">Ảnh (chọn nhiều)</label>
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
                    Thêm
                </button>
            </div>
        </form>

    </div>

</x-adminLayout>
