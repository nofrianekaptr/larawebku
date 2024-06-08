<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function profile()
    {
        return view('auth.profile');
    }

    public function profileUpdate(UpdateProfile $request)
    {

        $user = User::find(auth()->user()->id);

        if (!is_null($request->profile) && Storage::delete($user->profile)) {
            $img = $request->file('profile')->store('profile');
        } else {
            $img = $user->profile;
        }

        $user->name = $request->name;
        $user->quote = $request->quote;
        $user->job = $request->job;
        $user->profile = $img;
        $user->save();

        Alert::success('Successfully', 'Data Has Been Updated!');
        return redirect()->back();
    }

    public function password()
    {
        return view('auth.password');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);

        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password)) {
            Alert::error('Oops!', 'Current Password is Invalid!');
            return back();
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            Alert::warning('Oops!', 'New Password cannot be same as your current password!');
            return back();
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        Alert::success('Oops!', 'Password Changed Successfully!');
        return back();
    }
}
