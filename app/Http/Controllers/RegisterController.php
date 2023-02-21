<?php

namespace App\Http\Controllers;

use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function registrasi(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:users,email'],
            'nohp' => ['required','numeric'],
            'password' => ['required','min:5']
        ]);

        $otp = $this->generateNumericOTP();

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'otp' => $otp,
            'isVerified' => false,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password)
        ]);

        Mail::to("$request->email")->send(new OTPMail($otp));

        return redirect()->route('otp', ['email' => $request->email])->with('success','Akun berhasil dibuat, input token OTP anda!');
    }

    public function otp($email){
        $id =  User::select('id')->where('email', $email)->first();
        return view('otp', compact('id'));
    }

    public function otp_store(Request $request, $id){
        $token = User::select('otp')->where('id', $id)->first();
        if($token->otp == $request->otp){
            User::where('id',$id)->update([
                'isVerified' => true,
            ]);
            return view('login')->with('success','Email anda terverifikasi, silahkan login untuk melanjutkan!');
        }else{
            return back()->with('error','Token OTP yang dimasukan tidak sesuai!');
        }
    }

    public function generateNumericOTP(){
        $generator = "1357902468";
        $result = "";

        for ($i = 1; $i <= 6; $i++) {
            $result .= substr($generator, rand() % strlen($generator), 1);
        }

        // Returning the result
        return $result;
    }
}
