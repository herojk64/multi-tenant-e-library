<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;

class ProfileDashboard extends Controller
{
    public function index()
    {
        return view('tenants.profile.index');
    }

    public function changePassword(Request $request)
    {
        // Validate the request data
        $attributes = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            Toaster::error('You must be logged in to change your password.');
            return redirect()->route('home');
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($attributes['current_password'], $user->password)) {
            Toaster::error('Current password is incorrect.');
            return back()->withInput();
        }

        // Update the password
        $user->password = $attributes['password'];
        $user->save();

        // Optionally, you can log the user out or redirect to a different page
        Toaster::success('Password has been changed successfully.');
        return back();
    }


    public function services()
    {
        return view('tenants.profile.dashboard');
    }

    public function view(Tenant $tenant)
    {
        return view('tenants.profile.services',[
            'tenant' => $tenant
        ]);
    }
}
