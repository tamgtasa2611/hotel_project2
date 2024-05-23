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

        if ($newStatus < $currentStatus) {
            return Redirect::back()->with('failed', 'Lỗi! Trạng thái đặt phòng đã bị thay đổi rồi...');
        } else if ($newStatus > $currentStatus) {
            if ($newStatus != $currentStatus) {
                $booking->update([
                    'status' => $request->status
                ]);
            }
            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a booking');
            return Redirect::back()->with('success', 'Cập nhật trạng thái đặt phòng thành công');
        } else {
            $roomIds = $request->room_id;
            if ($roomIds != null) {
                foreach ($roomIds as $roomId) {
                    DB::table('booked_rooms')->insert([
                        'room_id' => $roomId,
                        'booking_id' => $booking->id,
                        'status' => 0
                    ]);
                }
            }
            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a booking');
            return Redirect::back()->with('success', 'Sắp xếp phòng thành công');
        }
    }

    public function cancelBooking(Booking $booking)
    {
        if ($booking->status >= 2) {
            return Redirect::back()->with('failed', 'Xảy ra lỗi!');
        }

        $booking->update(['status' => 4]);
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'cancel a booking');
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

    public function roomArrangement()
    {

    }
}
