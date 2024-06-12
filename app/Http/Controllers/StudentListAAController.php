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
        // Define columns to exclude
        $columnsToExclude = ['id', 'created_at', 'updated_at'];
    
        // Initialize $tableData variable
        $tableData = null;
    
        // Get the selected name from the dropdown menu
        $selectedName = '';
    
        // If a name is selected from the dropdown menu
        if ($request->has('activityname')) {
            $selectedName = $request->input('activityname');
    
            // Check if the selected name exists in the database
            if (AddActivity::where('activityname', $selectedName)->exists()) {
                // Get all columns from the table
                $tableData = DB::table($selectedName)->get();
                // Filter out excluded columns
                $tableData = $tableData->map(function ($item) use ($columnsToExclude) {
                    return collect($item)->except($columnsToExclude)->toArray();
                });
            }
        }
    
        // Get all activity names for the dropdown menu
        $activityNames = AddActivity::orderBy('id')->pluck('activityname', 'id');
        $activityNames = $activityNames->reverse();
    
        // Pass the data to the view
        return view('studentlistAA', compact('tableData', 'columnsToExclude', 'activityNames', 'selectedName'));
    }
    

}
