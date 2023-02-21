<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect('/');
    }
}
