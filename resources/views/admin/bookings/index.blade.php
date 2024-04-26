<title>Bookings management - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-3 bg-white rounded shadow-sm border mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Bookings Management</h4>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white rounded shadow-sm border overflow-hidden">
        <div
            class="p-3 d-flex flex-column flex-md-row justify-content-between rounded-top border-bottom">
            <div class="text-primary mb-3 mb-md-0">
                <i class="bi bi-table me-2"></i>Bookings Datatable
            </div>
            {{-- Button  --}}
            <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                <a href="{{ route('admin.bookings.create') }}"
                   class="d-flex align-items-center me-3">
                    <i class="me-2 bi bi-plus-circle"></i>Add new booking
                </a>
                <a href="{{ route('admin.bookings.downloadPdf') }}"
                   class="d-flex align-items-center">
                    <i class="me-2 bi bi-download"></i>Export
                </a>
            </div>
        </div>
        <div class="p-3 bg-white rounded-bottom text-muted">
            @if (count($bookings) != 0)
                <table
                    class="tran-3 table table-sm table-bordered align-middle mb-0 bg-white w-100"
                    id="dataTable">
                    <thead>
                    <tr>
                        <th class="align-middle text-center">ID</th>
                        <th class="align-middle text-center">Created Date</th>
                        <th class="align-middle text-center">Status</th>
                        <th class="align-middle text-center">Guest</th>
                        <th class="align-middle text-center">Room</th>
                        <th class="align-middle text-center">Check-in</th>
                        <th class="align-middle text-center">Check-out</th>
                        <th class="align-middle text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td class="text-center">
                                {{ $booking->id }}
                            </td>
                            <td class="text-break text-center">
                                {{ $booking->created_date }}
                            </td>
                            <td class="text-center">
                                @switch($booking->status)
                                    @case(0)
                                        <div class="badge badge-danger">Pending</div>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                {{ $booking->guest->first_name . ' ' . $booking->guest->last_name }}
                            </td>
                            <td class="text-center">
                                {{ $booking->room->name }}
                            </td>
                            <td class="text-center">
                                {{ $booking->checkin_date }}
                            </td>
                            <td class="text-center">
                                {{ $booking->checkout_date }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="{{ route('admin.bookings.edit', $booking) }}"
                                       class="btn btn-tertiary">
                                        View
                                    </a>
                                </div>
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
