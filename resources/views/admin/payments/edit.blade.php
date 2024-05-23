<title>Thêm thanh toán - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý thanh toán</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Thêm thanh toán
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.payments.update', $payment) }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <!-- booking input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="booking_id">Đặt phòng <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <select name="booking_id" id="booking_id" class="form-select" required>
                                    @foreach($bookings as $booking)
                                        <option value="{{$booking->id}}"
                                            {{$payment->booking_id == $booking->id ? 'selected' : ''}}
                                        >#{{$booking->id}}
                                            ({{\App\Helpers\AppHelper::vnd_format($booking->total_price)}}
                                            - {{$booking->guest_lname . ' ' . $booking->guest_fname}}
                                            - {{\Carbon\Carbon::createFromDate($booking->date)->format('d-m-Y')}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('booking_id'))
                            @foreach ($errors->get('booking_id') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--                    amout--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="amount">Số tiền <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <input type="number" class="form-control" id="amount" name="amount" min="10000"
                                       step="1000"
                                       required value="{{$payment->amount}}">
                            </div>
                        </div>
                        @if ($errors->has('amount'))
                            @foreach ($errors->get('amount') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--                    status--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="status">Trạng thái <span
                                        class="text-danger">*</span></label>
                            </div>
                            <div class="col-8">
                                <select name="status" id="status" class="form-select" required>
                                    <option value="0" {{$payment->status == 0 ? 'selected' : ''}}>Chưa
                                        thanh toán
                                    </option>
                                    <option value="1" {{$payment->status == 1 ? 'selected' : ''}}>Đã thanh
                                        toán
                                    </option>
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('status'))
                            @foreach ($errors->get('status') as $error)
                                <span class="text-danger fs-7">{{ $error }}</span>
                            @endforeach
                        @endif
                    </div>

                    {{--                    method--}}

                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="method">Phương thức</label>
                            </div>
                            <div class="col-8">
                                <select name="method_id" id="method" class="form-select">
                                    @foreach($methods as $method)
                                        <option
                                            value="{{$method->id}}" {{$payment->method_id == $method->id ? 'selected' : ''}}>{{$method->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--note--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="note">Ghi chú</label>
                            </div>
                            <div class="col-8">
                                <textarea name="note" id="note" class="form-control">{{$payment->note}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-0">
            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.payments') }}"
                   class="btn btn-secondary px-3 tran-3 me-3">
                    <i class="me-2 bi bi-arrow-left"></i>Quay lại
                </a>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary px-3 tran-3">
                    <i class="me-2 bi bi-floppy"></i>Cập nhật
                </button>
            </div>
        </form>
    </div>
</x-adminLayout>
