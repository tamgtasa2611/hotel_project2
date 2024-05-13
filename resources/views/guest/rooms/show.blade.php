<title>Room {{$room->name}} - Skyrim Hotel</title>
{{--calendar--}}
<script src="{{asset('plugins/calendar/index.global.min.js')}}"></script>
<x-guestLayout>
    {{--            alert--}}
    @if ($errors->has('checkin'))
        @foreach ($errors->get('checkin') as $error)
            {{session()->flash('failed', $error)}}
            @include('partials.flashMsgFail')
            {{session()->forget('failed')}}
        @endforeach
    @endif
    @if ($errors->has('checkout'))
        @foreach ($errors->get('checkout') as $error)
            {{session()->flash('failed', $error)}}
            @include('partials.flashMsgFail')
            {{session()->forget('failed')}}
        @endforeach
    @endif

    <section id="rooms" class="m-nav">
        {{--        main--}}
        <div class="container load-hidden fade-in">
            {{--            room detail--}}
            <div class="mb-5 pt-5">
                <div class="row g-5">
                    {{--                calendar--}}
                    <div class="col-12 col-lg-8 h-100">
                        <div class="bg-white p-4 pb-4 shadow-sm border rounded-3">
                            {{--                room image--}}
                            <div class="mb-4 ratio ratio-16x9 overflow-hidden">
                                @if(count($roomImages) > 1)
                                    <!-- Carousel wrapper -->
                                    <div id="carouselExampleAutoplaying" class="carousel slide"
                                         data-bs-ride="carousel">
                                        <div
                                            class="carousel-inner  shadow-sm tran-3 ratio ratio-16x9 overflow-hidden">
                                            @foreach($roomImages as $image)
                                                <div class="carousel-item {{$image == $roomImages[0] ? 'active' : '' }}"
                                                     data-bs-interval="4000">
                                                    <img src="{{asset('storage/admin/rooms/'.$image->path)}}"
                                                         class="d-block w-100  shadow-sm object-fit-cover"
                                                         alt="...">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                                data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <!-- Carousel wrapper -->
                                @elseif(count($roomImages) == 1)
                                    <div class=" shadow-sm overflow-hidden ratio ratio-16x9">
                                        <!--  item -->
                                        @foreach($roomImages as $image)
                                            <div
                                                class="overflow-hidden ratio ratio-16x9 ">
                                                <img src="{{asset('storage/admin/rooms/'.$image->path)}}"
                                                     class="d-block w-100  shadow-sm object-fit-cover"/>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class=" shadow-sm overflow-hidden ratio ratio-16x9">
                                        <!--  item -->
                                        <div
                                            class="overflow-hidden ratio ratio-16x9 ">
                                            <img src="{{asset('images/noimage.jpg')}}"
                                                 class="d-block w-100  shadow-sm object-fit-cover"/>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <div>
                                    <h1 class="m-0 fw-bold text-primary">{{$room->name}}</h1>
                                    <div class="fw-bold">{{$room->roomType->name}}
                                        / Giường {{$room->bed_size}} chỗ
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p class="">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus.
                                </p>
                                <p class="">
                                    Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat
                                    massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                    In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                                    eu pede mollis pretium. Integer tincidunt.
                                </p>
                            </div>
                            <div class="mb-4">
                                <h4 class="mb-3 text-primary">Tiện nghi</h4>
                                <div class="row h-100 g-4">
                                    <div class="col-12 col-md-4 h-100">
                                        <div class="shadow-sm   h-100 fs-6 p-4 text-center">
                                            Kitchen Items
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 h-100">
                                        <div class="shadow-sm   h-100 fs-6 p-4 text-center">Baby
                                            Crib
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 h-100">
                                        <div class="shadow-sm   h-100 fs-6 p-4 text-center">
                                            Washing
                                            Machine
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                calendar--}}
                    {{--               booking details--}}
                    <div class="col-12 col-lg-4 h-100">
                        <form method="post"
                              class="bg-white p-4 m-0 shadow-sm border rounded-3"
                              action="{{route('guest.cart.addToCart', $room)}}">
                            @csrf
                            @method('POST')
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <h4 class="m-0 fw-bold text-primary">Đặt phòng</h4>
                                <div><span
                                        class="text-success">{{AppHelper::vnd_format($room->price)}}</span> / đêm
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <!-- checkin input -->
                                    <div>
                                        <input id="checkin" name="checkin" type="text"
                                               placeholder="Check in"
                                               class="my-input form-control"
                                               value=""
                                               required
                                               autocomplete="one-time-code">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- checkout input -->
                                    <div>
                                        <input id="checkout" name="checkout" type="text"
                                               placeholder="Check out"
                                               value=""
                                               class="my-input form-control"
                                               required
                                               autocomplete="one-time-code">
                                    </div>
                                </div>
                                <div id="dateError" class="col-12 d-none text-danger"></div>
                            </div>
                            <div class="col-12 mt-4">
                                <!-- Submit button -->
                                <button type="submit" id="bookBtn"
                                        class="btn btn-primary  tran-3 w-100">
                                    Xác nhận
                                </button>
                            </div>
                        </form>

                        <div class="mt-5 bg-white p-4 shadow-sm  border rounded-3">
                            <h4 class="mb-3 mt-md-0 fw-bold text-primary">Tình trạng phòng</h4>
                            <div id='calendar' class="fs-7 mb-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal slideUp" id="calendarModal" tabindex="-1"
                 aria-labelledby="calendarModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body h-100">
                            <div id='calendar' class="fs-7"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{--            rating--}}
            <div class="mb-5 bg-white p-4 shadow-sm border rounded-3" id="rating">
                <h4 class="mb-4 fw-bold text-primary">Đánh giá <i class="bi bi-star"></i></h4>
                {{--                review--}}
                <div class="row g-4">
                    <div class="col-12">
                        @if(count($roomRatings) != 0)
                            @foreach($roomRatings as $roomRating)
                                <div class="text-bg-white p-4 mb-4  shadow-sm">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="div-img overflow-hidden  shadow-sm"
                                                 style="height: 60px; width: 60px">
                                                <img
                                                    src="{{asset(($roomRating->booking->guest->image) ? 'storage/admin/guests/'.$roomRating->booking->guest->image : 'images/noavt.jpg')}}"
                                                    class=" object-fit-cover"
                                                    alt="guest_avatar" height="60px" width="60px">
                                            </div>
                                            <div class="ms-3">
                                                <div class="fw-bold">
                                                    {{$roomRating->booking->guest->first_name . ' ' . $roomRating->booking->guest->last_name}}
                                                </div>
                                                <div
                                                    class="fs-7 fst-italic text-muted">{{$roomRating->rate_date}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            @if($roomRating->rating == 5)
                                                <div>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </div>
                                                <div class="text-warning-emphasis">
                                                    😍 Amazing!
                                                </div>
                                            @elseif($roomRating->rating == 4)
                                                <div>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </div>
                                                <div class="text-warning-emphasis">
                                                    😊 Good!
                                                </div>
                                            @elseif($roomRating->rating == 3)
                                                <div>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </div>
                                                <div class="text-warning-emphasis">
                                                    🙂 Neutral!
                                                </div>
                                            @elseif($roomRating->rating == 2)
                                                <div>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </div>
                                                <div class="text-warning-emphasis">
                                                    😒 Bad!
                                                </div>
                                            @elseif($roomRating->rating == 1)
                                                <div>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </div>
                                                <div class="text-warning-emphasis">
                                                    😡 Worst!
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    @if($roomRating->review)
                                        <div class="mt-3">
                                            <p class="m-0 p-0">
                                                {{$roomRating->review}}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            Chưa có đánh giá nào...
                        @endif
                    </div>
                </div>
            </div>

            {{--            SIMILAR ROOMS--}}
            @if(count($similarRooms) != 0)
                <div class="mb-5 bg-white p-4 shadow-sm border rounded-3">
                    <h4 class="mb-4 fw-bold text-primary">Phòng tương tự <i
                            class="bi bi-search ms-2"></i></h4>
                    <div class="row row-cols-3 g-4">
                        @foreach($similarRooms as $sRoom)
                            <div class="col-12 col-md-4">
                                <div class="shadow-sm border rounded-3 position-relative">
                                    <div class="ratio ratio-16x9 -4 hover-zoom overflow-hidden ">
                                        @if(count($sRoom->images)== 0)
                                            <a href="{{route('guest.rooms.show', $sRoom)}}">
                                                <img src="{{asset('images/noimage.jpg')}}"
                                                     class="img-fluid rounded-top-3"
                                                     alt="s_room_img">
                                            </a>
                                        @else
                                            <a href="{{route('guest.rooms.show', $sRoom)}}">
                                                <img src="{{asset('storage/admin/rooms/'.$sRoom->images[0]->path)}}"
                                                     alt="s_room_img" class="img-fluid rounded-top-3">
                                            </a>
                                        @endif
                                    </div>
                                    <div
                                        class="position-absolute top-0 start-0 z-2 bg-white px-2 py-2 m-4 shadow-sm rounded-3 fs-7">
                                        <a href="{{route('guest.rooms.show', $sRoom)}}"
                                           class="text-reset">
                                                            <span
                                                                class="text-success">{{\App\Helpers\AppHelper::vnd_format($sRoom->price)}}</span>
                                            / đêm
                                        </a>
                                    </div>
                                    <div
                                        class="col-12 row m-0 p-0 p-4 justify-content-between flex-column">
                                        <div
                                            class="col-12 p-0 mb-3">
                                            <div>
                                                <a href="{{route('guest.rooms.show', $sRoom)}}"
                                                   class="text-decoration-none">
                                                    <h4 class=" fw-bold m-0">
                                                        {{$sRoom->name}}
                                                    </h4>
                                                </a>
                                            </div>
                                        </div>

                                        <div
                                            class="col-12 p-0">
                                            <div
                                                class=" fs-7 d-flex justify-content-between align-items-baseline w-100">
                                                <div>
                                                    {{$sRoom->roomType->name}}
                                                    / Giường {{$sRoom->bed_size}} chỗ
                                                </div>
                                                <div>
                                                    <a href="{{route('guest.rooms.show', $sRoom)}}"
                                                       class=" border-bottom border-primary border-2 pb-1">
                                                        Tìm hiểu thêm <i class="bi bi-chevron-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
    <script src="{{asset('plugins/calendar/moment.min.js')}}"></script>
    <script>
        moment().format();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'vi',
                firstDay: '1',
                buttonText: {today: "Hôm nay"},
                validRange: {
                    start: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
                    end: new Date(new Date().setMonth(new Date().getMonth() + 3)),
                },
                themeSystem: 'bootstrap5',
                events: @json($events),

            });
            calendar.render();
        });
    </script>
    {{--     ==========   MCDATEPICKER FORM INPUT ==========--}}
    <script>
        const datePicker1 = MCDatepicker.create({
            el: '#checkin',
            theme: {
                theme_color: '#008cba',
                main_background: 'rgb(30,36,49)',
                active_text_color: 'rgb(255,255,255)',
                inactive_text_color: 'rgba(255,255,255,0.3)',
            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            minDate: new Date(),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Cancel',
            autoClose: true
        });

        const datePicker2 = MCDatepicker.create({
            el: '#checkout',
            theme: {
                theme_color: '#008cba',
                main_background: 'rgb(30,36,49)',
                active_text_color: 'rgb(255,255,255)',
                inactive_text_color: 'rgba(255,255,255,0.3)',
            },
            bodyType: 'inline',
            dateFormat: 'dd-mm-yyyy',
            closeOnBlur: true,
            minDate: new Date(new Date().setDate(new Date().getDate() + 1)),
            maxDate: new Date(new Date().setMonth(new Date().getMonth() + 3)),
            jumpToMinMax: true,
            customCancelBTN: 'Cancel',
            autoClose: true
        });

        let checkValid = true;
        let dateError = $("#dateError");
        let dayBooked = 0;
        let basePrice = $("#basePriceValue").val();
        let amount = 0;
        let bookBtn = $("#bookBtn");
        let currentDate = new Date().toJSON().slice(0, 10);

        // check date 1 < date 2
        datePicker1.onSelect(function (date, formatedDate) {
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
            dateError.html('<i class="bi bi-exclamation-circle"></i> Ngày trả phòng phải sau ngày nhận phòng ít nhất 1 ngày!');
            bookBtn.removeAttr("type").attr("type", "button");
            $("#dayBooked").html(`0 ngày`);
            $("#amount").html(`0`);
        }

        function vnd_format(number) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number);
        }

        function dateValidAction() {
            dateError.addClass("d-none");
            dateError.html();
            bookBtn.removeAttr("type").attr("type", "submit");
            // lam tron ngay
            dayBooked = Math.round((datePicker2.getFullDate() - datePicker1.getFullDate()) / (1000 * 3600 * 24));

            if (dayBooked === 1) {
                $("#dayBooked").html(`1 ngày`);
                $("#amount").html(`${basePrice}`);
            } else {
                if (isNaN(dayBooked)) {
                    $("#dayBooked").html(`0 ngày`);
                    $("#amount").html(`0`);
                } else {
                    $("#dayBooked").html(`${dayBooked} ngày`);
                    let vnd = vnd_format(basePrice * dayBooked);
                    $("#amount").html(vnd);
                }
            }
        }
    </script>
    {{--     ==========   END MCDATEPICKER FORM INPUT ==========--}}
</x-guestLayout>
