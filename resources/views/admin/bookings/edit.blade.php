<title>Booking information - Skyrim Hotel</title>
<x-adminLayout>
    {{-- ------------- MAIN ------------ --}}
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Bookings Management</h4>
        </div>
    </div>

    <div class="bg-white  shadow-sm border rounded-3  overflow-hidden">
        <div class="p-4 d-flex justify-content-between align-items-center">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Sửa đặt phòng
            </div>
            <form method="post" action="{{ route('admin.bookings.update', $booking) }}" autocomplete="off" class="m-0">
                @csrf
                @method('PUT')
                @if ($booking->status == 0)
                    <div class="ms-3">
                        <input type="hidden" hidden name="status" value="1">
                        <button type="submit" class="btn btn-success tran-3">
                            <i class="bi bi-check-circle me-2"></i>Duyệt
                        </button>
                    </div>
                @endif
                @if ($booking->status == 1)
                    <div class="ms-3">
                        <input type="hidden" hidden name="status" value="2">
                        <button type="submit" class="btn btn-success tran-3">
                            <i class="bi bi-check-circle me-2"></i>Đã nhận phòng
                        </button>
                    </div>
                @endif
                @if ($booking->status == 2)
                    <div class="ms-3">
                        <input type="hidden" hidden name="status" value="3">
                        <button type="submit" class="btn btn-success tran-3">
                            <i class="bi bi-check-circle me-2"></i>Đã hoàn thành
                        </button>
                    </div>
                @endif
            </form>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.bookings.arrange', $booking) }}" enctype="multipart/form-data"
            autocomplete="off" class="m-0">
            @csrf
            @method('POST')
            <div class="">
                <div class="d-flex flex-column justify-content-between h-auto p-4">
                    <div>
                        <div class="d-flex align-items-baseline justify-content-between flex-column flex-md-row">
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
                                <div class="ms-3 d-flex align-items-center justify-content-center fs-5">
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
                                    @endswitch
                                </div>
                            </h4>
                            <p class="m-0 text-muted">Tạo vào
                                ngày
                                {{ $bookingDay . '-' . $bookingMonth . '-' . $bookingYear . ' lúc ' . $bookingHour . ':' . $bookingMin }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <div class="overflow-x-auto">
                                <div>
                                    <div class=" fw-bold mb-2 ">
                                        Thông tin khách hàng
                                        <span
                                            class="fst-italic">{{ $booking->guest_id == null ? '(Không có tài khoản)' : '' }}</span>
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
                                                            <a href="{{ route('admin.payments.show', $payment) }}"
                                                                class="link-success">{{ \App\Helpers\AppHelper::vnd_format($payment->amount) }}</a>
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
                                <div class="fw-bold mb-2">Thông tin phòng</div>
                                <div class="overflow-x-auto mb-4">
                                    <table class="table table-bordered m-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center fw-bold">Loại phòng</th>
                                                <th class="text-center fw-bold">Giá (1 đêm)</th>
                                                <th class="text-center fw-bold">Số lượng</th>
                                                <th class="text-center fw-bold">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookedRoomTypes as $roomType)
                                                <tr>

                                                    <td class="align-middle text-center">
                                                        {{ $roomType->name }}
                                                    </td>
                                                    <td class="align-middle text-center text-success">
                                                        {{ \App\Helpers\AppHelper::vnd_format($roomType->price) }}
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{ $roomType->number_of_room }}
                                                    </td>
                                                    <td class="align-middle text-center text-success">
                                                        {{ \App\Helpers\AppHelper::vnd_format($roomType->price * $roomType->number_of_room) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr class="fs-5 table-secondary">
                                                <td colspan="3" class="text-center fw-bold">
                                                    Tổng cộng
                                                </td>
                                                <td class="text-center fw-bold text-success">
                                                    {{ \App\Helpers\AppHelper::vnd_format($booking->total_price) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row g-4">
                        @if ($booking->status != 0 && $booking->status != 4)
                            <div class="col-12 col-lg-8">
                                <div>
                                    <div class="mb-2 fw-bold">Sắp xếp phòng</div>
                                    @if ($booking->status == 1)
                                        <div class="bg-light rounded-3 d-flex">
                                            @foreach ($bookedRoomTypes as $bookedRoomType)
                                                @php
                                                    $countCurrentRoom = 0;
                                                    if ($groupCount->has($bookedRoomType->id)) {
                                                        $countCurrentRoom = $groupCount->get($bookedRoomType->id);
                                                    }
                                                @endphp
                                                <div class="px-3 py-2 type-id" id="type{{ $bookedRoomType->id }}">
                                                    <div>
                                                        {{ $bookedRoomType->name }}
                                                        @if ($bookedRoomType->number_of_room - $countCurrentRoom != 0)
                                                            <div class="d-inline">
                                                                (Cần thêm <span class="type-quantity"
                                                                    name="type-quantity"
                                                                    value="{{ $bookedRoomType->number_of_room - $countCurrentRoom }}">{{ $bookedRoomType->number_of_room - $countCurrentRoom }}</span>
                                                                phòng)
                                                            </div>
                                                        @else
                                                            <div class="d-none visually-hidden">
                                                                (Cần thêm <span class="type-quantity"
                                                                    name="type-quantity"
                                                                    value="{{ $bookedRoomType->number_of_room - $countCurrentRoom }}">{{ $bookedRoomType->number_of_room - $countCurrentRoom }}</span>
                                                                phòng)
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        @foreach ($currentBookedRooms as $currentBookedRoom)
                                                            @if ($bookedRoomType->id == $currentBookedRoom->room_type_id)
                                                                <li class="fw-bold text-primary">
                                                                    {{ $currentBookedRoom->name }}<a
                                                                        href="{{ route('admin.bookings.deleteRoom', [$booking, $currentBookedRoom->id]) }}"
                                                                        class="link-danger"><i
                                                                            class="bi bi-x-circle ms-2 text-danger"></i></a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        @if ($bookedRoomType->number_of_room > $countCurrentRoom)
                                                            @foreach ($rooms as $room)
                                                                @if ($room->room_type_id == $bookedRoomType->id)
                                                                    <div class=" form-check">
                                                                        <label for="room{{ $room->id }}"
                                                                            class="form-check-label">{{ $room->name }}</label>
                                                                        <input type="checkbox"
                                                                            id="room{{ $room->id }}"
                                                                            class="form-check-input" name="room_id[]"
                                                                            value="{{ $room->id }}">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($booking->status == 2 or $booking->status == 3)
                                        <div class="bg-light rounded-3 d-flex">
                                            <ul>
                                                @foreach ($currentBookedRooms as $currentBookedRoom)
                                                    <li class="fw-bold text-primary">
                                                        {{ $currentBookedRoom->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($booking->note)
                            <div class="col-12 col-lg-4">
                                <div>
                                    <div class=" fw-bold mb-2">Ghi chú</div>
                                    <pre style="white-space: pre-line" class="p-3 m-0 bg-light rounded-3 text-break">
                                        {!! $booking->note !!}
                                           </pre>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="m-0">
                <div class="d-flex justify-content-between justify-content-md-between p-4">
                    <div class="d-flex justify-content-between justify-content-md-start">
                        <a href="{{ route('admin.bookings') }}" class="btn btn-secondary  tran-3 me-3">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại
                        </a>

                        <!-- Submit button -->
                        @if ($booking->status < 2)
                            <button type="submit" class="btn btn-primary  tran-3" name="status"
                                value="{{ $booking->status }}">
                                <i class="bi bi-floppy me-2"></i>Cập nhật
                            </button>
                        @endauth
                </div>
                @if ($booking->status < 2)
                    <div>
                        <a href="{{ route('admin.bookings.cancel', $booking) }}" class="btn btn-danger tran-3">
                            <i class="bi bi-x-circle me-2"></i>Hủy đặt phòng
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        setInterval(function() {
            let roomTypes = $(".type-id")
            for (let i = 0; i < roomTypes.length; i++) {
                let inputs = $(roomTypes[i]).find('input');
                inputs.on("click", function() {
                    let parentDiv = $(this).parent().parent().parent()
                    let quantity = parentDiv.find('span').text()

                    var count = inputs.filter(':checked').length
                    if (count < quantity) { //only quantity of room type
                        for (let j = 0; j < inputs.length; j++) {
                            $(inputs[j]).removeAttr("disabled");
                            // re-enable all checkboxes
                        }
                    } else {
                        for (let j = 0; j < inputs.length; j++) {
                            $(inputs[j]).prop("disabled", "disabled");
                            // re-enable all checkboxes
                            inputs.filter(':checked').removeAttr("disabled");
                            // only enable the elements that are already checked.
                        }
                    }
                })
            }
        }, 100)
        $("input[type='checkbox']").on("click", function() {
            let roomTypes = $(".type-id")
            for (let i = 0; i < roomTypes.length; i++) {
                let inputs = $(roomTypes[i]).find('input');
                inputs.on("click", function() {
                    let parentDiv = $(this).parent().parent().parent()
                    let quantity = parentDiv.find('span').text()

                    var count = inputs.filter(':checked').length
                    if (count < quantity) { //only quantity of room type
                        for (let j = 0; j < inputs.length; j++) {
                            $(inputs[j]).removeAttr("disabled");
                            // re-enable all checkboxes
                        }
                    } else {
                        for (let j = 0; j < inputs.length; j++) {
                            $(inputs[j]).prop("disabled", "disabled");
                            // re-enable all checkboxes
                            inputs.filter(':checked').removeAttr("disabled");
                            // only enable the elements that are already checked.
                        }
                    }
                })
            }
        })
    });
</script>
</x-adminLayout>
