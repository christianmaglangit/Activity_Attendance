<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\AddActivityController;
use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentListAAController;

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
//
Route::get('/', function () {
    return view('login');
});
Route::post('/', [loginController::class, 'loginPost'])->name('login');
//

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register');
//
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

//

//for display student list
Route::get('/studentlist', [AddStudentController::class, 'studentlist'])->name('studentlist');
//end for display student list


//for display student activity attendance
Route::get('/studentlistAA', [StudentListAAController::class, 'studentlistAA'])->name('studentlistAA');
Route::get('/studentlistAA', [StudentListAAController::class, 'getActivityNames'])->name('getActivityNames');
Route::post('/studentlistAA', [StudentListAAController::class, 'getTableData'])->name('getTableData');



//end for display student activity attendance

//add Student route
Route::get('/addstudent', [AddStudentController::class, 'addstudent'])->name('addstudent');
Route::post('/addstudent', [AddStudentController::class, 'addstudentPost'])->name('addstudentPost');
Route::delete('/addstudent/{id}',[AddStudentController::class, 'destroy'])->name('addstudentdestroy');
Route::put('/addstudent/{id}', [AddStudentController::class, 'update'])->name('addstudentupdate');
//end add student route

//add activity route
Route::get('/addactivity', [AddActivityController::class, 'addactivity'])->name('addactivity');
Route::post('/addactivity', [AddActivityController::class, 'addactivityPost'])->name('addactivityPost');
//end add activity route
Route::get('/home', [AddActivityController::class, 'showActivityFormHome'])->name('home');
Route::post('/home', [AttendanceController::class, 'attendancePost'])->name('attendancePost');

