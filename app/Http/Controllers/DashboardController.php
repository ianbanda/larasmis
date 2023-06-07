<?php

namespace App\Http\Controllers;
use App\Models\Classes;

use App\Models\Teachers;
use App\Models\Timetables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        
        $cm = new Classes();//Class model inst
        $classes = $cm->getClasses();//Get class list

        $tm = new Teachers();//Teacher model inst
        $teachers = $tm->getTeachers(0,1);//get teacher list

        $tttypemodel = new Timetables();//Timetables model inst
        $tttypes = $tttypemodel->getTypes();//get teacher list

        $view = "dashboard";
        if(isset($request['client'])&&$request['client']=="android")
        {
            $view = 'android/dashboard';
        }

        return view($view
        ,[
            'classes' => $classes
            ,'teachers' => $teachers
            ,'tttypes' => $tttypes
        ]);
    }

    public function dashboardAction()
    {
        return view('dashboard');
    }
}
