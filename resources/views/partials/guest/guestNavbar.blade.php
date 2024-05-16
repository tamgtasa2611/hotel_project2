<nav class="navbar nav-underline navbar-expand-lg bg-primary tran-3 shadow fixed-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand d-block d-lg-none" href="/home">
            <div class="d-flex flex-column justify-content-center align-items-center">
                <div>SkyrimHotel</div>
                <div class="fs-7 text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarColor01">
            <ul class="navbar-nav col-lg-4">
                <li class="nav-item">
                    <a class="nav-link tran-3 {{request()->routeIs('guest.home') ? 'active' : ''}}"
                       href="{{route('guest.home')}}">Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tran-3 {{request()->is('rooms/*') ? 'active' : ''}}"
                       href="{{route('guest.rooms')}}">Phòng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tran-3 {{request()->routeIs('guest.contact') ? 'active' : ''}}"
                       href="{{route('guest.contact')}}">Liên hệ</a>
                </li>
                {{--                <li class=" nav-item">--}}
                {{--                    <a class="nav-link tran-3 {{request()->routeIs('guest.about') ? 'active' : ''}}"--}}
                {{--                       href="{{route('guest.about')}}">Về chúng tôi</a>--}}
                {{--                </li>--}}
            </ul>
            <a class="navbar-brand d-none d-lg-block flex-fill" href="{{route('guest.home')}}">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div>SkyrimHotel</div>
                    <div class="fs-7 text-warning-emphasis">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </a>
            <div class="d-lg-flex col-lg-4 justify-content-lg-end">
                @guest('guest')
                    <a class="btn btn-primary px-3 tran-3 me-3 shadow"
                       href="{{route('guest.login')}}">
                        Đăng nhập
                    </a>
                    <a class="btn btn-secondary px-3 tran-3 " href="{{route('guest.register')}}">
                        Đăng ký
                    </a>
                @endguest
                @auth('guest')
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link tran-3 tran-3 h-100"
                               href="{{route('guest.checkOut')}}" role="button">
                                <div class="d-flex align-items-center h-100 w-100">
                                    <i class="bi bi-bag"></i>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link tran-3 dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                @php
                                    $avatar = \Illuminate\Support\Facades\Auth::guard('guest')->user()->image;
                                @endphp
                                @if($avatar == null)
                                    <img src="{{asset('images/noavt.jpg')}}" alt="guest_avatar" width="24px"
                                         height="24px" class=" object-fit-cover rounded-circle">
                                @else
                                    <img src="{{asset('storage/admin/guests/' . $avatar)}}" alt="guest_avatar"
                                         width="24px"
                                         height="24px" class=" object-fit-cover rounded-circle">
                                @endif
                            </a>
                            <div class="dropdown-menu dropright" data-bs-theme="light">
                                <a class="dropdown-item tran-3" href="{{route('guest.profile')}}">
                                    <i class="bi bi-info-circle me-2"></i>Hồ sơ của tôi</a>
                                <a class="dropdown-item tran-3" href="{{route('guest.myBooking')}}">
                                    <i class="bi bi-receipt me-2"></i>Lịch sử đặt phòng</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item tran-3" href="{{route('guest.logout')}}">
                                    <i class="bi bi-box-arrow-left me-2"></i>Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
