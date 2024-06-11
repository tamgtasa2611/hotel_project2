<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        $currentId = Auth::guard('admin')->id();
        $admin = Admin::find($currentId);
        $bookings = Booking::where('status', '=', 0)->orderBy('date', 'DESC')->limit(3)->get();
        $rooms = Room::getRoomsWithBooking();

        $roomTypes = RoomType::all();
        $resources = [];

        foreach ($roomTypes as $roomType) {
            foreach ($roomType->rooms as $room) {
                $resources[] = json_encode([
                    'id' => $room->id,
                    'type' => $roomType->name,
                    'title' => $room->name,
                ]);
            }
        }

        $events = [];
        $bookedRooms = Booking::getAllBookedRooms();
        foreach ($bookedRooms as $bookedRoom) {
            $color = 'rgba(' . rand(30, 210) . ' , ' . rand(35, 215) . ', ' . rand(40, 220) . ', 0.9)';

            foreach ($events as $event) {
                if ($bookedRoom->booking_id == $event['id']) {
                    $color = $event['color'];
                }
            }

            $events[] = [
                'id' => $bookedRoom->booking_id,
                'resourceId' => $bookedRoom->room_id,
                'title' => $bookedRoom->guest_lname . ' ' . $bookedRoom->guest_fname . ' (#' . $bookedRoom->booking_id . ')',
                'start' => Carbon::createFromDate($bookedRoom->checkin)->setTime(14, 00),
                'end' => Carbon::createFromDate($bookedRoom->checkout)->setTime(12, 00),
                'color' => $color
            ];
        }

        $todayBooking = 0;
        $unconfirmedBooking = 0;
        $completedBooking = 0;
        $totalRevenue = 0;
        $checkBookings = Booking::all();
        foreach ($checkBookings as $booking) {
            $bookingDate = Carbon::createFromDate($booking->date);
            if ($bookingDate->isToday()) {
                $todayBooking++;
            }
            if ($booking->status == 0) {
                $unconfirmedBooking++;
            }
            if ($booking->status == 3) {
                $completedBooking++;
                $totalRevenue += $booking->total_price;
            }
        }

        $data = [
            'admin' => $admin,
            'bookings' => $bookings,
            'roomTypes' => $roomTypes,
            'resources' => $resources,
            'events' => $events,
            'todayBooking' => $todayBooking,
            'unconfirmedBooking' => $unconfirmedBooking,
            'completedBooking' => $completedBooking,
            'totalRevenue' => $totalRevenue,
        ];
        return view('admin.index', $data);
    }

    public function fastConfirm(Booking $booking)
    {
        //validate
        if ($booking->status == 1) {
            return Redirect::back()->with('failed', 'Đặt phòng này đã được duyệt rồi!');
        }

        if ($booking->status == 2) {
            return Redirect::back()->with('failed', 'Khách hàng đã nhận phòng rồi!');
        }

        if ($booking->status == 3) {
            return Redirect::back()->with('failed', 'Đặt phòng này đã hoàn thành rồi!');
        }

        if ($booking->status == 4) {
            return Redirect::back()->with('failed', 'Đặt phòng này đã bị hủy!');
        }

        $booking->update(['status' => 1]);
        return Redirect::back()->with('success', 'Duyệt đặt phòng thành công!');
    }
}
