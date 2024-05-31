<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function revenueReport()
    {
        $bookHours = [
            ['0:00 - 6:00', 0],
            ['6:00 - 8:00', 0],
            ['8:00 - 10:00', 0],
            ['10:00 - 12:00', 0],
            ['12:00 - 14:00', 0],
            ['14:00 - 16:00', 0],
            ['16:00 - 18:00', 0],
            ['18:00 - 20:00', 0],
            ['20:00 - 22:00', 0],
            ['22:00 - 0:00', 0],
        ];

        $bookings = Booking::all();
        foreach ($bookings as $booking) {
            $time = Carbon::createFromTimeString(
                Carbon::createFromDate($booking->date)->format('H:i:s')
            );

            if ($time->between(Carbon::createFromTimeString('00:00:00'), Carbon::createFromTimeString('05:59:59'))) {
                $bookHours[0][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('06:00:00'), Carbon::createFromTimeString('07:59:59'))) {
                $bookHours[1][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('08:00:00'), Carbon::createFromTimeString('09:59:59'))) {
                $bookHours[2][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('10:00:00'), Carbon::createFromTimeString('11:59:59'))) {
                $bookHours[3][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('12:00:00'), Carbon::createFromTimeString('13:59:59'))) {
                $bookHours[4][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('14:00:00'), Carbon::createFromTimeString('15:59:59'))) {
                $bookHours[5][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('16:00:00'), Carbon::createFromTimeString('17:59:59'))) {
                $bookHours[6][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('18:00:00'), Carbon::createFromTimeString('19:59:59'))) {
                $bookHours[7][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('20:00:00'), Carbon::createFromTimeString('21:59:59'))) {
                $bookHours[8][1]++;
            }
            if ($time->between(Carbon::createFromTimeString('22:00:00'), Carbon::createFromTimeString('23:59:59'))) {
                $bookHours[9][1]++;
            }
        }

        return view('admin.statistics.revenue', compact('bookHours'));
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
