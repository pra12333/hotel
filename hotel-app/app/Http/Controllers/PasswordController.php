<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    // show the form to set up the password
    public function showSetupForm($token) {
        // pass the token to the view
        return view('auth.password-setup',compact('token'));
    }
    public function showPasswordSetupForm(Request $request)
{
    $user = User::where('setup_token', $request->token)->first();

    if (!$user) {
        return redirect('/')->with('error', 'Invalid or expired token.');
    }

    return view('auth.password-setup', compact('user'));
}

public function setPassword(Request $request)
{
    $request->validate([
        'password' => 'required|confirmed|min:8',
    ]);

    $user = User::where('setup_token', $request->token)->first();

    if (!$user) {
        return redirect('/')->with('error', 'Invalid or expired token.');
    }

    $user->password = bcrypt($request->password);
    $user->setup_token = null; // Clear the token after use
    $user->save();

    return redirect('/login')->with('success', 'Password set successfully! Please login.');
}

    }


