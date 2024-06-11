<title>Admin dashboard - Skyrim Hotel</title>
<style>
    #fc-dom-1 {
        font-size: 1.5rem !important;
    }

    .fc-toolbar-title {
        text-transform: capitalize !important;
    }
</style>
<script src="{{ asset('plugins/calendar/index.global.min.js') }}"></script>

<x-adminLayout>
    <div class="p-4 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Tổng quát</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    {{--    newest --}}
    <div class="w-100 my-4">
        <div class="p-4 bg-white border rounded-3 shadow-sm overflow-x-auto">
            <div class="d-flex justify-content-between align-items-center">
                <div class="fw-bold fs-5">Đặt phòng mới nhất</div>
                <div>
                    <a href="{{ route('admin.bookings') }}">Xem tất cả</a>
                </div>
            </div>
            <div class="row gx-4">
                @if (count($bookings) != 0)
                    @foreach ($bookings as $booking)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="card mt-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ route('admin.bookings') }}"
                                            class="link-success text-decoration-underline">
                                            <h4 class="card-title text-success">
                                                {{ \App\Helpers\AppHelper::vnd_format($booking->total_price) }}
                                                <span class="fst-italic text-muted fs-6">#{{ $booking->id }}</span>
                                            </h4>
                                        </a>
                                        <a href="{{ route('admin.dashboard.fastConfirm', $booking) }}"
                                            class="btn btn-success tran-3">
                                            <i class="bi bi-check-circle  me-2"></i>Duyệt
                                        </a>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        {{ \Carbon\Carbon::createFromDate($booking->date)->format('d-m-Y H:i:s') }}</h6>
                                    <p class="card-text">
                                    <div>
                                        Khách: {{ $booking->guest_lname . ' ' . $booking->guest_fname }}
                                        <span
                                            class="text-muted fst-italic">({{ $booking->guest_id != null ? 'Có tài khoản' : 'Không có tài khoản' }})</span>
                                    </div>
                                    <div>
                                        Ngày nhận
                                        phòng: {{ \Carbon\Carbon::createFromDate($booking->checkin)->format('d-m-Y') }}
                                    </div>
                                    <div>
                                        Ngày trả
                                        phòng:
                                        {{ \Carbon\Carbon::createFromDate($booking->checkout)->format('d-m-Y') }}
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="mt-4">
                        Không có đặt phòng mới nào cần duyệt...
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-primary-subtle text-primary-emphasis px-4 py-3">Số đặt phòng hôm nay</div>
                <div class="fs-4 text-center p-4 fw-bold text-primary-emphasis">
                    {{ $todayBooking }}
                    {{-- <div>
                        <a href="{{ route('admin.bookings') }}" class="fs-6">Xem tất cả</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-danger-subtle text-danger-emphasis px-4 py-3">Đặt phòng chờ xác nhận</div>
                <div class="fs-4 text-center p-4 fw-bold text-danger-emphasis">
                    {{ $unconfirmedBooking }}
                    {{-- <div>
                        <a href="{{ route('admin.bookings') }}" class="fs-6">Xem tất cả</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-warning-subtle text-warning-emphasis px-4 py-3">Đặt phòng đã hoàn thành</div>
                <div class="fs-4 text-center p-4 fw-bold text-warning-emphasis">
                    {{ $completedBooking }}
                    {{-- <div>
                        <a href="{{ route('admin.bookings') }}" class="fs-6">Xem tất cả</a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">

            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-success-subtle text-success-emphasis px-4 py-3">Tổng doanh thu</div>
                <div class="fs-4 text-center p-4 fw-bold text-success-emphasis">
                    {{ AppHelper::vnd_format($totalRevenue) }}
                    <div>
                        {{-- @php
                            $admin = Auth::guard('admin')->user()->level;

                        @endphp
                        @if ($admin == 0)
                            <a href="{{ route('admin.statistics.revenue') }}" class="fs-6">Xem chi tiết</a>
                        @else
                            <a class="fs-6 fst-italic text-white">Xem chi tiết</a>
                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    calendar --}}
    <div class="row">
        <div class="col-12">
            <div class="p-4 border bg-white rounded-3 shadow-sm h-auto">
                <div class="mb-4 fw-bold fs-5">Lịch đặt phòng</div>
                <div id="calendar" class="mb-4"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                locale: 'vi',
                buttonText: {
                    today: "Tháng này",
                    week: "Tuần"
                },
                themeSystem: 'bootstrap5',
                validRange: {
                    start: new Date(new Date().getFullYear(), new Date().getMonth() - 1),
                    end: new Date(new Date().setMonth(new Date().getMonth() + 3)),
                },
                {{-- events: @json($events), --}}
                resourceAreaColumns: [{
                    field: 'title',
                    headerContent: 'Phòng'
                }],
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: ''
                },
                aspectRatio: 1.6,
                initialView: 'resourceTimelineMonth',
                resourceGroupField: 'type',

                resources: [
                    @foreach ($resources as $resource)
                        {
                            id: '{{ json_decode($resource)->id }}',
                            type: '{{ json_decode($resource)->type }}',
                            title: '{{ json_decode($resource)->title }}'
                        },
                    @endforeach
                ],
                events: @json($events)
            });

            calendar.render();
        });
    </script>
</x-adminLayout>
