<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

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
        return Redirect::route('profile.edit')->with('status', 'Profile updated successfully!');
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
          
            $oldImage = auth()->user()->profile_photo;

            // Delete the old image if it exists
            if ($oldImage && File::exists($destinationPath.$oldImage)) {
                File::delete($destinationPath.$oldImage);
            }

            // Get the file from the request
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            if (!File::exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Move the file to the public/uploads/images directory
            $file->move($destinationPath, $filename);
 
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
}
