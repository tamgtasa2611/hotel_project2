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
        $bookings = Booking::where('status', '=', 0)->limit(3)->get();
        $availRooms = Room::where('status', '=', 0)->get();
        $rooms = Room::getRoomsWithBooking();
        $emptyRooms = [];
        $activeRooms = [];
        $unavailRooms = Room::where('status', '=', 1)->get();

        $now = Carbon::createFromDate(Carbon::now())->startOfDay();
        foreach ($rooms as $room) {
            if ($room->checkin != null && $room->checkout != null) {
                $checkin = Carbon::createFromDate($room->checkin)->setTime(14, 00);
                $checkout = Carbon::createFromDate($room->checkout)->setTime(12, 00);

                //neu ngay hom nay phong do thuoc ve 1 booking nao do
                if ($now->between($checkin, $checkout)) {
//                    $rooms->forget($rooms->search($room));
                    $activeRooms[] = $room;
                } else {
                    $emptyRooms[] = $room;
                }
            } else {
                $emptyRooms[] = $room;
            }
        }

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
            $color = 'rgba(' . rand(40, 210) . ' , ' . rand(40, 210) . ', ' . rand(40, 210) . ', 0.9)';

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

        $data = [
            'admin' => $admin,
            'bookings' => $bookings,
            'availRooms' => $availRooms,
            'emptyRooms' => $emptyRooms,
            'activeRooms' => $activeRooms,
            'unavailRooms' => $unavailRooms,
            'roomTypes' => $roomTypes,
            'resources' => $resources,
            'events' => $events
        ];
        return view('admin.index', $data);
    }

    public function fastConfirm(Booking $booking)
    {
        //validate
        if ($booking->status != 0) {
            return Redirect::back()->with('failed', 'Đặt phòng này đã được duyệt rồi!');
        }

        $booking->update(['status' => 1]);
        return Redirect::back()->with('success', 'Duyệt đặt phòng thành công!');
    }
}
