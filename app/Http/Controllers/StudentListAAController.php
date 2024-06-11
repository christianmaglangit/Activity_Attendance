<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddActivity;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class StudentListAAController extends Controller
{
    public function studentlistAA(){
        return view('studentlistAA');
    }
    

    public function getActivityNames()
    {
        $activityNames = AddActivity::orderBy('id')->pluck('activityname', 'id');
        return view('studentlistAA', compact('activityNames'));
    }
    public function getTableData(Request $request)
    {
        $activityName = $request->input('activityname');
        $tableData = [];
    
        if ($activityName && Schema::hasTable($activityName)) {
            $tableData = DB::table($activityName)->get();
        }
    
        $activityNames = AddActivity::orderBy('id')->pluck('activityname', 'id');
    
        return view('studentlistAA', [
            'activityNames' => $activityNames,
            'tableData' => $tableData,
        ]);
    }
    
}
