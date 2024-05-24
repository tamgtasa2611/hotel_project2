<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function revenueReport()
    {
        return view('admin.statistics.index');
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

        foreach ($bookedTypes as $type) {
            $typeName = RoomType::find($type->room_type_id)->name ?? 'Không xác định';
            $dataChart[] = [$typeName, $type->sum_room, '#' . rand(100000, 999999)];
        }

//        print_r($dataChart);
//        dd($dataChart, $bookedTypes);

        return view('admin.statistics.index', compact('availRooms', 'unavailRooms', 'emptyRooms', 'activeRooms', 'dataChart'));

    }

    public function serviceReport()
    {
        return view('admin.statistics.index');

    }

    public function guestReport()
    {
        return view('admin.statistics.index');

    }
}
