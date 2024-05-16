<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with('room')->with('guest')->with('admin')->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $guests = Guest::all();

        return view('admin.bookings.create', compact('guests'));
    }

    public function edit(Booking $booking)
    {
        return view('admin.bookings.edit', [
            'booking' => $booking
        ]);
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
}
