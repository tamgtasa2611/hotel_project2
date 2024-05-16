<title>Giỏ hàng - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <div class="row h-auto py-5 g-4">
                <div class="col-12">
                    <div class="shadow-sm bg-white px-4 py-3 border rounded-3">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            @if(\Illuminate\Support\Facades\Session::get('cart') != null)
                                <div class="bg-primary rounded-circle shadow-sm border p-3">
                                    <i class="bi bi-bag display-6 text-white"></i>
                                </div>
                            @else
                                <div class="bg-white rounded-circle shadow-sm border p-3">
                                    <i class="bi bi-bag display-6 text-primary"></i>
                                </div>
                            @endif
                            <div class="bg-white shadow-sm rounded-circle border p-3">
                                <i class="bi bi-credit-card display-6 text-primary"></i>
                            </div>
                            <div class="bg-white shadow-sm  rounded-circle border p-3">
                                <i class="bi bi-check display-6 text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            @if(\Illuminate\Support\Facades\Session::get('cart') != null)
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: 3%;"
                                    aria-valuenow="3"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            @else
                                <div
                                    class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar"
                                    style="width: 0;"
                                    aria-valuenow="0"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Session::get('cart') != null)
                    <div class="col-12 col-lg-8 load-hidden fade-in">
                        <div class="bg-white p-4 shadow-sm border rounded-3 overflow-x-auto">
                            <table class="table table-responsive ">
                                <thead>
                                <tr>
                                    <th class="align-middle text-center">Phòng</th>
                                    <th class="align-middle text-center">Giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @foreach(\Illuminate\Support\Facades\Session::get('cart') as $room_id => $room)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="row g-4 align-items-center">
                                                <div class="col-1">
                                                    <a href="{{route('guest.cart.delete', $room_id)}}">
                                                        <i class="bi bi-x text-danger"></i>
                                                    </a>
                                                </div>
                                                <div class="col-3">
                                                    <div class="ratio ratio-16x9">
                                                        <a href="{{route('guest.rooms.show', $room['room'])}}"
                                                           class="ratio ratio-16x9">
                                                            @if(count($room['room']->images) == 0)
                                                                <img src="{{asset('images/noimage.jpg')}}"
                                                                     alt="room_img" class="rounded-3">
                                                            @else
                                                                <img
                                                                    src="{{asset('storage/admin/rooms/'.$room['room']->images[0]->path)}}"
                                                                    alt="room_img" class="rounded-3">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div>
                                                        <a href="{{route('guest.rooms.show', $room['room'])}}">
                                                            <h5>{{$room['room']->name}}</h5>
                                                        </a>
                                                        <div class="fs-7">
                                                            <div>
                                                                Ngày nhận phòng: {{$room['check_in']}}
                                                            </div>
                                                            <div class="mt-1">
                                                                Ngày trả phòng: {{$room['check_out']}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div>
                                                {{\App\Helpers\AppHelper::vnd_format($room['price'])}}
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $totalPrice += $room['price'];
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{route('guest.rooms')}}" class="">Chọn thêm phòng</a>
                                <a href="{{route('guest.cart.deleteAll')}}" class="text-danger">Xóa tất cả</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-12 col-lg-4 load-hidden fade-in">
                        <div class="p-4 bg-white border shadow-sm rounded-3">
                            <div>
                                <h4 class="m-0 text-primary fw-bold">Thông tin đặt phòng</h4>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>Số phòng</div>
                                    <div>{{count(\Illuminate\Support\Facades\Session::get('cart'))}}</div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>Thành tiền</div>
                                    <div>{{\App\Helpers\AppHelper::vnd_format($totalPrice)}}</div>
                                </div>
                                <hr>
                                <a class="btn btn-primary w-100 tran-3"
                                   href="{{route('guest.checkOut.payInPerson')}}">Tiếp tục thanh toán</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 load-hidden fade-in">
                        <div
                            class="p-4 bg-white border shadow-sm rounded-3 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="mt-5 mb-4">Giỏ hàng của bạn trống</h5>
                            <a href="{{route('guest.rooms')}}" class="btn btn-primary mb-5 tran-3">Chọn phòng</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-guestLayout>
