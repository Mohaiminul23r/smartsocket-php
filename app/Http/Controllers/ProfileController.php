<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        $profile_data = $request->all();
        $current_user = Auth::user();
        if ($request->hasFile('image')){
            $file =  $request->file('image');
            $filename = time().'.'.$file->getClientOriginalName();
            $image_dir = $file->move('upload/profile_pics', $filename);
            $oldPath = public_path() . '/' . $current_user->image;
            if($current_user->image == null){
                $profile_data['image'] =  $image_dir;
            }elseif($current_user->image != null || file_exists($oldPath) == false){
                if(file_exists($oldPath) && !is_dir($oldPath)){
                    unlink($oldPath);
                }
                $profile_data['image'] =  $image_dir;
            }
        }

        $current_user->update($profile_data);
        return back()->withStatus(__('Profile updated successfully.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
