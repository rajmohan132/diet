<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile_settings()
    {
        return view('profile_settings');
    }

    public function update_profile(Request $request)
    {
        //dd($request);
        $user = User::find(auth::user()->id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->save();
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    public function update_password(Request $request)
    {

        //dd($request);

        if (!env('USER_VERIFIED'))
            return redirect()->back()->with('error', 'Operation Not Permitted');
        $input = $request->all();
        $user = User::find(auth::user()->id);
        if ($input['new_password'] != $input['confirm_password'])
            return redirect()->back()->with('error', 'Please Confirm your new password');


        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['new_password']);
            $user->save();
        } else {
            return redirect()->back()->with('error', 'Current Password doesnt match');
        }

        return redirect()->back()->with('success', 'Successfully Updated');
    }
}
