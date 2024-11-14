<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user ()
    {
        $data['getResult'] = User::getResultUser();
        return view('backend.user.list', $data);
    }

    public function add(Request $request)
    {
        return view('backend.user.add');
    }

    public function insert(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
    // Validate the status input
    $request->validate([
        'status' => 'nullable|integer|in:0,1', // Accepts 0 or 1 as valid values for status
    ]);

    // Create a new User instance
    $get = new User;

    $get->name = trim($request->name);
    $get->email = trim($request->email);
    $get->password = Hash::make($request->password);

    // If status is not provided or invalid, set it to 0 (inactive)
    $get->status = !empty($request->status) ? (int) $request->status : 0;

    $get->save();

    return redirect('panel/user/list')->with('success', 'User successfully created');
    }

    public function edit($id)
    {
        $data['getResult'] = User::getSingle($id);
        return view('backend.user.edit', $data);
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id

        ]);

        // Validate the status input
    $request->validate([
        'status' => 'nullable|integer|in:0,1', // Accepts 0 or 1 as valid values for status
    ]);

    // Create a new User instance
    $get = User::getSingle($id);

    $get->name = trim($request->name);
    $get->email = trim($request->email);
    if(! empty($request->password))
    {
        $get->password = Hash::make($request->password);
    }


    // If status is not provided or invalid, set it to 0 (inactive)
    $get->status = !empty($request->status) ? (int) $request->status : 0;

    $get->save();

    return redirect('panel/user/list')->with('success', 'User successfully updated');

    }

    public function delete($id)
    {
        $get = User::getSingle($id);
        $get->is_delete = 1;
        $get->save();

        return redirect()->back()->with('success', 'User successfully deleted');
    }

    public function ChangePassword()
    {
        return view('backend.user.change_password');
    }

    public function UpdatePassword(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);

        if(Hash::check($request->old_password, $user->password))
        {
            if($request->new_password == $request->confirm_password)
            {
                $user->password = Hash::make($request->new_password);
                $user->save;

                return redirect()->back()->with('success', 'Your password successfully updated');
            }
            else
            {
                return redirect()->back()->with('error', 'Confirm password does not match to new password');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Old password does not match');
        }

    }

    public function AccountSetting()
    {
        $data['getUser'] = User::getSingle(Auth::user()->id);
        return view('backend.profile.account_setting', $data);
    }

    public function UpdateAccountSetting(Request $request)
{
    // Get the current logged-in user
    $getUser = User::find(Auth::user()->id);  // Using `find()` to get a single record by primary key

    // Update the user's name
    $getUser->name = $request->name;

    // Check if the profile picture file is uploaded
    if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {

        // If the user already has a profile picture, delete the old one (if exists)
        if ($getUser->profile_pic && file_exists(public_path('upload/profile/' . $getUser->profile_pic))) {
            unlink(public_path('upload/profile/' . $getUser->profile_pic)); // Delete the old file
        }

        // Get the file extension of the uploaded file
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        // Generate a random file name for the new profile picture
        $filename = Str::random(20) . '.' . $ext;

        // Move the uploaded file to the 'upload/profile' directory
        $request->file('profile_pic')->move(public_path('upload/profile'), $filename);

        // Update the profile_pic field in the database
        $getUser->profile_pic = $filename;
    }

    // Save the updated user record
    $getUser->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Account setting successfully updated');
}

}
