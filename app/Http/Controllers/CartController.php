<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Booking;
use App\Models\Room;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Integer;

class CartController extends Controller
{
    public function cart()
    {
        return view('guest.cart.index');
    }

    public function addToCart(Request $request, Room $room)
    {
        $validated = $request->validate([
            'checkin' => 'required|date|before:checkout|after:yesterday',
            'checkout' => 'required|date|after:checkin',
        ]);

        if (!$validated) {
            return back()->with('failed', 'Thêm phòng vào giỏ hàng thất bại! Vui lòng thử lại sau ít phút...');
        }

        //tong so ngay luu tru
        //            format lai tu d-m-y thanh y-m-d
        $checkInDate = date('Y-m-d', strtotime($request->checkin));
        $checkOutDate = date('Y-m-d', strtotime($request->checkout));
        $dateIn = Carbon::createFromFormat('Y-m-d', $checkInDate);
        $dateOut = Carbon::createFromFormat('Y-m-d', $checkOutDate);
        $datePeriod = CarbonPeriod::between($dateIn, $dateOut);
        $totalDays = $dateIn->diffInDays($dateOut);
        $totalPrice = $room->price * $totalDays;

        //check trung nhau
        $bookings = Booking::where('room_id', '=', $room->id)->get();
        foreach ($bookings as $booking) {
            $dateInCheck = Carbon::createFromFormat('Y-m-d', $booking->checkin_date);
            $dateOutCheck = Carbon::createFromFormat('Y-m-d', $booking->checkout_date)->subDay();
//            $datePeriodCheck = CarbonPeriod::between($dateInCheck, $dateOutCheck);

            //check
            foreach ($datePeriod as $date) {
                if ($date->between($dateInCheck, $dateOutCheck)) {
                    return back()->with('failed', 'Phòng không khả dụng trong khoảng thời gian này!');
                }
            }
        }

        //them vao session
        if (Session::exists('cart')) {
            $cart = Session::get('cart');
            if (isset($cart[$room->id])) {
                $cart[$room->id]['check_in'] = $dateIn;
                $cart[$room->id]['check_out'] = $dateOut;
                $cart[$room->id]['price'] = $totalPrice;
            } else {
                $cart = Arr::add($cart, $room->id, ['room' => $room, 'check_in' => $dateIn, 'check_out' => $dateOut, 'price' => $totalPrice]);
            }
        } else {
            $cart = array();
            $cart = Arr::add($cart, $room->id, ['room' => $room, 'check_in' => $dateIn, 'check_out' => $dateOut, 'price' => $totalPrice]);
        }
        Session::put(['cart' => $cart]);
        return Redirect::route('guest.cart')->with('success', 'Thêm phòng vào giỏ thành công!');
    }

    public function deleteFromCart(Request $request)
    {
        $cart = Session::get('cart');
        Arr::pull($cart, $request->id);
        Session::put(['cart' => $cart]);
        return Redirect::back()->with('success', 'Xóa phòng khỏi giỏ hàng thành công!');
    }

    public function deleteAllFromCart()
    {
        Session::forget('cart');
        return Redirect::back()->with('success', 'Xóa giỏ hàng thành công!');
    }
}
