<title>Lịch sử đặt phòng - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container">
            <div class="row py-5 g-4 justify-content-center position-relative">
                {{--                MENU --}}
                <div class="col-10 col-lg-3">
                    <div class="p-4 shadow-sm rounded-3 border  bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU --}}

                {{--                CONTENT --}}
                <div class="col-10 col-lg-9 h-100">
                    <div class="shadow-sm border rounded-3  bg-white d-flex flex-column justify-content-between h-100">
                        <div>
                            <div class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="text-primary fw-bold">
                                    Lịch sử đặt phòng</h4>
                                <div class="mb-4 mb-md-0 col-12 col-md-3 col-xl-2">
                                    <form method="GET" class="m-0">
                                        <select name="filter" id="filter" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Tất cả
                                            </option>
                                            <option value="pending" {{ $filter == 'pending' ? 'selected' : '' }}>Chờ xác
                                                nhận
                                            </option>
                                            <option value="confirmed" {{ $filter == 'confirmed' ? 'selected' : '' }}>
                                                Đã xác nhận
                                            </option>
                                            <option value="ongoing" {{ $filter == 'ongoing' ? 'selected' : '' }}>Đã nhận
                                                phòng
                                            </option>
                                            <option value="completed" {{ $filter == 'completed' ? 'selected' : '' }}>
                                                Đã hoàn thành
                                            </option>
                                            <option value="cancelled" {{ $filter == 'cancelled' ? 'selected' : '' }}>
                                                Đã hủy
                                            </option>
                                            <option value="refund" {{ $filter == 'refund' ? 'selected' : '' }}>Hoàn tiền
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <hr class="m-0">
                            <div class="p-4 ">
                                @if (count($bookings) != 0)
                                    <table
                                        class="shadow-sm tran-3 table table-striped table-bordered align-middle mb-0 w-100"
                                        id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="align-middle text-center">ID</th>
                                                <th class="align-middle text-center">Ngày tạo</th>
                                                <th class="align-middle text-center">Loại phòng</th>
                                                <th class="align-middle text-center">Trạng thái</th>
                                                <th class="align-middle text-center">Tổng cộng</th>
                                                <th class="align-middle text-center">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td class="text-center col">
                                                        {{ $booking->id }}
                                                    </td>
                                                    <td class="text-break text-center col">
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
                                                        {{ $bookingDay . '-' . $bookingMonth . '-' . $bookingYear . ' (' . $bookingHour . ':' . $bookingMin . ')' }}
                                                    </td>
                                                    <td class="text-break text-center col">
                                                        @php
                                                            $bookedRoomTypes = \App\Models\Booking::getBookedRoomTypes(
                                                                $booking->id,
                                                            );
                                                        @endphp

                                                        @foreach ($bookedRoomTypes as $bookedRoomType)
                                                            <div>
                                                                {{ \App\Models\RoomType::find($bookedRoomType->room_type_id)?->name }}
                                                                ({{ $bookedRoomType->number_of_room }})
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-center">
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
                                                    </td>
                                                    <td class="text-center text-success fw-bold col">
                                                        {{ \App\Helpers\AppHelper::vnd_format($booking->total_price) }}
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="d-flex flex-column align-items-center justify-content-center">
                                                            <a href="{{ route('guest.bookingDetail', $booking) }}"
                                                                class="btn btn-sm btn btn-outline-primary tran-3">
                                                                Chi tiết <i class="bi bi-chevron-right fw-bold"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        @else
                            Không có kết quả nào
                            @endif
                        </div>
                    </div>

                </div>
                {{--                    form --}}
            </div>
        </div>
    </section>
</x-guestLayout>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
            columnDefs: [{
                orderable: false,
                targets: 5,
            }, ],
            pagingType: "full_numbers",

            layout: {
                topEnd: {
                    search: {
                        text: "",
                        placeholder: "Tìm kiếm...",
                    },
                }
            },
        });
    });
</script>
