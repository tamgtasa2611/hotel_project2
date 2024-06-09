<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Activity;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // CRUD ====================================================================================
    public function index()
    {
        $admins = Admin::all();

        $data = [
            'admins' => $admins,
        ];

        return view('admin.admins.index', $data);
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
                if (!Storage::exists('public/admin/admins/' . $imagePath)) {
                    Storage::putFileAs('public/admin/admins/', $request->file('image'), $imagePath);
                }
            }

            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'password', Hash::make($request->password));
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'level', 1);
            $data = Arr::add($data, 'image', $imagePath);
            Admin::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã tạo tài khoản nhân viên mới');
            return to_route('admin.admins')->with('success', 'Tạo thành công!');
        } else {
            return back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', [
            'admin' => $admin
        ]);
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $admin->image;
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/admin/admins/' . $imagePath)) {
                Storage::putFileAs('public/admin/admins/', $request->file('image'), $imagePath);
            }
            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'level', $admin->level);
            $data = Arr::add($data, 'image', $imagePath);
            $admin->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật tài khoản nhân viên');
            return to_route('admin.admins')->with('success', 'Cập nhật thành công!');
        } else {
            return back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $admin = Admin::find($id);
        //Xóa bản ghi được chọn
        $admin->delete();
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa tài khoản nhân viên');
        //Quay về danh sách
        return to_route('admin.admins')->with('success', 'Xóa thành công!');
    }

    // PDF

    public function downloadPDF()
    {
        $admins = Admin::all();

        $pdf = PDF::loadView('admin.admins.pdf', array('admins' => $admins))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
        //        return $pdf->download('data.pdf');
    }
}
