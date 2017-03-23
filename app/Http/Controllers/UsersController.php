<?php
namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class UsersController extends Controller
{
    
    public function profile()
    {
        $user = Auth::user();
        $activityItems = Activity::causedBy($user)
            ->with(['subject'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('user.profile', compact('activityItems'));
    }
    
    public function changePasswordView()
    {
        return view('user.change_password');
    }
    
    public function changePassword(Request $request)
    {    
        $user = Auth::user();    
        $validation = Validator::make($request->all(), [    
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
