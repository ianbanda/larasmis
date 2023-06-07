<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\PapersController;
use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ContactsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return 'Working';
});

Route::controller(ClassesController::class)->group(function () {
    Route::get('/classes', 'index');
    Route::get('/classes/view', 'viewClass');
    Route::get('/classes/classstudents', 'getStudents');
    Route::get('/classes/classsubjects', 'getSubjects');
    Route::get('/classes/classhomeworks', 'getHomeworks');
    Route::get('/classes/classexams', 'getExams');
    Route::get('/classes/classattendance', 'getAttendance');
    Route::post('/classes/saveattendance', 'saveAttendance');
    Route::any('/classes/ajax', 'ajax');
});

//Route::get('/students/getcontacts', StudentsController::getContacts);

Route::controller(FlagsController::class)->group(function () {
    Route::get('/flags', 'index');
    Route::post('/flags/check', 'check');
    //Route::any('/classes/ajax', 'ajax');
});

Route::controller(StudentsController::class)->group(function () {
    Route::get('/students', 'index');
    Route::get('/students/getcontacts', 'getContacts');
    Route::get('/students/getstudentsubjects', 'getStudentSubjects');
    Route::get('/students/getstudentassignments', 'getStudentAssignments');
    Route::get('/students/getstudentexams', 'getStudentExams');
    Route::get('/students/getstudentattendance', 'getStudentAttendance');
    Route::post('/students/savecontact/new', 'saveNewContact');
    //Route::any('/classes/ajax', 'ajax');
});


Route::controller(PapersController::class)->group(function () {
    Route::get('/papers', 'index');
    Route::get('/papers/scores', 'getScores');
    Route::post('/papers/savescores', 'saveScores');
    //Route::any('/classes/ajax', 'ajax');
});

Route::controller(Authentication::class)->group(function () {
    /*Route::post('/authentication/login/submit', function(){
        return 'Working';
    });*/
    Route::post('/authentication/login/submit', 'login');
});

Route::controller(ContactsController::class)->group(function () {
    /*Route::post('/authentication/login/submit', function(){
        return 'Working';
    });*/
    Route::post('/contacts/savecontact/new', 'saveNewContact');
});
