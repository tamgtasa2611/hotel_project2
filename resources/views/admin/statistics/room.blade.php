<title>Thống kê phòng - Skyrim Hotel</title>
<script src="{{ asset('plugins/calendar/index.global.min.js') }}"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Phòng', 'Số phòng'],
            ['Phòng được sử dụng', {{ !is_null($activeRooms) ? count($activeRooms) : 0 }}],
            ['Phòng trống', {{ !is_null($emptyRooms) ? count($emptyRooms) : 0 }}]
        ]);

        var options = {
            title: ''
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);

        ///////////////////////////////////////////////////////////////////////
        var data1 = google.visualization.arrayToDataTable([
            ["Element", "Tổng số phòng đã đặt", {
                role: "style"
            }],
            @foreach ($dataChart as $data)
                ['{{ $data[0] }}', {{ $data[1] }}, '{{ $data[2] }}'],
            @endforeach
        ]);

        var view1 = new google.visualization.DataView(data1);
        view1.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);

        var options1 = {
            title: " ",
            width: 1000,
            height: 400,
            bar: {
                groupWidth: "95%"
            },
            legend: {
                position: "none"
            },
        };
        var chart1 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart1.draw(view1, options1);
        ////////////////////////////////////////////////////////////
    }
</script>

<x-adminLayout>
    <div class="p-4 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Thống kê phòng</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-primary-subtle text-primary-emphasis px-4 py-3">Phòng khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-primary-emphasis">
                    {{ !is_null($availRooms) ? count($availRooms) : 0 }}
                    <i class="bi bi-house-check"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-success-subtle text-success-emphasis px-4 py-3">Phòng đang còn trống</div>
                <div class="fs-4 text-center p-4 fw-bold text-success-emphasis">
                    {{ !is_null($emptyRooms) ? count($emptyRooms) : 0 }}
                    <i class="bi bi-house-up"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-warning-subtle text-warning-emphasis px-4 py-3">Phòng đang sử dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-warning-emphasis">
                    {{ !is_null($activeRooms) ? count($activeRooms) : 0 }}
                    <i class="bi bi-house-lock"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-danger-subtle text-danger-emphasis px-4 py-3">Phòng không khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-danger-emphasis">
                    {{ !is_null($unavailRooms) ? count($unavailRooms) : 0 }}
                    <i class="bi bi-house-dash"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div>
            <h5 class="m-0 fw-bold">Loại phòng được đặt phổ biến nhất (toàn thời gian)</h5>
        </div>
        <div class="overflow-x-auto">
            <div id="columnchart_values" style="" class="d-flex justify-content-center w-100"></div>
        </div>
    </div>

    <div class="my-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">Tỷ lệ phòng được sử dụng</h5>
            <form>
                <select name="occu_rate" class="form-select" id="" onchange="this.form.submit()">
                    <option value="day">Hôm nay</option>
                    <option value="week">Tuần này</option>
                    <option value="month">Tháng này</option>
                </select>
            </form>
        </div>
        <div class="overflow-x-auto h-auto overflow-y-hidden">
            <div id="piechart" style="height: 400px" class="d-flex justify-content-center w-100"></div>
        </div>
    </div>

    <div class="row gx-4">
        <div class="col-12">
            <div class=" p-4 border bg-white rounded-3 shadow-sm">
                <div class="">
                    <h5 class="m-0 fw-bold text-danger"> Phòng hỏng/cần dọn dẹp</h5>
                </div>
                <div class="row g-4">
                    @if (count($unavailRooms) != 0)
                        @foreach ($unavailRooms as $room)
                            <div class="col-6 col-xl-4">
                                <div
                                    class="border shadow-sm rounded-3 mt-4 p-4 d-flex align-items-center justify-content-between">
                                    <div class="fs-5 fw-bold">
                                        {{ $room->name }}
                                    </div>
                                    <div>
                                        <a class="btn btn-outline-dark tran-3"
                                            href="{{ route('admin.rooms.edit', $room) }}"><i
                                                class="bi bi-eye me-2"></i>Xem</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-4">
                            Không có phòng nào
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'vi',
                firstDay: '1',
                buttonText: {
                    today: "Tháng này"
                },
                validRange: {
                    start: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
                    end: new Date(new Date().setMonth(new Date().getMonth() + 3)),
                },
                themeSystem: 'bootstrap5',
                {{-- events: @json($events), --}}

            });
            calendar.render();
        });
    </script>
</x-adminLayout>
