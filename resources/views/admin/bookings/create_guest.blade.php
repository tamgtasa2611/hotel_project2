<title>Thêm đặt phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý đặt phòng</h4>
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
                <i class="bi bi-plus-circle me-2"></i>Thêm đặt phòng
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('POST')
            <div class="row overflow-hidden">
                <!--  input -->
                <div class="col-12 col-xl-5">
                    <div class="p-4 d-flex align-items-center justify-content-between">
                        <div class="">
                            <label class="form-label" for="checkin">Check in <span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="">
                            <input id="checkin" name="checkin" type="text"
                                   placeholder="Ngày nhận phòng"
                                   class=" form-control"
                                   value=""
                                   required
                            >
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-xl-5">
                    <div class="p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <label class="form-label" for="checkout">Check out <span
                                    class="text-danger">*</span></label>
                        </div>
                        <div class="">
                            <input id="checkout" name="checkout" type="text"
                                   placeholder="Ngày trả phòng"
                                   value=""
                                   class=" form-control"
                                   required
                            >
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 col-xl-2">
                    <div class="p-4 text-end h-100">
                        <button class="btn btn-primary">Tìm kiếm</button>
                    </div>
                </div>
            </div>
            {{--                    --}}{{--                    guest with account--}}
            {{--                    <div class="p-4 col-12">--}}
            {{--                        <div class="row g-4">--}}
            {{--                            <div class="col-4">--}}
            {{--                                <label class="form-label" for="guest">Khách</label>--}}
            {{--                            </div>--}}
            {{--                            <div class="col-8">--}}
            {{--                                <select name="guest" id="guest" class="form-select">--}}
            {{--                                    <option value="">--- Khách có tài khoản ---</option>--}}
            {{--                                    @foreach($guests as $guest)--}}
            {{--                                        <option value="{{$guest->id}}">{{$guest->last_name . ' ' . $guest->first_name}}--}}
            {{--                                        </option>--}}
            {{--                                    @endforeach--}}
            {{--                                </select>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        @if ($errors->has('name'))--}}
            {{--                            @foreach ($errors->get('name') as $error)--}}
            {{--                                <span class="text-danger fs-7">{{ $error }}</span>--}}
            {{--                            @endforeach--}}
            {{--                        @endif--}}
            {{--                    </div>--}}
            {{--   =========================--}}

            <div class="col-12">
                <div class="p-4 pt-0">
                    <div class="bg-white shadow-sm border rounded-3">
                        <div class="p-4 d-flex align-items-center">
                            <div>
                                <h6 class="m-0">Danh sách phòng khả dụng</h6>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div id="roomTypes" class="row g-4 m-0 p-0 overflow-hidden justify-content-evenly">
                            <div class="px-4">
                                <table class="table">
                                    <thead>
                                    <th></th>
                                    <th>Loại phòng</th>
                                    <th class="text-center align-middle">Giá (1 đêm)</th>
                                    <th class="text-center align-middle">Sức chứa</th>
                                    <th class="text-center align-middle">Số phòng khả dụng</th>
                                    <th style="width: 120px" class="align-middle"></th>
                                    </thead>
                                    <tbody>
                                    @foreach($roomTypes as $roomType)
                                        @if($roomType->rooms_count != 0)
                                            <tr>
                                                <td class="align-middle">
                                                    <input type="checkbox" class="">
                                                </td>
                                                <td class="align-middle">
                                                    {{$roomType->name}}
                                                </td>
                                                <td class="text-center align-middle">
                                            <span
                                                class="text-success">{{\App\Helpers\AppHelper::vnd_format($roomType->price)}}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{$roomType->max_capacity}}
                                                </td>
                                                <td class="text-center align-middle">
                                                    {{($roomType->rooms_count)}}
                                                </td>
                                                <td style="width: 120px" class="align-middle text-center">
                                                    <input type="number" class="form-control" value="0" min="0"
                                                           max="{{$roomType->rooms_count}}">
                                                </td>
                                            </tr>
                                        @else
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="m-0">
            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.bookings') }}"
                   class="btn btn-secondary px-3 tran-3 me-3">
                    Quay lại
                </a>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary px-3 tran-3">
                    Tiếp tục
                </button>
            </div>
        </form>
    </div>

    {{--     ==========   MCDATEPICKER FORM INPUT ==========--}}
    <script>
        const datePicker1 = MCDatepicker.create({
            el: '#checkin',
            theme: {
                theme_color: '#2fa4e7',

            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(),
            minDate: new Date(),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Cancel',
            autoClose: true
        });

        const datePicker2 = MCDatepicker.create({
            el: '#checkout',
            theme: {
                theme_color: '#2fa4e7',

            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(),
            minDate: new Date(new Date().setDate(new Date().getDate() + 1)),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Cancel',
            autoClose: true
        });

        let checkValid = true;
        let dateError = $("#dateError");
        let bookBtn = $("#bookBtn");
        let currentDate = new Date().toJSON().slice(0, 10);

        // check date 1 < date 2
        datePicker1.onSelect(function (date, formatedDate) {
            console.log(datePicker2.getFullDate())
            if (datePicker2.getFullDate() != null) {
                if (date >= datePicker2.getFullDate()) {
                    dateErrorAction()
                } else {
                    dateValidAction()
                }
            }
        });

        datePicker1.onClear(function (date, formatedDate) {
            if (datePicker2.getFullDate() != null) {
                if (date >= datePicker2.getFullDate()) {
                    dateErrorAction()
                } else {
                    dateValidAction()
                }
            }
        });

        datePicker2.onSelect(function (date, formatedDate) {
            if (datePicker1.getFullDate() != null) {
                if (date <= datePicker1.getFullDate()) {
                    dateErrorAction()
                } else {
                    dateValidAction()
                }
            }
        });

        datePicker2.onClear(function (date, formatedDate) {
            if (datePicker1.getFullDate() != null) {
                if (date <= datePicker1.getFullDate()) {
                    dateErrorAction()
                } else {
                    dateValidAction()
                }
            }
        });

        function dateErrorAction() {
            dateError.removeClass("d-none");
            dateError.html('<i class="bi bi-exclamation-circle"></i> Check Out date must be after Check In date!');
            bookBtn.removeAttr("type").attr("type", "button");
        }

        function dateValidAction() {
            dateError.addClass("d-none");
            dateError.html();
            bookBtn.removeAttr("type").attr("type", "submit");
        }
    </script>
    {{--     ==========   END MCDATEPICKER FORM INPUT ==========--}}
</x-adminLayout>
