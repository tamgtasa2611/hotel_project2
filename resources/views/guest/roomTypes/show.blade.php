<title>{{$roomType->name}} - Skyrim Hotel</title>
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
                                    <div id="carouselExampleAutoplaying" class="carousel slide rounded-3"
                                         data-bs-ride="carousel">
                                        <div
                                            class="carousel-inner rounded-3  shadow-sm tran-3 ratio ratio-16x9 overflow-hidden">
                                            @foreach($roomImages as $image)
                                                <div class="carousel-item {{$image == $roomImages[0] ? 'active' : '' }}"
                                                     data-bs-interval="4000">
                                                    <img src="{{asset('storage/rooms/'.$image->path)}}"
                                                         class="d-block w-100 rounded-3 shadow-sm object-fit-cover"
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
                                                <img src="{{asset('storage/rooms/'.$image->path)}}"
                                                     class="d-block w-100 rounded-3 shadow-sm object-fit-cover"/>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class=" shadow-sm overflow-hidden ratio ratio-16x9">
                                        <!--  item -->
                                        <div
                                            class="overflow-hidden ratio ratio-16x9 ">
                                            <img src="{{asset('images/noimage.jpg')}}"
                                                 class="d-block w-100 rounded-3 shadow-sm object-fit-cover"/>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h1 class="m-0 fw-bold text-primary">{{$roomType->name}}</h1>
                                    <div class="fst-italic">Dành cho {{$roomType->max_capacity}} người
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
                                    @foreach($roomAmenities as $amenity)
                                        <div class="col-12 col-md-4 h-100">
                                            <div
                                                class="shadow-sm border rounded-3 bg-light  h-100 fs-6 p-4 text-center">
                                                {{$amenity->name}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                calendar--}}
                    {{--               booking details--}}
                    <div class="col-12 col-lg-4 h-100">
                        <form method="post"
                              class="bg-white m-0 shadow-sm border rounded-3 addToCartForm"
                              action="{{route('guest.cart.addToCart', $roomType->id)}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" hidden
                                   name="room_count"
                                   value="">
                            <input type="hidden" name="_token"
                                   id="token"
                                   hidden
                                   class="visually-hidden"
                                   value="{{ csrf_token() }}">
                            <input type="hidden" hidden
                                   class="visually-hidden"
                                   name="id"
                                   value="{{$roomType->id}}">
                            <div class=" p-4 d-flex justify-content-between align-items-center">
                                <h4 class="m-0 fw-bold text-primary">Đặt phòng</h4>
                                <div><span
                                        class="text-success">{{AppHelper::vnd_format($roomType->price)}}</span> / đêm
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="p-4">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label for="checkin" class="form-label"><i
                                                class="bi bi-box-arrow-in-right me-2"></i>Ngày
                                            nhận
                                            phòng</label>
                                        <!-- checkin input -->
                                        <div>
                                            <input id="checkin" name="checkin" type="text"
                                                   placeholder="Checkin"
                                                   class=" form-control"
                                                   value=""
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
                                                   placeholder="Checkout"
                                                   value=""
                                                   class=" form-control"
                                                   required
                                            >
                                        </div>
                                    </div>
                                    <div id="dateError" class="col-12 d-none text-danger"></div>
                                </div>
                                <div class="col-12 mt-4">
                                    <!-- Submit button -->
                                    <button type="submit" id="bookBtn"
                                            class="btn btn-primary  tran-3 w-100 add-to-cart-btn">
                                        Xác nhận
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="mt-5 bg-white  shadow-sm  border rounded-3">
                            <div class="d-flex justify-content-between align-items-center p-4">
                                <h4 class="m-0 fw-bold text-primary ">Đánh giá</h4>
                                <div>
                                    <i class="bi bi-chat-dots text-primary fs-5"></i>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div id='review-div' class="p-4">
                                @if(count($roomRatings) != 0)
                                    @foreach($roomRatings as $roomRating)
                                        <div class="text-bg-white mb-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="">
                                                        <div class="fw-bold">
                                                            {{$roomRating->guest->last_name . ' ' . $roomRating->guest->first_name }}
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
                                                            😍 Tuyệt vời!
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
                                                            😊 Tốt!
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
                                                            🙂 Tạm được!
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
                                                            😒 Kém!
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
                                                            😡 Tồi tệ!
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                            @if($roomRating->review)
                                                <div class="mt-3">
                                                    <p class="m-0 p-0 text-bg-light rounded-3 p-2">
                                                        {{$roomRating->review}}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center">
                                        {{$roomRatings->onEachSide(2)->links()}}
                                    </div>
                                @else
                                    Chưa có đánh giá nào...
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('plugins/calendar/moment.min.js')}}"></script>
    <script>
        moment().format();
    </script>
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
            selectedDate: new Date(`{{\Carbon\Carbon::today()}}`),
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
            selectedDate: new Date(`{{\Carbon\Carbon::today()->addDay()}}`),
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
