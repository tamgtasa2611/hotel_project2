<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::all();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function create()
    {
        if (session()->get('dates')) {
            session()->forget('dates');
        }
        return view('admin.bookings.create');
    }

    public function storeDate(Request $request)
    {
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        session()->put('dates', ['checkin' => $checkin, 'checkout' => $checkout]);
        return Redirect::route('admin.bookings.createChooseRoom');
    }

    public function createChooseRoom()
    {
        $date = session()->get('dates');
        if ($date == null) {
            return Redirect::back()->with('failed', 'Vui lòng chọn ngày nhận phòng và ngày trả phòng!');
        }
        $roomTypes = RoomType::with('rooms')->withCount('rooms')->get();

        return view('admin.bookings.create_room', compact('date', 'roomTypes'));
    }

    public function storeRoom(Request $request)
    {
        dd($request->all());
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        session()->put('dates', ['checkin' => $checkin, 'checkout' => $checkout]);
        return Redirect::route('admin.bookings.createChooseRoom');
    }

    public function createChooseGuest()
    {
        $guests = Guest::all();

        return view('admin.bookings.create_guest', compact('guests'));
    }

    public function edit(Booking $booking)
    {
        $checkInFormat = Carbon::createFromDate($booking->checkin)->setTime(14, 00);
        $checkOutFormat = Carbon::createFromDate($booking->checkout)->setTime(12, 00);
        $roomTypesImages = RoomTypeImage::all();
        //lay loai phong cua booking
        $bookedRoomTypes = Booking::getRoomTypes($booking->id);
        //get room with booking info
        $bookedRooms = Room::getRoomsInBooking();
        //get room KHA DUNG
        $rooms = Room::where('status', '=', 0)->get();
        $unavailableRoomList = [];

        foreach ($bookedRooms as $bookedRoom) {
            $dates = [
                $bookedRoom->room_id,
                Carbon::createFromDate($bookedRoom->checkin)->setTime(14, 00),
                Carbon::createFromDate($bookedRoom->checkout)->setTime(12, 00)
            ];

            if ($checkInFormat->between($dates[1], $dates[2]) || $checkOutFormat->between($dates[1], $dates[2])) {
                if (!isset($unavailableRoomList[$bookedRoom->room_id])) {
                    //phong khong kha dung
                    $unavailableRoomList[] = $bookedRoom->room_id;
                }
            }
        }


        //filter xoa cac phong ko kha dung
        $rooms = $rooms->filter(function ($room, $key) use ($unavailableRoomList) {
            if (!in_array($room->id, $unavailableRoomList)) {
                return $room;
            }
        })->all();

        $payments = Payment::where('booking_id', '=', $booking->id)->get();

        $currentBookedRooms = Booking::getBookedRoomsByBookingId($booking->id);
        $grouped = $currentBookedRooms->groupBy(function ($item, $key) {
            return $item->room_type_id;
        });

        $groupCount = $grouped->map(function ($item, $key) {
            return collect($item)->count();
        });
        //        dd($currentBookedRooms, $groupCount);
        $data = [
            'booking' => $booking,
            'images' => $roomTypesImages,
            'bookedRoomTypes' => $bookedRoomTypes,
            'rooms' => $rooms,
            'currentBookedRooms' => $currentBookedRooms,
            'groupCount' => $groupCount,
            'payments' => $payments,
        ];

        return view('admin.bookings.edit', $data);
    }

    public function update(Request $request, Booking $booking)
    {
        $currentStatus = $booking->status;
        $newStatus = $request->status;

        if ($currentStatus == 4) {
            return Redirect::back()->with('failed', 'Lỗi! Đặt phòng đã bị hủy rồi...');
        }

        if ($newStatus != $currentStatus) {
            $booking->update([
                'status' => $request->status
            ]);
        } else {
            return Redirect::back()->with('failed', 'Trạng thái đặt phòng đã bị thay đổi rồi...');
        }
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật trạng thái 1 đặt phòng');
        return Redirect::back()->with('success', 'Cập nhật trạng thái đặt phòng thành công');
    }

    public function arrangeRoom(Request $request, Booking $booking)
    {
        $roomIds = $request->room_id;
        if ($roomIds != null) {
            foreach ($roomIds as $roomId) {
                $current = DB::table('booked_rooms')
                    ->where('booking_id', '=', $booking->id)
                    ->get()->pluck('room_id')->toArray();

                if (in_array($roomId, $current)) {
                    $roomName = Room::find($roomId)->name;
                    return Redirect::back()->with('failed', 'Phòng ' . $roomName . ' đã được sắp xếp cho đặt phòng này rồi!');
                }

                $checkin = Carbon::createFromDate($booking->checkin)->setTime(14, 00);
                $checkout = Carbon::createFromDate($booking->checkout)->setTime(12, 00);

                //2 nguoi cung them vao 1 dat phong


                //2 nguoi them cung 1 phong vao 2 dat phong khac nhau
                $roomInOtherBookings =
                    DB::table('booked_rooms')
                    ->where('room_id', '=', $roomId)
                    ->join('bookings', 'bookings.id', '=', 'booked_rooms.booking_id')
                    ->get();

                foreach ($roomInOtherBookings as $bookedRoom) {
                    $dateIn =
                        Carbon::createFromDate($bookedRoom->checkin)->setTime(14, 00);
                    $dateOut = Carbon::createFromDate($bookedRoom->checkout)->setTime(12, 00);
                    $roomName = Room::find($roomId)->name;
                    if ($checkin->between($dateIn, $dateOut) || $checkout->between($dateIn, $dateOut)) {
                        return Redirect::back()->with('failed', 'Phòng ' . $roomName . ' đã được xếp cho đặt phòng khác trong khoảng thời gian này!');
                    }
                }


                //insert
                DB::table('booked_rooms')->insert([
                    'room_id' => $roomId,
                    'booking_id' => $booking->id
                ]);
            }
            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật trạng thái 1 đặt phòng');
            return Redirect::back()->with('success', 'Sắp xếp phòng thành công!');
        }
        return Redirect::back()->with('failed', 'Bạn chưa chọn phòng nào cả!');
    }

    public function deleteRoom(Booking $booking, $id)
    {
        $roomToDelete = Room::find($id);
        if ($roomToDelete == null) {
            return Redirect::back()->with('failed', 'Xảy ra lỗi!');
        }

        DB::table('booked_rooms')
            ->where('room_id', '=', $roomToDelete->id)
            ->where('booking_id', '=', $booking->id)
            ->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 phòng khỏi đặt phòng #' . $booking->id);
        return Redirect::back()->with('success', 'Xóa phòng khỏi đặt phòng thành công!');
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->status == 2) {
            return Redirect::back()->with('failed', 'Không thể hủy đặt phòng khi khách đã nhận phòng!');
        }
        if ($booking->status == 3) {
            return Redirect::back()->with('failed', 'Không thể hủy đặt phòng đã hoàn thành!');
        }
        if ($booking->status == 4) {
            return Redirect::back()->with('failed', 'Đặt phòng đã bị hủy rồi!');
        }

        $booking->update(['status' => 4]);
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã hủy 1 đặt phòng');
        return Redirect::back()->with('success', 'Hủy đặt phòng thành công');
    }

    // PDF
    public function downloadPDF()
    {
        $bookings = Booking::all();

        $pdf = PDF::loadView('admin.bookings.pdf', array('roomTypes' => $bookings))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
