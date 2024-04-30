<title>Activities Log - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-sm border mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Activities Log</h4>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white border rounded shadow-sm overflow-hidden">
        <div
            class="p-3 d-flex flex-column flex-md-row justify-content-between rounded-top border-bottom">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-table me-2"></i>Activities Datatable
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="#!"
                   class="d-flex align-items-center text-danger text-decoration-none"
                   data-bs-toggle="modal"
                   data-bs-target="#exampleModal">
                    <i class="me-2 bi bi-trash"></i>Clear activities
                </a>
            </div>
        </div>
        <div class="p-3 bg-white rounded-bottom text-muted">
            @if (count($activities) != 0)
                <table
                    class="tran-3 table table-bordered  align-middle mb-0 bg-white border w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Admin (ID)</th>
                        <th class="align-middle text-center">Detail</th>
                        <th class="align-middle text-center">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td class="text-center">
                                {{ $activity->id }}
                            </td>
                            <td class="text-center">
                                {{$activity->admin->first_name . ' ' . $activity->admin->first_name . ' (#' . $activity->admin->id . ')'}}
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
                No results
            @endif
        </div>
    </div>
    <!-- Delete Account Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('admin.activities.clear') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                            <i class="bi bi-x-circle me-2"></i>Are you sure?
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="deletePassword" class="form-label">
                            Please enter your password:
                        </label>
                        <div>
                            <input type="password" name="deletePassword"
                                   class="form-control" id="deletePassword" required
                                   minlength="6">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-danger rounded-pill">
                            Clear activities
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-adminLayout>
<script>
    $(document).ready(function () {
        $("#dataTable").DataTable({
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
