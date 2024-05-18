<div class="list-group list-group-light bg-white overflow-x-hidden sticky-top overflow-y-scroll tran-3 hide-scroll-bar"
     style="max-height: 100vh;">
    {{--  ==================  AVATAR ================================================================================================================--}}
    @php
        $adminId = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        $currentAdmin = \App\Models\Admin::find($adminId);
    @endphp

    <div class="bg-image px-5">
        <div class="">
            <div class="p-4">
                <div class="ratio ratio-1x1">
                    <img
                        src="{{$currentAdmin->image ? asset('storage/admin/admins/'.$currentAdmin->image) : asset('images/noavt.jpg')}}"
                        alt="logo" class="object-fit-cover shadow-sm border rounded-circle ">
                </div>
            </div>
            <div class="mb-4 text-center">
                <div class="fw-bold">
                    {{$currentAdmin->first_name . ' ' . $currentAdmin->last_name}}
                </div>
                <div class="fs-7 text-reset">
                    @if($currentAdmin->level == 0)
                        Quản trị viên
                    @else
                        Nhân viên
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--  ==================  MAIN ================================================================================================================--}}

    @if($currentAdmin->level == 0)
        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-grid me-2"></i>Tổng quát
        </a>

        {{--  ==================  BOOKING ================================================================================================================--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="bookingHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 py-3 pe-4
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#booking" aria-expanded="false" aria-controls="booking">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-receipt me-2"></i>Đặt phòng
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>

                        </div>
                    </div>
                </button>
            </h2>
            <div id="booking" class="accordion-collapse collapse tran-3
            @if(request()->route()->getPrefix() == 'admin/bookings')
            show
            @endif
            " aria-labelledby="bookingHeader"
                 data-bs-parent="#booking" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.bookings.create') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-plus-circle me-2 ms-3"></i>Thêm đặt phòng
                    </a>

                    <a href="{{ route('admin.bookings') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-list-stars me-2 ms-3"></i>Danh sách đặt phòng
                    </a>

                    <a href="{{ route('admin.payments') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-cup-hot me-2 ms-3"></i>Danh sách đặt món
                    </a>

                </div>
            </div>
        </div>

        {{--  ==================  PAYMENT ================================================================================================================--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="paymentHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 py-3 pe-4
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-currency-dollar me-2"></i>Thanh toán
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>

                        </div>
                    </div>
                </button>
            </h2>
            <div id="payment" class="accordion-collapse collapse tran-3
            @if(request()->route()->getPrefix() == 'admin/payments')
            show
            @endif
            " aria-labelledby="paymentHeader"
                 data-bs-parent="#payment" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.roomTypes') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-plus-circle me-2 ms-3"></i>Thêm thanh toán
                    </a>

                    <a href="{{ route('admin.payments') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-currency-dollar me-2 ms-3"></i>Danh sách thanh toán
                    </a>

                </div>
            </div>
        </div>

        {{--  ==================  GUEST ================================================================================================================--}}

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
                       {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person me-2"></i>Khách hàng
        </a>

        {{--  ==================  HOTEL ================================================================================================================--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="hotelHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 py-3 pe-4
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#hotel" aria-expanded="false" aria-controls="hotel">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-building me-2"></i>Khách sạn
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="hotel" class="accordion-collapse collapse tran-3
            @if(request()->route()->getPrefix() == 'admin/roomTypes'
                OR request()->route()->getPrefix() == 'admin/rooms'
                OR request()->route()->getPrefix() == 'admin/amenities'
                OR request()->route()->getPrefix() == 'admin/services'
                OR request()->route()->getPrefix() == 'admin/food-items'
                OR request()->route()->getPrefix() == 'admin/admins')
            show
            @endif
            " aria-labelledby="hotelHeader"
                 data-bs-parent="#hotel" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.roomTypes') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-door-closed me-2 ms-3"></i>Loại phòng
                    </a>

                    <a href="{{ route('admin.rooms') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-key me-2 ms-3"></i>Danh sách phòng
                    </a>

                    <a href="{{ route('admin.amenities') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/amenities' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-heart me-2 ms-3"></i>Tiện nghi
                    </a>

                    <a href="{{ route('admin.services') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/services' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-bookmark-plus me-2 ms-3"></i>Dịch vụ
                    </a>

                    <a href="{{ route('admin.foodItems') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/food-items' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-egg-fried me-2 ms-3"></i>Món ăn
                    </a>

                    <a href="{{ route('admin.admins') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/admins' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-person-badge me-2 ms-3"></i>Nhân viên
                    </a>

                </div>
            </div>
        </div>

        {{--  ==================  STATISTIC ================================================================================================================--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="statisticHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 pe-4 py-3
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#statistic" aria-expanded="false" aria-controls="statistic">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-graph-up me-2"></i>Thống kê
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>
                        </div>
                    </div>
                </button>
            </h2>
            <div id="statistic" class="accordion-collapse collapse tran-3
            @if(request()->routeIs('admin.statistics.revenue')
                OR request()->routeIs('admin.statistics.rooms')
                OR request()->routeIs('admin.statistics.services')
                OR request()->routeIs('admin.statistics.foods')
                OR request()->routeIs('admin.statistics.guests'))
            show
            @endif
            " aria-labelledby="statisticHeader"
                 data-bs-parent="#statistic" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.statistics.revenue') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->routeIs('admin.statistics.revenue') ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-currency-dollar me-2 ms-3"></i>Thống kê doanh thu
                    </a>

                    <a href="{{ route('admin.statistics.rooms') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->routeIs('admin.statistics.rooms') ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-key me-2 ms-3"></i>Thống kê phòng
                    </a>

                    <a href="{{ route('admin.statistics.services') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->routeIs('admin.statistics.services') ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-bookmark-plus me-2 ms-3"></i>Thống kê dịch vụ
                    </a>

                    <a href="{{ route('admin.statistics.foods') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->routeIs('admin.statistics.foods') ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-egg-fried me-2 ms-3"></i>Thống kê đặt món
                    </a>

                    <a href="{{ route('admin.statistics.guests') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
{{ request()->routeIs('admin.statistics.guests') ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-person me-2 ms-3"></i>Thống kê khách
                    </a>

                </div>
            </div>
        </div>


        {{--  ==================  OTHER ================================================================================================================--}}
        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-clock-history me-2"></i>Nhật ký hệ thống
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Cài đặt tài khoản
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            <i class="bi bi-arrow-left-circle me-2"></i>Đăng xuất
        </a>
        {{--     END ADMIN  ---------------------------------------------------------------------------------------------------   --}}

    @else
        {{--     EMPLOYEE ---------------------------------------------------------------------------------------------------   --}}
        {{--        dat phong--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="bookingHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 py-3 pe-4
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#booking" aria-expanded="false" aria-controls="booking">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-receipt me-2"></i>Đặt phòng
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>

                        </div>
                    </div>
                </button>
            </h2>
            <div id="booking" class="accordion-collapse collapse tran-3
            @if(request()->route()->getPrefix() == 'admin/bookings')
            show
            @endif
            " aria-labelledby="bookingHeader"
                 data-bs-parent="#booking" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.roomTypes') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-plus-circle me-2 ms-3"></i>Thêm đặt phòng
                    </a>

                    <a href="{{ route('admin.bookings') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 pe-0 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-list-stars me-2 ms-3"></i>Danh sách đặt phòng
                    </a>

                </div>
            </div>
        </div>
        {{--    end dat phong--}}

        {{--       thanh toan--}}
        <div class="accordion-item">
            <h2 class="accordion-header" id="paymentHeader">
                <button
                    class="accordion-button collapsed list-group-item list-group-item-action tran-3 border-0 px-5 py-3 pe-4
                    d-flex align-items-center tran-3"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#payment" aria-expanded="false" aria-controls="payment">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <div>
                            <i class="bi bi-currency-dollar me-2"></i>Thanh toán
                        </div>
                        <div>
                            <i class="bi bi-chevron-down"></i>

                        </div>
                    </div>
                </button>
            </h2>
            <div id="payment" class="accordion-collapse collapse tran-3
            @if(request()->route()->getPrefix() == 'admin/payments')
            show
            @endif
            " aria-labelledby="paymentHeader"
                 data-bs-parent="#payment" style="">
                <div class="accordion-body fs-7">
                    <a href="{{ route('admin.roomTypes') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-plus-circle me-2 ms-3"></i>Thêm thanh toán
                    </a>

                    <a href="{{ route('admin.payments') }}"
                       class="list-group-item list-group-item-action tran-3  border-0 px-5 pe-0 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
                       aria-current="true">
                        <i class="bi bi-currency-dollar me-2 ms-3"></i>Danh sách thanh toán
                    </a>

                </div>
            </div>
        </div>
        {{--    end thanh toan--}}

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center  {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person me-2"></i>Khách hàng
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Cài đặt tài khoản
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action tran-3  border-0 px-5 py-3 d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            <i class="bi bi-arrow-left-circle me-2"></i>Đăng xuất
        </a>
    @endif
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="get" action="{{ route('admin.logout') }}">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">
                        Xác nhận đăng xuất
                    </h1>
                    <button type="button" class="btn-close tran-3" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có muốn đăng xuất khỏi hệ thống?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary tran-3"
                            data-bs-dismiss="modal">
                        Quay lại
                    </button>
                    <button type="submit" class="btn btn-danger tran-3">
                        Xác nhận
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
