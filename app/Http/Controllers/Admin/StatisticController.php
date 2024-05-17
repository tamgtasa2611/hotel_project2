<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function revenueReport()
    {
        return view('admin.statistics.index');
    }

    public function roomReport()
    {
        return view('admin.statistics.index');

    }

    public function serviceReport()
    {
        return view('admin.statistics.index');

    }

    public function foodReport()
    {
        return view('admin.statistics.index');

    }

    public function guestReport()
    {
        return view('admin.statistics.index');

    }
}
