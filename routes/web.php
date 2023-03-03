<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/students', 'App\Http\Controllers\Students@index');
Route::get('/classes', 'App\Http\Controllers\Classes@index');
Route::get('/classes/view', 'App\Http\Controllers\Classes@viewClass');