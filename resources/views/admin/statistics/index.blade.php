<title>Thống kê - Skyrim Hotel</title>
<script src="{{asset('plugins/calendar/index.global.min.js')}}"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tình trang', 'Số phòng'],
            ['Đang sử dụng', 11],
            ['Khả dụng', 8],
            ['Không khả dụng', 2]
        ]);

        var options = {
            title: 'Tình trạng phòng',
            is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);

        ///////////////////////////////////////////////////////////////////////
        var data1 = google.visualization.arrayToDataTable([
            ["Element", "Density", {role: "style"}],
            ["Copper", 8.94, "#b87333"],
            ["Silver", 10.49, "silver"],
            ["Gold", 19.30, "gold"],
            ["Platinum", 21.45, "color: #e5e4e2"]
        ]);

        var view1 = new google.visualization.DataView(data1);
        view1.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2]);

        var options1 = {
            title: "Density of Precious Metals, in g/cm^3",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: {position: "none"},
        };
        var chart1 = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart1.draw(view1, options1);
        ////////////////////////////////////////////////////////////
    }
</script>

<x-adminLayout>
    <div class="p-3 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Tổng quát</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-primary-subtle text-primary-emphasis px-4 py-3">Phòng khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-primary-emphasis">{{count($availRooms)}}
                    <i class="bi bi-house-check"></i></div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-success-subtle text-success-emphasis px-4 py-3">Phòng đang còn trống</div>
                <div class="fs-4 text-center p-4 fw-bold text-success-emphasis">{{count($emptyRooms)}}
                    <i class="bi bi-house-up"></i></div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-warning-subtle text-warning-emphasis px-4 py-3">Phòng đang sử dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-warning-emphasis">{{count($activeRooms)}}
                    <i class="bi bi-house-lock"></i></div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-danger-subtle text-danger-emphasis px-4 py-3">Phòng không khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-danger-emphasis">{{count($unavailRooms)}}
                    <i class="bi bi-house-dash"></i></div>
            </div>
        </div>
    </div>

    <div class="row gx-4">
        <div class="col-12 col-xl-7">
            <div class="my-4 p-4 border bg-white rounded-3 shadow-sm">
                <div class="mb-4 fw-bold fs-5">Danh sách đặt phòng</div>
                <div id="calendar" class="mb-4"></div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="mt-0 mt-xl-4 p-4 bg-white border rounded-3 shadow-sm overflow-x-auto">
                aaa
            </div>
            <div class="my-4 p-4 bg-white border rounded-3 shadow-sm">
                abc
            </div>
        </div>
    </div>

    <div class="w-100">
        <div
            class="p-4 border rounded-3 bg-white shadow-sm w-100 d-flex align-items-center justify-content-md-center overflow-x-auto">
            <div id="piechart_3d" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <div class="row gx-4">
        <div class="col-12 col-xl-6">
            <div class="mt-4 p-4 border bg-white rounded-3 shadow-sm">
                abc
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div
                class="mt-4 p-4 border bg-white rounded-3 shadow-sm w-100 d-flex align-items-center justify-content-md-center overflow-x-auto">
                <div id="columnchart_values" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'vi',
                firstDay: '1',
                buttonText: {today: "Tháng này"},
                validRange: {
                    start: new Date(new Date().getFullYear(), new Date().getMonth(), 1),
                    end: new Date(new Date().setMonth(new Date().getMonth() + 3)),
                },
                themeSystem: 'bootstrap5',
                {{--events: @json($events),--}}

            });
            calendar.render();
        })
        ;
    </script>
</x-adminLayout>
