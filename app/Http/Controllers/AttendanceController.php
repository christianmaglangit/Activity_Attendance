<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addstudent;
use Illuminate\Support\Facades\DB;
use App\Models\AddActivity;

class AttendanceController extends Controller
{
    public function attendancePost(Request $request)
{
    $request->validate([
        'activityname' => 'required',
        'idinput' => 'required',
        'realTime' => 'required', // Ensure realTime is required
    ]);

    $activityName = $request->input('activityname');
    $idNumber = $request->input('idinput');
    $realTime = $request->input('realTime'); // Fetch current time from the form

    // Get student information based on idnumber from the addstudent table
    $studentInfo = Addstudent::where('idnumber', $idNumber)->first();

    // If no information found, return to the previous page
    if (!$studentInfo) {
        return redirect()->back()->with('Not Found', 'Student information not found.');
    }

    // Get activity information
    $activity = AddActivity::where('activityname', $activityName)->first();
    $TImorningStartTime = $activity ? $activity->TImorningStartTime : null;;
    $TImorningEndTime = $activity ? $activity->TImorningEndTime : null;;
    $TOmorningStartTime = $activity ? $activity->TOmorningStartTime : null;;
    $TOmorningEndTime = $activity ? $activity->TOmorningEndTime : null;;
    $noonStartTime = $activity ? $activity->noonStartTime : null;;
    $noonEndTime = $activity ? $activity->noonEndTime : null;;
    $afternoonStartTime = $activity ? $activity->afternoonStartTime : null;;
    $afternoonEndTime = $activity ? $activity->afternoonEndTime : null;;


    // Convert the time from AM/PM format to 24-hour format
    $realTimeFormatted = date("H:i:s", strtotime($realTime));

    // Sample time ranges
    
    // Initialize data array for updateOrCreate


// Add the time-related data to the $data array
// Initialize data array for updateOrCreate
$data = [
    'idnumber' => $studentInfo->idnumber,
    'name' => $studentInfo->name,
    'yearlevel' => $studentInfo->yearlevel,
    'course' => $studentInfo->course,
    'created_at' => now(),
    'updated_at' => now()
];

    // Determine the category based on the time range
    if ($realTimeFormatted >= $TImorningStartTime && $realTimeFormatted < $TImorningEndTime) {
        // Check if the column already has a value
        if (!empty($studentInfo["TIMorning"])) {
            // If the column has a value, return an error message
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            // If the column doesn't have a value, update it
            $data["TIMorning"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $TOmorningStartTime && $realTimeFormatted <= $TOmorningEndTime) {
        if (!empty($studentInfo["TOMorning"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TOMorning"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $noonStartTime && $realTimeFormatted < $noonEndTime) {
        if (!empty($studentInfo["TINoon"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TINoon"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $afternoonStartTime && $realTimeFormatted < $afternoonEndTime) {
        if (!empty($studentInfo["TONoon"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TONoon"] = $realTimeFormatted;
        }
    } else {
        return redirect()->back()->with('warning', 'Time in time out not time');
    }



// Update or insert the record in the database
DB::table($activityName)->updateOrInsert(['idnumber' => $studentInfo->idnumber], $data);

// Redirect back with success message only if no error occurred
return redirect()->back()->with('success', "$idNumber Time IN / Time Out Successfully.");
}
}
