<title>Thống kê khách hàng - Skyrim Hotel</title>
<script src="{{ asset('plugins/calendar/index.global.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {

        var data = google.visualization.arrayToDataTable([
            ['Nhóm', 'Khách hàng', ],
            // ['Có tài khoản', 20],
            // ['Không có tài khoản', 12],
            @foreach ($guestTypes as $guestType)
                ['{{ $guestType[0] }}', {{ $guestType[1] }}],
            @endforeach
        ]);

        var options = {
            title: 'Thống kê nhóm khách hàng dựa trên các đặt phòng có trong hệ thống',
            chartArea: {
                width: '50%'
            },
            hAxis: {
                minValue: 0
            },
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(data, options);

        ////////////////////////////////////////////////////////////////
    }
</script>

<x-adminLayout>
    <div class="p-4 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Thống kê khách hàng</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="my-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div>
            <h5 class="m-0 fw-bold">Nhóm khách hàng</h5>
        </div>
        <div class="overflow-x-auto overflow-y-hidden">
            <div id="chart_div" style="height: 280px" class="d-flex justify-content-center w-100"></div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="p-4 border shadow-sm rounded-3 bg-white">
                <div class="mb-4">
                    <h5 class="m-0 fw-bold">Khách hàng đặt nhiều nhất (có tài khoản)</h5>
                </div>
                <div>
                    <table class="table table-bordered" id="datatable1">
                        <thead>
                            <th class="fw-bold text-center">Tên khách hàng</th>
                            <th class="fw-bold text-center">Số đặt phòng</th>
                        </thead>
                        <tbody>
                            @foreach ($countBookingOfGuest as $guest)
                                <tr>
                                    <td class=" align-middle text-center">
                                        {{ $guest->last_name . ' ' . $guest->first_name }}</td>
                                    <td class="text-center align-middle">{{ $guest->bookings_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="p-4 border shadow-sm rounded-3 bg-white">
                <div>
                    <h5 class="mb-4 fw-bold">Khách hàng chi nhiều tiền nhất (có tài khoản)</h5>
                </div>
                <div>
                    <table class="table table-bordered" id="datatable2">
                        <thead>
                            <th class="fw-bold text-center">Tên khách hàng</th>
                            <th class="fw-bold text-center">Tổng số tiền</th>

                        </thead>
                        <tbody>
                            @foreach ($guestSpentMoney as $guest)
                                <tr>
                                    <td class=" align-middle text-center">
                                        {{ $guest->last_name . ' ' . $guest->first_name }}</td>
                                    <td class="text-center align-middle text-success fw-bold">
                                        {{ AppHelper::vnd_format($guest->bookings_sum_total_price) }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#datatable1").DataTable({
                pagingType: "full_numbers",
                layout: {
                    topEnd: {
                        search: {
                            text: "",
                            placeholder: "Tìm kiếm...",
                        },
                    },
                    bottomEnd: {
                        paging: {
                            numbers: 3,
                        },
                    },
                },
            });
            $("#datatable2").DataTable({
                pagingType: "full_numbers",
                layout: {
                    topEnd: {
                        search: {
                            text: "",
                            placeholder: "Tìm kiếm...",
                        },
                    },
                    bottomEnd: {
                        paging: {
                            numbers: 3,
                        },
                    },
                },
            });
        });
    </script>
</x-adminLayout>
