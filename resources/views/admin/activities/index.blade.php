<title>Activities Log - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-3 mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Activities Log</h4>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white border rounded shadow-3 overflow-hidden">
        <div
            class="p-3 d-flex flex-column flex-md-row justify-content-between rounded-top border-bottom">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-table me-2"></i>Activities Datatable
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.roomTypes.create') }}"
                   class="d-flex align-items-center me-3">
                    <i class="me-2 bi bi-plus-circle"></i>Add new room type
                </a>
                <a href="{{ route('admin.activities.downloadPdf') }}"
                   class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <div class="p-3 bg-white rounded-bottom text-muted">
            @if (count($activities) != 0)
                <table
                    class="tran-3 table table-sm table-bordered  align-middle mb-0 bg-white border w-100"
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
