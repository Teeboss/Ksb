<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\adminUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\newsUpload;

class NewsUploadController extends Controller
{
    public function dashboardAdmin()
    {
        if (Auth::guard('admin')->check()) {
            $ads = DB::table('news_uploads')->orderBy('id', 'desc')->simplePaginate(2);
            return view('auth/dashboardAdminSecond', ['ads' => $ads]);
        }
    }
    public function fileUploadToServer(Request $request)
    {

        $data = array();

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,csv,txt,gif,pdf|max:2048',
            'newstitle' => 'required'
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
                $fileSave = new newsUpload();
                $fileSave->name = $filename;
                $fileSave->newstitle = $request->input('newstitle');
                $fileSave->uploader = $request->input('uploader');
                $fileSave->newsbody = $request->input('newsbody');
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

    public static function newsDisplay()
    {
        $ads = DB::table('news_uploads')->paginate(4);
        return $ads;
    }
    public function destroy($id)
    {
        $adsTable = DB::delete('DELETE FROM news_uploads WHERE id = ?', [$id]);
        return redirect()->route('dashboard.index');
    }
}
