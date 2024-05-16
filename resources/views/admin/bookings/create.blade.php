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
            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- name input -->
                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="checkin">Ngày nhận phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input id="checkin" name="checkin" type="text"
                                       placeholder="Ngày nhận phòng"
                                       class="my-input form-control"
                                       value=""
                                       required
                                >
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    {{--                    checkout--}}
                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="checkout">Ngày trả phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input id="checkout" name="checkout" type="text"
                                       placeholder="Ngày trả phòng"
                                       value=""
                                       class="my-input form-control"
                                       required
                                >
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                    {{--                    guest with account--}}
                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="guest">Khách</label>
                            </div>
                            <div class="col-8">
                                <select name="guest" id="guest" class="form-select">
                                    <option value="">--- Khách có tài khoản ---</option>
                                    @foreach($guests as $guest)
                                        <option value="{{$guest->id}}">{{$guest->last_name . ' ' . $guest->first_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="guest_name">Tên</label>
                            </div>
                            <div class="col-8">
                                <input id="guest_name" name="guest_name" type="text"
                                       placeholder=""
                                       value=""
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="guest_email">Email</label>
                            </div>
                            <div class="col-8">
                                <input id="guest_email" name="guest_email" type="text"
                                       placeholder=""
                                       value=""
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    <div class="p-4 col-12">
                        <div class="row g-4">
                            <div class="col-4">
                                <label class="form-label" for="guest_phone">Số điện thoại</label>
                            </div>
                            <div class="col-8">
                                <input id="guest_phone" name="guest_phone" type="text"
                                       placeholder=""
                                       value=""
                                       class="form-control"
                                       required>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            @foreach ($errors->get('name') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
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
                    Thêm
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
