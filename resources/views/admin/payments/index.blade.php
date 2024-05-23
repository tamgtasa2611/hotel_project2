<title>Quản lý thanh toán - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý thanh toán</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    {{--------------- MAIN --------------}}
    <div class="mt-4 bg-white  shadow-sm  border rounded-3 overflow-hidden">
        <div
            class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-currency-dollar me-2"></i>Danh sách thanh toán
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.payments.create') }}"
                   class="d-flex align-items-center btn btn-primary">
                    <i class="me-2 bi bi-plus-circle"></i>Thêm thanh toán
                </a>
            </div>
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if (count($payments) != 0)
                <table
                    class="tran-3 table table-bordered align-middle mb-0 bg-white  w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Ngày tạo</th>
                        <th class="align-middle text-center">Trạng thái</th>
                        <th class="align-middle text-center">Tổng cộng</th>
                        <th class="align-middle text-center" width="400">Ghi chú</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="text-center">
                                {{ $payment->id }}
                            </td>
                            <td class="text-center ">
                                {{ \Carbon\Carbon::createFromDate($payment->date)->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="text-center">
                                @switch($payment->status)
                                    @case(0)
                                        <div class="badge bg-danger">
                                            Chưa thanh toán
                                        </div>
                                        @break
                                    @case(1)
                                        <div class="badge bg-success">
                                            Đã thanh toán
                                        </div>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center text-success fw-bold">
                                {{ \App\Helpers\AppHelper::vnd_format($payment->amount) }}
                            </td>
                            <td class="text-break">
                                {{ $payment->note }}
                            </td>

                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-outline-dark"><i
                                            class="bi bi-eye me-2"></i>Xem</a>
                                    <a href="{{ route('admin.payments.edit', $payment) }}"
                                       class="btn btn-outline-primary tran-3 ms-3">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--                end modal--}}
            @else
                Không có kết quả nào
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
                    targets: 5,
                },
            ],
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
