<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Classes;
use App\Http\Controllers\Students;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'App\Http\Controllers\DashboardController@index', 'dashboard'); 

Route::get('/students', 'App\Http\Controllers\Students@index');
Route::get('/classes', 'App\Http\Controllers\Classes@index');
Route::get('/classes/view', 'App\Http\Controllers\Classes@viewClass');
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
    Route::get('/reports', 'index');
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