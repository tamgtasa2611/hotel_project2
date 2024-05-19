<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\Rating;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    //  profile
    public function profile()
    {
        $guestId = Auth::guard('guest')->id();
        $guest = Guest::find($guestId);
        return view('guest.profile.index', [
            'guest' => $guest
        ]);
    }


    public function updateAccount(Request $request)
    {
        $guestId = Auth::guard('guest')->id();
        $guest = Guest::find($guestId);

        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|max:255|unique:guests,email,' . $guestId,
            // lay id guest de bo qua unique cho email cua guest dang edit
            'phone' => 'required|max:20',
        ]);

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $guest->image;
            }

            if (!Storage::exists('public/admin/guests')) {
                Storage::createDirectory('public/admin/guests');
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/admin/guests/' . $imagePath)) {
                Storage::putFileAs('public/admin/guests/', $request->file('image'), $imagePath);
            }

            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'image', $imagePath);
            $guest->update($data);

            return to_route('guest.profile')->with('success', 'Update account successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function changePassword()
    {
        $guestId = Auth::guard('guest')->id();
        $guest = Guest::find($guestId);
        return view('guest.profile.changePassword', [
            'guest' => $guest
        ]);
    }

    public function updatePassword(Request $request)
    {
        $oldPassword = $request->old_password;
        $newPassword = $request->new_password;
        $confirmNewPassword = $request->confirm_new_password;

        $guest = Auth::guard('guest')->user();
        $currentPassword = $guest->getAuthPassword();

        //kiem tra bo trong
        if ($oldPassword == "" || $newPassword == "" || $confirmNewPassword == "") {
            return back()->with('failed', 'Please enter all the fields!');
        }

        if (!Hash::check($oldPassword, $currentPassword)) {
            return back()->with('failed', 'Wrong old password!');
        }

        if ($confirmNewPassword != $newPassword) {
            return back()->with('failed', 'Confirm new password is not the same as new password!');
        }

        $hashedNewPassword = Hash::make($newPassword);
        $guest->update(['password', $hashedNewPassword]);

        return back()->with('success', 'Change password successfully!');
    }

    //booking ================================================================
    public function myBooking(Request $request)
    {
        $filter = 'all';
        if ($request->filter) {
            $filter = $request->filter;
        }

        $currentGuestId = Auth::guard('guest')->id();
        $bookings = Booking::where('guest_id', '=', $currentGuestId)->get();

        if ($filter != 'all') {
            $status = 0;
            switch ($filter) {
                case 'pending':
                    break;
                case 'confirmed':
                    $status = 1;
                    break;
                case 'ongoing':
                    $status = 2;
                    break;
                case 'completed':
                    $status = 3;
                    break;
                case 'cancelled':
                    $status = 4;
                    break;
                case 'refund':
                    $status = 5;
                    break;
            }
            $bookings = Booking::where('status', '=', $status)->where('guest_id', '=', $currentGuestId)->get();
        }

        return view('guest.profile.bookings.myBooking', compact('filter', 'bookings'));
    }

    public function bookingDetail(Booking $booking)
    {
        $payments = Payment::where('booking_id', '=', $booking->id)->get();
        $bookedRoomTypes = Booking::getRoomTypes($booking->id);

        $rating = Rating::where('room_type_id', '=', $booking->id)
            ->where('guest_id', '=', $booking->guest_id)
            ->get();

        return view('guest.profile.bookings.bookingDetail', compact(
            'booking', 'payments', 'bookedRoomTypes', 'rating'
        ));
    }

    public function cancelBooking(Booking $booking, Request $request)
    {
        $note = $request->note ?? '';
        $note = trim($note);

        $booking->update([
            'status' => 4,
            'note' => $note
        ]);

        return Redirect::back()->with('success', 'Cancel booking successfully!');
    }

//    public function deleteAccount(Request $request)
//    {
//        $validated = $request->validate([
//            'deletePassword' => 'required|min:6'
//        ]);
//        if ($validated) {
//            $guest = Auth::guard('guest')->user();
//
////            check password
//            if (!Hash::check($request->deletePassword, $guest->password)) {
//                return Redirect::back()->with('failed', 'Wrong password!');
//            }
//
//            $guestRecord = Guest::find($guest->id);
//            //Xóa bản ghi được chọn
//            $guestRecord->delete();
//            return Redirect::route('guest.home')->with('success', 'You have deleted your account successfully!');
//        }
//        return Redirect::back()->with('failed', 'Something went wrong, please try again!');
//    }
    //    profile
}
