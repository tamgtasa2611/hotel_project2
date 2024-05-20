<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
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
        //lay loai phong cua booking
        $bookedRoomTypes = Booking::getRoomTypes($booking->id);
        //lay cac phong thuoc loai phong
        $rooms = Room::where('status', '=', 0)
            ->whereIn('room_type_id', $bookedRoomTypes->pluck('room_type_id')->toArray())
            ->get();
        //lay cac phong da duoc sap xep o booking
        $bookedRooms = Booking::getBookedRooms($rooms->pluck('id')->toArray());

        if (count($bookedRooms) != 0) {
            $thisCheckin = Carbon::createFromDate($booking->checkin);
            $thisCheckout = Carbon::createFromDate($booking->checkout);

            foreach ($bookedRooms as $bookedRoom) {
                //check neu phong nay da co trong booking khac cung ngay checkin checkout
                $checkinCheck = Carbon::createFromDate($bookedRoom->checkin);
                $checkoutCheck = Carbon::createFromDate($bookedRoom->checkout);

                if ($thisCheckin->between($checkinCheck, $checkoutCheck)
                    or $thisCheckout->between($checkinCheck, $checkoutCheck)) {
                    if ($booking->id != $bookedRoom->booking_id) {
                        $bookedRooms->forget($bookedRooms->search($bookedRoom));
                    }
                }
            }
        }

        $data = [
            'booking' => $booking,
            'bookedRoomTypes' => $bookedRoomTypes,
            'rooms' => $rooms,
            'bookedRooms' => $bookedRooms
        ];

        return view('admin.bookings.edit', $data);
    }

    public function update(Request $request, Booking $booking)
    {
//        $validated = $request->validated();

        if (true) {
            $booking->update([
                'status' => $request->status
            ]);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a booking');
            return to_route('admin.bookings')->with('success', 'Booking status updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
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
