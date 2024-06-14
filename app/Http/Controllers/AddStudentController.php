<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Addstudent;
use App\Models\User;

class AddStudentController extends Controller
{
    public function addstudent(){
        return view('addstudent');
    }
    // Modify your controller to associate students with accounts
    public function addstudentPost(Request $request){
        $loggedInUserId = auth()->user()->id; // Get the ID of the logged-in user

        $existingStudent = Addstudent::where('idnumber', $request->idnumber)->where('account_id', $loggedInUserId)->first();
        if ($existingStudent) {
            return redirect()->back()->with('alreadyexists', "Student with ID Number already exists.");
        }
        
        $addstudent = new Addstudent();
        $addstudent->name = $request->name;
        $addstudent->idnumber = $request->idnumber;
        $addstudent->course = $request->course;
        $addstudent->yearlevel = $request->yearlevel;
        $addstudent->collegedep = $request->collegedep;
        $addstudent->account_id = $loggedInUserId; // Assign the ID of the logged-in user as the account_id

        $addstudent->save();
        return redirect()->back()->with('success', "Student Add Success");
    }

    // Modify your studentlist method to fetch students associated with the logged-in account
    public function studentlist()
    {
        $loggedInUserId = auth()->user()->id; // Get the ID of the logged-in user

        $studentlist = Addstudent::where('account_id', $loggedInUserId)->orderBy('name')->get();
        return view('studentlist',[
            'studentlist' => $studentlist
        ]);
    }

    public function update(Request $request, string $id)
    {
        
        $student = Addstudent::find($id);
        $student->name = $request->name;
        $student->idnumber = $request->idnumber;
        $student->course = $request->course;
        $student->yearlevel = $request->yearlevel;
        $student->collegedep = $request->collegedep;
        $student->save();
        
        return redirect()->back()->with('success', "Student update Success");
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $student = Addstudent::find($id);
        $student->delete();
        return redirect()->back()->with('success', "Student delete Scuccess");
    }
}
