<title>Thank You - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <div class="row h-auto py-5 g-5">
                <div class="col-12">
                    <div class="shadow-lg   bg-dark px-4 py-3">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="bg-dark shadow-sm  p-3">
                                <i class="bi bi-house-check display-6 text-primary"></i>
                            </div>
                            <div class="bg-dark shadow-sm   p-3">
                                <i class="bi bi-credit-card display-6 text-primary"></i>
                            </div>
                            <div class="bg-dark shadow-sm   p-3">
                                <i class="bi bi-check display-6 text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar"
                                style="width: 100%;"
                                aria-valuenow="100"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 load-hidden fade-in">
                    <div class="p-4 bg-dark shadow-lg   h-100 d-flex flex-column">
                        <div>
                            {{--                    success icon--}}
                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <i class="bi bi-check-circle-fill text-success display-1"></i>
                            </div>
                            {{--                    heading--}}
                            <div class="d-flex flex-column justify-content-center align-items-center mb-4">
                                <div>
                                    <h4 class="fw-bold">Booked successfully!</h4>
                                </div>
                                <div class="text-center">
                                    <p class="m-0">We hope you will enjoy your stay with us</p>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-outline-primary "
                                   href="{{route('guest.myBooking')}}">VIEW MY BOOKING</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guestLayout>
