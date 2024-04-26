<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Activity;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('room')->with('guest')->with('admin')->get();

        $data = [
            'bookings' => $bookings,
        ];

        return view('admin.bookings.index', $data);
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', [
            'booking' => $booking
        ]);
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'base_price', $request->base_price);

            $booking->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a room type');
            return to_route('admin.bookings')->with('success', 'Room type updated successfully!');
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
}
