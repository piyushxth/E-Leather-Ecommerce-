<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use File, Image;

class AboutUsController extends Controller
{
    private $upload_path;
    private $width;
    private $height;

    public function __construct()
    {
        $this->upload_path = public_path("images/aboutus/");
        $this->width = 636;
        $this->height = 398;
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $title = "About us";
        $aboutUs = AboutUs::firstOrFail();
        return view("backend.pages.aboutUs.index", compact("aboutUs", "title"));
    }

    public function store(Request $request)
    {
        if (!File::isDirectory($this->upload_path)) {
            File::makeDirectory($this->upload_path, 0777, true, true);
        }

        $request->validate(
            [
                "about_us_description" => "required",
                "about_us_image" => "nullable|mimes:jpeg,png,jpg,gif",
            ],
            [
                "about_us_description.required" =>
                "About us description is required",
                "about_us_image.mimes" =>
                "About us image must have image with extension jpeg,png,jpg,gif"
            ]
        );

        $aboutUs = AboutUs::firstOrFail();
        $aboutUs->update($request->all());

        if ($request->hasFile("about_us_image")) {
            File::delete($this->upload_path . $aboutUs->about_us_image);
            $img_tmp = $request->file("about_us_image");
            $extension = $img_tmp->getClientOriginalExtension();
            $filename = time() . "." . $extension;

            $image = Image::make($img_tmp)->save(
                $this->upload_path . $filename
            );

            Image::make($img_tmp->getRealPath())
                ->resize($this->width, $this->height)
                ->save($this->upload_path . $filename);

            $aboutUs->about_us_image = $filename;
        }

        $aboutUs->save();
        return redirect()
            ->back()
            ->with("success_msg", "About us updated Successfully");
    }
}
