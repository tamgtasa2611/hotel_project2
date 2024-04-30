<title>Checkout - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <div class="row h-auto py-5 g-4">
                <div class="col-12">
                    <div class="shadow-sm rounded bg-white px-4 py-3">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="bg-light shadow-sm rounded-circle p-3">
                                <i class="bi bi-house-check display-6"></i>
                            </div>
                            <div class="bg-light shadow-sm  rounded-circle p-3">
                                <i class="bi bi-credit-card display-6"></i>
                            </div>
                            <div class="bg-light shadow-sm  rounded-circle p-3">
                                <i class="bi bi-check display-6"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar"
                                style="width: 50%;"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 load-hidden fade-in">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <div class="d-flex justify-content-between mb-3">
                            <h4 class="m-0 text-primary fw-bold">Booking Summary</h4>
                            <a href="{{route('guest.rooms.show', $data['room_id'])}}"
                               class="text-decoration-none"><i
                                    class="bi bi-arrow-left me-2"></i>Go back</a>
                        </div>
                        <div>
                            <div class="fw-bold">
                                Room Information<a href="{{route('guest.rooms')}}"><i
                                        class="bi bi-pencil-square ms-2"></i></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Room
                                </div>
                                <div class="">
                                    {{$room->name}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Room Type
                                </div>
                                <div class="">
                                    {{$room->roomType->name}}
                                </div>
                            </div>
                            <div class="fw-bold">
                                Guest Information<a href="{{route('guest.editAccount')}}"><i
                                        class="bi bi-pencil-square ms-2"></i></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Full Name
                                </div>
                                <div class="">
                                    {{$guest->first_name . ' ' . $guest->last_name}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Email Address
                                </div>
                                <div class="">
                                    {{$guest->email}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Phone Number
                                </div>
                                <div class="">
                                    {{$guest->phone_number}}
                                </div>
                            </div>
                            <div class="fw-bold">
                                Booking Information<a href="{{route('guest.rooms.show', $data['room_id'])}}"><i
                                        class="bi bi-pencil-square ms-2"></i></a>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Number of Guests
                                </div>
                                <div class="">
                                    {{$data['guest_num']}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Check In Date
                                </div>
                                <div class="">
                                    {{$data['checkin_date']}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Check Out Date
                                </div>
                                <div class="">
                                    {{$data['checkout_date']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 load-hidden fade-in">
                    <div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column">
                        <div class="flex-fill">
                            <div class="d-flex justify-content-between">
                                <div>
                                    Total rooms cost (tax incl)
                                </div>
                                <div class="">
                                    ${{$data['total_price']}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Convenience fees
                                </div>
                                <div class="">
                                    FREE
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div>
                                    Reservation fees
                                </div>
                                <div class="">
                                    FREE
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="fs-5 fw-bold">
                                    Final Total
                                </div>
                                <div class="text-success fs-5 fw-bold">
                                    ${{$data['total_price']}}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="my-2 text-center">
                                Select a payment method:
                            </div>
                            <a class="btn btn-secondary btn-sm rounded-pill w-100 spinner-btn"
                               href="{{route('guest.checkOut.payInPerson')}}">Pay in person</a>
                            <div class="my-2 text-center">
                                or be confirmed immediately with
                            </div>
                            <a class="btn btn-primary btn-sm rounded-pill w-100 spinner-btn"
                               href="{{route('guest.checkOut.banking')}}">Banking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="d-flex d-none justify-content-center align-items-center fixed-top w-100 tran-2"
         id="spinner"
         style="z-index: 999; height: 100dvh; background-color: rgba(0,0,0,0.2)">
        <div class="spinner-border text-primary tran-2" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="text-primary ms-2">
            Processing...
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(".spinner-btn").click(function () {
                $("#spinner").removeClass("d-none");
            });
        });
    </script>
</x-guestLayout>
