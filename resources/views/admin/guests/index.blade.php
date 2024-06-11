<title>Quản lý khách hàng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý khách hàng</h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    {{-- MAIN  --}}
    <div class="bg-white  shadow-sm border rounded-3 overflow-hidden">
        <div class="p-4 d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-person me-2"></i>Danh sách khách hàng
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.guests.create') }}"
                    class="d-flex align-items-center align-items-center btn btn-primary">
                    <i class="me-2 bi bi-plus-circle"></i>Thêm khách hàng
                </a>

            </div>
        </div>
        <hr class="m-0">
        <div class="p-4 bg-white  text-muted">
            @if (count($guests) != 0)
                <table class="tran-3 table table-bordered align-middle mb-0 bg-white  w-100" id="dataTable">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle">Tên</th>
                            <th class="align-middle text-center">Trạng thái tài khoản</th>
                            <th class="align-middle text-center">Số điện thoại</th>
                            <th class="align-middle text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $guest)
                            <tr>
                                <td class="text-center">
                                    {{ $guest->id }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="div-img overflow-hidden ">
                                            <img src="{{ $guest->image != '' ? asset('storage/admin/guests/' . $guest->image) : asset('images/noavt.jpg') }}"
                                                alt="guest_avatar"
                                                class="object-fit-cover border shadow-sm rounded-circle" width="40px"
                                                height="40px" />
                                        </div>
                                        <div class="ms-3">
                                            <p class="mb-1 fw-semibold">
                                                {{ $guest->first_name . ' ' . $guest->last_name }}
                                            </p>
                                            <p class=" text-muted mb-0"> {{ $guest->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if ($guest->status == 1)
                                            <span class="badge bg-success shadow-sm">
                                                Đang hoạt động</span>
                                        @else
                                            <span class="badge bg-danger shadow-sm">
                                                Bị khóa</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        {{ $guest->phone_number }}
                                    </div>
                                </td>
                                <td class="fs-5">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a href="{{ route('admin.guests.edit', $guest) }}"
                                            class="btn btn-outline-primary  me-3">
                                            Sửa<i class="bi bi-pencil-square ms-2"></i>
                                        </a>
                                        @if (Auth::guard('admin')->user()->level == 0)
                                            <a class="btn btn-outline-danger  dlt-btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal1" data-id={{ $guest->id }}>
                                                Xóa<i class="bi bi-trash ms-2"></i>
                                            </a>
                                        @else
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- DeleteModal -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('admin.guests.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel1">
                                        <i class="bi bi-x-circle me-2"></i>Xác nhận xóa
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Bạn sẽ không thể hoàn tác!
                                    <input id="id" name="id" hidden class="visually-hidden" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                                        Đóng
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
                Không có dữ liệu
            @endif
        </div>
    </div>
</x-adminLayout>
<script>
    $(document).ready(function() {
        $("#dataTable").DataTable({
            columnDefs: [{
                orderable: false,
                targets: 4,
            }, ],
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
