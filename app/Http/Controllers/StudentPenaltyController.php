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
    public function getTableName() {
        $loggedInUserId = auth()->user()->id;
        $activityNames = AddActivity::where('account_id', $loggedInUserId)
                                    ->orderBy('id')
                                    ->pluck('activityname', 'id');
    
        $studentList = Addstudent::where('account_id', $loggedInUserId)
                                 ->whereNotNull('idnumber')
                                 ->orderBy('name')
                                 ->select('name', 'yearlevel', 'course', 'idnumber')
                                 ->get();
        $nullCounts = [];
    
        foreach ($studentList as $student) {
            $idnumber = $student->idnumber;
            $nullCounts[$idnumber] = 0; 
    
            foreach ($activityNames as $activityId => $activityName) {
                if ($activityName === null) {
                    $nullCounts[$idnumber]++;
                }
            }
        }
         dd($nullCounts);
    
        return view('studentpenalty', [
            'studentList' => $studentList,
            'activityNames' => $activityNames,
            'nullCounts' => $nullCounts
        ]);
    }
    
    
}
