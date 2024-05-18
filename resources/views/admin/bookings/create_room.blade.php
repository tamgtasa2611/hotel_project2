<title>Thêm đặt phòng - Skyrim Hotel</title>
<x-adminLayout>
    <div class="p-4 bg-white  shadow-sm border rounded-3  mb-4">
        <div class="text-primary d-flex justify-content-between align-items-center">
            <h4 class="fw-bold m-0">Quản lý đặt phòng</h4>
            <a class="d-block d-lg-none"
               data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
               aria-controls="offcanvasExample">
                <i class="bi bi-list fs-4"></i>
            </a>
        </div>
    </div>
    {{--------------- MAIN --------------}}
    <div class="bg-white shadow-sm border rounded-3 overflow-hidden">
        <div
            class="p-4 d-flex justify-content-between">
            <div class="text-primary">
                <i class="bi bi-plus-circle me-2"></i>Thêm đặt phòng
            </div>
            <div class="d-flex">
                <i class="bi bi-calendar-check text-primary me-3"></i>
                <i class="bi bi-door-closed me-3"></i>
                <i class="bi bi-person"></i>
            </div>
        </div>
        <hr class="m-0">
        {{-- FORM  --}}
        <form method="post" action="{{ route('admin.bookings.storeRoom') }}" enctype="multipart/form-data"
              class="m-0">
            @csrf
            @method('POST')
            <div class="row overflow-hidden">
                <!--  input -->
                <div class="col-12">
                    <div class="p-4 d-flex align-items-center justify-content-between">
                        Check in: {{$date['checkin']}}
                    </div>
                </div>

                <div class="col-12">
                    <div class="p-4 pt-0 d-flex align-items-center justify-content-between">
                        Check out: {{$date['checkout']}}
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="p-4 pt-0">
                    <div id="roomTypes" class="overflow-hidden">
                        <div class="">
                            <table class="table table-bordered">
                                <thead>
                                <th class="text-center">Chọn</th>
                                <th class="text-center">Loại phòng</th>
                                <th class="text-center align-middle">Giá (1 đêm)</th>
                                <th class="text-center align-middle">Sức chứa</th>
                                <th class="text-center align-middle">Số phòng khả dụng</th>
                                </thead>
                                <tbody class="tbody">
                                @foreach($roomTypes as $roomType)
                                    @if($roomType->rooms_count != 0)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <input type="checkbox" name="roomType[]" value="{{$roomType->id}}"
                                                       required>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{$roomType->name}}
                                            </td>
                                            <td class="text-center align-middle">
                                            <span
                                                class="text-success">{{\App\Helpers\AppHelper::vnd_format($roomType->price)}}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                {{$roomType->max_capacity}}
                                            </td>
                                            <td class="text-center align-middle">
                                                {{($roomType->rooms_count)}}
                                            </td>
                                        </tr>
                                    @else
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="m-0">
            {{--            btn--}}
            <div class="d-flex justify-content-between justify-content-md-start p-4">
                <a href="{{ route('admin.bookings.create') }}"
                   class="btn btn-secondary px-3 tran-3 me-3">
                    Quay lại
                </a>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary px-3 tran-3">
                    Tiếp tục
                </button>
            </div>
        </form>
    </div>

    <script>
        $(function () {
            var requiredCheckboxes = $('.tbody :checkbox[required]');
            requiredCheckboxes.change(function () {
                if (requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                } else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });
        });
    </script>
</x-adminLayout>
