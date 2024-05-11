<title>Admins management - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-dark  shadow-lg  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Admins Management</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    {{-- MAIN  --}}
    <div class="bg-dark  shadow-lg  overflow-hidden">
        <div class="p-4 d-flex flex-column flex-md-row justify-content-between  -bottom">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-table me-2"></i>Admins Datatable
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.admins.create') }}" class="d-flex align-items-center me-3">
                    <i class="me-2 bi bi-plus-circle"></i>Add new admin
                </a>
                <a href="{{ route('admin.admins.downloadPdf') }}" class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <div class="p-4 bg-dark  text-muted">
            @if (count($admins) != 0)
                <table
                    class="tran-3 table table-striped table-sm align-middle mb-0 bg-dark  w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle text-center">Level</th>
                        <th class="align-middle text-center">Phone number</th>
                        <th class="align-middle text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td class="text-center">
                                {{ $admin->id }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div
                                        class="div-img overflow-hidden  shadow-lg ">
                                        <img
                                            src="{{ $admin->image != "" ? asset('storage/admin/admins/' . $admin->image) : asset('images/noavt.jpg') }}"
                                            alt="admin_avatar" class="object-fit-cover" width="40px"
                                            height="40px"/>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-semibold">
                                            {{ $admin->first_name . ' ' . $admin->last_name }}
                                        </p>
                                        <p class=" text-muted mb-0"> {{ $admin->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    @if ($admin->level == 0)
                                        <span class="badge bg-dark ">
                                        Owner</span>
                                    @else
                                        <span class="badge bg-dark  shadow-lg">
                                        Employee</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    {{ $admin->phone_number }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.admins.edit', $admin) }}"
                                       class="btn btn-outline-primary  me-3">
                                        Edit<i class="bi bi-pencil-square ms-2"></i>
                                    </a>
                                    @if($admin->level != 0)
                                        <a class="btn btn-outline-danger  dlt-btn"
                                           data-bs-toggle="modal"
                                           data-bs-target="#exampleModal1"
                                           data-id={{$admin->id}}>
                                            Delete<i class="bi bi-trash ms-2"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-outline-dark disabled ">
                                            Delete<i class="bi bi-trash ms-2"></i>
                                        </a>
                                    @endif
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
                            <form method="post" action="{{ route('admin.admins.destroy') }}">
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
