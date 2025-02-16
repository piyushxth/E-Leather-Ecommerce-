<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class CkEditorController extends Controller
{
    private $uploadPath;
    public function __construct()
    {
        $this->uploadPath = public_path('images/ckeditor/');

        if (!File::isDirectory($this->uploadPath)) {
            File::makeDirectory($this->uploadPath, 0777, true, true);
        }
        $this->middleware(["XssSanitizer"]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $img_tmp = $request->file("upload");

            $filenamewithextension = $img_tmp->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $img_tmp->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            $img_tmp->move($this->uploadPath, $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/ckeditor/' . $filenametostore);

            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }

    public function getUploadedFiles(Request $request)
    {
        $image_arr = array();
        $images = File::allFiles($this->uploadPath);
        if (!empty($images)) {

            foreach ($images as $key => $image) {
                $image_arr[$key]['image'] = asset("/images/ckeditor/") . "/" . $image->getRelativePathname();
                $image_arr[$key]['thumb'] = asset("/images/ckeditor/") . "/" . $image->getRelativePathname();
                $image_arr[$key]['folder'] = "ckeditor";
                $image_arr[$key]['image_name'] = $image->getRelativePathname();
            }
        }

        $html = view('backend.ckeditor.browse', compact('image_arr'))->render();
        echo $html;
        exit;
    }
}
