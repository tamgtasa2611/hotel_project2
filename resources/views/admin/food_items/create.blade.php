<title>Thêm món ăn - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý món ăn</h4>
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
                <i class="bi bi-plus-circle me-2"></i>Thêm món ăn
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.foodItems.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- name input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="name">Tên món ăn <span
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

                    <!-- price input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="price">Giá <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="number" id="price" name="price" class="form-control"
                                       value="{{ old('price') }}" min="0" step="0.01"
                                       required/>
                            </div>
                        </div>
                        @if ($errors->has('price'))
                            @foreach ($errors->get('price') as $error)
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
                                <textarea id="description" name="description"
                                          class="form-control">{{old('description')}}</textarea>
                            </div>
                        </div>
                        @if ($errors->has('description'))
                            @foreach ($errors->get('description') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <hr class="m-0">
            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.foodItems') }}"
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
