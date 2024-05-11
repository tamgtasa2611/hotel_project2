<title>Contact - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        {{--        breadcrumb--}}
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center hero-section">
                <form class="bg-white p-5 shadow-lg border rounded-4 col-12 col-md-8 col-lg-6 col-xl-4
                load-hidden fade-in" method="post" action="{{route('guest.sendContact')}}">
                    @csrf
                    @method('POST')
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Contact Us</h6>
                    </div>

                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="name" name="name" class="form-control" required placeholder="Your name"/>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" name="email" class="form-control" required
                               placeholder="Email address"/>
                    </div>

                    <!-- Message input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <textarea class="form-control" id="message" name="message" rows="4"
                                  required placeholder="Message"></textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="submit"
                            class="btn btn-primary rounded-pill w-100 spinner-btn">Send
                    </button>

                </form>
                <div class="d-flex d-none justify-content-center align-items-center fixed-top w-100 tran-2"
                     id="spinner"
                     style="z-index: 999; height: 100dvh; background-color: rgba(0,0,0,0.2)">
                    <div class="bg-light rounded-4 border p-4 d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary tran-2" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="text-primary ms-3">
                            Sending email...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $(".spinner-btn").click(function () {
                $("#spinner").removeClass("d-none");
            });
        });
    </script>
</x-guestLayout>
