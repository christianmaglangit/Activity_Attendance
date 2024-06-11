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
    $activitydays = $activity ? $activity->activitydays : null;


    // Convert the time from AM/PM format to 24-hour format
    $realTimeFormatted = date("H:i:s", strtotime($realTime));

    // Sample time ranges
    $TImorningStartTime = $request->input('TImorningStartTime');
    $TImorningEndTime = $request->input('TImorningEndTime');
    $TOmorningStartTime = $request->input('TOmorningStartTime');
    $TOmorningEndTime = $request->input('TOmorningEndTime');
    $noonStartTime = $request->input('noonStartTime');
    $noonEndTime = $request->input('noonEndTime');
    $afternoonStartTime = $request->input('afternoonStartTime');
    $afternoonEndTime = $request->input('afternoonEndTime');

    // Initialize data array for updateOrCreate


// Add the time-related data to the $data array
// Initialize data array for updateOrCreate
// Initialize data array for updateOrCreate
$data = [
    'idnumber' => $studentInfo->idnumber,
    'name' => $studentInfo->name,
    'yearlevel' => $studentInfo->yearlevel,
    'course' => $studentInfo->course,
    'created_at' => now(),
    'updated_at' => now()
];

// Add the time-related data to the $data array
// Loop through each day of the activity
for ($day = 1; $day <= $activitydays; $day++) {
    $dayColumnNamePrefix = "$day"; // Prefix para sa pangalan ng kolumna para sa bawat araw

    // Determine the category based on the time range
    if ($realTimeFormatted >= $TImorningStartTime && $realTimeFormatted < $TImorningEndTime) {
        // Check if the column already has a value
        if (!empty($studentInfo["TIMorning_$dayColumnNamePrefix"])) {
            // If the column has a value, return an error message
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            // If the column doesn't have a value, update it
            $data["TIMorning_$dayColumnNamePrefix"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $TOmorningStartTime && $realTimeFormatted <= $TOmorningEndTime) {
        if (!empty($studentInfo["TOMorning_$dayColumnNamePrefix"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TOMorning_$dayColumnNamePrefix"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $noonStartTime && $realTimeFormatted < $noonEndTime) {
        if (!empty($studentInfo["TINoon_$dayColumnNamePrefix"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TINoon_$dayColumnNamePrefix"] = $realTimeFormatted;
        }
    } elseif ($realTimeFormatted >= $afternoonStartTime && $realTimeFormatted < $afternoonEndTime) {
        if (!empty($studentInfo["TONoon_$dayColumnNamePrefix"])) {
            return redirect()->back()->with('warning', 'You Already TimeIn/TimeOut in this time and day range');
        } else {
            $data["TONoon_$dayColumnNamePrefix"] = $realTimeFormatted;
        }
    } else {
        return redirect()->back()->with('warning', 'Time in time out not time');
    }
}


// Update or insert the record in the database
DB::table($activityName)->updateOrInsert(['idnumber' => $studentInfo->idnumber], $data);

// Redirect back with success message only if no error occurred
return redirect()->back()->with('success', "$idNumber Time IN / Time Out Successfully.");
}
}
