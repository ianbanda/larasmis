<?php

namespace App\Http\Controllers;
use App\Models\Classes;

use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        
        $cm = new Classes();//Class model inst
        $classes = $cm->getClasses();//Get class list

        $tm = new Teachers();//Teacher model inst
        $teachers = $tm->getTeachers(0,1);//get teacher list

        return view('dashboard'
        ,[
            'classes' => $classes
            ,'teachers' => $teachers
        ]);
    }

    public function dashboardAction()
    {
        return view('dashboard');
    }
}