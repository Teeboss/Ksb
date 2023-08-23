<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\adminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\bannerUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    //
    public function index()
    {
        return view('auth/admin');
    }
    public function dashboardAdmin()
    {
        if (Auth::guard('admin')->check()) {
            $ads = DB::table('banner_uploads')->orderBy('id', 'desc')->simplePaginate(2);
            return view('auth/dashboardAdmin', ['ads' => $ads]);
        } else {
            return redirect("adminlogin");
        }
    }
    public function loginPage()
    {
        return view('auth/login');
    }
    public function logine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ]);
        } else {
            if (Auth::guard('admin')->attempt($request->only(['email', 'password']))) {
                return redirect()->intended('dashboard')->withSuccess('Sign in');
            }
            return redirect("adminlogin")->withSuccess('Login details are not valid');
        }
    }
    public function postRegistration(REQUEST $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|max:255|unique:admin_users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()
            ]);
        }
        $data = $request->all();
        $check = $this->create($data);
        Auth::guard('admin')->login($check);
        return response()->json([
            "status" => true,
        ]);
    }

    function create(array $data)
    {
        return adminUser::create([
            "username" => $data["username"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
        ]);
    }

    public function fileUploadToServer(Request $request)
    {

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,gif,pdf|max:2048',
            'bannertype' => 'required'
        ]);

        if ($validator->fails()) {

            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file'); // Error response

        } else {
            if ($request->file('file')) {

                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();

                // File extension
                $extension = $file->getClientOriginalExtension();

                // File upload location
                $location = 'files';

                // Upload file
                $file->move($location, $filename);

                // File path
                $filepath = url('files/' . $filename);
                $fileSave = new bannerUpload();
                $fileSave->name = $filename;
                $fileSave->bannertype = $request->input('bannertype');
                $fileSave->uploader = $request->input('uploader');
                $fileSave->url = $request->input('url');
                $fileSave->save();
                // Response
                $data['success'] = 1;
                $data['message'] = 'Uploaded Successfully!';
                $data['filepath'] = $filepath;
                $data['extension'] = $extension;
            } else {
                // Response
                $data['success'] = 2;
                $data['message'] = 'File not uploaded.';
            }
        }
        return response()->json($data);
    }

    public static function adsDisplay()
    {
        $ads = DB::table('banner_uploads')->paginate(1);
        return $ads;
    }
    public function destroy($id)
    {
        $adsTable = DB::delete('DELETE FROM banner_uploads WHERE id = ?', [$id]);
        return redirect()->route('dashboard.index');
    }

    function logout()
    {
        Session::flush();
        Auth::guard("admin")->logout();

        return Redirect('/adminlogin');
    }
}
