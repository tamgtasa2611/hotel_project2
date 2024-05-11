<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
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
        Mail::to($email)->send((new Contact($name, $email, $contact_message)));

        return back()->with('success', 'Message sent successfully!');
    }

    public function about()
    {
        return view('guest.home.about');
    }
}
