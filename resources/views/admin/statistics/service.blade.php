<title>Thống kê dịch vụ - Skyrim Hotel</title>
<script src="{{ asset('plugins/calendar/index.global.min.js') }}"></script>

<x-adminLayout>
    <div class="p-4 bg-white shadow-sm border rounded-3 mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Thống kê dịch vụ </h4>
            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-primary-subtle text-primary-emphasis px-4 py-3">Phòng khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-primary-emphasis">

                    <i class="bi bi-house-check"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-success-subtle text-success-emphasis px-4 py-3">Phòng đang còn trống</div>
                <div class="fs-4 text-center p-4 fw-bold text-success-emphasis">

                    <i class="bi bi-house-up"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-warning-subtle text-warning-emphasis px-4 py-3">Phòng đang sử dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-warning-emphasis">

                    <i class="bi bi-house-lock"></i>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="bg-white border shadow-sm rounded-3 overflow-hidden">
                <div class="fw-bold bg-danger-subtle text-danger-emphasis px-4 py-3">Phòng không khả dụng</div>
                <div class="fs-4 text-center p-4 fw-bold text-danger-emphasis">

                    <i class="bi bi-house-dash"></i>
                </div>
            </div>
        </div>
    </div>
</x-adminLayout>
