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
        $request->validate([
            'activityname' => 'required|string|max:255',
            'activitydays' => 'required|integer|min:1', // Ensure 'days' is an integer greater than or equal to 1
        ]);

        // Get the activity name and number of days from the form
        $activityname = $request->input('activityname');
        $activitydays = $request->input('activitydays');



        // Create a table if it doesn't exist
        if (!Schema::hasTable($activityname)) {
            Schema::create($activityname, function ($table) use ($activitydays) {
                $table->id();
                $table->string('idnumber');
                $table->string('name');
                $table->string('yearlevel');
                $table->string('course');

                // Add time-related fields for each day
                for ($i = 1; $i <= $activitydays; $i++) {
                    $table->time("TIMorning_$i")->nullable();
                    $table->time("TOMorning_$i")->nullable();
                    $table->time("TINoon_$i")->nullable();
                    $table->time("TONoon_$i")->nullable();
                }

                $table->timestamps();
            });
            Artisan::call('migrate', ['--force' => true]);
            // Store the activity information in the database
            addactivity::create([
                'activityname' => $activityname,
                'activitydays' => $activitydays,
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
        $activityNames = Addactivity::orderBy('id')->pluck('activityname', 'id');
        $activityName = $activityNames->reverse();
        return view('home', compact('activityName'));
    }
    

}

