<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Activity;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class GuestController extends Controller
{
    public function index(Request $request)
    {
//        $search = "";
//        if ($request->search) {
//            $search = $request->search;
//        }
//
//        $paginationNum = 5;
//        if ($request->pagination_num) {
//            $paginationNum = $request->pagination_num;
//        }

//        $guests = Guest::where('first_name', 'like', '%' . $search . '%')
//            ->orWhere('last_name', 'like', '%' . $search . '%')->get();
        $guests = Guest::all();

        $data = [
            'guests' => $guests,
//            'search' => $search,
        ];

        return view('admin.guests.index', $data);
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(StoreGuestRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
                if (!Storage::exists('public/admin/guests/' . $imagePath)) {
                    Storage::putFileAs('public/admin/guests/', $request->file('image'), $imagePath);
                }
            }

            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'password', Hash::make($request->password));
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'status', 1);
            $data = Arr::add($data, 'image', $imagePath);
            Guest::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'created a new guest account');
            return to_route('admin.guests')->with('success', 'Guest created successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', [
            'guest' => $guest
        ]);
    }

    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $guest->image;
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/admin/guests/' . $imagePath)) {
                Storage::putFileAs('public/admin/guests/', $request->file('image'), $imagePath);
            }
            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
//            //kiem tra neu password khong thay doi thi ko update password
//            if ($request->password != $guest->password) {
//                $data = Arr::add($data, 'password', Hash::make($request->password));
//            }
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'status', $request->status);
            $data = Arr::add($data, 'image', $imagePath);
            $guest->update($data);

//           update xong -> logout guest
            Auth::guard('guest')->logout();
            session()->forget('guest');

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a guest account');
            return to_route('admin.guests')->with('success', 'Guest updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $guest = Guest::find($id);
        //Xóa bản ghi được chọn
        $guest->delete();
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'deleted a guest account');
        //Quay về danh sách
        return to_route('admin.guests')->with('success', 'Guest deleted successfully!');
    }

    // PDF

    public function downloadPDF()
    {
        $guests = Guest::all();

        $pdf = PDF::loadView('admin.guests.pdf', array('guests' => $guests))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
//        return $pdf->download('data.pdf');
    }
}
