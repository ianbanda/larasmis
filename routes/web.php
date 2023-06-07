<?php

use App\Events\MessageNotification;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Classes;
use App\Http\Controllers\Students;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/event', function () {
    event (new MessageNotification('Ni hao Ma!!'));
});
Route::get('/listen', function () {
    return view ('listen');
});

Route::get('/', 'App\Http\Controllers\DashboardController@index'); 
Route::get('/testjs', 'App\Http\Controllers\TestjsController@index'); 

Route::get('/students', 'App\Http\Controllers\Students@index');
//Route::get('/classes/view', 'App\Http\Controllers\Classes@viewClass');
Route::get('/authentication', 'App\Http\Controllers\Authentication@index');
Route::get('/authentication/login', 'App\Http\Controllers\Authentication@loginScreen')->name('login');
Route::post('/authentication/login/submit', 'App\Http\Controllers\Authentication@login')->name('login.submit');
Route::get('/authentication/logout', 'App\Http\Controllers\Authentication@signout')->name('logout');
Route::get('/authentication/registration', 'App\Http\Controllers\Authentication@registration')->name('register-user');
Route::post('custom-registration', 'App\Http\Controllers\Authentication@customRegistration')->name('custom.registration'); 
Route::get('dashboard', 'App\Http\Controllers\DashboardController@index', 'dashboard'); 
//Route::get('login', [CustomAuthController::class, 'index'])->name('login');
//Route::post('custom-login', [Authentication::class, 'customLogin'])->name('login.custom'); 
//Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
//Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
//Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

use App\Http\Controllers\ReportsController;
Route::controller(ReportsController::class)->group(function () {
    Route::any('/reports', 'index');
    Route::any('/reports/ajax', 'ajax');
});

use App\Http\Controllers\AcademicsController;
Route::controller(AcademicsController::class)->group(function () {
    Route::get('/academics', 'index');
    Route::get('/academics/{subbit?}', 'showSubbit');
});

use App\Http\Controllers\LibraryController;
Route::controller(LibraryController::class)->group(function () {
    Route::get('/library', 'index');
});

use App\Http\Controllers\RegistrationsController;
Route::controller(RegistrationsController::class)->group(function () {
    Route::get('/registrations', 'index');
});

use App\Http\Controllers\TimetablesController;
Route::controller(TimetablesController::class)->group(function () {
    Route::get('/timetables', 'index');
});

use App\Http\Controllers\ClassesController;
Route::controller(ClassesController::class)->group(function () {
    Route::get('/classes', 'index');
    Route::get('/classes/view', 'viewClass');
    Route::get('/classes/classstudents', 'getStudents');
    Route::any('/classes/ajax', 'ajax');
});
use App\Http\Controllers\PdfController;
Route::controller(PdfController::class)->group(function () {
    Route::get('/pdf', 'index');
    Route::any('/pdf/ajax', 'ajax');
});

use App\Models\StdClass;
Route::GET('/getmsg', function (Request $request) {
    /*if(isset($request['isajax']))
    {
        $msg = "This is a simple ajax message.";
        
        $class = new StdClass(1,1,true);
        return $class->getStudentAttendanceList();
    }else
    {
        $msg = "This is a simple message.";
        //return $msg;
    }

    */
    $class = new StdClass(1);
    return $class->getStudents();
    /*return "[
        'name' => 'Abigail',
        'state' => 'CA',
    ]";*/
    
});

Route::post('/getdata',function(Request $request){
    $students = $request['students'];
    //$students = $_POST['students'];

    $sql = 1;
    $termid=1;
    
    if(is_array($students))
    {
        foreach ($students as $std) {
            $stdid = $std[0];
                
            if(is_array($std[1])){
                $sql = "DELETE FROM std_subjects WHERE studentid='$stdid' AND termid=$termid";
                $result = DB::delete($sql);
                foreach($std[1] as $subid)
                {
                    $sql = "INSERT INTO std_subjects (studentid,subjectid,termid) VALUES ('$stdid','$subid',$termid)";
                    $result = DB::insert($sql);
                }
            }else
            {
                $subid = $std[1];
                $sql = "DELETE FROM std_subjects WHERE studentid='$stdid'  AND subjectid='$subid' AND termid=$termid";
                $result = DB::delete($sql);
                $sql = "INSERT INTO std_subjects (studentid,subjectid,termid) VALUES ('$stdid','$subid',$termid)";
                    $result = DB::insert($sql);
            }
        }
    }
    

    return $sql;
});