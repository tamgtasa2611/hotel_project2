<div class="list-group list-group-light bg-white border-0 shadow-none rounded-0">
    <div class="bg-image p-4">
        <div class="d-flex align-items-center">
            <img src="{{asset('images/noavt.jpg')}}" alt="logo" class="rounded-circle shadow-lg border" width="40px"
                 height="40px">
            <div class="ms-2">
                <div class="fw-bold">
                    Tam Nguyen
                </div>
                <div class="fs-7 text-reset">
                    Admin
                </div>
            </div>
        </div>
    </div>

    @php
        $adminId = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        $currentAdmin = \App\Models\Admin::find($adminId);
    @endphp

    @if($currentAdmin->level == 0)
        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-house me-2"></i>Dashboard
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-graph-up-arrow me-2"></i>Statistics
        </a>

        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        <a href="{{ route('admin.roomTypes') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-house-door me-2"></i>Room Types
        </a>

        <a href="{{ route('admin.rooms') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-key me-2"></i>Rooms
        </a>

        <a href="{{ route('admin.ratings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
       {{ request()->route()->getPrefix() == 'admin/ratings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-star me-2"></i>Ratings
        </a>

        <a href="{{ route('admin.admins') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
     {{ request()->route()->getPrefix() == 'admin/admins' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person-workspace me-2"></i>Administrators
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0 {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-activity me-2"></i>Activities
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#logoutModal"
           class="list-group-item list-group-item-action d-flex align-items-center border-0 text-danger"
           aria-current="true" data-mdb-modal-init>
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
    @else
        {{--     EMPLOYEE ---------------------------------------------------------------------------------------------------   --}}
        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0 {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>


        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center border-0
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#logoutModal"
           class="list-group-item list-group-item-action d-flex align-items-center border-0 text-danger"
           aria-current="true" data-mdb-modal-init>
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
                <button type="button" class="btn-close"
                        data-mdb-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">Do you really want to logout?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light rounded"
                        data-mdb-dismiss="modal">Cancel
                </button>
                <form method="get"
                      action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-danger rounded">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
