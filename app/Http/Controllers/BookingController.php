<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingInformation;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function booking()
    {
        $paymentData = Session::get('payment_data');
        $cart = Session::get('cart');
        $start = Session::get('start');
        $end = Session::get('end');
        $totalPrice = Session::get('totalPrice');

        $bookingData = [
            'date' => Carbon::now(),
            'checkin' => Carbon::createFromDate($start)->format('Y-m-d'),
            'checkout' => Carbon::createFromDate($end)->format('Y-m-d'),
            'status' => 1,
            'total_price' => $totalPrice,
            'note' => $paymentData['note'],
            'guest_lname' => $paymentData['guest_lname'],
            'guest_fname' => $paymentData['guest_fname'],
            'guest_email' => $paymentData['guest_email'],
            'guest_phone' => $paymentData['guest_phone'],
            'guest_id' => Auth::guard('guest')->id() ?? null,
            'admin_id' => null
        ];

        Booking::create($bookingData);

        //khach ko co tk
        if ($bookingData['guest_id'] == null) {
            $lastBookingId = Booking::where('date', '=', $bookingData['date'])
                ->where('checkin', '=', $bookingData['checkin'])
                ->where('checkout', '=', $bookingData['checkout'])
                ->where('guest_email', '=', $bookingData['guest_email'])
                ->where('guest_phone', '=', $bookingData['guest_phone'])
                ->max('id');
            $booking = Booking::find($lastBookingId);

            $depositPaymentData = [
                'date' => Carbon::now(),
                'amount' => $paymentData['total_price'],
                'note' => 'Đặt cọc của khách hàng ' . $bookingData['guest_lname'] . ' ' . $bookingData['guest_fname']
                    . ' cho đặt phòng #' . $lastBookingId,
                'status' => 1,
                'guest_id' => null,
                'booking_id' => $lastBookingId,
                'method_id' => 2,
            ];
            Payment::create($depositPaymentData);

            foreach ($cart as $roomTypeId => $roomType) {
                DB::table('booked_room_types')->insert([
                    'booking_id' => $lastBookingId,
                    'room_type_id' => $roomTypeId,
                    'number_of_room' => $roomType['quantity']
                ]);
            }
            Mail::to($bookingData['guest_email'])->send((new BookingInformation($booking))->afterCommit());
//            session()->forget('bookingData');
        } //khach co tk
        else {
            $lastBookingId = Booking::where('guest_id', '=', $bookingData['guest_id'])->max('id');
            $booking = Booking::find($lastBookingId);

            $depositPaymentData = [
                'date' => Carbon::now(),
                'amount' => $paymentData['total_price'],
                'note' => 'Đặt cọc',
                'status' => 1,
                'guest_id' => $bookingData['guest_id'],
                'booking_id' => $lastBookingId,
                'method_id' => 2,
            ];
            Payment::create($depositPaymentData);

            foreach ($cart as $roomTypeId => $roomType) {
                DB::table('booked_room_types')->insert([
                    'booking_id' => $lastBookingId,
                    'room_type_id' => $roomTypeId,
                    'number_of_room' => $roomType['quantity']
                ]);
            }
//            session()->forget('bookingData');
            Mail::to(Auth::guard('guest')->user())->send((new BookingInformation($booking))->afterCommit());
        }
        return Redirect::route('guest.paymentSuccess');
    }
}
