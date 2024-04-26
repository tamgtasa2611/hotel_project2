<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::with('admin')->get();

        $data = [
            'activities' => $activities,
        ];

        return view('admin.activities.index', $data);
    }

    // PDF
    public function downloadPDF()
    {
        $activities = Activity::with('admin')->get();

        $pdf = PDF::loadView('admin.activities.pdf', array('activities' => $activities))
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
