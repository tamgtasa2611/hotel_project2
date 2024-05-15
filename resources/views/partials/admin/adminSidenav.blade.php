<div class="list-group list-group-light bg-white fs-ok">
    @php
        $adminId = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        $currentAdmin = \App\Models\Admin::find($adminId);
    @endphp

    <div class="bg-image px-5 py-3 fs-6">
        <div class="">
            <div class="p-3">
                <div class="ratio ratio-1x1">
                    <img
                        src="{{$currentAdmin->image ? asset('storage/admin/admins/'.$currentAdmin->image) : asset('images/noavt.jpg')}}"
                        alt="logo" class="object-fit-cover shadow-sm border rounded-circle ">
                </div>
            </div>
            <div class="mt-3 text-center">
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

    @if($currentAdmin->level == 0)
        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-grid me-2"></i>Tổng quát
        </a>

        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-receipt me-2"></i>Đặt phòng
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center  {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person me-2"></i>Khách hàng
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Thanh toán
        </a>

        <a href="{{ route('admin.roomTypes') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-door-closed me-2"></i>Loại phòng
        </a>

        <a href="{{ route('admin.rooms') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-key me-2"></i>Danh sách phòng
        </a>

        <a href="{{ route('admin.amenities') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/amenities' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-heart me-2"></i>Tiện nghi phòng
        </a>

        <a href="{{ route('admin.admins') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/admins' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person-badge me-2"></i>Nhân viên
        </a>


        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-graph-up me-2"></i>Báo cáo thống kê
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-clock-history me-2"></i>Nhật ký hệ thống
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Cài đặt tài khoản
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            <i class="bi bi-arrow-left-circle me-2"></i>Đăng xuất
        </a>
    @else
        {{--     EMPLOYEE ---------------------------------------------------------------------------------------------------   --}}
        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            Payments
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center  {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            Guests
        </a>


        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            Settings
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action  border-0 px-5 py-3 d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            Logout
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
                        Confirmation
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Logging out of the system?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary "
                            data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary ">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
