<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;
use Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.profile', [
            'userDetails' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();
        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's profile image.
     */
    public function profileImageUpdate(Request $request)
    {
        $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('profile_photo')) {
            $destinationPath = config('constants.PROFILE_PATH');
            $destinationPathResize = config('constants.PROFILE_PATH_RESIZE');
          
            $oldImage = auth()->user()->profile_photo;

            #Get the file from the request
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            #Save original image#############################################
            #Check if the folder is not exists then create it
            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            #Delete the old image if it exists
            if ($oldImage && File::exists($destinationPath.$oldImage)) {
                File::delete($destinationPath.$oldImage);
            }

            #Move original size file to the path
            $file->move($destinationPath, $filename);

            #Save resize image#############################################
            #Check if the folder is not exists then create it
             if (!File::exists($destinationPathResize)) {
                mkdir($destinationPathResize, 0777, true);
            }
            #Delete the old resize image if it exists
            if ($oldImage && File::exists($destinationPathResize.$oldImage)) {
                File::delete($destinationPathResize.$oldImage);
            }
            $fileResize = $request->file('profile_photo');
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($destinationPath.$filename);
            $image = $image->resize(100,100);
            $image->save($destinationPathResize.$filename);
 
            User::where('id', auth()->user()->id)->update(['profile_photo' => $filename]);

            return back()->with('success', "Profile photo updated successfully");
        }
    }
 

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

    
    /**
     * Channe password form.
     */
    public function changePasswordForm()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'confirm_password' => ['required','same:password'],
            ]
        );
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        return Redirect::route('admin.logout')->with('status', 'Password changed successfully!');
    }
}
