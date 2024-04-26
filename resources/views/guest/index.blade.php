<title>Home - Skyrim Hotel</title>
<x-guestLayout>
    {{--alert edit success--}}
    @if (session('success'))
        @include('partials.flashMsgSuccess')
    @endif
    {{--alert edit fail--}}
    @if (session('failed'))
        @include('partials.flashMsgFail')
    @endif
    {{--    HERO--}}
    <section class="m-nav mb-5 position-relative bg-black">
        <div
            class="mh-screen overflow-hidden fade-in load-hidden">
            <div class="h-100 overflow-hidden"
                 style="background-image: url('{{asset('images/hero.jpg')}}'); background-position: center; background-size: cover">
                <div style="background-color: rgba(0, 0, 0, 0.6);">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="container text-white">
                            <div class="row justify-content-center text-center align-items-center">
                                <div class="display-2 text-center text-capitalize col-12 mb-3">
                                    Book Your Stay
                                </div>
                                <div class="mb-3 col-12">
                                    <p class="fs-4">A stay infused with creativity and culture</p>
                                </div>
                                <div class="col-10">
                                    <form method="post" action="{{route('guest.rooms.search')}}"
                                          class="bg-white p-3 m-0 shadow rounded" autocomplete="off">
                                        @csrf
                                        @method('POST')
                                        <div class="row g-3">
                                            <div class="col-12 col-lg-3">
                                                <!-- checkin input -->
                                                <div>
                                                    <input id="checkin" name="checkin" type="text"
                                                           placeholder="Check in" required
                                                           class="my-input form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <!-- checkout input -->
                                                <div>
                                                    <input id="checkout" name="checkout" type="text"
                                                           placeholder="Check out" required
                                                           class="my-input form-control">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <!-- guest num input -->
                                                <div>
                                                    <input type="number" id="guest_num" name="guest_num"
                                                           class="my-input form-control"
                                                           required step="1" min="1" max="10" placeholder="Guests"/>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-3">
                                                <!-- Submit button -->
                                                <button type="submit" id="bookBtn"
                                                        class="btn btn-primary tran-2 w-100">
                                                    Check Availability
                                                </button>
                                            </div>
                                        </div>
                                        <div id="dateError"
                                             class="col-12 text-start d-none text-danger pt-3"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    END HERO--}}

    {{--    ABOUT US--}}
    <section class="welcome-section my-5 py-5 load-hidden fade-in">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-10 h-100">
                    <div class="h-100 text-dark d-flex flex-column justify-content-center align-items-center">
                        <div class="w-100 text-center">
                            <span class="text-uppercase text-primary">Welcome to SkyrimHotel</span>
                            <h2 class="font-2 display-6 my-3">Find the perfect space for your stay</h2>
                        </div>
                        <p class="lead col-10 text-center">All rooms have a bathroom with bathtub and/or shower, cable
                            television/radio,
                            free WIFI and mini bar. In addition, all rooms are equipped with a Nespresso coffee machine.
                        </p>
                        <!-- Carousel wrapper -->
                        <div id="carouselMaterialStyle" class="mt-3 carousel slide carousel-fade"
                             data-mdb-ride="carousel"
                             data-mdb-carousel-init>
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                <button type="button" data-mdb-target="#carouselMaterialStyle" data-mdb-slide-to="0"
                                        class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                <button type="button" data-mdb-target="#carouselMaterialStyle" data-mdb-slide-to="1"
                                        aria-label="Slide 2"></button>
                                <button type="button" data-mdb-target="#carouselMaterialStyle" data-mdb-slide-to="2"
                                        aria-label="Slide 3"></button>
                            </div>

                            <!-- Inner -->
                            <div class="carousel-inner rounded shadow-sm overflow-hidden">
                                <!-- Single item -->
                                <div class="carousel-item active">
                                    <img src="{{asset('images/1.png')}}"
                                         class="w-100 d-block tran-3"/>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Double Room</h5>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    </div>
                                </div>

                                <!-- Single item -->
                                <div class="carousel-item">
                                    <img src="{{asset('images/2.png')}}"
                                         class="w-100 d-block tran-3"/>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Deluxe City View</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>

                                <!-- Single item -->
                                <div class="carousel-item">
                                    <img src="{{asset('images/3.png')}}"
                                         class="w-100 d-block tran-3"/>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>King Bedroom</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Inner -->

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-mdb-target="#carouselMaterialStyle"
                                    data-mdb-slide="prev">
                                <span aria-hidden="true">
                                    <i class="bi bi-chevron-left fs-2"></i>
                                </span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-mdb-target="#carouselMaterialStyle"
                                    data-mdb-slide="next">
                                <span aria-hidden="true">
                                    <i class="bi bi-chevron-right fs-2"></i>
                                </span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <!-- Carousel wrapper -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-pic">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="img/about/about-1.jpg" alt="">
                            </div>
                            <div class="col-sm-6">
                                <img src="img/about/about-2.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--    ABOUT US--}}

    {{-- SERVICES --}}
    <section id="introduction" class="my-5 py-5 load-hidden fade-in">
        <!-- Background image -->
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-10 h-100">
                    <div class="h-100 text-dark d-flex flex-column justify-content-center align-items-center">
                        <div class="w-100 text-center">
                            <span class="text-uppercase text-primary">THE ESSENTIAL IN-ROOM AMENITIES</span>
                            <h2 class="font-2 display-6 my-3">All the essentials you need</h2>
                        </div>
                        <div class="row mt-3 g-5">
                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-wifi fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">Wifi & Internet</h6>
                                <p class="px-3 text-center">Lorem ipsum proin gravida velit auctor sde re sit amet
                                    space.</p>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-cup-straw fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">Bar And Lounge Area</h6>
                                <p class="px-3 text-center">
                                    Lorem ipsum proin gravida velit auctor sde re sit amet space.
                                </p>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-car-front fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">Private Parking Space</h6>
                                <p class="px-3 text-center">Lorem ipsum proin gravida velit auctor sde re sit amet
                                    space.</p>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-headset fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">24/7 Room Services</h6>
                                <p class="px-3 text-center">Lorem ipsum proin gravida velit auctor sde re sit amet
                                    space.</p>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-person-walking fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">Diverse Guide Tour</h6>
                                <p class="px-3 text-center">
                                    Lorem ipsum proin gravida velit auctor sde re sit amet space.
                                </p>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="d-flex justify-content-center mb-4">
                                    <div class="bg-light p-4 rounded-circle shadow-sm">
                                        <i class="bi bi-bicycle fs-4"></i>
                                    </div>
                                </div>
                                <h6 class="font-2 text-primary text-center mb-3">Free Fitness Center</h6>
                                <p class="px-3 text-center">Lorem ipsum proin gravida velit auctor sde re sit amet
                                    space.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- ENDINTRODUCTION --}}
    {{--     ==========   MCDATEPICKER FORM INPUT ==========--}}
    <script>
        const datePicker1 = MCDatepicker.create({
            el: '#checkin',
            theme: {
                theme_color: '#3b71ca',

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
                theme_color: '#3b71ca',

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

