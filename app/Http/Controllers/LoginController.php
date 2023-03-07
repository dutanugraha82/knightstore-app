<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class LoginController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        $auth = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if($user->isVerified == false){
            return back()->with('error','email belum terverifikasi!');
        }

        if (Auth::attempt($auth)){
            $request->session()->regenerate();
            if(auth()->user()->role == 'superadmin'){
                return redirect('/superadmin');
            }elseif (auth()->user()->role == 'admin') {
                return redirect('/admin');
            }elseif(auth()->user()->role == 'user'){
                return redirect('/');
            }
        }

        return redirect('/login');
    }

    public function forgotPassword(){
        return view('forgot-password');
    }

    public function requestResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword($token){
        return view('reset-password',['token' => $token]);
    }

    public function resetingPassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect('/');
    }
}
