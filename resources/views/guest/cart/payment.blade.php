<title>Thanh toán - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <form class="row h-auto py-4 g-4" method="post" action="{{route('guest.paymentProcess')}}">
                @csrf
                @method('POST')
                <div class="col-12">
                    <div class="">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-bag text-white"></i>
                            </div>

                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-credit-card text-white"></i>
                            </div>
                            <div class="p-3 border rounded-circle shadow-sm">
                                <i class="bi bi-check text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 50%;"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-xl-8 load-hidden fade-in">
                    <div class="p-4 bg-white border shadow-sm rounded-3">
                        <div class="col-12">
                            <h4 class="m-0 text-primary fw-bold">Thông tin khách hàng</h4>
                            <hr>
                            <div class="row g-4">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="lname">Họ <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" id="lname" name="guest_lname" class="form-control"
                                           value="{{\Illuminate\Support\Facades\Auth::guard('guest')->user()->last_name}}">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="fname">Tên <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" id="fname" name="guest_fname" class="form-control"
                                           value="{{\Illuminate\Support\Facades\Auth::guard('guest')->user()->first_name}}">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">Email <span
                                            class="text-danger">*</span></label>
                                    <input required type="email" id="email" name="guest_email" class="form-control"
                                           value="{{\Illuminate\Support\Facades\Auth::guard('guest')->user()->email}}">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="phone">Số điện thoại <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" id="phone" name="guest_phone" class="form-control"
                                           value="{{\Illuminate\Support\Facades\Auth::guard('guest')->user()->phone_number}}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="note">Ghi chú</label>
                                    <textarea id="note" name="note" class="form-control"></textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-12">
                            <a href="{{route('guest.cart')}}">Quay lại</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-xl-4 load-hidden fade-in">
                    <div class="p-4 bg-white border shadow-sm rounded-3">
                        <div>
                            <h4 class="m-0 text-primary fw-bold">Chi tiết thanh toán</h4>
                            <hr>
                            <table class="table table-striped table-borderless">
                                <tr>
                                    <td>Ngày nhận phòng</td>
                                    <td>{{$start}}</td>
                                </tr>
                                <tr>
                                    <td>Ngày trả phòng</td>
                                    <td>{{$end}}</td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Phòng</td>
                                    <td>
                                        @foreach($carts as $roomTypeId => $roomType)
                                            <div>
                                                {{$roomType['roomType']->name}} x {{$roomType['quantity']}}
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tổng cộng</td>
                                    <td>{{\App\Helpers\AppHelper::vnd_format($totalPrice)}}</td>
                                </tr>
                                <tr>
                                    <td>Tiền đặt cọc (25%)</td>
                                    <td>{{\App\Helpers\AppHelper::vnd_format(($totalPrice * 0.25))}}</td>
                                </tr>
                            </table>
                        </div>
                        {{--                        <div class="fst-italic opacity-75 fs-7 mb-3 text-center">--}}
                        {{--                            Bạn sẽ thanh toán--}}
                        {{--                            <span--}}
                        {{--                                class="fst-italic fw-bold">{{\App\Helpers\AppHelper::vnd_format($totalPrice - ($totalPrice * 0.25))}}</span>--}}
                        {{--                            còn lại sau khi trả phòng--}}
                        {{--                        </div>--}}
                        <input type="hidden" class="visually-hidden" name="total_price"
                               value="{{$totalPrice * 0.25}}">
                        <div class="mb-3">
                            <button class="btn btn-secondary w-100 tran-3 mb-1" name="pay_layer" value="1"
                                    type="submit">Thanh
                                toán sau
                            </button>
                            <button class="btn btn-primary w-100 tran-3" name="redirect" type="submit">Thanh toán tiền
                                cọc
                            </button>
                        </div>
                        <div class="fst-italic opacity-75 fs-7 text-center">
                            Nếu bạn chọn <span class="fw-bold fst-italic">Thanh toán sau</span>, nhân viên sẽ gọi điện
                            cho bạn để xác nhận đặt phòng trong vòng 24h
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-guestLayout>
