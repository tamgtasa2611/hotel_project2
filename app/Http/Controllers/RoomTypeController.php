<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        //FORM
        $search = [
            'checkin' => $request->checkin ?? Carbon::now()->format('d-m-Y'),
            'checkout' => $request->checkout ?? Carbon::now()->addDay()->format('d-m-Y')
        ];

//        carbon
        $checkInFormat = Carbon::createFromDate($search['checkin'])->setTime(14, 00);
        $checkOutFormat = Carbon::createFromDate($search['checkout'])->setTime(12, 00);

        //        check in < check out
        if ($search['checkin'] != null || $search['checkout'] != null) {
            if ($checkInFormat >= $checkOutFormat) {
                return back()->with('failed', 'Ngày trả phòng phải sau ngày nhận phòng!');
            }
        }

        //sap xep
        $sort = $request->sort ?? 0;

        //check and get room
        $roomTypes = RoomType::checkAndGetRoomTypes($sort);
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

        $data = [
            'search' => $search,
            'checkin' => $checkInFormat,
            'checkout' => $checkOutFormat,
            'sort' => $sort,
            'roomTypes' => $roomTypes,
            'rooms' => $rooms
        ];
        return view('guest.roomTypes.index', $data);
    }

    public function show($id)
    {
        $roomType = RoomType::find($id);
        $roomImages = RoomTypeImage::where('room_type_id', '=', $id)->get();
        $roomAmenities = DB::table('room_type_amenities')
            ->join('amenities', 'room_type_amenities.amenity_id', '=', 'amenities.id')
            ->where('room_type_id', '=', $id)
            ->get();
        $roomRatings = Rating::where('room_type_id', '=', $id)->with('guest')->paginate(3)->withQueryString();

        return view('guest.roomTypes.show', compact('roomType', 'roomImages', 'roomAmenities', 'roomRatings'));
    }
}
