<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimetablesController extends Controller
{
    //
    public function index()
    {
        return view('timetables.index');
    }
}
