<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;
use App\Models\Activity;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.roomTypes.create');
    }

    public function store(StoreRoomTypeRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'base_price', $request->base_price);

            RoomType::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'created a new room type');
            return to_route('admin.roomTypes')->with('success', 'Room type created successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function edit(RoomType $roomType)
    {
        return view('admin.roomTypes.edit', [
            'roomType' => $roomType
        ]);
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'base_price', $request->base_price);

            $roomType->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'updated a room type');
            return to_route('admin.roomTypes')->with('success', 'Room type updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $roomType = RoomType::find($id);
        //Xóa bản ghi được chọn
        $roomType->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'deleted a room type');
        //Quay về danh sách
        return to_route('admin.roomTypes')->with('success', 'Room type deleted successfully!');
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
