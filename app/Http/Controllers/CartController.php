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

        $checkInFormat = Carbon::createFromDate($start)->setTime(14, 00);
        $checkOutFormat = Carbon::createFromDate($end)->setTime(12, 00);

        //get room with booking info
        $bookedRooms = Room::getRoomsInBookingByTypeId($roomType->id);
        //get room KHA DUNG
        $rooms = Room::where('status', '=', 0)->where('room_type_id', '=', $roomType->id)->get();
        $unavailableRoomList = [];

        if (count($bookedRooms) != 0) {
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
        }

        //filter xoa cac phong ko kha dung
        $rooms = $rooms->filter(function ($room, $key) use ($unavailableRoomList) {
            if (!in_array($room->id, $unavailableRoomList)) {
                return $room;
            }
        })->all();

        if (count($rooms) == 0) {
            return Redirect::back()->with('failed', 'Đã hết ' . $roomType->name . ' trong khoảng thời gian này!');
        }

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
                $newQuantity = $request->quantity;
                $rooms = Room::where('status', '=', 0)
                    ->where('room_type_id', '=', $request->room_type_id)
                    ->get();
                $bookedRoom = Room::getRoomsInBookingByTypeId($request->room_type_id);
                $checkin = Carbon::createFromDate($request->checkin)->setTime(14, 00);
                $checkout = Carbon::createFromDate($request->checkout)->setTime(12, 00);
                $unavailableRoomList = [];

                if (count($bookedRoom) > 0) {
                    foreach ($bookedRoom as $broom) {
                        $dateIn = Carbon::createFromDate($broom->checkin);
                        $dateOut = Carbon::createFromDate($broom->checkout);
                        if ($checkin->between($dateIn, $dateOut) || $checkout->between($dateIn, $dateOut)) {
                            if (!isset($unavailableRoomList[$bookedRoom->room_id])) {
                                //phong khong kha dung
                                $unavailableRoomList[] = $bookedRoom->room_id;
                            }
                        }
                    }
                }

                //filter xoa cac phong ko kha dung
                $rooms = $rooms->filter(function ($room, $key) use ($unavailableRoomList) {
                    if (!in_array($room->id, $unavailableRoomList)) {
                        return $room;
                    }
                })->all();

                if (count($rooms) == 0) {
                    return Redirect::back()->with('failed', 'Đã hết phòng trong khoảng thời gian này!');
                } else if ($newQuantity > count($rooms)) {
                    return Redirect::back()->with('failed', 'Số lượng phòng đạt tối đa!');
                } else {
                    $cart[$request->room_type_id]['quantity'] = $newQuantity;
                    Session::put('cart', $cart);
                    return Redirect::back()->with('success', 'Sửa số lượng phòng thành công!');
                }
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
