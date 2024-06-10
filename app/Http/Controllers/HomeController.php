<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //home
    public function index()
    {
        return view('guest.index');
    }

    public function contact()
    {
        return view('guest.home.contact');
    }

    public function sendContact(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $contact_message = $request->get('message');
        Mail::to("tam.ad.php@gmail.com")->send((new Contact($name, $email, $contact_message)));

        return back()->with('success', 'Gửi tin nhắn thành công!');
    }

    public function about()
    {
        return view('guest.home.about');
    }
}
