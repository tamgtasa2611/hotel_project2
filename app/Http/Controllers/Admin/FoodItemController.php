<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FoodItemRequest;
use App\Models\Activity;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FoodItemController extends Controller
{
    public function index()
    {
        $foodItems = FoodItem::all();
        return view('admin.food_items.index', compact('foodItems'));
    }

    public function create()
    {
        return view('admin.food_items.create');
    }

    public function store(FoodItemRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'description', $request->description);
            FoodItem::create($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã thêm 1 món ăn');
            return Redirect::route('admin.foodItems')->with('success', 'Thêm món ăn thành công!');
        }
    }


    public function edit(FoodItem $foodItem)
    {
        return view('admin.food_items.edit', compact('foodItem'));
    }

    public function update(FoodItemRequest $request, FoodItem $foodItem)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'price', $request->price);
            $data = Arr::add($data, 'description', $request->description);
            $foodItem->update($data);

            //log
            Activity::saveActivity(Auth::guard('admin')->id(), 'đã sửa 1 món ăn');
            return Redirect::back()->with('success', 'Sửa món ăn thành công!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $foodItem = FoodItem::find($id);
        //Xóa bản ghi được chọn
        $foodItem->delete();

        //log
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã xóa 1 món ăn');
        //Quay về danh sách
        return Redirect::route('admin.foodItems')->with('success', 'Xóa món ăn thành công');
    }
}
