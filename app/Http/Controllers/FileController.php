<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function fileUpload()
    {
        return view('upload');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $fileName = time() . '.' . request()->file->getClientOriginalExtension();
        $rand = str_random(20);
        $folder = 'images/' . date("Y/m/d/his") . '/' . $rand;
        mkdir($folder, 0755, true);
        chmod($folder, 0755);
        request()->file->move($folder, $fileName);
        $package_image = "images/" . date("Y/m/d/his") . "/" . $rand . "/" . $fileName;
        
        return response()->json(['success' => 'You have successfully upload file.','path'=>$package_image]);
    }
}
