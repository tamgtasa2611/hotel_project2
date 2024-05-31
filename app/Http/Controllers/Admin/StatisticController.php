<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function revenueReport()
    {
        return view('admin.statistics.revenue');
    }

    public function roomReport()
    {
        $rooms = Room::getRoomsWithBooking();
        $availRooms = Room::where('status', '=', 0)->get();
        $unavailRooms = Room::where('status', '=', 1)->get();
        $emptyRooms = [];
        $activeRooms = [];

        $now = Carbon::createFromDate(Carbon::now());
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

        $bookedTypes = DB::table('booked_room_types')
            ->selectRaw('room_type_id, SUM(number_of_room) as sum_room')
            ->groupBy('room_type_id')
            ->get();

        $dataChart = [];

        foreach ($bookedTypes as $type) {
            $typeName = RoomType::find($type->room_type_id)->name ?? 'Không xác định';
            $dataChart[] = [$typeName, $type->sum_room, '#' . rand(100000, 999999)];
        }


        return view('admin.statistics.room', compact('availRooms', 'unavailRooms', 'emptyRooms', 'activeRooms', 'dataChart'));
    }

    public function serviceReport()
    {
        return view('admin.statistics.service');
    }

    public function guestReport()
    {
        $guestWithAccount = 0;
        $guestWithoutAccount = 0;
        $guestList = [];

        $bookings = Booking::all();
        foreach ($bookings as $booking) {
            //loai khach hang
            if ($booking->guest_id == null) {
                $guestWithoutAccount++;
            } else {
                $guestWithAccount++;
            }
        }

        //dat nhieu nhat
        $countBookingOfGuest = Guest::countBooking();

        //chi nhieu tien nhat
        $guestSpentMoney = Guest::countMoney();

        $guestTypes = [
            ['Có tài khoản', $guestWithAccount],
            ['Không có tài khoản', $guestWithoutAccount],
        ];



        return view('admin.statistics.guest', compact('guestTypes', 'countBookingOfGuest', 'guestSpentMoney'));
    }
}
