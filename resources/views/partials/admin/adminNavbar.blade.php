<nav class="navbar navbar-expand-lg sticky-top py-0 tran-2 bg-white rounded border-0 shadow-sm">
    <div class="container-fluid p-3 justify-content-between">
        {{--        brand --}}
        <div>
            <div class="input-group rounded">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                       aria-describedby="search-addon"/>
                <span class="input-group-text border-0" id="search-addon">
    <i class="bi bi-search"></i>
  </span>
            </div>
        </div>

        {{--        account btn --}}
        <div class="d-flex justify-content-end align-items-center d-none d-lg-flex">
            <!-- Icon -->
            <div class="dropdown me-3">
                <a class="text-reset tran-2 dropdown-toggle hidden-arrow" aria-expanded="false" id="dropdown3"
                   data-mdb-toggle="dropdown" href="#" role="button">
                    <i class="bi bi-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul class="end-0 dropdown-menu dropright mt-0 tran-3 bg-white border shadow-sm animate slideIn"
                    aria-labelledby="dropdown3">
                    <li><a class="dropdown-item tran-2" href="#">Welcome back!</a></li>
                    <li><a class="dropdown-item tran-2" href="#">Book a room now for 20% sales off!</a>
                    </li>
                    <li><a class="dropdown-item tran-2" href="#">Account created successfully!</a></li>
                </ul>
            </div>

            <!-- Notifications -->
            <div class="dropdown">
                <a class="text-reset tran-2  dropdown-toggle hidden-arrow" aria-expanded="false" id="dropdown4"
                   data-mdb-toggle="dropdown" href="#" role="button">
                    <i class="bi bi-person"></i>
                </a>
                <ul class="end-0 dropdown-menu dropright mt-0 tran-3 bg-white border shadow-sm animate slideIn"
                    aria-labelledby="dropdown4">
                    <li><a class="dropdown-item tran-2" href="{{ route('guest.home') }}">
                            <i class="bi bi-cursor me-2"></i>Visit guest site</a></li>
                    <li>
                    <li><a class="dropdown-item tran-2" href="{{ route('guest.home') }}">
                            <i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li>
                        <hr class="m-0">
                    </li>
                    <li><a class="dropdown-item tran-2" href="{{ route('admin.logout') }}">
                            <i class="bi bi-box-arrow-left me-2"></i>Logout</a></li>
                </ul>
            </div>

          
        </div>
        {{--        account btn --}}

        {{--       responsive list button --}}
        <div class="text-end navbar-toggler border-0 p-0">
            <a class="text-reset" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list"></i>
            </a>
        </div>

        {{--        responsive nav bar button --}}
        <div class="offcanvas offcanvas-start tran-3 d-lg-none" tabindex="-1" id="offcanvasExample"
             aria-labelledby="offcanvasExampleLabel" style="width: 240px">
            <div class="offcanvas-body d-flex flex-column justify-content-between">
                <div class="list-group list-group-light">
                    <a href="{{ route('admin.dashboard') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
    {{ request()->route()->getPrefix() == 'admin/dashboard' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>

                    <a href="{{ route('admin.roomTypes') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
{{ request()->route()->getPrefix() == 'admin/roomTypes' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-grid me-2"></i>Room Types
                    </a>

                    <a href="{{ route('admin.rooms') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
{{ request()->route()->getPrefix() == 'admin/rooms' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-key me-2"></i>Rooms
                    </a>

                    <a href="{{ route('admin.employees') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->route()->getPrefix() == 'admin/employees' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-person-vcard me-2"></i>Employees
                    </a>

                    <a href="{{ route('admin.guests') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0 {{ request()->route()->getPrefix() == 'admin/guests' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-person me-2"></i>Guests
                    </a>

                    <a href="{{ route('admin.bookings') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-receipt me-2"></i>Bookings
                    </a>

                    <a href="{{ route('admin.bookings') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->route()->getPrefix() == 'admin/bookings' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-person-workspace me-2"></i>Tasks Manager
                    </a>

                    <a href="{{ route('admin.services') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->route()->getPrefix() == 'admin/services' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-chat-heart me-2"></i>Services
                    </a>

                    <a href="{{ route('admin.ratings') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->route()->getPrefix() == 'admin/ratings' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-star me-2"></i>Ratings
                    </a>

                    <a href="{{ route('admin.settings') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
     {{ request()->route()->getPrefix() == 'admin/settings' ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-envelope me-2"></i>Emails
                    </a>

                    <a href="{{ route('admin.settings') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0
       {{ request()->routeIs('admin.settings') ? 'active' : '' }}"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-gear me-2"></i>Settings
                    </a>

                    <a href="{{ route('admin.logout') }}"
                       class="list-group-item list-group-item-action d-flex align-items-center px-3 border-0"
                       data-mdb-ripple-init aria-current="true">
                        <i class="bi bi-box-arrow-left me-2"></i>Logout
                    </a>
                </div>

            </div>
        </div>
    </div>
</nav>
