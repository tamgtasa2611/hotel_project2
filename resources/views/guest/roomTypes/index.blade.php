<title>Rooms - Skyrim Hotel</title>
<x-guestLayout>
    <section id="rooms" class="m-nav">
        {{--            heading--}}
        <div class="mb-5 d-flex flex-column justify-content-center align-items-center "
             style="height: 40dvh;background-image: url('{{asset('images/room_list.jpg')}}'); background-position: center; background-size: cover">
            <h6 class="display-6 fw-bold text-white m-0">
                Danh sách phòng
            </h6>
        </div>
        {{--            end heading--}}

        <div class="container load-hidden fade-in">
            {{--            rooms--}}
            <div class="mb-5 row g-4">
                {{--            filter--}}
                <div class="col-12 col-lg-3" style="height: fit-content !important;">
                    {{--            search form--}}
                    <div class="shadow-sm bg-white mb-4 border rounded-3">
                        <div class="p-4">
                            <h5 class="m-0 fw-bold text-primary text-center">Tìm phòng trống
                            </h5>
                        </div>
                        <hr class="m-0">
                        <form method="get"
                              class="m-0 p-4" autocomplete="off">
                            <div class="row g-4">
                                <div class="col-12">
                                    <label for="checkin" class="form-label"><i
                                            class="bi bi-box-arrow-in-right me-2"></i>Ngày
                                        nhận
                                        phòng</label>
                                    <!-- checkin input -->
                                    <div>
                                        <input id="checkin" name="checkin" type="text"
                                               placeholder="Ngày nhận phòng"
                                               class=" form-control"
                                               value="{{$search['checkin']}}"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="checkout" class="form-label"><i
                                            class="bi bi-box-arrow-in-left me-2"></i>Ngày
                                        trả phòng</label>
                                    <!-- checkout input -->
                                    <div>
                                        <input id="checkout" name="checkout" type="text"
                                               placeholder="Ngày trả phòng"
                                               value="{{$search['checkout']}}"
                                               class=" form-control"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Submit button -->
                                    <button type="submit" id="bookBtn"
                                            class="btn btn-primary tran-3 w-100 ">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>
                            <div id="dateError"
                                 class="col-12 d-none text-danger pt-3"></div>
                        </form>
                    </div>
                    {{--           end search form--}}
                </div>
                {{--                rooms--}}
                <div class="col-12 col-lg-9">
                    @if(count($roomTypes) != 0)
                        {{--                right side--}}
                        <div class="">
                            <div
                                class="w-100 d-flex flex-column flex-md-row justify-content-end align-items-center mb-4">
                                {{--                        SORTING--}}
                                <div class="d-flex align-items-center justify-content-between col-12 col-md-auto">
                                    <div class="text-primary fw-bold me-3">
                                        Sắp xếp theo <i class="ms-2 bi bi-arrow-down-up"></i>
                                    </div>
                                    <form class="m-0 flex-fill">
                                        <select class="form-select auto-submit" name="sort" id="sort"
                                                aria-label="sort" onchange="this.form.submit()">
                                            <option value="0" {{$sort == 0 ? 'selected' : ''}}>Mới nhất</option>
                                            <option value="1" {{$sort == 1 ? 'selected' : ''}}>Đánh giá cao
                                            </option>
                                            <option value="2" {{$sort == 2 ? 'selected' : ''}}>Đặt nhiều
                                            </option>
                                            <option value="3" {{$sort == 3 ? 'selected' : ''}}>Giá thấp nhất
                                            </option>
                                            <option value="4" {{$sort == 4 ? 'selected' : ''}}>Giá cao nhất
                                            </option>
                                        </select>
                                        {{--                            search--}}
                                        <input type="text" name="checkin" value="{{$search['checkin']}}"
                                               class="visually-hidden"
                                               hidden>
                                        <input type="text" name="checkout" value="{{$search['checkout']}}"
                                               class="visually-hidden"
                                               hidden>
                                    </form>
                                </div>
                                {{--                        SORTING--}}
                            </div>
                            {{--                    ROOMS DIV--}}
                            <div id="rooms_div" class="row row-cols-1 row-cols-md-2 g-4">
                                @foreach($roomTypes as $roomType)
                                    @if($roomType->rooms_count != 0)
                                        <div class="col-12 col-md-6  ">
                                            <div class="bg-white shadow-sm border row m-0 mb-3 rounded-3">
                                                <div class="col-12 p-0 overflow-hidden -4 position-relative">
                                                    <div class="overflow-hidden ratio ratio-16x9">
                                                        <a href="{{route('guest.rooms.show', $roomType)}}">
                                                            @if(count($roomType->images) != 0)
                                                                <img
                                                                    src="{{asset('storage/rooms/'.$roomType->images[0]->path)}}"
                                                                    alt="room_img"
                                                                    class="object-fit-cover shadow-sm tran-3 img-fluid rounded-top-3"/>
                                                            @else
                                                                <img src="{{asset('images/noimage.jpg')}}"
                                                                     alt="room_img"
                                                                     class="object-fit-cover shadow-sm tran-3 img-fluid rounded-top-3"/>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-12 row m-0 p-0 p-4 justify-content-between flex-column">
                                                    <div
                                                        class="col-12 p-0 mb-3">
                                                        <div class="d-flex justify-content-between">
                                                            <a href="{{route('guest.rooms.show', $roomType)}}"
                                                               class="text-decoration-none">
                                                                <h4 class="fw-bold m-0">
                                                                    {{$roomType->name}}
                                                                </h4>
                                                            </a>
                                                            <div class="text-success">
                                                                {{\App\Helpers\AppHelper::vnd_format($roomType->price)}}
                                                                <span class="fs-7 text-secondary">/đêm</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-12 p-0">
                                                        <div
                                                            class=" fs-7 d-flex justify-content-between align-items-baseline w-100">
                                                            <div class="d-flex">
                                                                <div>
                                                                    @php
                                                                        $roomCount = 0;
                                                                        foreach ($roomType->rooms as $room) {
                                                                            if($room->status == 0) {
                                                                                $roomCount++;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    Còn {{$roomCount}} phòng trống
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <form
                                                                    action="{{route('guest.cart.addToCart')}}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" hidden class="visually-hidden"
                                                                           name="id"
                                                                           value="{{$roomType->id}}">
                                                                    <input type="hidden" hidden class="visually-hidden"
                                                                           name="checkin"
                                                                           value="{{$search['checkin']}}">
                                                                    <input type="hidden" hidden class="visually-hidden"
                                                                           name="checkout"
                                                                           value="{{$search['checkout']}}">
                                                                    <button type="submit"
                                                                            class="btn btn-primary tran-3">
                                                                        Đặt ngay
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-center align-items-center w-100"
                                             style="height: 200px">
                                            Không có phòng nào trống trong khoảng thời gian này
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            {{--                   END ROOMS DIV--}}

                            <div class="mt-4 ">
                                {{$roomTypes->onEachSide(2)->links()}}
                            </div>
                        </div>
                    @else
                        <div>
                            Không có phòng nào để hiển thị!
                        </div>
                    @endif
                </div>
                {{--                endrooms--}}
            </div>
            {{--            end rooms--}}
        </div>
    </section>
    {{--     ==========   MCDATEPICKER FORM INPUT ==========--}}
    <script>
        const datePicker1 = MCDatepicker.create({
            el: '#checkin',
            theme: {
                theme_color: '#3459e6',

            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(`{{$checkin}}`),
            minDate: new Date(),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Cancel',
            autoClose: true
        });

        const datePicker2 = MCDatepicker.create({
            el: '#checkout',
            theme: {
                theme_color: '#3459e6',

            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(`{{$checkout}}`),
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
</x-guestLayout>
