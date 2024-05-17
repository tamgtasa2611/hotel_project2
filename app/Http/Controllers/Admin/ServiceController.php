<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Models\Activity;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request)
    {
        $validated = $request->validated();
        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'description', $request->description);
            Service::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã thêm 1 dịch vụ');
            return Redirect::route('admin.services')->with('success', 'Thêm dịch vụ thành công!');
        }
    }


    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'description', $request->description);
            $service->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã sửa 1 dịch vụ');
            return Redirect::back()->with('success', 'Sửa dịch vụ thành công!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $service = Service::find($id);
        //Xóa bản ghi được chọn
        $service->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 dịch vụ');
        //Quay về danh sách
        return Redirect::route('admin.services')->with('success', 'Xóa dịch vụ thành công');
    }
}
