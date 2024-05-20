<title>Quản lý phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý phòng</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white  shadow-sm  border rounded-3 overflow-hidden">
        <div
            class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-key me-2"></i>Danh sách phòng
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.rooms.create') }}"
                   class="d-flex align-items-center me-3 btn btn-primary">
                    <i class="me-2 bi bi-plus-circle"></i>Thêm phòng
                </a>
                <a href="{{ route('admin.rooms.downloadPdf') }}"
                   class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if (count($rooms) != 0)
                <table
                    class="tran-3 table table-bordered align-middle mb-0 bg-white  w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Tên phòng</th>
                        <th class="align-middle text-center">Trạng thái</th>
                        <th class="align-middle text-center">Loại phòng</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td class="text-center">
                                {{ $room->id }}
                            </td>
                            <td class="text-center">
                                {{ $room->name }}
                            </td>
                            <td class="text-center">
                                @switch($room->status)
                                    @case(0)
                                        <div class="badge bg-success shadow-sm ">Khả dụng</div>
                                        @break
                                    @case(1)
                                        <div class="badge bg-danger shadow-sm ">Không khả dụng</div>
                                        @break
                                @endswitch
                            </td>
                            @if($room->roomType == null)
                                <td class="text-center text-danger">
                                    <i class="bi bi-exclamation-triangle me-2"></i>Chưa phân loại
                                </td>
                            @else
                                <td class="text-center">
                                    {{ $room->roomType->name}}
                                </td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.rooms.edit', $room) }}"
                                       class="btn btn-outline-primary  me-3">
                                        <i class="bi bi-pencil-square me-2"></i>Sửa
                                    </a>
                                    <a class="btn btn-outline-danger  dlt-btn"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal1"
                                       data-id={{$room->id}}>
                                        <i class="bi bi-trash me-2"></i>Xóa
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- DeleteModal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1"
                     aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('admin.rooms.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel1">
                                        <i class="bi bi-x-circle me-2"></i>Are you sure?
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    You won't be able to revert this!
                                    <input id="id" name="id" hidden class="visually-hidden"
                                           value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                            data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-danger ">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--                end modal--}}
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
                    targets: 4,
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
