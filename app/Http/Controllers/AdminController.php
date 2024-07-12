<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect('admin/login')->with($notification);
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $profile = User::find(auth()->user()->id);
        return view('admin.admin_profile',compact('profile'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $profile = User::find(auth()->user()->id);
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('uploads/admin_images/'.$profile->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move('uploads/admin_images/', $filename);
            $profile->photo = $filename;
        }
        $profile->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $profile = User::find(auth()->user()->id);
        return view('admin.admin_change_password',compact('profile'));
    }

    public function AdminUpdatePassword(Request $request)
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
