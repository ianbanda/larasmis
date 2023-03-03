<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Students extends Controller
{
    //
    function index()
    {
        return view('students.students',[
            'title' => 'Student List',
            'students' => [
                [
                    'id' =>'10',
                    'name'=>'ian'
                ]
            ]
        ]);
    }
        
    
}
