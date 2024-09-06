<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.tenants.login');
    }

    public function login(Request $request)
    {
        //TODO: Implement remember me function
        // Validate the request data
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt($attributes)) {
            // LandlordAuthentication was successful
            $request->session()->regenerate();
            Toaster::success("Login Successfull!");

            return redirect()->intended('home');
        }

        // LandlordAuthentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function register()
    {
        return view('auth.tenants.register');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create the user
        $user = User::create($attributes);

        Toaster::success('Your account has been created. Please login.');

        // Redirect or return a response
        return redirect('/login')->with('success', 'Your account has been created. Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Toaster::success("You have been logged out!");

        return redirect()->intended('home');
    }

    public function forget()
    {
        return view('auth.tenants.passwords.email');
    }

    public function sendForgetPasswordConfirmation(Request $request)
    {
        // Validate the email address
        $request->validate(['email' => 'required|email']);

        $user = User::where('email',$request->get('email'))->first();

        if(!$user){
            return redirect()->back()->withErrors(['email' => 'No user found with this email address.']);
        }

        // Generate a password reset token
        $token = Str::random(60); // Generate a random string for the token

        // Save the token to the user record
        PasswordResetToken::updateOrCreate(
            ['email' => $user->email],
            ['email'=>$user->email,'token' => $token]
        );
        Mail::to($user->email)->send(new ResetPasswordMail($user,$token,'password.reset'));

        return redirect()->back()->with('status', 'Password reset token generated successfully.');
    }

    public function reset_view($token)
    {
        $email = PasswordResetToken::where('token', $token)->pluck('email')->first();
        if(!$email){
            return abort(404);
        }
        return view('auth.tenants.passwords.reset', ['token' => $token,'email'=>$email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        if(!$request->get('token')){
            Toaster::error('Invalid token.');
            return redirect()->route('landlord.home');
        }

        $user = User::where('email',$request->get('email'))->first();

        if(!$user){
            return redirect('/')->with('error','User not found');
        }
        $user->password = $request->get('password');
        $user->save();
        Toaster::success('Password has been changed. Please login to continue.');
        return redirect('/login')->with('success','Password has been changed');
    }



}
