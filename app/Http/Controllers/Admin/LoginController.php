<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //LOGIN ==================================================================
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
        $loginData = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];
        //        $admin = Admin::where('email', $loginData['email'])->first();
        //check db
        if (Auth::guard('admin')->attempt($loginData)) {
            $request->session()->regenerate();
            //Lấy thông tin của admin đang login
            $admin = Auth::guard('admin')->user();
            //Cho login
            Auth::guard('admin')->login($admin);
            //Ném thông tin user đăng nhập lên session
            session(['admin' => $admin]);

            //log activity
            Activity::saveActivity($admin->id, 'đã đăng nhập vào hệ thống');
            return to_route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
        }
        return to_route('admin.login')->with('failed', 'Sai email hoặc mật khẩu!')->withInput($request->input());
    }

    public function logout(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return Redirect::route('admin.login')->with('failed', 'Bạn đã đăng xuất rồi!');
        }
        //log activity
        Activity::saveActivity(Auth::guard('admin')->id(), 'đã đăng xuất khỏi hệ thống');

        Auth::guard('admin')->logout();
        session()->forget('admin');

        return to_route('admin.login')->with('success', 'Đăng xuất thành công!');
    }

    public function forgotPassword()
    {
        return view('admin.forgot_password.forgot_password');
    }

    public function forgotPasswordSendEmail(Request $request)
    {
        //validation: email, required
        //...
        $validated = $request->validate([
            'email' => ['required', 'email'],
        ]);

        if ($validated) {
            $resetEmail = $request->email;
            $emailList = Admin::pluck('email')->toArray();
            if (!in_array($resetEmail, $emailList)) {
                return back()->with('failed', 'Email không tồn tại');
            }

            $admin = Admin::where('email', '=', $resetEmail)->first();
            $resetCode = rand(100000, 999999);
            Mail::to($admin)->send((new ForgotPassword($resetCode)));
            session()->put('resetEmail', $resetEmail);
            session()->put('resetCode', $resetCode);
            return Redirect::route('admin.forgotPassword.enterCode')->with('Vui lòng kiểm tra mã đặt lại được gửi về email của bạn!');
        }
    }

    public function forgotPasswordEnterCode()
    {
        if (!session()->has('resetCode')) {
            return Redirect::back()->with('failed', 'Bạn chưa nhập email để nhận mã!');
        }

        return view('admin.forgot_password.forgot_password_enter_code');
    }

    public function forgotPasswordCheckCode(Request $request)
    {
        $validated = $request->validate([
            'reset_code' => 'integer'
        ]);

        if ($validated) {
            $resetCode = session()->get('resetCode');
            $inputCode = $request->reset_code;

            if ($inputCode != $resetCode) {
                return back()->with('failed', 'Sai mã đặt lại!');
            }
            session()->forget('resetCode');
            session()->put('reset_ready', true);
            return Redirect::route('admin.forgotPassword.resetPassword');
        }
    }

    public function resetPassword()
    {
        if (!session()->has('reset_ready')) {
            return Redirect::back()->with('failed', 'Bạn chưa nhập mã đặt lại!');
        }
        session()->forget('reset_ready');
        return view('admin.forgot_password.reset_password');
    }

    public function resetPasswordProcess(Request $request)
    {
        $newPassword = $request->new_password;
        $confirmNewPassword = $request->confirm_new_password;
        $validated = $request->validate([
            'new_password' => 'min:6',
            'confirm_new_password' => 'min:6',
        ]);

        if ($validated) {
            if ($confirmNewPassword != $newPassword) {
                return back()->with('failed', 'Mật khẩu nhập lại không khớp!');
            }

            $hashedNewPassword = Hash::make($newPassword);

            $resetEmail = session()->get('resetEmail');
            $admin = Admin::where('email', '=', $resetEmail)->firstOrFail();
            session()->forget('resetEmail');

            $admin->update([
                'password' => $hashedNewPassword
            ]);

            session()->forget('reset_ready');

            return Redirect::route('admin.login')->with(
                'success',
                'Đặt lại mật khẩu thành công!'
            );
        }
    }
}
