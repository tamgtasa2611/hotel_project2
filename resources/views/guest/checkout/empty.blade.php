<title>Checkout - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <div class="row h-auto py-5 g-4">
                <div class="col-12">
                    <div class="shadow-sm   bg-white px-4 py-3">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="bg-white shadow-sm  p-3">
                                <i class="bi bi-house-check display-6"></i>
                            </div>
                            <div class="bg-white shadow-sm   p-3">
                                <i class="bi bi-credit-card display-6"></i>
                            </div>
                            <div class="bg-white shadow-sm   p-3">
                                <i class="bi bi-check display-6"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar bg-primary"
                                role="progressbar"
                                style="width: 0;"
                                aria-valuenow="0"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 load-hidden fade-in">
                    <div class="p-4 bg-white shadow-sm   h-100 d-flex flex-column">
                        <div class="my-3">
                            {{--                    heading--}}
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <div class="text-center">
                                    <p>You haven't chosen a room yet...</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-primary "
                                   href="{{route('guest.rooms')}}">VIEW ROOMS<i class="ms-2 bi bi-search"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guestLayout>
