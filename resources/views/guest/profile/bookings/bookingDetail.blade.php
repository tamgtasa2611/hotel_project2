<title>My bookings - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU--}}
                <div class="col-12 col-lg-3">
                    <div class="p-4 border rounded shadow-sm bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU--}}

                {{--                CONTENT--}}
                <div class="col-12 col-lg-9 h-100">
                    <div
                        class="p-4 rounded border bg-white shadow-sm d-flex flex-column justify-content-between h-100">
                        {{--alert edit success--}}
                        @if (session('success'))
                            @include('partials.flashMsgSuccess')
                        @endif
                        {{--alert edit fail--}}
                        @if (session('failed'))
                            @include('partials.flashMsgFail')
                        @endif
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
                                                <div class="badge bg-danger rounded-pill">
                                                    Pending
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="badge bg-warning rounded-pill">
                                                    Confirmed
                                                </div>
                                                @break
                                            @case(2)
                                                <div class="badge bg-info rounded-pill">
                                                    Ongoing
                                                </div>
                                                @break
                                            @case(3)
                                                <div class="badge bg-success rounded-pill">
                                                    Completed
                                                </div>
                                                @break
                                            @case(4)
                                                <div class="badge bg-danger rounded-pill">
                                                    Cancelled
                                                </div>
                                                @break
                                            @case(5)
                                                <div class="badge bg-dark rounded-pill">
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
                                <div class="mb-2 fw-bold"><i class="bi bi-person me-2"></i>Guest details</div>
                                <div class="overflow-x-auto mb-2">
                                    <table class="table table-striped table-sm table-hover align-middle">
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
                            <div class="mb-2 fw-bold"><i class="bi bi-currency-dollar me-2"></i>Payment details</div>
                            <div class="mb-2">
                                <div class="overflow-x-auto">
                                    @foreach($payments as $payment)
                                        <table class="table table-striped table-sm table-hover align-middle">
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
                                     class="mb-4 border-start border-primary border-3 ps-3 text-bg-light">
                                    {!! $booking->note !!}
                                </pre>
                            @endif
                            <div
                                class="overflow-x-auto d-flex justify-content-center justify-content-md-end mb-4">
                                @if($booking->status == 3 || $booking->status == 5)
                                    <a href="" class="btn btn-info rounded-pill me-2">Write a
                                        review</a>
                                @endif
                                <a href="" class="btn btn-primary rounded-pill ">Refund
                                    policies</a>
                                @if($booking->status == 0)
                                    <a class="btn btn-secondary rounded-pill tran-2 ms-2"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"
                                       data-id="1">
                                        Cancel booking
                                    </a>
                                @endif
                            </div>
                            <div class="overflow-x-auto">
                                <table class="table table-bordered table">
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
                                                <div class="bg-image ratio ratio-16x9 rounded shadow-sm">
                                                    @if(count($booking->room->images) != 0)
                                                        <img
                                                            src="{{asset('storage/admin/rooms/' .  $booking->room->images[0]->path)}}"
                                                            alt="room_image" class="object-fit-cover">
                                                    @else
                                                        <img
                                                            src="{{asset('images/noimage.jpg')}}"
                                                            alt="room_image" class="object-fit-cover">
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
                                            @endphp
                                            {{$checkout->get('day') . '/' . $checkoutMonth . '/' . $checkout->get('year')}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-success">${{$booking->total_price}}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{route('guest.myBooking')}}" class="text-decoration-none"><i
                                        class="bi bi-chevron-left fw-bold me-1"></i>Back to my
                                    bookings</a>
                                <a href="" class="text-decoration-none"><i
                                        class="bi bi-download fw-bold me-1"></i>Invoice</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{--                    form--}}
            </div>
        </div>
        {{--                CONTENT--}}
    </section>
    <!-- Delete Account Modal -->
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
                        <button type="button" class="btn btn-secondary rounded-pill"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger rounded-pill">
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
</script>

