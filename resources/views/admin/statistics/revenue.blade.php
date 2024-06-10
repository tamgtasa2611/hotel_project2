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
            <h5 class="mb-4 fw-bold">Doanh thu theo thời gian</h5>
        </div>
        <div class="overflow-x-auto h-auto overflow-y-hidden row g-4">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">Doanh thu ngày</div>
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">{{ AppHelper::vnd_format($todayRev) }}</h4>
                        <p class="card-text text-center">
                            @if ($todayRev - $prevRev > 0)
                                <span class="text-success">
                                    <i class="bi bi-graph-up"></i> Nhiều hơn
                                    {{ AppHelper::vnd_format($todayRev - $prevRev) }} so với hôm qua
                                </span>
                            @elseif($todayRev - $prevRev < 0)
                                <span class="text-danger">
                                    <i class="bi bi-graph-down"></i> Kém hơn
                                    {{ AppHelper::vnd_format($todayRev - $prevRev) }} so với hôm qua
                                </span>
                            @else
                                Bằng với hôm qua
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">Doanh thu tháng</div>
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">{{ AppHelper::vnd_format($monthRev) }}</h4>
                        <p class="card-text text-center">
                            @if ($monthRev - $prevMonthRev > 0)
                                <span class="text-success">
                                    <i class="bi bi-graph-up"></i> Nhiều hơn
                                    {{ AppHelper::vnd_format($monthRev - $prevMonthRev) }} so với tháng trước
                                </span>
                            @elseif($monthRev - $prevMonthRev < 0)
                                <span class="text-danger">
                                    <i class="bi bi-graph-down"></i> Kém hơn
                                    {{ AppHelper::vnd_format($monthRev - $prevMonthRev) }} so với tháng trước
                                </span>
                            @else
                                Bằng với tháng trước
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header">Doanh thu năm</div>
                    <div class="card-body">
                        <h4 class="card-title text-center text-success">{{ AppHelper::vnd_format($yearRev) }}</h4>
                        <p class="card-text text-center">
                            @if ($yearRev - $prevYearRev > 0)
                                <span class="text-success">
                                    <i class="bi bi-graph-up"></i> Nhiều hơn
                                    {{ AppHelper::vnd_format($yearRev - $prevYearRev) }} so với năm ngoái
                                </span>
                            @elseif($yearRev - $prevYearRev < 0)
                                <span class="text-danger">
                                    <i class="bi bi-graph-down"></i> Kém hơn
                                    {{ AppHelper::vnd_format($yearRev - $prevYearRev) }} so với năm ngoái
                                </span>
                            @else
                                Bằng với năm ngoái
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
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
                    <h5 class="m-0 fw-bold">Doanh thu theo loại phòng</h5>
                </div>
                <div class="overflow-x-auto h-auto overflow-y-hidden d-flex justify-content-center ">
                    <div id="donutchart" style="width: 900px; height: 456px;"></div>
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
