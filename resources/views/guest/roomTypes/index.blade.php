<title>Rooms - Skyrim Hotel</title>
<x-guestLayout>
    <section id="rooms" class="m-nav">
        {{--            heading--}}
        <div class="mb-5 d-flex flex-column justify-content-center align-items-center "
             style="height: 40dvh;background-image: url('{{asset('images/room_list.jpg')}}'); background-position: center; background-size: cover">
            <h6 class="display-6 fw-bold text-white m-0 text-shadow">
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
                        <form method="get" id="searchForm"
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
                                    <button type="submit" id="searchBtn"
                                            class="btn btn-primary tran-3 w-100 ">
                                        <i class="bi bi-search me-2"></i>Tìm kiếm
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
                    <div id="rooms_side" class="tran-3">
                        @if(count($roomTypes) != 0)
                            {{--                right side--}}
                            <div class="">
                                <div
                                    class="w-100 d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                                    <div class="text-muted">
                                        Nhận phòng lúc 14:00 - Trả phòng lúc
                                        12:00
                                    </div>
                                    {{--                        SORTING--}}
                                    <div class="d-flex align-items-center justify-content-between col-12 col-md-auto">
                                        <div class="text-primary fw-bold me-3">
                                            <i class="me-2 bi bi-arrow-down-up"></i>Sắp xếp theo
                                        </div>
                                        <form class="m-0 flex-fill" id="sortForm" method="get">
                                            <select class="form-select auto-submit" name="sort" id="sort"
                                                    aria-label="sort">
                                                <option value="0" {{$sort == 0 ? 'selected' : ''}}>Mới nhất</option>
                                                <option value="1" {{$sort == 1 ? 'selected' : ''}}>Giá thấp nhất
                                                </option>
                                                <option value="2" {{$sort == 2 ? 'selected' : ''}}>Giá cao nhất
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                    {{--                        SORTING--}}
                                </div>
                                {{--                    ROOMS DIV--}}

                                <div
                                    class="center w-100 h-50 d-none d-flex justify-content-center align-items-center tran-3"
                                    id="wave">
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                    <div class="wave"></div>
                                </div>

                                <div id="rooms_div" class="tran-3 load-animation">
                                    <div class="row row-cols-1 row-cols-md-2 g-4">
                                        @foreach($roomTypes as $roomType)
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
                                                                        Còn @php
                                                                            $countRoom = 0;
                                                                                foreach ($rooms as $room) {
                                                                                 if($room->room_type_id == $roomType->id) {
                                                                                    $countRoom++;
                                                                                    }
                                                                                }
                                                                                echo $countRoom;
                                                                        @endphp
                                                                        phòng trống
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    @if($countRoom != 0)
                                                                        <form
                                                                            action="{{route('guest.cart.addToCart')}}"
                                                                            method="post" class="addToCartForm">
                                                                            @csrf
                                                                            @method('POST')
                                                                            <input type="hidden" name="_token"
                                                                                   id="token"
                                                                                   hidden
                                                                                   class="visually-hidden"
                                                                                   value="{{ csrf_token() }}">
                                                                            <input type="hidden" hidden
                                                                                   class="visually-hidden"
                                                                                   name="id"
                                                                                   value="{{$roomType->id}}">
                                                                            <button type="submit"
                                                                                    class="btn btn-primary tran-3 add-to-cart-btn">
                                                                                Đặt ngay
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        <button type="button" disabled
                                                                                class="btn btn-secondary disabled tran-3">
                                                                            Hết phòng
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
                </div>
                {{--                endrooms--}}
            </div>
            {{--            end rooms--}}
        </div>

        {{--        add to cart success modal--}}
        <div class="modal fade tran-3" id="ajax-modal">
            <div class="modal-dialog w-fit" role="document">
                <div class="modal-content w-fit overflow-hidden">
                    <div class="rounded-top-3 overflow-hidden text-center">
                        <h5 class="modal-title text-success mt-5 mb-4 text-center">
                            <i class="bi bi-check-circle display-1"></i>
                        </h5>
                    </div>
                    <div class="modal-body text-center px-5" id="success-ajax">
                    </div>
                    <div class="p-4 pt-0 text-center d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary tran-3 me-2 w-50" data-bs-dismiss="modal">Đóng
                        </button>
                        <a href="{{route('guest.cart')}}" class="btn btn-primary tran-3 w-50">Tới giỏ hàng</a>
                    </div>
                </div>
            </div>
        </div>
        {{--        end--}}
    </section>
    {{--     ==========   MCDATEPICKER FORM INPUT ==========--}}
    <script>
        const datePicker1 = MCDatepicker.create({
            el: '#checkin',
            theme: {
                theme_color: '#2fa4e7',

            },
            showCalendarDisplay: false,
            bodyType: 'inline',
            firstWeekday: 1,
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(`{{$checkin}}`),
            minDate: new Date(),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Quay lại',
            customOkBTN: 'Chọn',
            customClearBTN: 'Xóa',
            autoClose: true
        });

        const datePicker2 = MCDatepicker.create({
            el: '#checkout',
            theme: {
                theme_color: '#2fa4e7',

            },
            showCalendarDisplay: false,
            bodyType: 'inline',
            firstWeekday: 1,
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            selectedDate: new Date(`{{$checkout}}`),
            minDate: new Date(new Date().setDate(new Date().getDate() + 1)),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Quay lại',
            customOkBTN: 'Chọn',
            customClearBTN: 'Xóa',
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

    {{--    JQUERY AJAX ADD TO CART--}}
    <script>
        var addToCartAjax = function () {
            var btns = $(".add-to-cart-btn");
            // Attach a submit handler to the form
            $(".addToCartForm").submit(function (event) {

                // Stop form from submitting normally
                event.preventDefault();

                // Get some values from elements on the page:
                var $form = $(this),
                    token = $form.find("input[name='_token']").val(),
                    roomTypeId = $form.find("input[name='id']").val(),
                    checkin = $("#searchForm").find("input[name='checkin']").val(),
                    checkout = $("#searchForm").find("input[name='checkout']").val(),
                    url = $form.attr("action");
                btns.removeAttr("type").attr("type", "button");

                // Send the data using post
                var posting = $.post(url, {
                    _token: token,
                    id: roomTypeId,
                    checkin: checkin,
                    checkout: checkout
                });

                // Put the results in a div
                posting.done(function (data) {
                    $("#success-ajax").empty().append("Thêm phòng vào giỏ hàng thành công!");
                    $("#ajax-modal").modal('show');
                    btns.removeAttr("type").attr("type", "submit");
                });
            });

            var wave = $("#wave");
        }

        addToCartAjax();
        {{--    END ADD TO CART--}}

        {{--    JQUERY SEARCH ROOM--}}
        var wave = $("#wave");
        var searchBtn = $("#searchBtn");
        $("#searchForm").submit(function (event) {
            event.preventDefault();
            var $form = $("#searchForm"),
                sort = $("#sortForm").find(":selected").val(),
                checkin = $form.find("input[name='checkin']").val(),
                checkout = $form.find("input[name='checkout']").val(),
                url = `http://127.0.0.1:8000/rooms`;
            searchBtn.removeAttr("type").attr("type", "button");

            var getting = $.get(url, {
                sort: sort,
                checkin: checkin,
                checkout: checkout
            });

            $("#rooms_div").empty();
            wave.removeClass(" d-none ");

            // Put the results in a div
            getting.done(function (data) {
                setTimeout(function () {
                    wave.addClass(" d-none ")
                    $("#rooms_div").html($($.parseHTML(data)).find("#rooms_div"));
                    searchBtn.removeAttr("type").attr("type", "submit");
                    addToCartAjax();
                }, 1000)
            });
        });
        {{--    END SEARCH--}}

        {{--    JQUERY SORT--}}
        $("select").on("change", function (event) {
            var $form = $("#sortForm"),
                sort = $form.find(":selected").val(),
                checkin = $("#searchForm").find("input[name='checkin']").val(),
                checkout = $("#searchForm").find("input[name='checkout']").val(),
                url = `http://127.0.0.1:8000/rooms`;

            var getting = $.get(url, {
                sort: sort,
                checkin: checkin,
                checkout: checkout
            });

            $("#rooms_div").empty();
            wave.removeClass(" d-none ");

            getting.done(function (data) {
                setTimeout(function () {
                    wave.addClass(" d-none ")
                    $("#rooms_div").html($($.parseHTML(data)).find("#rooms_div"));
                    searchBtn.removeAttr("type").attr("type", "submit");
                    addToCartAjax();
                }, 500)
            });
        });
    </script>
    {{--    END--}}
</x-guestLayout>
