<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::all();

        $data = [
            'activities' => $activities,
        ];

        return view('admin.activities.index', $data);
    }

    // PDF
    public function clear(Request $request)
    {
        $validated = $request->validate([
            'deletePassword' => 'required|min:6'
        ]);

        if ($validated) {
            $admin = Auth::guard('admin')->user();

//            check password
            if (!Hash::check($request->deletePassword, $admin->password)) {
                return Redirect::back()->with('failed', 'Sai mật khẩu');
            }

            $date = $request->date ?? 'day';

            Activity::deleteByDate($date);
            return Redirect::back()->with('success', 'Xóa lịch sử thành công');
        }
        return Redirect::back()->with('failed', 'Xảy ra lỗi!');
    }
}