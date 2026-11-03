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
    /**
     * How long a reset pin stays valid, in minutes.
     */
    private const PIN_TTL_MINUTES = 30;

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input("email");
        $message = 'If that email is registered, a reset pin has been sent. Check your spam folder too.';

        if (User::where('email', $email)->exists()) {
            // replace any older pin so the user can ask for a new one
            ForgotPasswordModel::where('email', $email)->delete();
            ForgotPasswordModel::create([
                'email' => $email,
                'pin' => (string) random_int(100000, 999999),
            ]);
        }

        // same answer either way, so this form can't be used to find accounts
        return redirect()->back()->with(['successfor' => $message]);
    }

    public function rest(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pin' => 'required|digits:6',
            'password' => 'required|min:6',
        ]);

        $reset = ForgotPasswordModel::where('email', $request->input('email'))
            ->where('pin', $request->input('pin'))
            ->where('created_at', '>=', now()->subMinutes(self::PIN_TTL_MINUTES))
            ->first();

        if ($reset) {
            User::where('email', $reset->email)->update(['password' => Hash::make($request->input('password'))]);
            // a pin works once
            ForgotPasswordModel::where('email', $reset->email)->delete();

            return redirect()->back()
                ->with(['recovery' => 'You will now be redirected to login']);
        }

        return redirect()->back()
            ->with(['pinMsg' => 'Pin expired or check your mail and try again']);
    }
}
