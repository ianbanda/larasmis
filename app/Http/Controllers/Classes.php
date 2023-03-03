<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Classes extends Controller
{
    //
    public function index()
    {
        $results = DB::select('select * from classes');
        return view('classes.classes',['classes'=>$results]);
    }//
    public function viewClass(Request $request)
    {
        //return $request;
        return view('classes.viewclass',$request);
    }
}
