<title>Booking information - Skyrim Hotel</title>
<x-adminLayout>
    {{--------------- MAIN --------------}}
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary">
            <h4 class="fw-bold m-0">Bookings Management</h4>
        </div>
    </div>

    <div class="bg-white  shadow-sm border rounded-3  overflow-hidden">
        <div
            class="p-4 -top -bottom">
            <div class="text-primary">
                <i class="bi bi-pencil-square me-2"></i>Sửa đặt phòng
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.bookings.update', $booking) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <div class="p-4">
                <!-- name input -->
                <div class=" col-12  col-lg-6 col-xl-4">
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

                <div class="shadow-sm rounded-3 border col-12 col-md-4">
                    <div class="p-4 fw-bold">Sắp xếp phòng</div>
                    <hr class="m-0">
                    <div class="p-4">
                        @foreach($bookedRoomTypes as $bookedRoomType)
                            <div class="mb-4">
                                <div>
                                    {{$bookedRoomType->name}} ({{$bookedRoomType->number_of_room}} phòng)
                                </div>
                                @foreach($bookedRooms as $bookedRoom)
                                    @if($bookedRoom->room_type_id == $bookedRoomType->id)
                                        <div class="form-check">
                                            <label
                                                for="room{{$bookedRoom->room_id}}"
                                                class="form-check-label">{{$bookedRoom->name}}</label>
                                            <input type="checkbox" id="room{{$bookedRoom->room_id}}"
                                                   class="form-check-input">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <hr class="m-0">
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.bookings') }}"
                   class="btn btn-secondary  tran-3 me-3">
                    <i class="bi bi-arrow-left me-2"></i>Quay lại
                </a>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary  tran-3">
                    <i class="bi bi-floppy me-2"></i>Cập nhật
                </button>
            </div>
        </form>

    </div>

</x-adminLayout>
