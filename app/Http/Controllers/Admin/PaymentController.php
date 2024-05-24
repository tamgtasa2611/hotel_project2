<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function create()
    {
        $bookings = Booking::all();
        $methods = PaymentMethod::all();
        return view('admin.payments.create', compact('bookings', 'methods'));
    }

    public function store(PaymentRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $data = [
                'date' => Carbon::now(),
                'amount' => $request->amount,
                'note' => $request->note,
                'status' => $request->status,
                'guest_id' => null,
                'booking_id' => $request->booking_id,
                'method_id' => $request->method_id,
                'admin_id' => Auth::guard('admin')->id()
            ];

            Payment::create($data);
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã tạo 1 thanh toán mới');
            return Redirect::route('admin.payments')->with('success', 'Tạo thanh toán thành công!');
        }
    }

    public function edit(Payment $payment)
    {
        $bookings = Booking::all();
        $methods = PaymentMethod::all();
        return view('admin.payments.edit', compact('payment', 'bookings', 'methods'));
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $validated = $request->validated();
        if ($validated) {
            $data = [
                'date' => Carbon::now(),
                'amount' => $request->amount,
                'note' => $request->note,
                'status' => $request->status,
                'guest_id' => $payment->guest_id,
                'booking_id' => $request->booking_id,
                'method_id' => $request->method_id,
                'admin_id' => Auth::guard('admin')->id()
            ];

            if ($payment->status == 1) {
                $data = [
                    'date' => Carbon::now(),
                    'amount' => $request->amount,
                    'note' => $request->note,
                    'status' => 1,
                    'guest_id' => $payment->guest_id,
                    'booking_id' => $request->booking_id,
                    'method_id' => $request->method_id,
                    'admin_id' => Auth::guard('admin')->id()
                ];
            }

            $payment->update($data);
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã sửa 1 thanh toán');
            return Redirect::route('admin.payments.show', $payment)->with('success', 'Cập nhật thanh toán thành công!');
        }
    }
}
