<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Integer;

class CartController extends Controller
{
    public function cart()
    {
        $carts = [];
        $start = Session::get('start');
        $end = Session::get('end');
        if (Session::get('cart') != null) {
            $carts = Session::get('cart');
        } else {
            $carts = null;
        }

        return view('guest.cart.index', compact('carts', 'start', 'end'));
    }

    public function addToCart(Request $request)
    {
        $start = $request->checkin ?? Carbon::now()->format('d-m-Y');
        $end = $request->checkout ?? Carbon::now()->addDay()->format('d-m-Y');
        $roomType = RoomType::where('id', '=', $request->id)->first();

        //tong so ngay luu tru
        //            format lai tu d-m-y thanh y-m-d
        $checkInDate = date('Y-m-d', strtotime($start));
        $checkOutDate = date('Y-m-d', strtotime($end));
        $dateIn = Carbon::createFromFormat('Y-m-d', $checkInDate);
        $dateOut = Carbon::createFromFormat('Y-m-d', $checkOutDate);
        $datePeriod = CarbonPeriod::between($dateIn, $dateOut);
        $totalDays = $dateIn->diffInDays($dateOut);

        //check trung nhau
//        $bookings = Booking::where('room_id', '=', $room->id)->get();
//        foreach ($bookings as $booking) {
//            $dateInCheck = Carbon::createFromFormat('Y-m-d', $booking->checkin_date);
//            $dateOutCheck = Carbon::createFromFormat('Y-m-d', $booking->checkout_date)->subDay();
////            $datePeriodCheck = CarbonPeriod::between($dateInCheck, $dateOutCheck);
//
//            //check
//            foreach ($datePeriod as $date) {
//                if ($date->between($dateInCheck, $dateOutCheck)) {
//                    return back()->with('failed', 'Phòng không khả dụng trong khoảng thời gian này!');
//                }
//            }
//        }

        //them vao session
        if (Session::exists('cart')) {
            $cart = Session::get('cart');
            if (isset($cart[$roomType->id])) {
                $cart[$roomType->id]['quantity']++;
            } else {
                $cart = Arr::add($cart, $roomType->id, [
                    'roomType' => $roomType,
                    'quantity' => 1
                ]);
            }
        } else {
            $cart = array();
            $cart = Arr::add($cart, $roomType->id, [
                'roomType' => $roomType,
                'quantity' => 1
            ]);
        }
        Session::put('cart', $cart);
        if (!Session::exists('start')) {
            Session::put('start', $start);
        }
        if (!Session::exists('end')) {
            Session::put('end', $end);
        }

        return Redirect::back()->with('success', 'Thêm phòng vào giỏ thành công!');
    }

    public function updateQuantity(Request $request)
    {
        if ($request->quantity < 1) {
            return Redirect::back()->with('failed', 'Số lượng phòng ít nhất là 1!');
        }

        if (Session::exists('cart')) {
            $cart = Session::get('cart');
            if (isset($cart[$request->room_type_id])) {
                $cart[$request->room_type_id]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
                return Redirect::back()->with('success', 'Sửa số lượng phòng thành công!');
            }
            return Redirect::back()->with('failed', 'Vui lòng thử lại sau!');
        }

        return Redirect::back()->with('failed', 'Vui lòng thử lại sau!');
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
