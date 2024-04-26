<div class="list-group list-group-light p-3 rounded">
    {{--    <div class="d-flex align-items-center">--}}
    {{--        <div--}}
    {{--            class="div-img overflow-hidden rounded-circle shadow">--}}
    {{--            <img--}}
    {{--                src="{{ $admin->image != "" ? asset('storage/admin/guest/' . $admin->image) : asset('images/noavt.jpg') }}"--}}
    {{--                alt="admin_avatar" class="img-fluid rounded-circle"/>--}}
    {{--        </div>--}}
    {{--        <div class="ms-3">--}}
    {{--            <div class="fw-bold">--}}
    {{--                {{ $admin->first_name . ' ' . $admin->last_name }}--}}
    {{--            </div>--}}
    {{--            @if(session()->has('admin'))--}}
    {{--                <div class="text-success fs-7">--}}
    {{--                    <i class="bi bi-circle-fill me-1"></i>Online--}}
    {{--                </div>--}}
    {{--            @endif--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="bg-image">
        <a href="{{route('guest.home')}}">
            <img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid">
        </a>
    </div>

    {{--    SEARCH--}}
    <div class="form-outline mt-3">
        <input type="text" id="search_nav" class="form-control" placeholder="Type to search..."/>
    </div>

    @php
        $adminId = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        $currentAdmin = \App\Models\Admin::find($adminId);
    @endphp

    @if($currentAdmin->level == 0)
        {{--    MASTER--}}
        <div class="text-uppercase fs-7 fw-bold py-3 text-primary">
            General
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-grid me-2"></i>Dashboard
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-activity me-2"></i>Activities
        </a>

        {{--    BOOKING MANAGEMENT --}}
        <div class="text-uppercase fs-7 fw-bold py-3 text-primary">
            Booking Management
        </div>

        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        {{--    HOTEL MANAGEMENT--}}
        <div class="text-uppercase fs-7 fw-bold py-3 text-primary">
            Hotel Management
        </div>

        <a href="{{ route('admin.roomTypes') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-house-door me-2"></i>Room Types
        </a>

        <a href="{{ route('admin.rooms') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-key me-2"></i>Rooms
        </a>

        <a href="{{ route('admin.ratings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
       {{ request()->route()->getPrefix() == 'admin/ratings' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-star me-2"></i>Ratings
        </a>

        {{--    ACCOUNT MANAGEMENT--}}
        <div class="text-uppercase fs-7 fw-bold py-3 text-primary">
            Account Management
        </div>

        <a href="{{ route('admin.admins') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
     {{ request()->route()->getPrefix() == 'admin/admins' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-person-workspace me-2"></i>Administrators
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2 {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>

        {{--    OTHER--}}
        <div class="text-uppercase fs-7 fw-bold py-3 text-primary">
            Other
        </div>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#logoutModal"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2 text-danger"
           data-mdb-ripple-init aria-current="true" data-mdb-modal-init>
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
    @else
        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2 mt-3
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2 {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           data-mdb-ripple-init aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#logoutModal"
           class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 py-2 text-danger"
           data-mdb-ripple-init aria-current="true" data-mdb-modal-init>
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
    @endif

</div>

<!-- DeleteModal -->
<div class="modal slideUp" id="logoutModal" tabindex="-1"
     aria-labelledby="logoutModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="logoutModalLabel">
                    <i class="bi bi-exclamation-circle me-2"></i>Confirmation
                </h5>
                <button type="button" class="btn-close" data-mdb-ripple-init
                        data-mdb-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">Do you really want to logout?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded" data-mdb-ripple-init
                        data-mdb-dismiss="modal">Cancel
                </button>
                <form method="get"
                      action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-danger rounded" data-mdb-ripple-init>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
