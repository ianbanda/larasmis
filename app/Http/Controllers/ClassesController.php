<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Papers;
use App\Models\Attendances;
use App\Models\Paper;
use App\Models\StdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Terms;

class ClassesController extends Controller
{
    //
     //
     public function index(Request $request)
     {
        $sql = "SELECT *"
                . ", (SELECT COUNT(studentid) FROM studentsinclass WHERE classID=ID LIMIT 1) AS numofstudents"
                . ", (
						SELECT 
							GROUP_CONCAT((SELECT abbr FROM subjects WHERE ID=subjectid LIMIT 1),' ') 
						FROM classsubjects WHERE classid=cl.ID LIMIT 1
					 ) AS subjects"
                . ", (SELECT COUNT(*) FROM classteachers WHERE classid=ID LIMIT 1) AS numofteachers"
                . ", (SELECT COUNT(*) FROM studentsinclass WHERE classID=cl.ID LIMIT 1) AS numonroll"
                . ", (SELECT COUNT(*) FROM studentsinclass sic WHERE classID=cl.ID AND (SELECT gender FROM profile WHERE user_id=sic.studentid LIMIT 1)='MALE' LIMIT 1) AS numofboys"
                . ", (SELECT COUNT(*) FROM studentsinclass sic WHERE classID=cl.ID AND (SELECT gender FROM profile WHERE user_id=sic.studentid LIMIT 1)='FEMALE' LIMIT 1) AS numofgirls"
                . ", (SELECT name FROM terms WHERE ID=term LIMIT 1) AS termname"
                . ", (ID) AS classid"
                . " FROM classes cl";
        $results = DB::select($sql);
        $view = "classes";
        if(isset($request['client'])&&$request['client']=="android")
        {
            $view = 'android/classes';
            return view($view,['classes'=>$results]);
        }
        else
        {
            if( $request->is('api/*')){
                //write your logic for api call
                //return response(['classes'=>$results]);
                $users = [
                    ['userid' => 1, 'name' => 'Alex'],
                    ['userid' => 2, 'name' => 'Jane'],
                ];
                //response()->json($users, 200);
                //return $users;
                //return response()->json($results, 200);
                //return "users:".$users;
                return response()->json(['classes'=>$results]);
            }else{
                //write your logic for web call
                return view('classes.classes',['classes'=>$results]);
            }
        }
        
       
     }//
     public function getStudents(Request $request)
     {
        $classid = $request['classid'];
        $term = 0;

        $terms = new Terms();
        $termlist = $terms->getTerms();

        $classModel = new StdClass($classid,$term);
         $classstudents = $classModel->getStudents($classid,$term);

        if( $request->is('api/*')){
            $classjo = ['classstudents'=>$classstudents];
            return response()->json($classjo);
        }
        
     }

     public function getHomeworks(Request $request)
     {
         $class = DB::select('select * from classes WHERE ID='.$request['classid']);
 
         $classid = $request['classid'];
         $term = 0;

        $terms = new Terms();

        $date = "";
        if(isset($_GET['date']))
            {
                $date = $_GET['date'];
            }else{
                $date = getdate();
                $day = $date["mday"];
                if($day<10)
                {
                    $day = "0".$day;
                }
                $date = $date["year"]."-".$date["mon"]."-".$day;
            }

         $classModel = new StdClass($classid,$term);
         $classhomeworks = $classModel->getClassHomeworks();

         if( $request->is('api/*')){
            $classjo = ['classhomeworks'=>$classhomeworks];
            return response()->json($classjo);
            //return response()->json(['classjo'=>$classstudents]);
        }

        
        
     }
     public function getExams(Request $request)
     {
         //$class = DB::select('select * from classes WHERE ID='.$request['classid']);
 
         $classid = $request['classid'];
         $term = 0;

        $terms = new Terms();

        $date = "";
        if(isset($_GET['date']))
            {
                $date = $_GET['date'];
            }else{
                $date = getdate();
                $day = $date["mday"];
                if($day<10)
                {
                    $day = "0".$day;
                }
                $date = $date["year"]."-".$date["mon"]."-".$day;
            }

         $classModel = new StdClass($classid,$term);
         $classexams = $classModel->getClassExams();

         if( $request->is('api/*')){
            $classjo = ['classexams'=>$classexams];
            return response()->json($classjo);
            //return response()->json(['classjo'=>$classstudents]);
        }
        
     }

     public function getSubjects(Request $request)
     { 
         $classid = $request['classid'];
         $term = 0;
        $date = "";
        if(isset($_GET['date']))
            {
                $date = $_GET['date'];
            }else{
                $date = getdate();
                $day = $date["mday"];
                if($day<10)
                {
                    $day = "0".$day;
                }
                $date = $date["year"]."-".$date["mon"]."-".$day;
            }

        $classModel = new StdClass($classid,$term);
        $classsubjects = $classModel->getSubjects($classid,$term);
        

        if( $request->is('api/*')){
            $classjo = ['classsubjects'=>$classsubjects];
            return response()->json($classjo);
        }
     }
     public function getAttendance(Request $request)
     {
         $class = DB::select('select * from classes WHERE ID='.$request['classid']);
 
         $classid = $request['classid'];
         $term = 0;

        $terms = new Terms();
        $termlist = $terms->getTerms();

        $attendances = new Attendances();
        $date = "";
        if(isset($_GET['date']))
            {
                $date = $_GET['date'];
            }else{
                $date = getdate();
                $day = $date["mday"];
                if($day<10)
                {
                    $day = "0".$day;
                }
                $date = $date["year"]."-".$date["mon"]."-".$day;
            }
        $classAttendanceStdList = $attendances->getStudents($date,$classid,'class');

         $classModel = new StdClass($classid,$term);
        
         if( $request->is('api/*')){
            $classjo = ['classAttendanceStdList'=>$classAttendanceStdList];
            return response()->json($classjo);
            //return response()->json(['classjo'=>$classstudents]);
        }
     }
     public function viewClass(Request $request)
     {
         $class = DB::select('select * from classes WHERE ID='.$request['classid']);
 
         $classid = $request['classid'];
         $term = 0;

        $terms = new Terms();
        $termlist = $terms->getTerms();

        $attendances = new Attendances();
        $date = "";
        if(isset($_GET['date']))
            {
                $date = $_GET['date'];
            }else{
                $date = getdate();
                $day = $date["mday"];
                if($day<10)
                {
                    $day = "0".$day;
                }
                $date = $date["year"]."-".$date["mon"]."-".$day;
            }
        $classAttendanceStdList = $attendances->getStudents($date,$classid,'class');

         $classModel = new StdClass($classid,$term);
         $classstudents = $classModel->getStudents($classid,$term);
         $classsubjects = $classModel->getSubjects($classid,$term);
         $formteachers = $classModel->getFormTeachers($classid,$term);
         $nonformteachers = $classModel->getNonFormTeachers($classid,$term);
         $gotoclasslist = $classModel->getOtherClasses($classid);
         $classhomeworks = $classModel->getClassHomeworks();

        if(isset($request['client'])&&$request['client']=='android') {
            return view(
                'android.class',
                [
                'class'=>$class[0]
                ,'gotoclasslist'=>$gotoclasslist
                ,'classstudents'=>$classstudents
                ,'classAttendanceStdList'=>$classAttendanceStdList
                ,'classsubjects'=>$classsubjects
                ,'formteachers'=>$formteachers
                ,'nonformteachers'=>$nonformteachers
                ,'termslist'=>$termlist
                ]
            );
        }else{
            if( $request->is('api/*')){
                $classjo =
                    ['classjo'=>
                        [
                            ['class'=>$class[0]]
                            ,['gotoclasslist'=>$gotoclasslist]
                            ,['classstudents'=>$classstudents]
                            ,['classAttendanceStdList'=>$classAttendanceStdList]
                            ,['classsubjects'=>$classsubjects]
                            ,['classhomeworks'=>$classhomeworks]
                            ,['formteachers'=>$formteachers]
                            ,['nonformteachers'=>$nonformteachers]
                            ,['termslist'=>$termlist]
                        ]
                    ];
                return response()->json($classjo);
                //return response()->json(['classjo'=>$classstudents]);
            }
            else{
                return view(
                    'classes.class.view',
                    [
                    'class'=>$class[0]
                    ,'gotoclasslist'=>$gotoclasslist
                    ,'classstudents'=>$classstudents
                    ,'classAttendanceStdList'=>$classAttendanceStdList
                    ,'classsubjects'=>$classsubjects
                    ,'formteachers'=>$formteachers
                    ,'nonformteachers'=>$nonformteachers
                    ,'termslist'=>$termlist
                    ]
                );
            }
        }

         
     }

     public function ajax(Request $request)
     {
        $return = 0;
        $action = $request['action'];
        $action = strtolower($action);
        
        switch ($action) {
            case 'getstudentsubjects':
                $classid = $request['classid'];
                $term =  $request['term'];

                $classModel = new StdClass($classid,$term);
                $return = $classModel->getStudentSubjects();

                //$class = new StdClass(1);
                //$return = $class->getStudents();
                //$return = $classid;
                break;
            case 'studentattlist':
                $classid = $request['classid'];
                $for =  'class';  
                $date =  '';
                if(isset($request['date'])&&intval($request['date'])>0){
                    $date = $request['date'];
                    $date = "'$date'";
                }
                else
                {
                    $date = "CURRENT_DATE()";
                }
                
                $classModel = new StdClass($classid,0);
                $return = $classModel->getStudentAttendanceList($for,$date);
                //$return = json_decode($return);
                //$return = $classid;

                //return $date;
                break;

            case 'saveattendance':
                $attendance = new Attendances();
                $uid = 1;
                $date = "";

                //print_r($_POST['students']);
                //$return = $request['students'];
                $return = $attendance->saveAttendance($date, $request['classid'], $uid, $request['students']);
                break;
        }
        
        return $return;
        
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


     public function saveAttendance()
     {
        $model = new Attendances();
        $post = $_REQUEST;
        //$paperid = $post['paperid'];

        $scores = json_decode($post["attendances"]);
        //saveAttendance($date, $classid, $recorder, $students,$lessonid=0)
        $model->saveAttendance('01-01-2002',1,1,$post["attendances"]);
        $str = "hey";
        
        return $str;
        
     }
}
