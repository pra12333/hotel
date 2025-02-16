<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    // show forgot passsword form

    public function showForgotPasswordForm(){
        return view('auth.forgot-password');
    }

    // handle password reset link
    public function sendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = \Str::random(64);

        // store token in password_reset table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // send email with reset link
        \Mail::send('emails.password-reset',['token'=>$token],function($message)use($request){
            $message->to($request->email);
            $message->subject('Password Reset Request');
        });
        return back()->with('success','A Password reset link has been sent to your mail.');
    }

    // show reset password
    public function showResetForm($token) {
        return view('auth.reset-password',['token'=>$token]);
    }

    // handle password reset
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // check if the token is valid
        $reset = DB::table('password_resets')->where([
            'email' => $request->email,
            'token'=>$request->token,
        ])->first();

        if(!$reset) {
            return back()->withErrors(['email'=>'Invalid or expired token.']);
        }

        // reset password
        $user = User::where('email',$request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // delete token after password reset
        DB::table('password_resets')->where('email',$request->email)->delete();

        return redirect()->route('login')->with('success','your password has been changed successfully');
    }
}
