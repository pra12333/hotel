<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\PasswordSetupMail;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the registration form
    public function showSignupForm()
    {
        return view('register'); // Ensure you have a `register.blade.php` view file
    }

    // Handle the registration form submission
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create the user without a password
        $token = Str::random(64); // Generate a unique token
        

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => null,
            'setup_token' => $token,
        ]);
        

        // Send the password setup email
        $this->sendPasswordSetupEmail($user);

        return back()->with('success', 'A link to set your password has been sent to your email.');
    }

    protected function sendPasswordSetupEmail(User $user)
    {
        $token = $user->setup_token;

        
        // Send the email with the password setup link
        Mail::to($user->email)->send(new PasswordSetupMail($user,$token));
    }

    public function showPasswordSetupForm($token)
{
    return view('auth.password-setup', ['token' => $token]);
}

public function setPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'password' => 'required|confirmed|min:8',
    ]);

    // Find the user with the given token
    $user = User::where('setup_token', $request->token)->first();

    if (!$user) {
        return redirect()->route('password.setup', ['token' => $request->token])
                         ->with('error', 'Invalid or expired token.');
    }

    // Update the user's password and clear the token
    $user->password = bcrypt($request->password);
    $user->setup_token = null;
    $user->save();

    return redirect()->route('login')->with('success', 'Password has been set successfully. You can now log in.');
}
   public function signin() {
    return view('login');
   }
      public function login(Request $request) {
        // Validate the input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // Attempt to authenticate the user
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember-me'))) {
        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Redirect to the intended page or fallback to the dashboard
        return redirect()->intended('dashboard');
    }

    // If authentication fails, redirect back with an error message
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->withInput($request->only('email', 'remember-me'));
      }
}
