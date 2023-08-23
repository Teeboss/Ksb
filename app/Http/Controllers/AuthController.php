<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function index()
    {
        return view('home');
    }
    function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        } else {
            if (Auth::attempt($request->only(['email', 'password']))) {
                # code...
                return response()->json([
                    'status' => true,
                    'redirect' => url('/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => ['invalid credentials']
                ]);
            }
        }
    }
    function postRegistration(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users|max:15',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors()
            ]);
        }
        $data = $request->all();
        $check = $this->create($data);
        Auth::login($check);

        return response()->json([
            "status" => true,
            // "redirect" => /*url("dashboard") */
        ]);
    }
    function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
    }
    function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
