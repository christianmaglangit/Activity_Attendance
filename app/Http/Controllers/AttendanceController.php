<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addstudent;
use Illuminate\Support\Facades\DB;
use App\Models\AddActivity;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    public function attendancePost(Request $request)
    {
        $loggedInUserId = auth()->user()->id;
        $request->validate([
            'activityname' => 'required',
            'idinput' => 'required',
            'realTime' => 'required'
        ]);

        $activityName = $request->input('activityname');
        $idNumber = $request->input('idinput');
        $realTime = $request->input('realTime'); 
        $studentInfo = Addstudent::where('idnumber', $idNumber)
                            ->where('account_id', $loggedInUserId)
                            ->first();
        if (!$studentInfo) {
            return redirect()->back()->with('Not Found', 'Student information not found. / ID Number Incorrect');
        }

        $activity = AddActivity::where('activityname', $activityName)->first();
        $TImorningStartTime = $activity ? $activity->TImorningStartTime : null;;
        $TImorningEndTime = $activity ? $activity->TImorningEndTime : null;;
        $TOmorningStartTime = $activity ? $activity->TOmorningStartTime : null;;
        $TOmorningEndTime = $activity ? $activity->TOmorningEndTime : null;;
        $noonStartTime = $activity ? $activity->noonStartTime : null;;
        $noonEndTime = $activity ? $activity->noonEndTime : null;;
        $afternoonStartTime = $activity ? $activity->afternoonStartTime : null;;
        $afternoonEndTime = $activity ? $activity->afternoonEndTime : null;;
        $realTimeFormatted = date("H:i:s", strtotime($realTime));

        $data = [
            'idnumber' => $studentInfo->idnumber,
            'name' => $studentInfo->name,
            'yearlevel' => $studentInfo->yearlevel,
            'course' => $studentInfo->course,
            'account_id' => $loggedInUserId,
            'created_at' => now(),
            'updated_at' => now()
        ];

        if ($realTimeFormatted >= $TImorningStartTime && $realTimeFormatted < $TImorningEndTime) {
            if (!empty($studentInfo["TIMorning"])) {
                return redirect()->back()->with('warning', 'You Already TimeIn / TimeOut in this time and day range');
            } else {
                $data["TIMorning"] = $realTimeFormatted;
            }
        } elseif ($realTimeFormatted >= $TOmorningStartTime && $realTimeFormatted <= $TOmorningEndTime) {
            if (!empty($studentInfo["TOMorning"])) {
                return redirect()->back()->with('warning', 'You Already TimeIn / TimeOut in this time and day range');
            } else {
                $data["TOMorning"] = $realTimeFormatted;
            }
        } elseif ($realTimeFormatted >= $noonStartTime && $realTimeFormatted < $noonEndTime) {
            if (!empty($studentInfo["TINoon"])) {
                return redirect()->back()->with('warning', 'You Already TimeIn / TimeOut in this time and day range');
            } else {
                $data["TINoon"] = $realTimeFormatted;
            }
        } elseif ($realTimeFormatted >= $afternoonStartTime && $realTimeFormatted < $afternoonEndTime) {
            if (!empty($studentInfo["TONoon"])) {
                return redirect()->back()->with('warning', 'You Already TimeIn / TimeOut in this time and day range');
            } else {
                $data["TONoon"] = $realTimeFormatted;
            }
        } else {
            return redirect()->back()->with('warning', 'Time in / Time out not time');
        }

        DB::table($activityName)->updateOrInsert(['idnumber' => $studentInfo->idnumber], $data);
        $name = $studentInfo->name;
        $name = strtoupper($name);
        return redirect()->back()->with('success', "$name - Time IN / Time Out Successfully.");

    }
}
