<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utlity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('backend.profile.index',[
            'title' => 'Profile',
            'page_name' => 'Profile',
            'page_title' => 'Profile',
        ]);
    }

    public function edit($id){
        return view('backend.profile.edit',[
            'title' => 'Update Profile',
            'page_name' => 'Profile',
            'page_title' => 'Update',
            'user'      => User::find($id),
        ]);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if($user->save()){
            return redirect()->back()->with("success","Data Updated Successfully Done ");
        }
        else {
            return redirect()->back()->with("failed","Sorry!! Something is Wrong ");
        }
    }



    //change password

    public function changePassword(Request $request,$id){

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("failed","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("failed","New Password cannot be same as your current password. Please choose a different password.");
        }

        //Change Password
        $user = User::find($id);
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }
}
