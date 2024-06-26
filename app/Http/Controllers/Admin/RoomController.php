<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $amenities = Amenity::all();

        $data = [
            'rooms' => $rooms,
            'amenities' => $amenities
        ];

        return view('admin.rooms.index', $data);
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', [
            'roomTypes' => $roomTypes,
        ]);
    }

    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'status', $request->status);
            $data = Arr::add($data, 'room_type_id', $request->room_type_id);
            Room::create($data);

            //            images
            $roomId = Room::max('id');
            //            $images = [];
            //            neu co input anh
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $path = $file->getClientOriginalName();
                    //                    $file->move('image', $path);
                    if (!Storage::exists('public/admin/rooms/' . $path)) {
                        Storage::putFileAs('public/admin/rooms/', $file, $path);
                    }
                    //                    $images[] = $path;
                    RoomImage::insert([
                        'path' => $path,
                        'room_id' => $roomId,
                    ]);
                }
                //                //           insert room image table
                //                //            1 record = multiple files
                //
                //                RoomImage::insert([
                //                    'path' => implode("|", $images),
                //                    'room_id' => $roomId,
                //                ]);
            }

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã thêm phòng mới');
            return to_route('admin.rooms')->with('success', 'Thêm phòng thành công!');
        } else {
            return back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();

        $data = [
            'room' => $room,
            'roomTypes' => $roomTypes
        ];
        return view('admin.rooms.edit', $data);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'status', $request->status);
            $data = Arr::add($data, 'room_type_id', $request->room_type_id);
            $room->update($data);

            //            //            images
            //            $roomId = $room->id;
            ////            $newImages = [];
            //            //            neu co input
            //            if ($files = $request->file('images')) {
            //                foreach ($files as $file) {
            //                    $path = $file->getClientOriginalName();
            //                    if (!Storage::exists('public/admin/rooms/' . $path)) {
            //                        Storage::putFileAs('public/admin/rooms/', $file, $path);
            //                    }
            ////                    $newImages[] = $path;
            //                    RoomImage::insert([
            //                        'path' => $path,
            //                        'room_id' => $roomId,
            //                    ]);
            //                }
            ////                //           insert room image table
            ////                //            1 record = multiple files
            ////                RoomImage::insert([
            ////                    'path' => implode("|", $newImages),
            ////                    'room_id' => $roomId,
            ////                ]);
            //            }

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật 1 phòng');
            return back()->with('success', 'Cập nhật phòng thành công!');
        } else {
            return back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $room = Room::find($id);
        //Xóa bản ghi được chọn
        $room->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 phòng');
        //Quay về danh sách
        return to_route('admin.rooms')->with('success', 'Xóa thành công!');
    }
}
