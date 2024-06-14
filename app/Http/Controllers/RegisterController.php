<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AddStudent;

class RegisterController extends Controller
{
    //register function mo register padulong db
    public function register(){
        return view('register');
    }
    public function registerPost(Request $request){
        $user = new User();
        $user->idnumber = $request->idnumber;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->year = $request->year;
        $user->course = $request->course;
        $user->collegedep = $request->collegedep;
        $user->password = Hash::make($request->password);
        $user->save();
    
        $addStudent = new AddStudent();
        $addStudent->idnumber = $request->idnumber;
        $addStudent->name = $request->name;
        $addStudent->yearlevel = $request->year;
        $addStudent->course = $request->course;
        $addStudent->collegedep = $request->collegedep;
        $addStudent->account_id = $user->id;
        $addStudent->save();
        return view('login');
    }
    
     // end sa register function mo register padulong db
}
