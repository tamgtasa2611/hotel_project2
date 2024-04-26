<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::all();

        $data = [
            'employees' => $employees,
        ];

        return view('admin.employees.index', $data);
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
                if (!Storage::exists('public/admin/employee/' . $imagePath)) {
                    Storage::putFileAs('public/admin/employee/', $request->file('image'), $imagePath);
                }
            }

            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'role', $request->role);
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'image', $imagePath);
            Employee::create($data);
            return to_route('admin.employees')->with('success', 'Employee created successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', [
            'employee' => $employee
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $validated = $request->validated();

        if ($validated) {
            $imagePath = "";
            //Kiểm tra nếu đã chọn ảnh thì Lấy tên ảnh đang được chọn
            //không chọn ảnh thì sẽ lấy tên ảnh cũ trên db
            if ($request->file('image')) {
                $imagePath = $request->file('image')->getClientOriginalName();
            } else {
                $imagePath = $employee->image;
            }
            //Kiểm tra nếu file chưa tồn tại thì lưu vào trong folder code
            if (!Storage::exists('public/admin/employee/' . $imagePath)) {
                Storage::putFileAs('public/admin/employee/', $request->file('image'), $imagePath);
            }
            $data = [];
            $data = Arr::add($data, 'name', $request->name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'role', $request->role);
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'image', $imagePath);
            $employee->update($data);

            return to_route('admin.employees')->with('success', 'Employee updated successfully!');
        } else {
            return back()->with('failed', 'Something went wrong!');
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $employee = Employee::find($id);
        //Xóa bản ghi được chọn
        $employee->delete();
        //Quay về danh sách
        return to_route('admin.employees')->with('success', 'Employee deleted successfully!');
    }

    // PDF

    public function downloadPDF()
    {
        $employees = Employee::all();

        $pdf = PDF::loadView('admin.employees.pdf', array('employees' => $employees))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
//        return $pdf->download('data.pdf');
    }
}
