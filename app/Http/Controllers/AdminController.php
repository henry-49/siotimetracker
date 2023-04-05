<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'You Have Successfully Logout',
            'alert-type' => 'info'
        );

        return redirect('/login')->with($notification);
    }

    /**
     * Admin profile
     */
    public function profile()
    {
        $id = Auth::user()->id;

        $adminData = User::find($id);

       return view('admin.admin_profile_view', compact('adminData'));
    }

    /**
     * Edit Profile
     */

     public function EditProfile()
     {

        $id = Auth::user()->id;

        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
     }

    /**
     * StoreProfile
     */

     public function StoreProfile(Request $request)
     {
        $id = Auth::user()->id;

        $data = User::find($id);

        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')){

            $file = $request->file('profile_image');

            $filename = date('YmdHi').'_'.$file->getClientOriginalName();

            $file->move(public_path('upload/admin_images/'), $filename);

            $data['profile_image'] = $filename;
        }
            $data->save();

            $notification = array(
                'message' => 'Admin Profile Update Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.profile')->with($notification);
     }

    /**
     * ChangeProfile
     */

     public function ChangePassword()
     {

        return view('admin.admin_change_password');

     }

    /**
     * UpdatePassword
     */

     public function UpdatePassword(Request $request)
     {

        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        // get authenticated user password
        $hashPassword = Auth::user()->password;

        // check if old password matches the hasded password
        if(Hash::check($request->old_password, $hashPassword)){

            // find the authenticated user id
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->new_password);
            $users->save();

            session()->flash('message', 'Password updated successfully');
            return redirect()->back();
        }else{
            session()->flash('message', 'Old Password did not match');
            return redirect()->back();
        }

     }

}

