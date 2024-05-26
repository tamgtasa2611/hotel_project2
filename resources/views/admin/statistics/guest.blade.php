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
            ['Có tài khoản', 20],
            ['Không có tài khoản', 12],
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
        var data1 = new google.visualization.DataTable();
        data1.addColumn('timeofday', 'Time of Day');
        data1.addColumn('number', 'Số ngày');

        data1.addRows([
            [{
                v: [8, 0, 0],
                f: '8 am'
            }, 1],
            [{
                v: [9, 0, 0],
                f: '9 am'
            }, 2],
            [{
                v: [10, 0, 0],
                f: '10 am'
            }, 3],
            [{
                v: [11, 0, 0],
                f: '11 am'
            }, 4],
            [{
                v: [12, 0, 0],
                f: '12 pm'
            }, 5],
            [{
                v: [13, 0, 0],
                f: '1 pm'
            }, 6],
            [{
                v: [14, 0, 0],
                f: '2 pm'
            }, 7],
            [{
                v: [15, 0, 0],
                f: '3 pm'
            }, 8],
            [{
                v: [16, 0, 0],
                f: '4 pm'
            }, 9],
            [{
                v: [17, 0, 0],
                f: '5 pm'
            }, 10],
        ]);

        var options1 = {
            title: 'Motivation Level Throughout the Day',
            hAxis: {
                title: 'Time of Day',
                format: 'h:mm a',
                viewWindow: {
                    min: [7, 30, 0],
                    max: [17, 30, 0]
                }
            },
            vAxis: {
                title: 'Rating (scale of 1-10)'
            }
        };

        var chart1 = new google.visualization.ColumnChart(
            document.getElementById('chart_div1'));

        chart1.draw(data1, options1);
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
                    <h5 class="m-0 fw-bold">Khách hàng đặt phòng nhiều nhất</h5>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <th class="fw-bold">Tên khách hàng</th>
                            <th class="fw-bold text-center">Số đặt phòng</th>
                            <th class="fw-bold text-center">Số phòng</th>
                        </thead>
                        <tbody>
                            <td class=" align-middle">abc</td>
                            <td class="text-center align-middle">abc</td>
                            <td class="text-center align-middle">
                                <a href="" class="btn btn-outline-dark btn-sm tran-3"><i
                                        class="bi bi-eye me-2"></i>Xem</a>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="p-4 border shadow-sm rounded-3 bg-white">
                <div>
                    <h5 class="mb-4 fw-bold">Khách hàng chi nhiều tiền nhất</h5>
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <th class="fw-bold">Tên khách hàng</th>
                            <th class="fw-bold text-center">Tổng số tiền</th>

                        </thead>
                        <tbody>
                            <td class=" align-middle">abc</td>
                            <td class="text-center align-middle text-success fw-bold">
                                {{ AppHelper::vnd_format(1000000) }}
                            </td>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 w-100 p-4 border bg-white rounded-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="m-0 fw-bold">Thời gian khách hàng lưu trú</h5>
        </div>
        <div class="overflow-x-auto h-auto overflow-y-hidden">
            <div id="chart_div1" style="height: 280px" class="d-flex justify-content-center w-100"></div>
        </div>
    </div>
</x-adminLayout>
