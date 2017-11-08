<?php
namespace App\Http\Controllers;

use Auth;
use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        Log::info('Showing user profile for ' . $user->full_name);
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
        Log::info('User ' . $user->full_name . ' changed their password.');
        return redirect()->route('profile');
    }
}
