<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingInformation;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Guest;
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
        $totalPrice = Session::get('total_price');
        $payLater = Session::get('pay_later');
        $status = 1;
        if ($payLater != null) {
            $status = 0;
        }

        //du lieu insert vao bang bookings
        $bookingData = [
            'date' => Carbon::now(),
            'checkin' => Carbon::createFromDate($start)->format('Y-m-d'),
            'checkout' => Carbon::createFromDate($end)->format('Y-m-d'),
            'status' => $status,
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

        //insert vao bang payments va booked_room_types
        //khach ko co tai khoan
        if ($bookingData['guest_id'] == null) {
            //lay booking moi nhat vua tao
            $lastBookingId = Booking::where('date', '=', $bookingData['date'])
                ->where('checkin', '=', $bookingData['checkin'])
                ->where('checkout', '=', $bookingData['checkout'])
                ->where('guest_email', '=', $bookingData['guest_email'])
                ->where('guest_phone', '=', $bookingData['guest_phone'])
                ->max('id');
            $booking = Booking::find($lastBookingId);

            //dat coc
            $depositPaymentData = [
                'date' => Carbon::now(),
                'amount' => $paymentData['total_price'],
                'note' => 'Đặt cọc của khách hàng ' . $bookingData['guest_lname'] . ' ' . $bookingData['guest_fname']
                    . ' cho đặt phòng #' . $lastBookingId,
                'status' => $status, //da thanh toan
                'guest_id' => null,
                'booking_id' => $lastBookingId,
                'method_id' => 2, //online
            ];
            Payment::create($depositPaymentData);

            //tien con lai
            $remainPaymentData = [
                'date' => Carbon::now(),
                'amount' => $totalPrice - $paymentData['total_price'],
                'note' => 'Thanh toán còn lại của khách hàng ' . $bookingData['guest_lname'] . ' ' . $bookingData['guest_fname']
                    . ' cho đặt phòng #' . $lastBookingId,
                'status' => 0, //chua thanh toan
                'guest_id' => null,
                'booking_id' => $lastBookingId,
                'method_id' => null, //chua co phuong thuc (vi thanh toan sau khi tra phong)
            ];
            Payment::create($remainPaymentData);

            //insert vao bang booked_room_types
            foreach ($cart as $roomTypeId => $roomType) {
                DB::table('booked_room_types')->insert([
                    'booking_id' => $lastBookingId,
                    'room_type_id' => $roomTypeId,
                    'number_of_room' => $roomType['quantity']
                ]);
            }
            //gui mail
            Mail::to($bookingData['guest_email'])->send((new BookingInformation($booking))->afterCommit());
        } else {    //khach co tai khoan
            $lastBookingId = Booking::where('guest_id', '=', $bookingData['guest_id'])->max('id');
            $booking = Booking::find($lastBookingId);
            $guest = Guest::find($bookingData['guest_id']);

            $depositPaymentData = [
                'date' => Carbon::now(),
                'amount' => $paymentData['total_price'],
                'note' => 'Đặt cọc của khách hàng ' . $guest->last_name . ' ' . $guest->first_name
                    . ' cho đặt phòng #' . $lastBookingId,
                'status' => $status,
                'guest_id' => $bookingData['guest_id'],
                'booking_id' => $lastBookingId,
                'method_id' => 2,
            ];
            Payment::create($depositPaymentData);

            //tien con lai
            $remainPaymentData = [
                'date' => Carbon::now(),
                'amount' => $totalPrice - $paymentData['total_price'],
                'note' => 'Thanh toán còn lại của khách hàng ' . $guest->last_name . ' ' . $guest->first_name
                    . ' cho đặt phòng #' . $lastBookingId,
                'status' => 0, //chua thanh toan
                'guest_id' => $bookingData['guest_id'],
                'booking_id' => $lastBookingId,
                'method_id' => null, //chua co phuong thuc (vi thanh toan sau khi tra phong)
            ];
            Payment::create($remainPaymentData);

            foreach ($cart as $roomTypeId => $roomType) {
                DB::table('booked_room_types')->insert([
                    'booking_id' => $lastBookingId,
                    'room_type_id' => $roomTypeId,
                    'number_of_room' => $roomType['quantity']
                ]);
            }

            Mail::to(Auth::guard('guest')->user())->send((new BookingInformation($booking))->afterCommit());
        }
        //xoa session
        Session::forget('payment_data');
        Session::forget('cart');
        Session::forget('start');
        Session::forget('end');
        Session::forget('total_price');
        Session::forget('pay_later');
        return Redirect::route('guest.paymentSuccess');
    }
}
