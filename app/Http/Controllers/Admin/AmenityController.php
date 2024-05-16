<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::all();
        return view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        return view('admin.amenities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            Amenity::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã thêm 1 tiện nghi');
            return Redirect::route('admin.amenities')->with('success', 'Thêm tiện nghi thành công!');
        }
    }


    public function edit(Amenity $amenity)
    {
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, Amenity $amenity)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);
        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $amenity->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã sửa 1 tiện nghi');
            return Redirect::route('admin.amenities')->with('success', 'Sửa tiện nghi thành công!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $amenity = Amenity::find($id);
        //Xóa bản ghi được chọn
        $amenity->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 tiện nghi');
        //Quay về danh sách
        return Redirect::route('admin.amenities')->with('success', 'Xóa tiện nghi thành công');
    }
}
