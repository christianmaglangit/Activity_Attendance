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
    
    public function getTableData(Request $request)
    {
        $loggedInUserId = auth()->user()->id;
        $tableData = null;
        $selectedName = '';
    
        if ($request->has('activityname')) {
            $selectedName = $request->input('activityname');
            if (AddActivity::where('activityname', $selectedName)->exists()) {
                $tableData = DB::table($selectedName)
                                ->select('idnumber', 'name', 'yearlevel', 'course' ,'TIMorning', 'TOMorning', 'TINoon' ,'TONoon')
                                ->orderBy('name')
                                ->get();
            }
        }
        
        $loggedInUserId = auth()->user()->id;
        $activityNames = AddActivity::where('account_id', $loggedInUserId)
                                    ->orderBy('id')
                                    ->pluck('activityname', 'id')
                                    ->reverse();

        return view('studentlistAA', compact('tableData', 'activityNames', 'selectedName'));
    }
}
