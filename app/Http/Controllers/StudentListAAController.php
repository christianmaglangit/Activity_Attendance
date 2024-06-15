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
        // Initialize $tableData variable
        $tableData = null;
    
        // Get the selected name from the dropdown menu
        $selectedName = '';
    
        // If a name is selected from the dropdown menu
        if ($request->has('activityname')) {
            $selectedName = $request->input('activityname');
            
            // Check if the selected name exists in the database
            if (AddActivity::where('activityname', $selectedName)->exists()) {
                // Get specific columns and order by 'name'
                $tableData = DB::table($selectedName)
                                ->select('idnumber', 'name', 'yearlevel', 'course' ,'TIMorning', 'TOMorning', 'TINoon' ,'TONoon')
                                ->orderBy('name')
                                ->get();
            }
        }
        
        $loggedInUserId = auth()->user()->id;
        // Get activity names associated with the logged-in user
        $activityNames = AddActivity::where('account_id', $loggedInUserId)
                                    ->orderBy('id')
                                    ->pluck('activityname', 'id')
                                    ->reverse();

        // Pass the data to the view
        return view('studentlistAA', compact('tableData', 'activityNames', 'selectedName'));

    }
    

}
