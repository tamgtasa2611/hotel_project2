<title>My bookings - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU--}}
                <div class="col-12 col-lg-3">
                    <div class="p-4  shadow-sm  bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU--}}

                {{--                CONTENT--}}
                <div class="col-12 col-lg-9 h-100">
                    <div
                        class="p-4  shadow-sm  bg-white d-flex flex-column justify-content-between h-100">
                        <div>
                            <div
                                class="d-flex align-items-baseline justify-content-between flex-column flex-md-row mb-4">
                                <h4 class="text-primary fw-bold m-0 d-flex">
                                    @php
                                        $bookingDate = Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $booking->created_date);

                                        $bookingDay = $bookingDate->get('day');
                                    if(mb_strlen($bookingDay) == 1) {
                                        $bookingDay = '0' . $bookingDay;
                                    }

                                    $bookingMonth = $bookingDate->get('month');
                                    if(mb_strlen($bookingMonth) == 1) {
                                        $bookingMonth = '0' . $bookingMonth;
                                    }

                                    $bookingYear = $bookingDate->get('year');

                                    $bookingHour = $bookingDate->get('hour');
                                    if(mb_strlen($bookingHour) == 1) {
                                        $bookingHour = '0' . $bookingHour;
                                    }

                                    $bookingMin = $bookingDate->get('minute');
                                    if(mb_strlen($bookingMin) == 1) {
                                        $bookingMin = '0' . $bookingMin;
                                    }
                                    @endphp

                                    Booking #{{$booking->id}}
                                    <div class="ms-3 d-flex align-items-center justify-content-center">
                                        @switch($booking->status)
                                            @case(0)
                                                <div class="badge bg-danger ">
                                                    Pending
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="badge bg-warning ">
                                                    Confirmed
                                                </div>
                                                @break
                                            @case(2)
                                                <div class="badge bg-info ">
                                                    Ongoing
                                                </div>
                                                @break
                                            @case(3)
                                                <div class="badge bg-success ">
                                                    Completed
                                                </div>
                                                @break
                                            @case(4)
                                                <div class="badge bg-danger ">
                                                    Cancelled
                                                </div>
                                                @break
                                            @case(5)
                                                <div class="badge bg-white ">
                                                    Refund
                                                </div>
                                                @break
                                        @endswitch
                                    </div>
                                </h4>
                                <p class="m-0">Placed
                                    on {{$bookingDate->englishDayOfWeek . ', ' . $bookingDay . '/' . $bookingMonth . '/' . $bookingYear . ' at ' . $bookingHour . ':' . $bookingMin}}
                                </p>
                            </div>
                            <div class="overflow-x-auto">
                                <div class="mb-2 fw-bold   -primary  ps-2">
                                    Guest details<i class="bi bi-person text-warning ms-2"></i>
                                </div>
                                <div class="overflow-x-auto mb-2">
                                    <table class="table table-hover align-middle">
                                        <tr>
                                            <td class="w-25">
                                                Name
                                            </td>
                                            <td>
                                                {{$booking->guest->first_name . ' ' . $booking->guest->last_name}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="w-25">
                                                Email
                                            </td>
                                            <td>
                                                {{$booking->guest->email}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="w-25">
                                                Phone number
                                            </td>
                                            <td>
                                                {{$booking->guest->phone_number}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="mb-2 fw-bold   -primary  ps-2">Payment details<i
                                    class="bi bi-currency-dollar text-success ms-2"></i>
                            </div>
                            <div class="mb-2">
                                <div class="overflow-x-auto">
                                    @foreach($payments as $payment)
                                        <table class="table table-hover align-middle">
                                            <tr>
                                                <td class="w-25">
                                                    ID
                                                </td>
                                                <td>
                                                    {{$payment->id}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Date
                                                </td>
                                                <td>
                                                    {{$payment->date}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Amount
                                                </td>
                                                <td>
                                                    ${{$payment->amount}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Status
                                                </td>
                                                <td>
                                                    @switch($payment->status)
                                                        @case(0)
                                                            Unpaid
                                                            @break
                                                        @case(1)
                                                            Partial payment
                                                            @break
                                                        @case(2)
                                                            Paid
                                                            @break
                                                        @case(3)
                                                            Refunding
                                                            @break
                                                        @case(4)
                                                            Refunded
                                                            @break
                                                    @endswitch
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Payment Method
                                                </td>
                                                <td>
                                                    {{$payment->method->name}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Note
                                                </td>
                                                <td>
                                                    {{$payment->note}}
                                                </td>
                                            </tr>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                            @if($booking->note)
                                <div class="mb-2 fw-bold"><i class="bi bi-chat-dots me-2"></i>Note</div>
                                <pre style="white-space: pre-line"
                                     class="mb-4 p-3 text-bg-white">
                                    {!! $booking->note !!}
                                </pre>
                            @endif
                            <div
                                class="overflow-x-auto d-flex justify-content-center justify-content-md-end mb-4">
                                @if($booking->status == 3 || $booking->status == 5)
                                    @if(!$rate)
                                        <a href="" class="btn btn-primary  me-2" data-bs-toggle="modal"
                                           data-bs-target="#ratingModal">Write a
                                            review</a>
                                    @else
                                        <a href="" class="btn btn-primary  me-2" data-bs-toggle="modal"
                                           data-bs-target="#myReviewModal">My review</a>
                                    @endif
                                @endif
                                <a href="" class="btn btn-dark  ">Refund
                                    policies</a>
                                @if($booking->status == 0)
                                    <a class="btn btn-secondary  tran-3 ms-2"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"
                                       data-id="1">
                                        Cancel booking
                                    </a>
                                @endif
                            </div>
                            <div class="overflow-x-auto">
                                <table class="shadow-sm  table mb-4">
                                    <thead>
                                    <tr>
                                        <th>Room booked</th>
                                        <th class="text-center">Guests</th>
                                        <th class="text-center">Check-in Date</th>
                                        <th class="text-center">Check-out Date</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column flex-xl-row align-middle align-items-center">
                                                <div class="bg-image ratio ratio-16x9  shadow-sm">
                                                    @if(count($booking->room->images) != 0)
                                                        <img
                                                            src="{{asset('storage/admin/rooms/' .  $booking->room->images[0]->path)}}"
                                                            alt="room_image"
                                                            class="object-fit-cover  shadow-sm">
                                                    @else
                                                        <img
                                                            src="{{asset('images/noimage.jpg')}}"
                                                            alt="room_image"
                                                            class="object-fit-cover  shadow-sm">
                                                    @endif
                                                </div>
                                                <div class="mt-3 mt-xl-0 ms-xl-3">
                                                    <div>Room {{$booking->room->name}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{$booking->guest_num}}
                                        </td>
                                        <td class="align-middle text-center">
                                            @php
                                                $checkin = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $booking->checkin_date);
                                                $checkinMonth =$checkin->get('month');
                                                if(mb_strlen($checkinMonth) == 1) {
                                                     $checkinMonth = '0' . $checkinMonth;
                                                }
                                            @endphp
                                            {{$checkin->get('day') . '/' . $checkinMonth . '/' . $checkin->get('year')}}
                                        </td>
                                        <td class="align-middle text-center">
                                            @php
                                                $checkout = \Illuminate\Support\Carbon::createFromFormat('Y-m-d', $booking->checkout_date);
                                                $checkoutMonth =$checkout->get('month');
                                                if(mb_strlen($checkoutMonth) == 1) {
                                                     $checkoutMonth = '0' . $checkoutMonth;
                                                }
//                                            @endphp
                                            {{$checkout->get('day') . '/' . $checkoutMonth . '/' . $checkout->get('year')}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-success">${{$booking->total_price}}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>

                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{route('guest.myBooking')}}" class="text-decoration-none"><i
                                        class="bi bi-chevron-left fw-bold me-2"></i>Back to my
                                    bookings</a>
                                <a href="" class="text-decoration-none"><i
                                        class="bi bi-download fw-bold me-2"></i>Invoice</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{--                    form--}}
            </div>
        </div>
        {{--                CONTENT--}}
    </section>
    <!-- Rating Modal -->
    <div class="modal fade" id="ratingModal" tabindex="-1"
         aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{route('guest.rateBooking', $booking->id)}}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="ratingModalLabel">
                            <i class="bi bi-pencil-square me-2"></i>Write a review
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="input-1" class="form-label">Rate this room</label>
                            <div class="my-3">
                                <div class="star-rating text-center">
                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="1"></span>
                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="2"></span>
                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="3"></span>
                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="4"></span>
                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="5"></span>
                                    <input type="hidden" name="rating" id="rating" class="rating-value" value="5">
                                </div>
                                <div id="rate-comment" class="text-warning-emphasis text-center mt-1">

                                </div>
                            </div>
                        </div>
                        <label for="review" class="form-label mt-2">
                            Review (optional)
                        </label>
                        <textarea name="review" id="review" cols="20" rows="6" class="form-control"
                                  value=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary ">
                            Rate
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--myReviewModal Modal -->
    <div class="modal fade" id="myReviewModal" tabindex="-1"
         aria-labelledby="myReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('guest.deleteRate', $booking) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="myReviewModalLabel">
                            <i class="bi bi-pencil-square me-2"></i>My review
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="input-1" class="form-label">Rating</label>
                            <div class="my-3">
                                <div class="text-center">
                                    @if($rate?->rating)
                                        @switch($rate->rating)
                                            @case(1)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                @break
                                            @case(2)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                @break
                                            @case(3)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                @break
                                            @case(4)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                @break
                                            @case(5)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                @break
                                        @endswitch
                                    @endif
                                </div>
                            </div>
                        </div>
                        <label for="review" class="form-label mt-2">
                            Review
                        </label>
                        @if($rate?->review)
                            <div>
                                  <pre style="white-space: pre-line"
                                       class="mb-4 p-3 text-bg-white">
                                    {!! $rate->review !!}
                                </pre>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger ">
                            Delete this review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{route('guest.cancelBooking', $booking->id)}}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                            <i class="bi bi-x-circle me-2"></i>Are you sure?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="reason" class="form-label">
                            Please let us know the reason (optional):
                        </label>
                        <textarea name="note" id="reason" cols="20" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary "
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger ">
                            Cancel booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guestLayout>
<script>
    $(document).ready(function () {
        $("#dataTable").DataTable({
            layout: {
                topEnd: {},
                topStart: {},
                bottomEnd: {},
                bottomStart: {}
            },
        });
    });

    // star rating
    let $star_rating = $('.star-rating .bi');
    let rateComment = $('#rate-comment');
    let SetRatingStar = function () {
        return $star_rating.each(function () {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                return $(this).removeClass('bi-star').addClass('bi-star-fill');
            } else {
                return $(this).removeClass('bi-star-fill').addClass('bi-star');
            }
        });
    };

    $star_rating.siblings('input.rating-value').val(5);
    let rateVal = $("#rating").val();
    rateComment.html('😍 Amazing!');

    // onclick
    $star_rating.on('click', function () {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));

        rateVal = $("#rating").val();
        if (rateVal == 1) {
            rateComment.html('😡 Worst!');
        } else if (rateVal == 2) {
            rateComment.html('😒 Bad!');
        } else if (rateVal == 3) {
            rateComment.html('🙂 Neutral!');
        } else if (rateVal == 4) {
            rateComment.html('😊 Good!');
        } else {
            rateComment.html('😍 Amazing!');
        }

        // console.log(rateVal, rateComment)
        return SetRatingStar();
    });

    SetRatingStar();
</script>

