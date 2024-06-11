<title>Chi tiết đặt phòng - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU --}}
                <div class="col-12 col-lg-3">
                    <div class="p-4  shadow-sm border rounded-3 bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU --}}

                {{--                CONTENT --}}
                <div class="col-12 col-lg-9 h-100">
                    <div class=" shadow-sm border rounded-3 bg-white d-flex flex-column justify-content-between h-100">
                        <div>
                            <div id="printarea">
                                <div
                                    class="p-4 d-flex align-items-baseline justify-content-between flex-column flex-md-row">
                                    <h4 class="text-primary fw-bold m-0 d-flex">
                                        @php
                                            $bookingDate = Illuminate\Support\Carbon::createFromFormat(
                                                'Y-m-d H:i:s',
                                                $booking->date,
                                            );

                                            $bookingDay = $bookingDate->get('day');
                                            if (mb_strlen($bookingDay) == 1) {
                                                $bookingDay = '0' . $bookingDay;
                                            }

                                            $bookingMonth = $bookingDate->get('month');
                                            if (mb_strlen($bookingMonth) == 1) {
                                                $bookingMonth = '0' . $bookingMonth;
                                            }

                                            $bookingYear = $bookingDate->get('year');

                                            $bookingHour = $bookingDate->get('hour');
                                            if (mb_strlen($bookingHour) == 1) {
                                                $bookingHour = '0' . $bookingHour;
                                            }

                                            $bookingMin = $bookingDate->get('minute');
                                            if (mb_strlen($bookingMin) == 1) {
                                                $bookingMin = '0' . $bookingMin;
                                            }
                                        @endphp

                                        Đặt phòng #{{ $booking->id }}
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
                                        ngày
                                        {{ $bookingDay . '-' . $bookingMonth . '-' . $bookingYear . ' lúc ' . $bookingHour . ':' . $bookingMin }}
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
                                                        {{ $booking->guest_lname . ' ' . $booking->guest_fname }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="w-25">
                                                        Email
                                                    </td>
                                                    <td>
                                                        {{ $booking->guest_email }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="w-25">
                                                        Số điện thoại
                                                    </td>
                                                    <td>
                                                        {{ $booking->guest_phone }}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="w-25">
                                                        Ngày nhận phòng
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::createFromDate($booking->checkin)->format('d-m-Y') }}
                                                        lúc 14:00
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="w-25">
                                                        Ngày trả phòng
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::createFromDate($booking->checkout)->format('d-m-Y') }}
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
                                            @foreach ($payments as $payment)
                                                <div class="card mb-4">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title text-success">
                                                                {{ \App\Helpers\AppHelper::vnd_format($payment->amount) }}
                                                            </h4>
                                                            <div class="overflow-hidden">
                                                                @switch($payment->status)
                                                                    @case(0)
                                                                        <div class="badge bg-danger ">
                                                                            Chưa thanh toán
                                                                        </div>
                                                                    @break

                                                                    @case(1)
                                                                        <div class="badge bg-success ">
                                                                            Đã thanh toán
                                                                        </div>
                                                                    @break

                                                                    @case(2)
                                                                        <div class="badge bg-dark ">
                                                                            Đã hoàn tiền
                                                                        </div>
                                                                    @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <h6 class="card-subtitle mb-2 text-muted">Thanh toán
                                                                #{{ $payment->id }} ({{ $payment->date }})</h6>
                                                            <div class="card-subtitle text-muted">
                                                                {{ $payment->method?->name }}
                                                            </div>
                                                        </div>
                                                        <p class="card-text">{{ $payment->note }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div
                                        class="overflow-x-auto d-flex justify-content-center justify-content-md-end mb-4">

                                        @if ($booking->status == 0)
                                            <a class="btn btn-secondary  tran-3 ms-2" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-id="1">
                                                Hủy đặt phòng
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
                                                    @if ($booking->status == 3)
                                                        <th class="text-center">
                                                            Thao tác
                                                        </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bookedRoomTypes as $roomType)
                                                    <tr>
                                                        <td class="align-middle text-center col-2">
                                                            <div class="ratio ratio-16x9 overflow-hidden shadow-sm">
                                                                @foreach ($roomTypesImages as $image)
                                                                    @if ($roomType->id == $image->room_type_id)
                                                                        <img src="{{ asset('storage/rooms/' . $image->path) }}"
                                                                            alt="room_img"
                                                                            class="object-fit-cover shadow-sm tran-3 img-fluid rounded-3" />
                                                                    @break

                                                                @else
                                                                    <img src="{{ asset('images/noimage.jpg') }}"
                                                                        alt="room_img"
                                                                        class="object-fit-cover shadow-sm tran-3 img-fluid rounded-3" />
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <a
                                                            href="{{ route('guest.rooms.show', $roomType->id) }}">{{ $roomType->name }}</a>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ \App\Helpers\AppHelper::vnd_format($roomType->price) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ $roomType->number_of_room }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ \App\Helpers\AppHelper::vnd_format($roomType->price * $roomType->number_of_room) }}
                                                    </td>
                                                    @if ($booking->status == 3)
                                                        <td class=" align-middle text-center">
                                                            @if (in_array($roomType->id, $ratings->pluck('room_type_id')->toArray()))
                                                                @foreach ($ratings as $rating)
                                                                    @if ($roomType->id == $rating->room_type_id)
                                                                        <a href=""
                                                                            class="btn btn-warning tran-3 rate-btn"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#myReviewModal{{ $rating->id }}"
                                                                            data-id="{{ $roomType->id }}"><i
                                                                                class="bi bi-eye me-2"></i>Xem đánh
                                                                            giá</a>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <a href=""
                                                                    class="btn btn-warning tran-3 rate-btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#ratingModal"
                                                                    data-id="{{ $roomType->id }}"><i
                                                                        class="bi bi-star me-2"></i>Đánh
                                                                    giá</a>
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="4" class="text-center fw-bold">Tổng cộng</td>
                                                <td class="text-center fw-bold">
                                                    {{ \App\Helpers\AppHelper::vnd_format($booking->total_price) }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if ($booking->note)
                                    <div class="">
                                        <div class=" fw-bold mb-2">Ghi chú</div>
                                        <pre style="white-space: pre-line" class="p-3 m-0 bg-light">
                                        {!! $booking->note !!}
                                           </pre>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-between p-4">
                            <a href="{{ route('guest.myBooking') }}" class="btn btn-primary"><i
                                    class="bi bi-chevron-left fw-bold me-2 tran-3"></i>Quay lại</a>
                            <a href="#!" onclick="printDiv('printarea')" class="btn btn-secondary tran-3"><i
                                    class="bi bi-download fw-bold me-2"></i>Hóa đơn</a>
                        </div>
                    </div>
                </div>

            </div>
            {{--                    form --}}
        </div>
    </div>
    {{--                CONTENT --}}
</section>

<script>
    function printDiv(divName) // pass the id of which area you want to print
    {
        var printContents = document.getElementById(divName).innerHTML; // get the content of printing area
        var originalContents = document.body.innerHTML; // preserving current content
        document.body.innerHTML = printContents; // overriding the body with print area content
        window.print();
        document.body.innerHTML = originalContents; // reset to original state
    }
</script>

<!-- Rating Modal -->
<div class="modal fade tran-3" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('guest.rateBooking', $booking->id) }}">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-primary" id="ratingModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Đánh giá phòng
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="room_type_id" hidden class="visually-hidden room_type_id" value="">
                    <div>
                        <div class="my-3">
                            <div class="star-rating text-center">
                                <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="1"></span>
                                <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="2"></span>
                                <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="3"></span>
                                <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="4"></span>
                                <span class="bi bi-star text-warning fs-4 hover-pointer" data-rating="5"></span>
                                <input type="hidden" name="rating" id="rating" class="rating-value"
                                    value="5">
                            </div>
                            <div id="rate-comment" class="text-warning-emphasis text-center mt-1">

                            </div>
                        </div>
                    </div>
                    <label for="review" class="form-label mt-2">
                        Review
                    </label>
                    <textarea name="review" id="review" cols="20" rows="6" class="form-control" value=""></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="submit" class="btn btn-primary ">
                        Đánh giá
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($ratings as $rating)
    <!--myReviewModal Modal -->
    <div class="modal fade tran-3" id="myReviewModal{{ $rating->id }}" tabindex="-1"
        aria-labelledby="myReviewModalLabel{{ $rating->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('guest.deleteRate', $booking) }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-primary" id="myReviewModalLabel{{ $rating->id }}">
                            <i class="bi bi-star me-2"></i>Xem đánh giá
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input name="room_type_id" hidden class="visually-hidden room_type_id" value="">
                        <div>
                            <div class="my-3">
                                <div class="text-center">
                                    @if ($rating->rating)
                                        @switch($rating->rating)
                                            @case(1)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <div>
                                                    😡 Tồi tệ!
                                                </div>
                                            @break

                                            @case(2)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <div>
                                                    😒 Kém!
                                                </div>
                                            @break

                                            @case(3)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <div>
                                                    🙂 Tạm được!
                                                </div>
                                            @break

                                            @case(4)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star text-warning fs-4"></span>
                                                <div>
                                                    😊 Tốt!
                                                </div>
                                            @break

                                            @case(5)
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <span class="bi bi-star-fill text-warning fs-4"></span>
                                                <div>
                                                    😍 Tuyệt vời!
                                                </div>
                                            @break
                                        @endswitch
                                    @endif
                                </div>
                            </div>
                        </div>
                        <label for="review" class="form-label mt-2">
                            Review
                        </label>
                        @if ($rating->review)
                            <div>
                                <pre style="white-space: pre-line" class="mb-4 p-3 text-bg-light rounded-3">
                                            {!! $rating->review !!}
                                        </pre>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button type="submit" class="btn btn-danger ">
                            Xóa đánh giá
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- Cancel Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('guest.cancelBooking', $booking->id) }}">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                        <i class="bi bi-x-circle me-2"></i>Hủy đặt phòng
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="reason" class="form-label">
                        Hãy cho chúng tôi biết lý do:
                    </label>
                    <textarea name="note" id="reason" cols="20" rows="6" class="form-control"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="submit" class="btn btn-danger ">
                        Xác nhận hủy
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-guestLayout>
<script>
    $(document).ready(function() {
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
    let SetRatingStar = function() {
        return $star_rating.each(function() {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data(
                    'rating'))) {
                return $(this).removeClass('bi-star').addClass('bi-star-fill');
            } else {
                return $(this).removeClass('bi-star-fill').addClass('bi-star');
            }
        });
    };

    $star_rating.siblings('input.rating-value').val(5);
    let rateVal = $("#rating").val();
    rateComment.html('😍 Tuyệt vời!');

    // onclick
    $star_rating.on('click', function() {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));

        rateVal = $("#rating").val();
        if (rateVal == 1) {
            rateComment.html('😡 Tồi tệ!');
        } else if (rateVal == 2) {
            rateComment.html('😒 Kém!');
        } else if (rateVal == 3) {
            rateComment.html('🙂 Tạm được!');
        } else if (rateVal == 4) {
            rateComment.html('😊 Tốt!');
        } else {
            rateComment.html('😍 Tuyệt vời!');
        }

        // console.log(rateVal, rateComment)
        return SetRatingStar();
    });

    SetRatingStar();

    $(document).on("click", ".rate-btn", function() {
        let id = $(this).attr("data-id");
        $(".room_type_id").val(id);
    });
</script>
