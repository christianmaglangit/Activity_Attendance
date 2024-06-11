<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    //register function mo register padulong db
    public function register(){
        return view('register');
    }
    public function registerPost(Request $request){
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user-> save();
        return view('home');
    }
     // end sa register function mo register padulong db
}
