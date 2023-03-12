<?php

namespace App\Http\Controllers;

use App\Models\StdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    //
     //
     public function index()
     {
         $results = DB::select('select * from classes');
         return view('classes.classes',['classes'=>$results]);
     }//
     public function viewClass(Request $request)
     {
         $class = DB::select('select * from classes WHERE ID='.$request['classid']);
 
         $classid = $request['classid'];
         $term = 0;
         $classModel = new StdClass($classid,$term);
         $classstudents = $classModel->getStudents($classid,$term);
         $classsubjects = $classModel->getSubjects($classid,$term);
         $formteachers = $classModel->getFormTeachers($classid,$term);
         return view('classes.class.view'
             ,['class'=>$class[0]
             ,'classstudents'=>$classstudents
             ,'classsubjects'=>$classsubjects
             ,'formteachers'=>$formteachers
             ]
         );
     }
 
     public function getClassStudents($classid,$term)
     {
         if(intval($term)<=0)
         {
             $term = "(SELECt svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
         }else
         {
             $term = '$term';
         }
         
         $termq = " termid=$term";
         $sql = "SELECT sic.*,p.* "
                 . ", (SELECT CONCAT_WS(' ',firstname,othernames,surname) FROM profile WHERE user_id=sic.studentid LIMIT 1) AS stdname"
                 . ", (studentid) AS studentid"
                 . ", (SELECT username FROM users WHERE ID=p.user_id LIMIT 1) AS stdcode"
                 . ", (
                         SELECT 
                             GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=ss.subjectid LIMIT 1),' ') 
                         FROM std_subjects ss WHERE ss.studentid=sic.studentid AND $termq LIMIT 1
                      ) AS subjectstaken"
                 . ", (
                         SELECT 
                             GROUP_CONCAT((SELECT id FROM subjects WHERE ID=ss.subjectid LIMIT 1),'') 
                         FROM std_subjects ss WHERE ss.studentid=sic.studentid AND $termq LIMIT 1
                      ) AS subjects"
                 . ", (
                         YEAR(CURRENT_DATE) 
                         - 
                         YEAR( (SELECT user_dob FROM profile WHERE user_id=sic.studentid LIMIT 1))
                      ) AS age"
                 . ", (SELECT GROUP_CONCAT(attstatus SEPARATOR ', ') FROM studentattendance WHERE studentid=p.user_id GROUP BY studentid) AS atthist"
                 . " FROM studentsinclass sic, profile p WHERE p.user_id=sic.studentid AND classID='" . $classid . "' AND $termq";
         $classstudents = DB::select($sql);
         return $classstudents;
     }    
     
     public function getClassSubjects($classid,$term)
     {
         if(intval($term)<=0)
         {
             $term = "(SELECt svalue FROM settings WHERE skey='thisterm' LIMIT 1)";
         }else
         {
             $term = '$term';
         }
         
         $termq = " termid=$term";
         $sql = "SELECT *
         , (SELECT name FROM subjects WHERE ID=subjectid LIMIT 1) AS name 
         , (SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1) AS abbr 
         FROM classsubjects WHERE classid='" . $classid . "' AND $termq";
         $subjects = DB::select($sql);
         return $subjects;
     }
}
