<title>Xem thanh toán - Skyrim Hotel</title>
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
                <i class="bi bi-eye me-2"></i>Xem thanh toán
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <div>
            @csrf
            @method('POST')
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="method">Ngày tạo</label>
                            </div>
                            <div class="col-8">
                                <div>{{\Carbon\Carbon::createFromDate($payment->date)->format('d-m-Y H:i:s')}}</div>
                            </div>
                        </div>
                    </div>
                    <!-- booking input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="booking_id">Đặt phòng</label>
                            </div>
                            <div class="col-8">
                                <div>
                                    <a href="{{route('admin.bookings.edit', $payment->booking)}}">#{{$payment->booking?->id}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--                    amout--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="amount">Số tiền</label>
                            </div>
                            <div class="col-8">
                                <div
                                    class="fw-bold text-success">{{\App\Helpers\AppHelper::vnd_format($payment->amount)}}</div>
                            </div>
                        </div>
                    </div>

                    {{--                    status--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="status">Trạng thái</label>
                            </div>
                            <div class="col-8">
                                @switch($payment->status)
                                    @case(0)
                                        <div class="badge bg-danger">
                                            Chưa thanh toán
                                        </div>
                                        @break
                                    @case(1)
                                        <div class="badge bg-success">
                                            Đã thanh toán
                                        </div>
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <!-- booking input -->
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="booking_id">Khách</label>
                            </div>
                            <div class="col-8">
                                <div>{{$payment->booking?->guest_lname . ' ' . $payment->booking?->guest_fname}}</div>
                            </div>
                        </div>
                    </div>

                    {{--                    amout--}}
                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="amount">Người quản lý</label>
                            </div>
                            <div class="col-8">
                                <div>{{$payment->admin?->last_name . ' ' . $payment->admin?->first_name}}</div>
                            </div>
                        </div>
                    </div>


                    {{--                    method--}}

                    <div class="p-4 col-12 ">
                        <div class="row">
                            <div class="col-4">
                                <label class="form-label" for="method">Phương thức</label>
                            </div>
                            <div class="col-8">
                                <div>{{$payment->method?->name}}</div>
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
                                <div>{{$payment->note}}</div>
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
                <a href="{{route('admin.payments.edit', $payment)}}" class="btn btn-primary px-3 tran-3">
                    <i class="me-2 bi bi-pencil-square"></i>Sửa
                </a>
            </div>
        </div>
    </div>
</x-adminLayout>
