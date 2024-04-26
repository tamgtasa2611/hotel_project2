<div>
    <h6 class="fw-bold text-muted text-center">Welcome back,</h6>
    <h4 class="fw-bold text-primary text-center mb-3">Tam Nguyen!</h4>
</div>
<div class="list-group list-group-light">
    <a href="{{route('guest.profile')}}" class="list-group-item list-group-item-action
                        px-3 border-0 d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.profile') ? 'active' : ''}}" data-mdb-ripple-init
       aria-current="true">
        <i class="bi bi-info-circle me-2"></i>
        <div>My profile</div>
    </a>
    <a href="{{route('guest.myBooking')}}" class="list-group-item list-group-item-action
                        px-3 border-0 d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.myBooking') ? 'active' : ''}}" data-mdb-ripple-init
       aria-current="true">
        <i class="bi bi-receipt me-2"></i>
        <div>My bookings</div>
    </a>
    <a href="{{route('guest.editAccount')}}" class="list-group-item list-group-item-action
                        px-3 border-0 d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.editAccount') ? 'active' : ''}}" data-mdb-ripple-init
       aria-current="true">
        <i class="bi bi-pencil-square me-2"></i>
        <div>Edit account</div>
    </a>
    <a href="{{route('guest.changePassword')}}" class="list-group-item list-group-item-action
                        px-3 border-0 d-flex align-items-center justify-content-lg-start justify-content-center
                        {{request()->routeIs('guest.changePassword') ? 'active' : ''}}" data-mdb-ripple-init
       aria-current="true">
        <i class="bi bi-shield-lock me-2"></i>
        <div>Change password</div>
    </a>
    <a href="{{route('guest.logout')}}" class="list-group-item list-group-item-action
                        px-3 border-0 d-flex align-items-center justify-content-lg-start justify-content-center"
       data-mdb-ripple-init
       aria-current="true">
        <i class="bi bi-box-arrow-left me-2"></i>
        <div>Sign out</div>
    </a>
</div>
