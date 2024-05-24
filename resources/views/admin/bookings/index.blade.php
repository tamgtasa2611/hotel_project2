<title>Quản lý đặt phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý đặt phòng</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-list-stars me-2"></i>Danh sách đặt phòng
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.bookings.create') }}"
                   class="d-flex align-items-center me-3 btn btn-primary">
                    <i class="me-2 bi bi-plus-circle"></i>Thêm đặt phòng
                </a>
                <a href="{{ route('admin.bookings.downloadPdf') }}"
                   class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if (count($bookings) != 0)
                <table
                    class="tran-3 table table-bordered align-middle mb-0 w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Ngày tạo</th>
                        <th class="align-middle text-center">Trạng thái</th>
                        <th class="align-middle text-center">Khách hàng</th>
                        <th class="align-middle text-center">Ngày nhận phòng</th>
                        <th class="align-middle text-center">Ngày trả phòng</th>
                        <th class="align-middle text-center">Tổng cộng</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td class="text-center">
                                {{ $booking->id }}
                            </td>
                            <td class="text-break text-center">
                                {{ $booking->date }}
                            </td>
                            <td class="text-center">
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
                            </td>
                            <td class="text-center">
                                {{ $booking->guest_lname . ' ' . $booking->guest_fname }}
                            </td>
                            <td class="text-center">
                                {{ $booking->checkin}} <span class="text-muted ">(14:00)</span>
                            </td>
                            <td class="text-center">
                                {{ $booking->checkout }} <span class="text-muted ">(12:00)</span>
                            </td>
                            <td class="text-center fw-bold text-success">
                                {{ \App\Helpers\AppHelper::vnd_format($booking->total_price) }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.bookings.show', $booking) }}"
                                       class="btn btn-outline-dark tran-3 me-3">
                                        <i class="bi bi-eye me-2"></i>Xem
                                    </a>
                                    <a href="{{ route('admin.bookings.edit', $booking) }}"
                                       class="btn btn-outline-primary tran-3">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                No results
            @endif
        </div>
    </div>
</x-adminLayout>
<script>
    $(document).ready(function () {
        $("#dataTable").DataTable({
            columnDefs: [
                {
                    orderable: false,
                    targets: 7,
                },
            ],
            pagingType: "full_numbers",
            layout: {
                topEnd: {
                    search: {
                        text: "",
                        placeholder: "Type to search...",
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
