<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedule.create');
    }
}
