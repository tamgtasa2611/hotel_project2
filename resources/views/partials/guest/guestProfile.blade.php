<div>
    <h6 class="fw-bold text-muted text-center">Xin chào,</h6>
    <h4 class="fw-bold text-primary text-center mb-3">
        @php
            $currentGuest = \Illuminate\Support\Facades\Auth::guard('guest')->user();
        @endphp
        {{$currentGuest->last_name . ' ' . $currentGuest->first_name}}!</h4>
</div>
<div class="list-group list-group-light  shadow-none">
    <a href="{{route('guest.profile')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.profile') ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-person me-2"></i>
        <div>Hồ sơ của tôi</div>
    </a>
    <a href="{{route('guest.myBooking')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->route()->getPrefix() == '/myBooking' ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-receipt me-2"></i>
        <div>Lịch sử đặt phòng</div>
    </a>
    <a href="{{route('guest.changePassword')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.changePassword') ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-shield-lock me-2"></i>
        <div>Đổi mật khẩu</div>
    </a>
    <a href="{{route('guest.logout')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center"

       aria-current="true">
        <i class="bi bi-box-arrow-left me-2"></i>
        <div>Đăng xuất</div>
    </a>
</div>
