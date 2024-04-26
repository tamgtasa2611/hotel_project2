<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Activity;
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
        $rooms = Room::with('roomType')->get();

        $data = [
            'rooms' => $rooms,
        ];

        return view('admin.rooms.index', $data);
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        $data = [
            'roomTypes' => $roomTypes
        ];
        return view('admin.rooms.create', $data);
    }

    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'capacity', $request->capacity);
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
            Activity::saveActivity(Auth::guard('admin')->id(), 'created a new room');
            return to_route('admin.rooms')->with('success', 'Room created successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
//        lay cac images thuoc ve room hien tai
        $roomImageRecord = RoomImage::where('room_id', '=', $room->id)->get();
//        tao array chua nhieu anh
        $roomImages = [];
        foreach ($roomImageRecord as $record) {
////            tach anh giua dau |
//            $images = explode('|', $record->path);
////            lay tung path anh
//            foreach ($images as $image) {
//                $roomImages[] = $image;
//            }
            $roomImages[] = $record;
        }

        $data = [
            'room' => $room,
            'roomTypes' => $roomTypes,
            'roomImages' => $roomImages
        ];
        return view('admin.rooms.edit', $data);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'capacity', $request->capacity);
            $data = Arr::add($data, 'room_type_id', $request->room_type_id);
            $room->update($data);

            //            images
            $roomId = $room->id;
//            $newImages = [];
            //            neu co input
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $path = $file->getClientOriginalName();
                    if (!Storage::exists('public/admin/rooms/' . $path)) {
                        Storage::putFileAs('public/admin/rooms/', $file, $path);
                    }
//                    $newImages[] = $path;
                    RoomImage::insert([
                        'path' => $path,
                        'room_id' => $roomId,
                    ]);
                }
//                //           insert room image table
//                //            1 record = multiple files
//                RoomImage::insert([
//                    'path' => implode("|", $newImages),
//                    'room_id' => $roomId,
//                ]);
            }

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a room');
            return back()->with('success', 'Room updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function destroyImage(Request $request)
    {
        $imageId = $request->id;
        RoomImage::destroy($imageId);

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'updated a room');
        return back()->with('success', 'Room image deleted successfully!');
    }

    public function destroyAllImages(Room $room)
    {
        $roomId = $room->id;
        $roomImageRecords = RoomImage::where('room_id', '=', $roomId)->get();
        foreach ($roomImageRecords as $record) {
            RoomImage::destroy($record->id);
        }

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'updated a room');
        return back()->with('success', 'Delete all room images successfully!');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $room = Room::find($id);
        //Xóa bản ghi được chọn
        $room->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'deleted a room');
        //Quay về danh sách
        return to_route('admin.rooms')->with('success', 'Room deleted successfully!');
    }

    // PDF
    public function downloadPDF()
    {
        $rooms = Room::all();

        $pdf = PDF::loadView('admin.rooms.pdf', array('rooms' => $rooms))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
