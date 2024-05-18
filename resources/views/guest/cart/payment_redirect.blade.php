<title>Thanh toán - Skyrim Hotel</title>
<x-guestLayout>
    <section id="" class="m-nav">
        <div class="container">
            <div class="row g-4 py-4">
                <div class="col-12">
                    <div class="">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-bag text-white"></i>
                            </div>

                            <div class="p-3 bg-primary rounded-circle shadow-sm">
                                <i class="bi bi-credit-card text-white"></i>
                            </div>
                            <div class="p-3 border rounded-circle shadow-sm">
                                <i class="bi bi-check text-primary"></i>
                            </div>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 50%;"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 load-hidden fade-in">
                    <div class="p-4 bg-white border shadow-sm rounded-3">
                        <div class="my-5 text-center">
                            <h4 class="py-5 text-primary fw-bold">Đang chuyển hướng tới VNPAY...</h4>
                        </div>
                        <form class="m-0 p-0" id="vnpay_form" method="post" action="{{route('guest.vnpay')}}">
                            @csrf
                            @method('POST')
                            <input type="hidden" hidden name="redirect">
                            <div class="text-center">
                                Vui lòng nhấn vào
                                <a class="text-decoration-underline" role="button" href="#!"
                                   onclick="$('#vnpay_form').submit()">đây</a>
                                nếu bạn không được tự động chuyển hướng
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        window.onload = function () {
            setTimeout(function () {
                $('#vnpay_form').submit();
            }, 100);
        };
    </script>
</x-guestLayout>
