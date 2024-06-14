<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Models\AddActivity;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;




class AddActivityController extends Controller
{
    public function addactivity(){
        return view('addactivity');
    }
    public function addactivityPost(Request $request)
    {
        $loggedInUserId = auth()->user()->id;
        $request->validate([
            'activityname' => 'required|string|max:255',
            'TImorningStartTime' => 'required', 
            'TImorningEndTime' => 'required',
            'TOmorningStartTime' => 'required', 
            'TOmorningEndTime' => 'required',
            'noonStartTime' => 'required', 
            'noonEndTime' => 'required',
            'afternoonStartTime' => 'required', 
            'afternoonEndTime' => 'required',
        ]);

        // Get the activity name and number of days from the form
        $activityname = $request->input('activityname');
        $TImorningStartTime = $request->input('TImorningStartTime');
        $TImorningEndTime = $request->input('TImorningEndTime');
        $TOmorningStartTime = $request->input('TOmorningStartTime');
        $TOmorningEndTime = $request->input('TOmorningEndTime');
        $noonStartTime = $request->input('noonStartTime');
        $noonEndTime = $request->input('noonEndTime');
        $afternoonStartTime = $request->input('afternoonStartTime');
        $afternoonEndTime = $request->input('afternoonEndTime');


        // Create a table if it doesn't exist
        if (!Schema::hasTable($activityname)) {
            Schema::create($activityname, function ($table) {
                $table->id();
                $table->string('idnumber');
                $table->string('name');
                $table->string('yearlevel');
                $table->string('course');
                $table->time("TIMorning")->nullable();
                $table->time("TOMorning")->nullable();
                $table->time("TINoon")->nullable();
                $table->time("TONoon")->nullable();
                $table->string("account_id");
                $table->timestamps();
            });
            Artisan::call('migrate', ['--force' => true]);
            // Store the activity information in the database
            addactivity::create([
                'activityname' => $activityname,
                'TImorningStartTime' => $TImorningStartTime,
                'TImorningEndTime' => $TImorningEndTime,
                'TOmorningStartTime' => $TOmorningStartTime,
                'TOmorningEndTime' => $TOmorningEndTime,
                'noonStartTime' => $noonStartTime,
                'noonEndTime' => $noonEndTime,
                'afternoonStartTime' => $afternoonStartTime,
                'afternoonEndTime' => $afternoonEndTime,
                'account_id' => $loggedInUserId,
            ]);
            // Convert table name to CamelCase
            $modelClassName = Str::studly(str_replace(' ', '', $activityname));
            $activitynameWithoutSpaces = str_replace(' ', '', strtolower($activityname));

            

            return redirect()->back()->with('success', "Activity Add Scuccess");
        } else {
            return redirect()->back()->with('warning', 'Activity already exists!');
        }
        
        
    }
    public function showActivityFormHome()
{
    // Get the ID of the logged-in user
    $loggedInUserId = auth()->user()->id;

    // Retrieve activities where the account_id matches the ID of the logged-in user
    $activityNames = Addactivity::where('account_id', $loggedInUserId)
                                  ->orderBy('id')
                                  ->pluck('activityname', 'id')
                                  ->reverse();

    return view('home', compact('activityNames'));
}

    

}

