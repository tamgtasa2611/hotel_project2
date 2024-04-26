<title>Admins management - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-3 mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Admins Management</h4>
        </div>
    </div>

    {{-- MAIN  --}}
    <div class="bg-white rounded shadow-3 overflow-hidden">
        <div class="p-3 d-flex flex-column flex-md-row justify-content-between rounded-top border-bottom">
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
        <div class="p-3 bg-white rounded-bottom text-muted">
            @if (count($admins) != 0)
                <table
                    class="tran-3 table table-sm table-bordered  align-middle mb-0 bg-white border w-100"
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
                                        class="div-img overflow-hidden rounded-circle
                                    shadow-2-strong">
                                        <img
                                            src="{{ $admin->image != "" ? asset('storage/admin/admins/' . $admin->image) : asset('images/noavt.jpg') }}"
                                            alt="admin_avatar" class="img-fluid rounded-circle"/>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 fw-semibold">
                                            {{ $admin->first_name . ' ' . $admin->last_name }}
                                            @if(\Illuminate\Support\Facades\Auth::guard('admin')->id() == $admin->id)
                                                <span class="text-success badge">Online</span>
                                            @endif
                                        </p>
                                        <p class=" text-muted mb-0"> {{ $admin->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    @if ($admin->level == 0)
                                        <span class="badge badge-primary">
                                        Owner</span>
                                    @else
                                        <span class="badge badge-warning">
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
                                    <a href="{{ route('admin.admins.edit', $admin) }}" class="btn btn-tertiary me-3">
                                        Edit
                                    </a>
                                    <a class="btn btn-tertiary text-danger dlt-btn" data-mdb-ripple-init
                                       data-mdb-modal-init href="#deleteModal" data-id={{$admin->id}}>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- DeleteModal -->
                <div class="modal slideUp" id="deleteModal" tabindex="-1"
                     aria-labelledby="deleteModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-danger" id="deleteModalLabel">
                                    <i class="bi bi-x-circle me-2"></i>Are you sure?
                                </h5>
                                <button type="button" class="btn-close" data-mdb-ripple-init
                                        data-mdb-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">You won't be able to revert this!</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded"
                                        data-mdb-ripple-init
                                        data-mdb-dismiss="modal">Cancel
                                </button>
                                <form method="post"
                                      action="{{ route('admin.admins.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input id="id" name="id" hidden class="visually-hidden" value="">
                                    <button class="btn btn-danger rounded" data-mdb-ripple-init>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
