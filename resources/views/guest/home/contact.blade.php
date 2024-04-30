<title>Contact - Skyrim Hotel</title>
<x-guestLayout>
    <section id="login-section" class="m-nav">
        {{--        breadcrumb--}}
        <div class="container mh-screen">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center hero-section">
                <form class="bg-white p-5 shadow-lg border rounded-4 col-12 col-md-8 col-lg-6 col-xl-4
                load-hidden fade-in">
                    {{--                    heading--}}
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <h6 class="display-6 text-primary fw-bold">Contact Us</h6>
                    </div>

                    <!-- Name input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="text" id="name" class="form-control" placeholder="Your name"/>
                    </div>

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <input type="email" id="email" class="form-control" placeholder="Email address"/>
                    </div>

                    <!-- Message input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                        <textarea class="form-control" id="message" rows="4" placeholder="Message"></textarea>
                    </div>

                    <!-- Submit button -->
                    <button type="button"
                            class="btn btn-primary rounded-pill w-100">Send
                    </button>

                </form>
            </div>
        </div>
    </section>
</x-guestLayout>
