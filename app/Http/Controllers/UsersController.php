<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Hash;
use Validator;

class UsersController extends Controller
{
    
    public function profile()
    {
        $activityItems = \Auth::user()->activity;
        $sortedActivityItems = $activityItems->sortByDesc('created_at')->take(15);
    	return view('user.profile', compact('sortedActivityItems'));
    }

    public function changePasswordView()
    {
    	return view('user.change_password');
    }

    public function changePassword(Request $request)
    {

	  $user = Auth::user();

	  $validation = Validator::make($request->all(), [

	    // Here's how our new validation rule is used.
	    'password' => 'hash:' . $user->password,
	    'new_password' => 'required|different:password|confirmed'
	  ]);

	  if ($validation->fails()) {
	    return redirect()->back()->withErrors($validation->errors());
	  }

	  $user->password = Hash::make($request->input('new_password'));
	  $user->save();

      flash('Success!', 'Password changed.');
      return redirect()->route('profile');

    }
}
