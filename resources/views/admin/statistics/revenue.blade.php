<title>Thống kê doanh thu - Skyrim Hotel</title>
<script src="{{ asset('plugins/calendar/index.global.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            @foreach ($roomTypes as $roomType)
                ['{{ $roomType[0] }}', {{ $roomType[1] }}],
            @endforeach
        ]);

        var options = {
            title: 'Tổng doanh thu: ' + '{{ AppHelper::vnd_format($totalRevenue) }}',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

<x-adminLayout>
    <div class="p-4 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Thống kê doanh thu</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="my-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">Doanh thu theo loại phòng</h5>
        </div>
        <div class="overflow-x-auto h-auto overflow-y-hidden d-flex justify-content-center ">
            <div id="donutchart" style="width: 900px; height: 400px;"></div>
        </div>
    </div>

    <div class="my-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">Doanh thu theo thời gian</h5>
            <form>
                <select name="room_type_revenue" class="form-select" id="" onchange="this.form.submit()">

                    <option value="week">Tuần này</option>
                    <option value="month">Tháng hiện tại</option>
                    <option value="quarter">Quý hiện tại</option>
                    <option value="year">Năm nay</option>
                </select>
            </form>
        </div>
        <div class="overflow-x-auto h-auto overflow-y-hidden">
            a
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="p-4 border shadow-sm rounded-3 bg-white">
                <div class="mb-4">
                    <h5 class="m-0 fw-bold">Khung giờ có nhiều khách đặt</h5>
                </div>
                <div>
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <th class="fw-bold text-center">Khung giờ</th>
                            <th class="fw-bold text-center">Số đặt phòng</th>
                        </thead>
                        <tbody>
                            @foreach ($bookHours as $hour)
                                <tr>
                                    <td class=" align-middle text-center">{{ $hour[0] }}</td>
                                    <td class="text-center align-middle">{{ $hour[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="p-4 border shadow-sm rounded-3 bg-white">
                <div class="mb-4">
                    <h5 class="m-0 fw-bold">abc</h5>
                </div>
                <div>
                    abc
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#datatable").DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 0,
                }, ],
                layout: {
                    topStart: {

                    },
                    topEnd: {

                    },
                    bottomStart: {

                    },
                    bottomEnd: {

                    },
                },
            });
        });
    </script>
</x-adminLayout>
