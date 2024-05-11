<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Mail\ForgotPassword;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class GuestController extends Controller
{
    //    login logout register
    public function login()
    {
//        lay url chuyen huong sang login
        session([
            'myUrl' => url()->previous()
        ]);
        return view('guest.login.login');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        //check account status
        //0 = locked
        //1 = active
        $guestEmail = $credentials['email'];
        $guestAccount = Guest::where('email', '=', $guestEmail)->first();
        if ($guestAccount == null) {
            return Redirect::back()->with('failed', 'Email does not exist!');
        }
        $accountStatus = $guestAccount->status;
        if ($accountStatus == 0) {
            return to_route('guest.login')->with('failed', 'This account has been locked!')->withInput($request->input());
        }
        //check account trong db
        if (Auth::guard('guest')->attempt($credentials)) {
            $request->session()->regenerate();
            //Lấy thông tin của guest đang login
            $guest = Auth::guard('guest')->user();
            //Cho login
            Auth::guard('guest')->login($guest);
            //Ném thông tin user đăng nhập lên session
            session(['guest' => $guest]);

//            lay thong tin url truoc do de chuyen guest ve
            $url = Str::replace(url('/'), '', session('myUrl'));

            //tu register sang
            if (Str::contains($url, 'signup')) {
                return to_route('guest.home')->with('success', 'Sign in successfully!');
            } //tu rooms/id sang
            else if (Str::contains($url, 'rooms/')) {
                $roomId = Str::replace('/rooms/', '', $url);
                return to_route('guest.rooms.show', $roomId)->with('success', 'Sign in successfully!');
            }
            return to_route('guest.profile')->with('success', 'Sign in successfully!');
        }
        return to_route('guest.login')->with('failed', 'Wrong email or password!')->withInput($request->input());
    }

    public function logout(Request $request)
    {
        if (!Auth::guard('guest')->check()) {
            return Redirect::route('guest.home')->with('success', 'You have already been logged out!');
        }
        Auth::guard('guest')->logout();
        session()->forget('guest');
        return view('guest.login.logout');
    }

    public function register()
    {
        return view('guest.login.signup');
    }

    public function registerProcess(StoreGuestRequest $request)
    {
        $validated = $request->validated();

        if ($validated) {
            $data = [];
            $data = Arr::add($data, 'first_name', $request->first_name);
            $data = Arr::add($data, 'last_name', $request->last_name);
            $data = Arr::add($data, 'email', $request->email);
            $data = Arr::add($data, 'password', Hash::make($request->password));
            $data = Arr::add($data, 'phone_number', $request->phone);
            $data = Arr::add($data, 'status', 1);
            Guest::create($data);

            return to_route('guest.login')->with('success', 'Account created successfully!');
        } else {
            return to_route('guest.register')->with('failed', 'Something went wrong!');
        }
    }

    //    login logout register

    public function forgotPassword()
    {
        return view('guest.login.forgotPassword');
    }

    public function forgotPasswordSendEmail(Request $request)
    {
        //validation: email, required
        //...

        $resetEmail = $request->email;
        $emailList = Guest::pluck('email')->toArray();
        if (!in_array($resetEmail, $emailList)) {
            return back()->with('failed', 'Email doesn\'t exist!');
        }

        $guest = Guest::where('email', '=', $resetEmail)->first();
        $resetCode = rand(100000, 999999);
        Mail::to($guest)->send((new ForgotPassword($resetCode)));
        session()->put('resetEmail', $resetEmail);
        session()->put('resetCode', $resetCode);
        return Redirect::route('guest.forgotPassword.enterCode')->with('Please check your email for the code!');
    }

    public function forgotPasswordEnterCode()
    {
        return view('guest.login.forgotPasswordEnterCode');
    }

    public function forgotPasswordCheckCode(Request $request)
    {
        $resetCode = session()->get('resetCode');
        $inputCode = $request->reset_code;
        if (!$inputCode == $resetCode) {
            return back()->with('failed', 'Wrong reset code!');
        }
        session()->forget('resetCode');
        return Redirect::route('guest.forgotPassword.resetPassword');
    }

    public function resetPassword()
    {
        return view('guest.login.resetPassword');
    }

    public function resetPasswordProcess(Request $request)
    {
        $newPassword = $request->new_password;
        $confirmNewPassword = $request->confirm_new_password;

        //kiem tra bo trong
        if ($newPassword == "" || $confirmNewPassword == "") {
            return back()->with('failed', 'Please enter all the fields!');
        }

        if ($confirmNewPassword != $newPassword) {
            return back()->with('failed', 'Confirm new password is not the same as new password!');
        }

        $hashedNewPassword = Hash::make($newPassword);

        $resetEmail = session()->get('resetEmail');
        $guest = Guest::where('email', '=', $resetEmail)->firstOrFail();
        session()->forget('resetEmail');

        $guest->update([
            'password' => $hashedNewPassword
        ]);

        return Redirect::route('guest.login')->with('success', 'Reset password successfully!');
    }
}
