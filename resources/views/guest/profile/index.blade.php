<title>My profile - Skyrim Hotel</title>
<x-guestLayout>
    <section id="profile-section" class="m-nav">
        <div class="container position-relative">
            {{--alert create account--}}
            @if (session('success'))
                @include('partials.flashMsgSuccess')
            @endif
            <div class="row py-5 g-4 justify-content-center">
                {{--                MENU--}}
                <div class="col-10 col-lg-3">
                    <div class="p-4 border rounded shadow-sm bg-white">
                        @include('partials.guest.guestProfile')
                    </div>
                </div>
                {{--                MENU--}}

                {{--                CONTENT--}}
                <div class="col-10 col-lg-9">
                    <div class="p-4 border rounded bg-white shadow-sm">
                        <h4 class="text-primary fw-bold mb-4">Profile</h4>
                        <div>
                            abc
                        </div>
                    </div>
                </div>
                {{--                CONTENT--}}
            </div>
        </div>
    </section>
</x-guestLayout>
