<title>Guests management - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-sm border mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Guests Management</h4>
        </div>
    </div>

    {{-- MAIN  --}}
    <div class="bg-white rounded shadow-sm border overflow-hidden">
        <div class="p-3 d-flex flex-column flex-md-row justify-content-between rounded-top border-bottom">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-table me-2"></i>Guests Datatable
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.guests.create') }}" class="d-flex align-items-center me-3">
                    <i class="me-2 bi bi-plus-circle"></i>Add new guest
                </a>
                <a href="{{ route('admin.guests.downloadPdf') }}" class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <div class="p-3 bg-white rounded-bottom text-muted">
            @if (count($guests) != 0)
                <table
                    class="tran-3 table table-bordered  align-middle mb-0 bg-white border w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle">Name</th>
                        <th class="align-middle text-center">Account Status</th>
                        <th class="align-middle text-center">Phone number</th>
                        <th class="align-middle text-center">Actions</th>
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
                                    <div
                                        class="div-img overflow-hidden rounded-circle shadow-sm">
                                        <img
                                            src="{{ $guest->image != "" ? asset('storage/admin/guests/' . $guest->image) : asset('images/noavt.jpg') }}"
                                            alt="guest_avatar" class="object-fit-cover" width="40px"
                                            height="40px"/>
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
                                        <span class="badge bg-success rounded-pill">
                                        Active</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill">
                                        Locked</span>
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
                                       class="me-3">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a class="text-danger dlt-btn"
                                       data-bs-toggle="modal" href="#!"
                                       data-bs-target="#exampleModal" data-id={{$guest->id}}>
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!-- Delete Account Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('admin.guests.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <input id="id" name="id" hidden class="visually-hidden" value="">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                                        <i class="bi bi-x-circle me-2"></i>Are you sure?
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">You won't be able to revert this!</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded-pill"
                                            data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-danger rounded-pill">
                                        Delete
                                    </button>
                                </div>
                            </form>
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
