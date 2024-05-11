<div>
    <h6 class="fw-bold text-muted text-center">Welcome back,</h6>
    <h4 class="fw-bold text-primary text-center mb-3">
        @php
            $currentGuest = \Illuminate\Support\Facades\Auth::guard('guest')->user();
        @endphp
        {{$currentGuest->first_name . ' ' . $currentGuest->last_name}}!</h4>
</div>
<div class="list-group list-group-light  shadow-none">
    <a href="{{route('guest.profile')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.profile') ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-info-circle me-2"></i>
        <div>My profile</div>
    </a>
    <a href="{{route('guest.myBooking')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->route()->getPrefix() == '/myBooking' ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-receipt me-2"></i>
        <div>My bookings</div>
    </a>
    <a href="{{route('guest.changePassword')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.changePassword') ? 'active' : ''}}"
       aria-current="true">
        <i class="bi bi-shield-lock me-2"></i>
        <div>Change password</div>
    </a>
    <a href="{{route('guest.logout')}}" class="list-group-item list-group-item-action
                        px-3  d-flex align-items-center justify-content-lg-start justify-content-center"

       aria-current="true">
        <i class="bi bi-box-arrow-left me-2"></i>
        <div>Sign out</div>
    </a>
</div>
