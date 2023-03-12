<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use Illuminate\Http\Request;

class AcademicsController extends Controller
{
    //
    public function index()
    {
        return view('academics.main');
    }

    public function showSubbit(string $subbit = null) {
        switch($subbit)
        {
            case 'assignments':
                //getAssignments($classid=0,$subjectid=0,$state="all",$q="")
                $assignments = Assignments::getAssignments(1,1);
                return view('academics.assignments.index'
                ,[
                    'assignments' => $assignments
                ]);
                break;
        }
    }

}
