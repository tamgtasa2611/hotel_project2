<title>Booking information - Skyrim Hotel</title>
<x-adminLayout>
    {{--------------- MAIN --------------}}
    <div class="p-3 bg-white rounded-4 shadow-sm border mb-3">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Bookings Management</h4>
        </div>
    </div>

    <div class="bg-white rounded-4 shadow-sm border overflow-hidden">
        <div
            class="p-3 rounded-4-top border-bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Edit booking
            </div>
        </div>
        {{-- FORM  --}}

        <form method="post" action="{{ route('admin.bookings.update', $booking) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <!-- name input -->
            <div class="p-3 col-12  col-lg-6 col-xl-4">
                <label class="form-label" for="status">status</label>
                <select name="status" id="status" required class="form-select">
                    <option value="0" {{$booking->status == 0 ? 'selected' : ''}}>Pending</option>
                    <option value="1" {{$booking->status == 1 ? 'selected' : ''}}>Confirmed</option>
                    <option value="2" {{$booking->status == 2 ? 'selected' : ''}}>Ongoing</option>
                    <option value="3" {{$booking->status == 3 ? 'selected' : ''}}>Completed</option>
                    <option value="4" {{$booking->status == 4 ? 'selected' : ''}}>Cancelled</option>
                    <option value="5" {{$booking->status == 5 ? 'selected' : ''}}>Refund</option>
                </select>
                @if ($errors->has('status'))
                    @foreach ($errors->get('status') as $error)
                        <span class="text-danger fs-7">{{ $error }}</span>
                    @endforeach
                @endif
            </div>

            TEST DEMO

            <div class="d-flex justify-content-between justify-content-md-start border-top p-3">
                <a href="{{ route('admin.bookings') }}"
                   class="btn btn-secondary rounded-4 tran-2 me-3">
                    Back
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary rounded-4 tran-2">
                    Update
                </button>
            </div>
        </form>

    </div>

</x-adminLayout>
