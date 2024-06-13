<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddActivity;
use App\Models\AddStudent;

class StudentPenaltyController extends Controller
{
    public function studentpenalty(){
        return view('studentpenalty');
    }
    public function getTableName(){
        $activityNames = AddActivity::orderBy('activityname')->pluck('activityname');
        $studentList = Addstudent::orderBy('name')->select('name', 'yearlevel', 'course', 'idnumber')->get();
        return view('studentpenalty',[
            'activityNames' => $activityNames,
            'studentList' => $studentList
        ]);
        
    } 
}
