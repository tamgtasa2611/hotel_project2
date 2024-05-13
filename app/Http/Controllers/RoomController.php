<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search = [
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guest_num' => $request->guest_num ?? 1,
        ];

        $checkInFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkin'])));
        $checkOutFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkout'])));

        //        check in < check out
        if ($search['checkin'] != null || $search['checkout'] != null) {
            if ($checkInFormat >= $checkOutFormat) {
                return back()->with('failed', 'Check Out date must be after Check In date!');
            }
        }

        $price = [
            'from_price' => $request->from_price ?? 0,
            'to_price' => $request->to_price ?? 5000000,
        ];

        if ($price['from_price'] > $price['to_price']) {
            $temp = $price['from_price'];
            $price['from_price'] = $price['to_price'];
            $price['to_price'] = $temp;
        }

        $rating = $request->rating ?? 0;

        $defaultType = [];
        foreach (RoomType::all()->toArray() as $item) {
            $defaultType[] = $item['id'];
        }
        $type = $request->roomType ?? $defaultType;

        $view = $request->view ?? "grid";
        $sort = $request->sort ?? 0;
//        get rooms
        $roomList = Room::getRooms($search, $price, $type, $sort);
        $roomListCopy = $roomList;
        //        get room types for filter
        $roomTypes = RoomType::all();

        //        get total rooms dua vao search/filter
        $countRoom = count($roomList->get());
        $roomsPaginated = $roomList->paginate(6)->withQueryString();

        $checkInFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkin'] ?? now())));
        $checkOutFormat = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime($search['checkout'] ?? Carbon::now()->addDay())));

        $data = [
            'search' => $search,
            'checkin' => $checkInFormat,
            'checkout' => $checkOutFormat,
            'rooms' => $roomsPaginated,
            'countRoom' => $countRoom,
            'price' => $price,
            'rating' => $rating,
            'type' => $type,
            'view' => $view,
            'sort' => $sort,
            'roomTypes' => $roomTypes
        ];
        return view('guest.rooms.index', $data);
    }

    public function show(Room $room)
    {
        $roomImages = RoomImage::where('room_id', '=', $room->id)->get();

        //calendar
        $events = [];
        $bookings = Booking::where('room_id', '=', $room->id)->get();
        foreach ($bookings as $booking) {
            $checkInDate = $booking->checkin_date;
            $checkOutDate = $booking->checkout_date;
            //days booked
            $dateIn = Carbon::createFromFormat('Y-m-d', $checkInDate);
            $dateOut = Carbon::createFromFormat('Y-m-d', $checkOutDate)->addDay();

            if ($booking->guest_id == Auth::guard('guest')->id()) {
                $events[] = [
                    'id' => $booking->id,
                    'title' => 'Your Booking',
                    'allDay' => true,
                    'start' => $dateIn,
                    'end' => $dateOut,
                    'color' => '#137ea7'
                ];
            } else {
                $events[] = [
                    'id' => $booking->id,
                    'title' => 'Booked',
                    'allDay' => true,
                    'start' => $dateIn,
                    'end' => $dateOut,
                    'color' => '#e63b31',
                ];
            }
        }

        $bookingsContainThisRoom = Booking::where('room_id', '=', $room->id)->pluck('id')->toArray();
        $roomRatings = Rating::whereIn('booking_id', $bookingsContainThisRoom)->get();
        $similarRooms = Room::where('room_type_id', '=', $room->roomType->id)
            ->where('id', '!=', $room->id)
            ->with('images')
            ->get();

        return view('guest.rooms.show', compact('room', 'roomImages', 'events', 'roomRatings', 'similarRooms'));
    }
}
