<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    public function index(Request $request)
    {
        $roomTypes = RoomType::all();

        $data = [
            'roomTypes' => $roomTypes,
        ];

        return view('admin.roomTypes.index', $data);
    }

    public function create()
    {
        $rooms = Room::whereNull('room_type_id')->get();
        $amenities = Amenity::all();

        return view('admin.roomTypes.create', compact('rooms', 'amenities'));
    }

    public function store(StoreRoomTypeRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'max_capacity', $request->max_capacity);
            $data = Arr::add($data, 'description', $request->description);

            RoomType::create($data);
            $newRoomTypeId = RoomType::max('id');

            //            images
//            neu co input anh
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $path = $file->getClientOriginalName();
                    if (!Storage::exists('public/rooms/' . $path)) {
                        Storage::putFileAs('public/rooms/', $file, $path);
                    }
                    RoomTypeImage::insert([
                        'path' => $path,
                        'room_type_id' => $newRoomTypeId
                    ]);
                }
            }

            //them phong vao loai phong nay
            $roomIds = $request->rooms;
            if ($roomIds != null) {
                foreach ($roomIds as $roomId) {
                    $room = Room::where('id', '=', $roomId)->first();
                    $room->update(['room_type_id' => $newRoomTypeId]);
                }
            }

            //them tien nghi
            $amenityIds = $request->amenities;
            if ($amenityIds != null) {
                foreach ($amenityIds as $amenityId) {
                    $amenity = Amenity::where('id', '=', $amenityId)->first();
                    Amenity::insertToRoomTypeAmenities($newRoomTypeId, $amenity->id);
                }
            }

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã thêm loại phòng mới');
            return Redirect::route('admin.roomTypes')->with('success', 'Thêm loại phòng thành công!');
        } else {
            return Redirect::back()->with('failed', 'Xảy ra lỗi!');
        }
    }

    public function edit(RoomType $roomType)
    {
        $rooms = Room::whereNull('room_type_id')->orWhere('room_type_id', '=', $roomType->id)->get();
//        lay cac images thuoc ve room hien tai
        $roomImageRecord = RoomTypeImage::where('room_type_id', '=', $roomType->id)->get();
//        tao array chua nhieu anh
        $roomImages = [];
        foreach ($roomImageRecord as $record) {
            $roomImages[] = $record;
        }

        $amenities = Amenity::all();
        $currentAmenities = Amenity::getRoomTypeAmenities($roomType->id)->pluck('amenity_id')->toArray();
        return view('admin.roomTypes.edit', [
            'roomType' => $roomType,
            'rooms' => $rooms,
            'roomImages' => $roomImages,
            'amenities' => $amenities,
            'currentAmenities' => $currentAmenities
        ]);
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'max_capacity', $request->max_capacity);
            $data = Arr::add($data, 'description', $request->description);
            $roomType->update($data);

            //images
            //            neu co input
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $path = $file->getClientOriginalName();
                    if (!Storage::exists('public/rooms/' . $path)) {
                        Storage::putFileAs('public/rooms/', $file, $path);
                    }
                    RoomTypeImage::insert([
                        'path' => $path,
                        'room_type_id' => $roomType->id,
                    ]);
                }
            }

            //them/xoa phong vao loai phong nay
            $currentRoomIds = Room::where('room_type_id', '=', $roomType->id)->pluck('id')->toArray();
            $roomIds = $request->rooms;

            //them phong
            if ($roomIds != null) {
                foreach ($roomIds as $roomId) {
                    $room = Room::where('id', '=', $roomId)->first();
                    $room->update(['room_type_id' => $roomType->id]);
                }
            }

            //xoa phong
            foreach ($currentRoomIds as $roomId) {
                if (!in_array($roomId, $roomIds)) {
                    $room = Room::where('id', '=', $roomId)->first();
                    $room->update(['room_type_id' => null]);
                }
            }

            //them/xoa tien nghi vao loai phong nay
            $currentAmenities = Amenity::getRoomTypeAmenities($roomType->id)->pluck('amenity_id')->toArray();
            $amenityIds = $request->amenities;

            //them tien nghi
            if ($amenityIds != null) {
                foreach ($amenityIds as $amenityId) {
                    //neu hien tai khong co thi insert
                    if (!in_array($amenityId, $currentAmenities)) {
                        Amenity::insertToRoomTypeAmenities($roomType->id, $amenityId);
                    }
                }
            }

            //xoa tien nghi
            foreach ($currentAmenities as $currentAmenity) {
                if (!in_array($currentAmenity, $amenityIds)) {
                    Amenity::destroyRoomTypeAmenities($roomType->id, $currentAmenity);
                }
            }

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã cập nhật loại phòng');
            return Redirect::back()->with('success', 'Cập nhật loại phòng thành công');
        } else {
            return Redirect::back()->with('failed', 'Xảy ra lỗi');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $roomType = RoomType::find($id);
        //Xóa bản ghi được chọn
        $roomType->delete();

        //xoa lien ket cac phong
        $rooms = Room::where('room_type_id', '=', $id)->get();
        foreach ($rooms as $room) {
            $room->update(['room_type_id' => null]);
        }
        
        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 loại phòng');
        //Quay về danh sách
        return to_route('admin.roomTypes')->with('success', 'Xóa loại phòng thành công!');
    }

    public function destroyImage(Request $request)
    {
        $imageId = $request->id;
        RoomTypeImage::destroy($imageId);

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'xóa ảnh của 1 loại phòng');
        return back()->with('success', 'Xóa ảnh thành công!');
    }


    // PDF
    public function downloadPDF()
    {
        $roomTypes = RoomType::all();

        $pdf = PDF::loadView('admin.roomTypes.pdf', array('roomTypes' => $roomTypes))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
