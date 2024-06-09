<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.index');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        //check db
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            //Lấy thông tin của admin đang login
            $admin = Auth::guard('admin')->user();
            //Cho login
            Auth::guard('admin')->login($admin);
            //Ném thông tin user đăng nhập lên session
            session(['admin' => $admin]);
            return to_route('admin.dashboard')->with('success', 'Sign in successfully!');
        }
        return to_route('admin.login')->with('failed', 'Sai email hoặc mật khẩu!')->withInput($request->input());
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        session()->forget('admin');
        return to_route('admin.login')->with('success', 'Đăng xuất thành công!');
    }
}
