<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateAdminRequest;
use App\Models\Activity;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SettingController
{
    public function setting()
    {
        return view('admin.setting.index');
    }

    public function saveSetting(UpdateAdminRequest $request, Admin $admin)
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
            $data = Arr::add($data, 'image', $imagePath);
            $admin->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật thông tin cá nhân');
            return Redirect::route('admin.settings')->with('success', 'Cập nhật thông tin tài khoản thành công!');
        } else {
            return Redirect::back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function changePwd()
    {
        dd("chuc nang doi mat khau admin");
    }
}
