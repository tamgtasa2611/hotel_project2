<title>Nhật ký hệ thống - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Nhật ký hệ thống</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{-- ------------- MAIN ------------ --}}
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div class="p-4 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-clock-history me-2"></i>Danh sách nhật ký hệ thống
            </div>
            @if (count($activities) != 0)
                {{-- Button  --}}
                <div class="d-flex align-items-center justify-content-end">
                    <a href="#!" class="btn btn-danger tran-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModal1">
                        <i class="me-2 bi bi-trash"></i>Xóa nhật ký
                    </a>
                </div>
            @endif
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if ($activities != null)
                @if (count($activities) != 0)
                    <table class="tran-3 table table-bordered align-middle mb-0 bg-white  w-100" id="dataTable">
                        <thead>
                            <tr>
                                <th class="align-middle text-center">ID</th>
                                <th class="align-middle text-center">Tên nhân viên (ID)</th>
                                <th class="align-middle text-center">Chi tiết</th>
                                <th class="align-middle text-center">Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="text-center">
                                        {{ $activity->id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $activity->admin->first_name . ' ' . $activity->admin->last_name . ' (#' . $activity->admin->id . ')' }}
                                    </td>
                                    <td class="text-break text-center">
                                        {{ $activity->detail }}
                                    </td>
                                    <td class="text-center">
                                        {{ $activity->date }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    Không có dữ liệu
                @endif
            @else
                Không có dữ liệu
            @endif
        </div>
    </div>
    <!-- Delete Account Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.activities.clear') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel1">
                            <i class="bi bi-x-circle me-2"></i>Xác nhận xóa
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="date" class="form-label">
                            Chọn khoảng thời gian xóa:
                        </label>
                        <select name="date" id="date" class="form-select">
                            <option value="day">24 giờ qua</option>
                            <option value="week">Tuần này</option>
                            <option value="month">Tháng này</option>
                            <option value="all">Toàn bộ</option>
                        </select>
                        <label for="deletePassword" class="form-label mt-4">
                            Vui lòng nhập mật khẩu của bạn:
                        </label>
                        <div>
                            <input type="password" name="deletePassword" class="form-control" id="deletePassword"
                                required minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                            Quay lại
                        </button>
                        <button type="submit" class="btn btn-danger ">
                            Xóa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminLayout>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
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
