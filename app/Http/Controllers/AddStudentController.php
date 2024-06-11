<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addstudent;

class AddStudentController extends Controller
{
    public function addstudent(){
        return view('addstudent');
    }
    public function addstudentPost(Request $request){
        $existingStudent = Addstudent::where('idnumber', $request->idnumber)->first();
    if ($existingStudent) {
        return redirect()->back()->with('alreadyexists', "Student with ID Number already exists.");
    }

        $addstudent = new Addstudent();
        $addstudent->name = $request->name;
        $addstudent->idnumber = $request->idnumber;
        $addstudent->course = $request->course;
        $addstudent->yearlevel = $request->yearlevel;
        $addstudent->collegedep = $request->collegedep;
        

        $addstudent->save();
        return redirect()->back()->with('success', "Student Add Scuccess");
    }
    public function studentlist()
    {
        $studentlist = Addstudent::orderBy('idnumber')->get();
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
        $student = Addstudent::find($id);
        $student->delete();
        return redirect()->back()->with('success', "Student delete Scuccess");
    }
}
