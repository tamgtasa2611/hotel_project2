<title>Chi tiết đặt phòng - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU--}}
                <div class="col-12 col-lg-3">
                    <div class="p-4  shadow-sm border rounded-3 bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU--}}

                {{--                CONTENT--}}
                <div class="col-12 col-lg-9 h-100">
                    <div
                        class=" shadow-sm border rounded-3 bg-white d-flex flex-column justify-content-between h-100">
                        <div>
                            <div
                                class="p-4 d-flex align-items-baseline justify-content-between flex-column flex-md-row">
                                <h4 class="text-primary fw-bold m-0 d-flex">
                                    @php
                                        $bookingDate = Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $booking->date);

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

                                    Đặt phòng #{{$booking->id}}
                                    <div class="ms-3 d-flex align-items-center justify-content-center">
                                        @switch($booking->status)
                                            @case(0)
                                                <div class="badge bg-danger ">
                                                    Chờ xác nhận
                                                </div>
                                                @break
                                            @case(1)
                                                <div class="badge bg-success ">
                                                    Đã xác nhận
                                                </div>
                                                @break
                                            @case(2)
                                                <div class="badge bg-info ">
                                                    Đã nhận phòng
                                                </div>
                                                @break
                                            @case(3)
                                                <div class="badge bg-success ">
                                                    Đã hoàn thành
                                                </div>
                                                @break
                                            @case(4)
                                                <div class="badge bg-danger ">
                                                    Đã hủy
                                                </div>
                                                @break
                                            @case(5)
                                                <div class="badge bg-white ">
                                                    Hoàn tiền
                                                </div>
                                                @break
                                        @endswitch
                                    </div>
                                </h4>
                                <p class="m-0 text-muted">Tạo vào
                                    ngày {{$bookingDay . '-' . $bookingMonth . '-' . $bookingYear . ' lúc ' . $bookingHour . ':' . $bookingMin}}
                                </p>
                            </div>
                            <hr class="m-0">
                            <div class="p-4 overflow-x-auto">
                                <div>
                                    <div class=" fw-bold mb-2 ">
                                        Thông tin khách hàng
                                    </div>
                                    <div class="overflow-x-auto mb-4">
                                        <table class="table m-0 table-striped align-middle">
                                            <tr>
                                                <td class="w-25">
                                                    Họ tên
                                                </td>
                                                <td>
                                                    {{$booking->guest_lname . ' ' . $booking->guest_fname}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Email
                                                </td>
                                                <td>
                                                    {{$booking->guest_email}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Số điện thoại
                                                </td>
                                                <td>
                                                    {{$booking->guest_phone}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Ngày nhận phòng
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::createFromDate($booking->checkin)->format('d-m-Y')}}
                                                    lúc 14:00
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="w-25">
                                                    Ngày trả phòng
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::createFromDate($booking->checkout)->format('d-m-Y')}}
                                                    lúc 12:00
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class=" fw-bold  mb-2">Thanh toán
                                </div>
                                <div class="">
                                    <div class="overflow-x-auto">
                                        @foreach($payments as $payment)
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="card-title text-success">{{\App\Helpers\AppHelper::vnd_format($payment->amount)}}</h4>
                                                        <div class="overflow-hidden">
                                                            @switch($payment->status)
                                                                @case(0)
                                                                    <div
                                                                        class="badge bg-danger ">
                                                                        Chưa thanh toán
                                                                    </div>
                                                                    @break
                                                                @case(1)
                                                                    <div
                                                                        class="badge bg-success ">
                                                                        Đã thanh toán
                                                                    </div>
                                                                    @break
                                                                @case(2)
                                                                    <div
                                                                        class="badge bg-dark ">
                                                                        Đã hoàn tiền
                                                                    </div>
                                                                    @break
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="card-subtitle mb-2 text-muted">Thanh toán
                                                            #{{$payment->id}} ({{$payment->date}})</h6>
                                                        <div class="card-subtitle text-muted">
                                                            {{$payment->method?->name}}
                                                        </div>
                                                    </div>
                                                    <p class="card-text">{{$payment->note}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
                                    <a href="" class="btn btn-info">Chính sách hoàn tiền</a>
                                    @if($booking->status == 0)
                                        <a class="btn btn-secondary  tran-3 ms-2"
                                           data-bs-toggle="modal"
                                           data-bs-target="#exampleModal"
                                           data-id="1">
                                            Cancel booking
                                        </a>
                                    @endif
                                </div>
                                <div class="fw-bold mb-2">Thông tin phòng</div>
                                <div class="overflow-x-auto mb-4">
                                    <table class="table table-bordered m-0">
                                        <thead>
                                        <tr>
                                            <th class="text-center" colspan="2">Loại phòng</th>
                                            <th class="text-center">Giá (1 đêm)</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Thành tiền</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bookedRoomTypes as $roomType)
                                            <tr>
                                                <td class="align-middle text-center col-2">
                                                    <div class="ratio ratio-16x9 overflow-hidden shadow-sm">

                                                        {{--                                                    @if(count($booking->roomTypes->images) != 0)--}}
                                                        {{--                                                        <img--}}
                                                        {{--                                                            src="{{asset('storage/admin/rooms/' .  $booking->room->images[0]->path)}}"--}}
                                                        {{--                                                            alt="room_image"--}}
                                                        {{--                                                            class="object-fit-cover  shadow-sm">--}}
                                                        {{--                                                    @else--}}
                                                        {{--                                                        <img--}}
                                                        {{--                                                            src="{{asset('images/noimage.jpg')}}"--}}
                                                        {{--                                                            alt="room_image"--}}
                                                        {{--                                                            class="object-fit-cover  shadow-sm">--}}
                                                        {{--                                                    @endif--}}
                                                        <img
                                                            src="{{asset('images/noimage.jpg')}}"
                                                            alt="room_image"
                                                            class="object-fit-cover rounded-3 border shadow-sm">
                                                    </div>
                                                </td>
                                                <td class="align-middle text-start">
                                                    {{$roomType->name}}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{\App\Helpers\AppHelper::vnd_format($roomType->price)}}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{$roomType->number_of_room}}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{\App\Helpers\AppHelper::vnd_format($roomType->price * $roomType->number_of_room)}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($booking->note)
                                    <div class="">
                                        <div class=" fw-bold mb-2">Ghi chú</div>
                                        <pre style="white-space: pre-line"
                                             class="p-3 m-0 bg-light">
                                        {!! $booking->note !!}
                                           </pre>
                                    </div>
                                @endif
                            </div>
                            <hr class="m-0">
                            <div class="d-flex justify-content-between p-4">
                                <a href="{{route('guest.myBooking')}}" class="btn btn-primary"><i
                                        class="bi bi-chevron-left fw-bold me-2 tran-3"></i>Quay lại</a>
                                <a href="" class="btn btn-secondary tran-3"><i
                                        class="bi bi-download fw-bold me-2"></i>Hóa đơn</a>
                            </div>
                        </div>
                    </div>

                </div>
                {{--                    form--}}
            </div>
        </div>
        {{--                CONTENT--}}
    </section>

    {{--    <!-- Rating Modal -->--}}
    {{--    <div class="modal fade" id="ratingModal" tabindex="-1"--}}
    {{--         aria-labelledby="ratingModalLabel" aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <form method="post" action="{{route('guest.rateBooking', $booking->id)}}">--}}
    {{--                    @csrf--}}
    {{--                    @method('POST')--}}
    {{--                    <div class="modal-header">--}}
    {{--                        <h1 class="modal-title fs-5 text-primary" id="ratingModalLabel">--}}
    {{--                            <i class="bi bi-pencil-square me-2"></i>Write a review--}}
    {{--                        </h1>--}}
    {{--                        <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
    {{--                                aria-label="Close"></button>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-body">--}}
    {{--                        <div>--}}
    {{--                            <label for="input-1" class="form-label">Rate this room</label>--}}
    {{--                            <div class="my-3">--}}
    {{--                                <div class="star-rating text-center">--}}
    {{--                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="1"></span>--}}
    {{--                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="2"></span>--}}
    {{--                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="3"></span>--}}
    {{--                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="4"></span>--}}
    {{--                                    <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="5"></span>--}}
    {{--                                    <input type="hidden" name="rating" id="rating" class="rating-value" value="5">--}}
    {{--                                </div>--}}
    {{--                                <div id="rate-comment" class="text-warning-emphasis text-center mt-1">--}}

    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <label for="review" class="form-label mt-2">--}}
    {{--                            Review (optional)--}}
    {{--                        </label>--}}
    {{--                        <textarea name="review" id="review" cols="20" rows="6" class="form-control"--}}
    {{--                                  value=""></textarea>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary "--}}
    {{--                                data-bs-dismiss="modal">--}}
    {{--                            Close--}}
    {{--                        </button>--}}
    {{--                        <button type="submit" class="btn btn-primary ">--}}
    {{--                            Rate--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--    <!--myReviewModal Modal -->--}}
    {{--    <div class="modal fade" id="myReviewModal" tabindex="-1"--}}
    {{--         aria-labelledby="myReviewModalLabel" aria-hidden="true">--}}
    {{--        <div class="modal-dialog">--}}
    {{--            <div class="modal-content">--}}
    {{--                <form method="post" action="{{ route('guest.deleteRate', $booking) }}">--}}
    {{--                    @csrf--}}
    {{--                    @method('DELETE')--}}
    {{--                    <div class="modal-header">--}}
    {{--                        <h1 class="modal-title fs-5 text-primary" id="myReviewModalLabel">--}}
    {{--                            <i class="bi bi-pencil-square me-2"></i>My review--}}
    {{--                        </h1>--}}
    {{--                        <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
    {{--                                aria-label="Close"></button>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-body">--}}
    {{--                        <div>--}}
    {{--                            <label for="input-1" class="form-label">Rating</label>--}}
    {{--                            <div class="my-3">--}}
    {{--                                <div class="text-center">--}}
    {{--                                    @if($rate?->rating)--}}
    {{--                                        @switch($rate->rating)--}}
    {{--                                            @case(1)--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                @break--}}
    {{--                                            @case(2)--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                @break--}}
    {{--                                            @case(3)--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                @break--}}
    {{--                                            @case(4)--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star text-warning fs-4"></span>--}}
    {{--                                                @break--}}
    {{--                                            @case(5)--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                <span class="bi bi-star-fill text-warning fs-4"></span>--}}
    {{--                                                @break--}}
    {{--                                        @endswitch--}}
    {{--                                    @endif--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <label for="review" class="form-label mt-2">--}}
    {{--                            Review--}}
    {{--                        </label>--}}
    {{--                        @if($rate?->review)--}}
    {{--                            <div>--}}
    {{--                                  <pre style="white-space: pre-line"--}}
    {{--                                       class="mb-4 p-3 text-bg-white">--}}
    {{--                                    {!! $rate->review !!}--}}
    {{--                                </pre>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary "--}}
    {{--                                data-bs-dismiss="modal">--}}
    {{--                            Close--}}
    {{--                        </button>--}}
    {{--                        <button type="submit" class="btn btn-danger ">--}}
    {{--                            Delete this review--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

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

