<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function UserProfile()
    {
        $profile = User::find(auth()->user()->id);
        return view('frontend.dashboard.edit_profile',compact('profile'));
    }

    public function UserProfileUpdate(Request $request)
    {
        $profile = User::find(auth()->user()->id);
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('uploads/user_images/'.$profile->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move('uploads/user_images/', $filename);
            $profile->photo = $filename;
        }
        $profile->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }

    public function UserChangePassword(Request $request)
    {
        return view('frontend.dashboard.change_password');
    }

    public function UserUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            $notification = array(
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            $notification = array(
                'message' => 'Password Change Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
