<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ForgotPasswordModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Controller
{
    //
    public function index()
    {
        return view("forgot");
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $pin = rand(99999, 999999);
        $email = $request->input("email");
        $request->merge(["pin" => $pin]);
        if (DB::table('users')->where('email', $email)->exists()) {
            if (DB::table('forgot_password_models')->where('email', $email)->exists()) {
                return redirect()->back()
                    ->with(['successfor' => 'An email has been sent containing a reset password pin you might want to check your spam folder, sometimes mails get redirected.']);
            } else {
                ForgotPasswordModel::create($request->all());
                return redirect()->back()
                    ->with(['successfor' => 'An email has been sent containing a reset password pin.']);
            }
        } else {
            return redirect()->back()
                ->with(['noMail' => 'Your Email Address does not appear to be available']);
        }
    }

    public function rest(Request $request)
    {
        $request->validate([
            'pin' => 'required|max:6',
            'password' => 'required',
        ]);
        if (DB::table('forgot_password_models')->where('pin', $request->input('pin'))->exists()) {
            // 
            $email = DB::table('forgot_password_models')->select('email')->where('pin', $request->input('pin'))->first();
            User::where('email', $email->email)->update(['password' => Hash::make($request->input('password'))]);
            return redirect()->back()
                ->with(['recovery' => 'You will now be redirected to login']);
        }
        return redirect()->back()
            ->with(['pinMsg' => 'Pin expired or check your mail and try again']);
    }
}
