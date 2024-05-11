<title>Rooms - Skyrim Hotel</title>
<x-guestLayout>
    <section id="rooms" class="m-nav">
        @if(session('failed'))
            @include('partials.flashMsgFail')
        @endif
        <div class="container load-hidden fade-in">
            {{--            heading--}}
            <div class="mb-5 pt-5">
                <h6 class="display-6 text-primary fw-bold m-0">
                    {{$countRoom}} rooms available
                </h6>
            </div>
            {{--            end heading--}}

            {{--            rooms--}}
            <div class="mb-5 row g-4">
                <div class="col-12 col-lg-9">
                    @if($countRoom != 0)
                        {{--                right side--}}
                        <div class="">
                            <div
                                class="w-100 d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
                                {{--                        VIEW GIRD/LIST FORM--}}
                                <form class="d-none d-md-flex m-0 align-items-center">
                                    <div class="">
                                        <input class="btn-check tran-3" type="radio" name="view" value="grid"
                                               id="grid"
                                               onchange="this.form.submit()" {{$view == 'grid' ? 'checked' : ''}}
                                        />
                                        <label class=" tran-3 btn btn-outline-light text-primary"
                                               for="grid"> <i class="bi bi-grid h-100"></i></label>
                                    </div>
                                    <div class="ms-3">
                                        <input class="btn-check tran-3" type="radio" name="view" value="list"
                                               id="list"
                                               onchange="this.form.submit()" {{$view == 'list' ? 'checked' : ''}}/>
                                        <label class=" tran-3 btn btn-outline-light text-primary"
                                               for="list"> <i class="bi bi-list h-100"></i></label>
                                    </div>
                                    {{--                            search--}}
                                    <input type="text" name="checkin" value="{{$search['checkin']}}"
                                           class="visually-hidden"
                                           hidden>
                                    <input type="text" name="checkout" value="{{$search['checkout']}}"
                                           class="visually-hidden"
                                           hidden>
                                    <input type="text" name="guest_num" value="{{$search['guest_num']}}"
                                           class="visually-hidden"
                                           hidden>
                                    {{--                            sort--}}
                                    <input type="text" name="sort" value="{{$sort}}" class="visually-hidden" hidden>
                                    {{--                            price--}}
                                    <input type="text" name="from_price" value="{{$price['from_price']}}"
                                           class="visually-hidden"
                                           hidden>
                                    <input type="text" name="to_price" value="{{$price['to_price']}}"
                                           class="visually-hidden"
                                           hidden>
                                    {{--                            roomType--}}
                                    @foreach($type as $value)
                                        <input type="text" name="roomType[]" class="visually-hidden" hidden
                                               value="{{$value}}">
                                    @endforeach
                                </form>
                                {{--                        VIEW GIRD/LIST FORM--}}

                                {{--                        SORTING--}}
                                <div class="d-flex align-items-center justify-content-between col-12 col-md-auto">
                                    <div class="text-primary fw-bold me-3">
                                        Sort by<i class="ms-2 bi bi-arrow-down-up"></i>
                                    </div>
                                    <form class="m-0 flex-fill">
                                        <select class="form-select auto-submit" name="sort" id="sort"
                                                aria-label="sort" onchange="this.form.submit()">
                                            <option value="0" {{$sort == 0 ? 'selected' : ''}}>Recommended</option>
                                            <option value="1" {{$sort == 1 ? 'selected' : ''}}>Rating: Low to High
                                            </option>
                                            <option value="2" {{$sort == 2 ? 'selected' : ''}}>Rating: High to Low
                                            </option>
                                            <option value="3" {{$sort == 3 ? 'selected' : ''}}>Price: Low to High
                                            </option>
                                            <option value="4" {{$sort == 4 ? 'selected' : ''}}>Price: High to Low
                                            </option>
                                        </select>
                                        {{--                            search--}}
                                        <input type="text" name="checkin" value="{{$search['checkin']}}"
                                               class="visually-hidden"
                                               hidden>
                                        <input type="text" name="checkout" value="{{$search['checkout']}}"
                                               class="visually-hidden"
                                               hidden>
                                        <input type="text" name="guest_num" value="{{$search['guest_num']}}"
                                               class="visually-hidden"
                                               hidden>
                                        {{--                                view--}}
                                        <input type="text" name="view" value="{{$view}}" class="visually-hidden" hidden>
                                        {{--                            price--}}
                                        <input type="text" name="from_price" value="{{$price['from_price']}}"
                                               class="visually-hidden"
                                               hidden>
                                        <input type="text" name="to_price" value="{{$price['to_price']}}"
                                               class="visually-hidden"
                                               hidden>
                                        {{--                            roomType--}}
                                        @foreach($type as $value)
                                            <input type="text" name="roomType[]" class="visually-hidden" hidden
                                                   value="{{$value}}">
                                        @endforeach
                                    </form>
                                </div>
                                {{--                        SORTING--}}
                            </div>
                            {{--                    ROOMS DIV--}}
                            @if($view == 'grid')
                                <div id="rooms_div" class="row row-cols-1 row-cols-md-2 g-4">
                                    @foreach($rooms as $room)
                                        <div class="col-12 col-md-6 overflow-hidden">
                                            <div class="  bg-dark shadow-lg row m-0 mb-3">
                                                <div class="col-12 p-0 overflow-hidden -4 position-relative">
                                                    <div class="overflow-hidden ratio ratio-16x9">
                                                        <a href="{{route('guest.rooms.show', $room)}}">
                                                            @if(count($room->images) != 0)
                                                                <img
                                                                    src="{{asset('storage/admin/rooms/'.$room->images[0]->path)}}"
                                                                    alt="room_img"
                                                                    class="object-fit-cover shadow-lg tran-3 img-fluid"/>
                                                            @else
                                                                <img src="{{asset('images/noimage.jpg')}}"
                                                                     alt="room_img"
                                                                     class="object-fit-cover shadow-lg tran-3 img-fluid"/>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-12 row m-0 p-0 p-4 justify-content-between flex-column">
                                                    <div
                                                        class="col-12 p-0 d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <a href="{{route('guest.rooms.show', $room)}}"
                                                               class="text-decoration-none">
                                                                <h4 class="fw-bold m-0">
                                                                    Room {{$room->name}}
                                                                </h4>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex w-100 justify-content-start">
                                                                <div class="me-3">
                                                                    <i class="bi bi-house me-2"></i>{{$room->roomType->name}}
                                                                </div>
                                                                <div class="">
                                                                    <i class="bi bi-people me-2"></i>{{$room->capacity}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-12 p-0">
                                                        <div
                                                            class="d-flex justify-content-between align-items-baseline w-100">
                                                            <div class="">
                                                                <h5 class="m-0 fw-bold text-success">
                                                                    ${{$room->roomType->base_price}}<span
                                                                        class="text-muted fs-7">/night</span>
                                                                </h5>
                                                            </div>
                                                            <div>
                                                                <a href="{{route('guest.rooms.show', $room)}}"
                                                                   class="btn btn-outline-primary ">
                                                                    Book now
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div id="rooms_div" class="">
                                    @foreach($rooms as $room)
                                        <div class="  shadow-lg row m-0 mb-4 bg-dark overflow-hidden">
                                            <div
                                                class="col-12 col-md-4 p-0 overflow-hidden position-relative">
                                                <div class="overflow-hidden ratio ratio-16x9">
                                                    <a href="{{route('guest.rooms.show', $room)}}"
                                                       class="ratio ratio-16x9">
                                                        @if(count($room->images) != 0)
                                                            <img
                                                                src="{{asset('storage/admin/rooms/'.$room->images[0]->path)}}"
                                                                alt="room_img"
                                                                class="object-fit-cover shadow-lg tran-3 "/>
                                                        @else
                                                            <img src="{{asset('images/noimage.jpg')}}" alt="room_img"
                                                                 class="object-fit-cover shadow-lg tran-3 "/>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>

                                            <div
                                                class="col-12 col-md-8 row m-0 p-0 p-4 justify-content-between flex-column">
                                                <div
                                                    class="col-12 p-0 d-flex justify-content-between align-items-center mb-3">
                                                    <div>
                                                        <a href="{{route('guest.rooms.show', $room)}}"
                                                           class="text-decoration-none">
                                                            <h4 class="fw-bold m-0">
                                                                Room {{$room->name}}
                                                            </h4>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex w-100 justify-content-start">
                                                            <div class="me-3">
                                                                <i class="bi bi-house me-2"></i>{{$room->roomType->name}}
                                                            </div>
                                                            <div class="">
                                                                <i class="bi bi-people me-2"></i>{{$room->capacity}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-12 p-0">
                                                    <div
                                                        class="d-flex justify-content-between align-items-baseline w-100">
                                                        <div class="">
                                                            <h5 class="m-0 fw-bold text-success">
                                                                ${{$room->roomType->base_price}}<span
                                                                    class="text-muted fs-7">/night</span>
                                                            </h5>
                                                        </div>
                                                        <div>
                                                            <a href="{{route('guest.rooms.show', $room)}}"
                                                               class="btn btn-outline-primary ">
                                                                Book now
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            {{--                   END ROOMS DIV--}}

                            <div class="mt-4 ">
                                {{$rooms->onEachSide(2)->links()}}
                            </div>
                        </div>
                    @else
                        <div>
                            No rooms to show!
                        </div>
                    @endif
                </div>
                {{--            filter--}}
                <div class="col-12 col-lg-3" style="height: fit-content !important;">
                    <div class="  shadow-lg bg-dark">
                        <div class="p-4">
                            <h5 class="m-0 fw-bold text-primary">Filter By <i class="ms-2 bi bi-sliders"></i></h5>
                        </div>
                        <hr class="m-0">
                        <form class="p-4 m-0">
                            {{-- price filter--}}
                            <div class="mb-4">
                                <div class="mb-3 fw-bold">
                                    Price
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <span class="input-group-text text-success">$</span>
                                            <input type="number" id="from" class="form-control" name="from_price"
                                                   placeholder="From" min="0"
                                                   value="{{$price['from_price']}}"/>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-group">
                                            <span class="input-group-text text-success">$</span>
                                            <input type="number" id="to" class="form-control" name="to_price"
                                                   placeholder="To" value="{{$price['to_price']}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end price filter--}}

                            {{--           rating filter--}}
                            <div class="mb-4">
                                <div class="mb-3 fw-bold">
                                    Rating
                                </div>
                                <div class="">
                                    @php
                                        $starFill = 5;
                                        $star = 0;
                                    @endphp
                                    @for($rate = 5; $rate >= 1; $rate--)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                   name="rating" value="{{$rate}}"
                                                   id="rating_{{$rate}}"
                                                {{$rating == $rate ? 'checked' : ''}}
                                            />
                                            <label class="form-check-label"
                                                   for="rating_{{$rate}}">
                                                @for($i = $starFill; $i >= 1; $i--)
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                @endfor
                                                @for($j = 0; $j < $star; $j++)
                                                    <i class="bi bi-star text-warning"></i>
                                                @endfor
                                            </label>
                                        </div>
                                        @php
                                            $starFill--;
                                            $star++;
                                        @endphp
                                    @endfor
                                </div>
                            </div>
                            {{--                       end rating filter--}}

                            {{--                        room type filter--}}
                            <div class="mb-4">
                                <div class="mb-3 fw-bold">
                                    Room type
                                </div>
                                <div class="">
                                    @foreach($roomTypes as $roomType)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$roomType->id}}"
                                                   id="roomType_{{$roomType->id}}" name="roomType[]"
                                                {{in_array($roomType->id, $type) ? 'checked' : ''}}/>
                                            <label class="form-check-label"
                                                   for="roomType_{{$roomType->id}}">{{$roomType->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{--                       end room type filter--}}

                            <div class="row gx-3">
                                <div class="col">
                                    <a href="{{route('guest.rooms')}}"
                                       class="btn btn-secondary w-100 ">Reset</a>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary w-100 ">Apply
                                    </button>
                                </div>
                            </div>
                            {{--                            search--}}
                            <input type="text" name="checkin" value="{{$search['checkin']}}" class="visually-hidden"
                                   hidden>
                            <input type="text" name="checkout" value="{{$search['checkout']}}" class="visually-hidden"
                                   hidden>
                            <input type="text" name="guest_num" value="{{$search['guest_num']}}" class="visually-hidden"
                                   hidden>
                        </form>
                    </div>

                    {{--            search form--}}
                    <div class="  shadow-lg bg-dark mt-4">
                        <div class="p-4">
                            <h5 class="m-0 fw-bold text-primary">Check Availability <i class="ms-2 bi bi-search"></i>
                            </h5>
                        </div>
                        <hr class="m-0">
                        <form method="get"
                              class="m-0 p-4" autocomplete="off">
                            <div class="row g-4">
                                <div class="col-12">
                                    <!-- checkin input -->
                                    <div>
                                        <input id="checkin" name="checkin" type="text"
                                               placeholder="Check in"
                                               class="my-input form-control"
                                               value="{{$search['checkin']}}"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- checkout input -->
                                    <div>
                                        <input id="checkout" name="checkout" type="text"
                                               placeholder="Check out"
                                               value="{{$search['checkout']}}"
                                               class="my-input form-control"
                                               required
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- guest num input -->
                                    <div>
                                        <input type="number" id="guest_num" name="guest_num"
                                               class="my-input form-control"
                                               step="1" min="1" max="10" placeholder="Guests"
                                               value="{{$search['guest_num']}}"
                                               required/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Submit button -->
                                    <button type="submit" id="bookBtn"
                                            class="btn btn-outline-primary tran-3 w-100 ">
                                        Check Availability
                                    </button>
                                </div>

                                {{--                                view--}}
                                <input type="text" name="view" value="{{$view}}" class="visually-hidden" hidden>
                                {{--                            price--}}
                                <input type="text" name="from_price" value="{{$price['from_price']}}"
                                       class="visually-hidden"
                                       hidden>
                                <input type="text" name="to_price" value="{{$price['to_price']}}"
                                       class="visually-hidden"
                                       hidden>
                                {{--                            roomType--}}
                                @foreach($type as $value)
                                    <input type="text" name="roomType[]" class="visually-hidden" hidden
                                           value="{{$value}}">
                                @endforeach
                            </div>
                            <div id="dateError"
                                 class="col-12 d-none text-danger pt-3"></div>
                        </form>
                    </div>
                    {{--           end search form--}}
                </div>
                {{--            filter--}}
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
