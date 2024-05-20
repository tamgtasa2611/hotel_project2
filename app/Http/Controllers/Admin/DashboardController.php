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
                $checkin = Carbon::createFromDate($room->checkin);
                $checkout = Carbon::createFromDate($room->checkout);

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

//        dd($resources);

        $event = [];
        $data = [
            'admin' => $admin,
            'bookings' => $bookings,
            'availRooms' => $availRooms,
            'emptyRooms' => $emptyRooms,
            'activeRooms' => $activeRooms,
            'unavailRooms' => $unavailRooms,
            'roomTypes' => $roomTypes,
            'resources' => $resources,
            'events' => $event
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
