<nav class="navbar nav-underline navbar-expand-lg bg-primary tran-2 shadow-lg fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="/home">SkyrimHotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('guest.home') ? 'active' : ''}}"
                       href="{{route('guest.home')}}">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->route()->getPrefix() == '/rooms' ? 'active' : ''}}"
                       href="{{route('guest.rooms')}}">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('guest.contact') ? 'active' : ''}}"
                       href="{{route('guest.contact')}}">Contact</a>
                </li>
                <li class=" nav-item">
                    <a class="nav-link {{request()->routeIs('guest.about') ? 'active' : ''}}"
                       href="{{route('guest.about')}}">About</a>
                </li>
            </ul>
            <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                @guest('guest')
                    <a class="btn btn-primary px-3 tran-2 me-2 rounded-pill"
                       href="{{route('guest.login')}}">
                        Log in
                    </a>
                    <a class="btn btn-secondary px-3 tran-2 rounded-pill" href="{{route('guest.register')}}">
                        Sign up
                    </a>
                @endguest
                @auth('guest')
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link tran-2 h-100"
                               href="{{route('guest.checkOut')}}" role="button">
                                <div class="d-flex align-items-center h-100 w-100">
                                    <i class="bi bi-bag"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                @php
                                    $avatar = \Illuminate\Support\Facades\Auth::guard('guest')->user()->image;
                                @endphp
                                @if($avatar == null)
                                    <img src="{{asset('images/noavt.jpg')}}" alt="guest_avatar" width="24px"
                                         height="24px" class="rounded-circle object-fit-cover">
                                @else
                                    <img src="{{asset('storage/admin/guests/' . $avatar)}}" alt="guest_avatar"
                                         width="24px"
                                         height="24px" class="rounded-circle object-fit-cover">
                                @endif
                            </a>
                            <div class="dropdown-menu dropright" data-bs-theme="light">
                                <a class="dropdown-item tran-2" href="{{route('guest.profile')}}">
                                    <i class="bi bi-info-circle me-2"></i>My profile</a>
                                <a class="dropdown-item tran-2" href="{{route('guest.myBooking')}}">
                                    <i class="bi bi-receipt me-2"></i>My bookings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item tran-2" href="{{route('guest.logout')}}">
                                    <i class="bi bi-box-arrow-left me-2"></i>Sign out</a>
                            </div>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
