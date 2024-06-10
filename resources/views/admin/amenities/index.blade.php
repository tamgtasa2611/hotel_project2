<title>Quản lý tiện nghi - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý tiện nghi</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{-- ------------- MAIN ------------ --}}
    <div class="mt-4 bg-white  shadow-sm  border rounded-3 overflow-hidden">
        <div class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-heart me-2"></i>Danh sách tiện nghi
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.amenities.create') }}" class="d-flex align-items-center btn btn-primary">
                    <i class="me-2 bi bi-plus-circle"></i>Thêm tiện nghi
                </a>

            </div>
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if (count($amenities) != 0)
                <table class="tran-3 table table-bordered align-middle mb-0 bg-white  w-100" id="dataTable">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Tên tiện nghi</th>
                            <th class="align-middle text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($amenities as $amenity)
                            <tr>
                                <td class="text-center">
                                    {{ $amenity->id }}
                                </td>
                                <td class="text-center">
                                    {{ $amenity->name }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('admin.amenities.edit', $amenity) }}"
                                            class="btn btn-outline-primary  me-3">
                                            <i class="bi bi-pencil-square me-2"></i>Sửa
                                        </a>
                                        <a class="btn btn-outline-danger  dlt-btn" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal2" data-id={{ $amenity->id }}>
                                            <i class="bi bi-trash me-2"></i>Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- DeleteModal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('admin.amenities.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel2">
                                        <i class="bi bi-x-circle me-2"></i>Xác nhận xóa
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn có chắc mình muốn xóa tiện nghi này?
                                    <input id="id" name="id" hidden class="visually-hidden" value="">
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
                {{--                end modal --}}
            @else
                Không có kết quả nào
            @endif
        </div>
    </div>
</x-adminLayout>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
            columnDefs: [{
                orderable: false,
                targets: 2,
            }, ],
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
