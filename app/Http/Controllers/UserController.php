<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function UserProfileUpdate(Request $request,$id)
    {

    }
}
