<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class BookingController extends Controller
{
    public function bookRoom(Request $request)
    {
        $validated = $request->validate([
            'checkin' => 'required|date|before:checkout|after:yesterday',
            'checkout' => 'required|date|after:checkin',
            'guest_num' => 'required|integer',
        ]);

        if ($validated) {
            $room = Room::find($request->room_id);
            $created_date = date('Y-m-d H:i:s');
            $guest_id = Auth::guard('guest')->id();
            $admin_id = Admin::first()->id;
//            format lai tu d-m-y thanh y-m-d
            $checkInDate = date('Y-m-d', strtotime($request->checkin));
            $checkOutDate = date('Y-m-d', strtotime($request->checkout));

            //days booked
            $dateIn = Carbon::createFromFormat('Y-m-d', $checkInDate);
            $dateOut = Carbon::createFromFormat('Y-m-d', $checkOutDate);
            $datePeriod = CarbonPeriod::between($dateIn, $dateOut);
            $daysBooked = $dateIn->diffInDays($dateOut);

//            price
            $basePrice = $room->roomType->base_price;
            $totalPrice = $basePrice * $daysBooked;

            //check trung nhau
            $bookings = Booking::where('room_id', '=', $room->id)->get();
            foreach ($bookings as $booking) {
                $dateInCheck = Carbon::createFromFormat('Y-m-d', $booking->checkin_date);
                $dateOutCheck = Carbon::createFromFormat('Y-m-d', $booking->checkout_date);
                $datePeriodCheck = CarbonPeriod::between($dateInCheck, $dateOutCheck);

                //check
                foreach ($datePeriod as $date) {
                    if ($date->between($dateInCheck, $dateOutCheck)) {
                        return back()->with('failed', 'This room has already been booked for this period!');
                    }
                }
            }

            $data = [
                'created_date' => $created_date,
                'status' => 0,
                'guest_id' => $guest_id,
                'room_id' => $room->id,
                'admin_id' => $admin_id,
                'checkin_date' => $checkInDate,
                'checkout_date' => $checkOutDate,
                'guest_num' => $request->guest_num,
                'total_price' => $totalPrice,
            ];

//            Booking::create($data);
//            return back()->with('success', 'Booked successfully!');
            session()->put('bookingData', $data);
            return Redirect::route('guest.checkOut');
        } else {
            return back()->with('failed', 'Something went wrong...');
        }
    }

    public function checkOut()
    {
        if (session()->has('bookingData')) {
            $data = session('bookingData');
            $room = Room::with('roomType')->find($data['room_id']);
            $guest = Auth::guard('guest')->user();

            return view('guest.checkout.index', [
                'data' => $data,
                'room' => $room,
                'guest' => $guest
            ]);
        } else {
            session()->forget('bookingData');
            return view('guest.checkout.empty');
        }
    }

    public function payInPerson()
    {
        $data = session('bookingData');
        if ($data != []) {
            Booking::create($data);

            $paymentData = [
                'date' => date('Y-m-d H:i:s'),
                'amount' => $data['total_price'],
                'note' => 'Pay in person',
                'status' => 0,
                'guest_id' => $data['guest_id'],
                'booking_id' => Booking::where('guest_id', '=', $data['guest_id'])->max('id'),
                'method_id' => 1,
            ];
            Payment::create($paymentData);

            session()->forget('bookingData');
            return Redirect::route('guest.checkOut.success')->with('success', 'Booked successfully!');
        } else {
            session()->forget('bookingData');
//            return Redirect::route('guest.rooms')->with('failed', 'Something went wrong, please try again later...');
            return view('guest.checkout.empty');
        }
    }

    public function banking()
    {
        $data = session('bookingData');
        if ($data != []) {
            $data['status'] = 1;
//            Booking::create($data);
            $paymentData = [
                'date' => $data['created_date'],
                'amount' => $data['total_price'],
                'note' => 'Pay by banking',
                'status' => 1,
                'guest_id' => $data['guest_id'],
//                'booking_id' => a,
                'method_id' => 2,
            ];
            dd($paymentData);
            session()->forget('bookingData');
            return Redirect::route('guest.checkOut.success')->with('success', 'Booked successfully!');
        } else {
            session()->forget('bookingData');
//            return Redirect::route('guest.rooms')->with('failed', 'Something went wrong, please try again later...');
            return view('guest.checkout.empty');
        }
    }

    public function success()
    {
        return view('guest.checkout.checkOutSuccess');
    }
}
