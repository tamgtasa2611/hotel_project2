<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RateController extends Controller
{
    public function rateBooking(Booking $booking, Request $request)
    {
        $data = [
            'rating' => $request->rating,
            'review' => $request->review,
            'rate_date' => date('Y-m-d'),
            'booking_id' => $booking->id
        ];
        Rating::create($data);
        return Redirect::back()->with('success', 'Thank you for voting!');
    }

    public function deleteRate(Booking $booking)
    {
        $rating = Rating::where('booking_id', '=', $booking->id)->first();
        $rating->delete();
        return Redirect::back()->with('success', 'Delete rating successfully!');
    }
}
