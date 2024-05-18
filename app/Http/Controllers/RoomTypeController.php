<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = [
            'checkin' => $request->checkin ?? Carbon::now()->format('d-m-Y'),
            'checkout' => $request->checkout ?? Carbon::now()->addDay()->format('d-m-Y')
        ];

        $checkInFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkin'])));
        $checkOutFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkout'])));

        //        check in < check out
        if ($search['checkin'] != null || $search['checkout'] != null) {
            if ($checkInFormat >= $checkOutFormat) {
                return back()->with('failed', 'Ngày trả phòng phải sau ngày nhận phòng!');
            }
        }

        $sort = $request->sort ?? 0;

        //check and get room
        $roomTypes = RoomType::checkAndGetRoomTypes();
        $availableRoomList = [];
        foreach ($roomTypes as $roomType) {
            foreach ($roomType->rooms as $room) {
                if ($room->status == 0) {
                    $availableRoomList = Arr::add($availableRoomList, $roomType->id, $room);
                }
            }
        }

        $checkInFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkin'] ?? now())));
        $checkOutFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkout'] ?? Carbon::now()->addDay())));

        $data = [
            'search' => $search,
            'checkin' => $checkInFormat,
            'checkout' => $checkOutFormat,
            'sort' => $sort,
            'roomTypes' => $roomTypes,
            'rooms' => $availableRoomList
        ];
        return view('guest.roomTypes.index', $data);
    }

    public function show(RoomType $roomType)
    {
        $roomImages = RoomTypeImage::where('room_type_id', '=', $roomType->id)->get();

        return view('guest.roomTypes.show', compact('roomType', 'roomImages'));
    }
}
