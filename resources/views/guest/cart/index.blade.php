<title>Giỏ hàng - Skyrim Hotel</title>
<x-guestLayout>
    <section class="m-nav">
        <div class="container">
            <div class="row h-auto py-4 g-4" id="cart-page">
                <div class="col-12">
                    <div class="">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            @if ($cart != null)
                                <div class="p-3 bg-primary rounded-circle shadow-sm">
                                    <i class="bi bi-bag text-white"></i>
                                </div>
                            @else
                                <div class="p-3 border rounded-circle shadow-sm">
                                    <i class="bi bi-bag text-primary"></i>
                                </div>
                            @endif
                            <div class="p-3 border rounded-circle shadow-sm">
                                <i class="bi bi-credit-card text-primary"></i>
                            </div>
                            <div class="p-3 border rounded-circle shadow-sm">
                                <i class="bi bi-check text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            @if ($cart != null)
                                <div class="progress-bar" role="progressbar" style="width: 24px;" aria-valuenow="2"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            @else
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            @endif
                        </div>
                    </div>
                </div>
                @if ($cart != null)
                    <div class="col-12 col-lg-8 tran-3">
                        <div class="bg-white p-4 shadow-sm border rounded-3 overflow-x-auto">
                            <div class="mb-4 text-center">
                                <h3 class="fw-bold mb-4">Giỏ hàng</h3>
                            </div>
                            <div class="mb-3 d-flex justify-content-between ">
                                <div>
                                    Ngày nhận phòng: {{ $start }}
                                </div>
                                <div>
                                    Ngày trả phòng: {{ $end }}
                                </div>
                            </div>
                            <hr class="m-0">
                            <table class="table table-responsive">
                                <thead class="table-light">
                                    <tr>
                                        <th class="align-middle text-center py-3 col-8">Phòng</th>
                                        <th class="align-middle text-center py-3 col-2">Số lượng</th>
                                        <th class="align-middle text-center py-3 col-2">Tổng cộng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                    @foreach ($cart as $roomTypeId => $roomType)
                                        <tr>
                                            <td class="align-middle col-6">
                                                <div class="row g-4 align-items-center">
                                                    <div class="col-2 text-center">
                                                        <a href="{{ route('guest.cart.delete', $roomTypeId) }}">
                                                            <i class="bi bi-x-circle text-danger"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-5 py-3">
                                                        <div class="ratio ratio-16x9">
                                                            <a href="{{ route('guest.rooms.show', $roomType['roomType']) }}"
                                                                class="ratio ratio-16x9 overflow-hidden">
                                                                @if (count($roomType['roomType']->images) == 0)
                                                                    <img src="{{ asset('images/noimage.jpg') }}"
                                                                        alt="room_img"
                                                                        class="rounded-3 object-fit-cover shadow-sm border">
                                                                @else
                                                                    <img src="{{ asset('storage/rooms/' . $roomType['roomType']->images[0]->path) }}"
                                                                        alt="room_img"
                                                                        class="rounded-3 object-fit-cover shadow-sm border">
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div>
                                                            <a
                                                                href="{{ route('guest.rooms.show', $roomType['roomType']) }}">
                                                                <h5>{{ $roomType['roomType']->name }}</h5>
                                                            </a>
                                                            <div class="">
                                                                <div class="text-success">
                                                                    {{ \App\Helpers\AppHelper::vnd_format($roomType['roomType']->price) }}
                                                                    <span class="text-dark"> / đêm</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center col-2">
                                                <div>
                                                    <form action="{{ route('guest.cart.updateQuantity') }}"
                                                        method="POST" class="quantity_form">
                                                        @method('POST')
                                                        @csrf
                                                        <input type="hidden" name="checkin" hidden
                                                            class="visually-hidden" value="{{ $start }}">
                                                        <input type="hidden" name="checkout" hidden
                                                            class="visually-hidden" value="{{ $end }}">
                                                        <input type="hidden" class="visually-hidden" hidden
                                                            name="room_type_id" value="{{ $roomTypeId }}">
                                                        <input type="number" value="{{ $roomType['quantity'] }}"
                                                            min="1" name="quantity"
                                                            class="form-control quantity-input"
                                                            onchange="this.form.submit()">
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center col-2">
                                                <div class="text-success">
                                                    {{ \App\Helpers\AppHelper::vnd_format($roomType['roomType']->price * $roomType['quantity']) }}
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $totalPrice += $roomType['roomType']->price * $roomType['quantity'];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('guest.rooms') }}" class="">Chọn thêm phòng</a>
                                <a href="{{ route('guest.cart.deleteAll') }}" class="text-danger">Xóa tất cả</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-4 tran-3">
                        <div class="p-4 bg-white border shadow-sm rounded-3">
                            <div>
                                <h4 class="m-0 text-primary fw-bold">Thông tin đặt phòng</h4>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>Số phòng</div>
                                    <div>{{ count($cart) }}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Thành tiền</div>
                                    <div>{{ \App\Helpers\AppHelper::vnd_format($totalPrice) }}</div>
                                    @php
                                        \Illuminate\Support\Facades\Session::put('total_price', $totalPrice);
                                    @endphp
                                </div>
                                <hr>
                                <a class="btn btn-primary w-100 tran-3" href="{{ route('guest.payment') }}">Tiếp tục
                                    thanh toán</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 tran-3">
                        <div
                            class="p-4 my-4 bg-white border shadow-sm rounded-3 d-flex flex-column justify-content-center align-items-center">
                            <h4 class="fw-bold mb-4 mt-5">Giỏ hàng của bạn trống</h4>
                            <a href="{{ route('guest.rooms') }}" class="btn btn-primary mb-5 tran-3">Chọn phòng</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <script>
        let updateQuantity = function() {
            // $(".quantity-input").each(function (index, element) {
            //     $(element).on("input", function (event) {
            //         console.log($(element).parent())
            //         var $form = $(element).parent(),
            //             token = $form.find("input[name='_token']").val(),
            //             roomTypeId = $form.find("input[name='room_type_id']").val(),
            //             quantity = $form.find("input[name='quantity']").val(),
            //             url = 'http://127.0.0.1:8000/cart/update';
            //
            //         console.log(token, roomTypeId, quantity, url)
            //
            //         var posting = $.post(url, {
            //             _token: token,
            //             room_type_id: roomTypeId,
            //             quantity: quantity
            //         });
            //
            //         posting.done(function (data) {
            //             alert(data)
            //         });
            //     });
            // })
        };
        updateQuantity();

        //tu dong reload
        setInterval(function() {
            $("#cart-page").load(" #cart-page > *");

            //update quantity
            updateQuantity();
        }, 3000);
    </script>
</x-guestLayout>
