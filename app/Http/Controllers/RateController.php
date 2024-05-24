<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RateController extends Controller
{
    public function rateBooking(Booking $booking, Request $request)
    {
        $data = [
            'rating' => $request->rating,
            'review' => $request->review,
            'room_type_id' => $request->room_type_id,
            'rate_date' => Carbon::now(),
            'guest_id' => $booking->guest_id
        ];
        Rating::create($data);
        return Redirect::back()->with('success', 'Cảm ơn bạn đã đánh giá!');
    }

    public function deleteRate(Booking $booking, Request $request)
    {

        $rating = Rating::where('guest_id', '=', $booking->guest_id)
            ->where('room_type_id', '=', $request->room_type_id)
            ->first();
        $rating->delete();
        return Redirect::back()->with('success', 'Xóa đánh giá thành công!');
    }
}
