<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\University;

class UniversityController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = $request->only('email', 'password');
    	if(Auth::guard('university')->attempt($credentials, $request->remember))
    	{
    		$user = University::where('email', $request->email)->first();
    		Auth::guard('university')->login($user);
    		return redirect()->route('university.dashboard');
    	}
    	return redirect()->route('university.login')->with('status','Faild login');
    }
    public function logout()
    {
        // $guards = array_keys(config('auth.guards'));
        // foreach ($guards as $guards) {
            
        // }
    	if(Auth::guard('university')->logout()){
    		return redirect()->route('university.login')->with('status','logout successfully');
    	}
    }
}
