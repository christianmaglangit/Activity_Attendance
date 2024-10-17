<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\AddActivityController;
use App\Http\Controllers\AddStudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StudentListAAController;
use App\Http\Controllers\StudentPenaltyController;

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
Route::get('/', [loginController::class, 'login'])->name('login');
Route::post('/', [loginController::class, 'loginPost'])->name('loginPost');

//register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'registerPost'])->name('register');
//end register

//logout
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
//end logout

//for display student list
Route::get('/studentlist', [AddStudentController::class, 'studentlist'])->name('studentlist')->middleware('auth');
//end for display student list


//for display student activity attendance
Route::get('/studentlistAA', [StudentListAAController::class, 'getTableData'])->name('getTableData')->middleware('auth');
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

//home
Route::get('/home', [AddActivityController::class, 'showActivityFormHome'])->name('home')->middleware('auth');
Route::post('/home', [AttendanceController::class, 'attendancePost'])->name('attendancePost');
//end home

//student penalty route 
//abot kanusa pa ni ma human gi kapoy na ko
Route::get('/studentpenalty', [StudentPenaltyController::class, 'studentpenalty'])->name('studentpenalty')->middleware('auth');
Route::get('/studentpenalty', [StudentPenaltyController::class, 'getTableName'])->name('getTableName');
//end student penalty