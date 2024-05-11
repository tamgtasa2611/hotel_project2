<div class="list-group list-group-light bg-dark  shadow-none ">
    @php
        $adminId = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        $currentAdmin = \App\Models\Admin::find($adminId);
    @endphp

    <div class="bg-image p-4">
        <div class="d-flex align-items-center">
            <img src="{{asset('images/noavt.jpg')}}" alt="logo" class=" shadow-lg " width="40px"
                 height="40px">
            <div class="ms-2">
                <div class="fw-bold">
                    {{$currentAdmin->first_name . ' ' . $currentAdmin->last_name}}
                </div>
                <div class="fs-7 text-reset">
                    @if($currentAdmin->level == 0)
                        Admin
                    @else
                        Employee
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($currentAdmin->level == 0)
        <a href="{{ route('admin.dashboard') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-house me-2"></i>Dashboard
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-activity me-2"></i>Activities
        </a>

        <a href="{{ route('admin.activities') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
    {{ request()->routeIs('admin.activities') ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-graph-up-arrow me-2"></i>Statistics
        </a>

        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        <a href="{{ route('admin.roomTypes') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-house-door me-2"></i>Room Types
        </a>

        <a href="{{ route('admin.rooms') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-key me-2"></i>Rooms
        </a>

        <a href="{{ route('admin.ratings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/ratings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-star me-2"></i>Ratings
        </a>

        <a href="{{ route('admin.admins') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/admins' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-person-workspace me-2"></i>Administrators
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center  {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>

        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
    @else
        {{--     EMPLOYEE ---------------------------------------------------------------------------------------------------   --}}
        <a href="{{ route('admin.bookings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-receipt me-2"></i>Bookings
        </a>

        <a href="{{ route('admin.payments') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
       {{ request()->route()->getPrefix() == 'admin/payments' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-currency-dollar me-2"></i>Payments
        </a>

        <a href="{{ route('admin.guests') }}"
           class="list-group-item list-group-item-action d-flex align-items-center  {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-people me-2"></i>Guests
        </a>


        <a href="{{ route('admin.settings') }}"
           class="list-group-item list-group-item-action d-flex align-items-center
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
           aria-current="true">
            <i class="bi bi-gear me-2"></i>Settings
        </a>

        <a href="#!"
           class="list-group-item list-group-item-action d-flex align-items-center  text-danger"
           data-bs-toggle="modal"
           data-bs-target="#exampleModal">
            <i class="bi bi-box-arrow-left me-2"></i>Logout
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
                        <i class="bi bi-exclamation-circle me-2"></i>Confirmation
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
