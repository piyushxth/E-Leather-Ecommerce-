<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use File,Image;

class PagesController extends Controller
{
    private $upload_path;
    private $width;
    private $height;

    public function __construct(){

        $this->middleware(["XssSanitizer"]);
        $this->upload_path = public_path("images/pages/");
        $this->width = 636;
        $this->height = 398;

        if (!File::isDirectory($this->upload_path)) {
            File::makeDirectory($this->upload_path, 0777, true, true);
        }
    }

     public function index()
    {
        $title = "Pages";
        $pages = Pages::orderBy("id","ASC")->get();
        return view("backend.pages.page.index", compact("pages","title"));
    }

    public function create()
    {
        $title = "Create Page";
        return view("backend.pages.page.create", compact("title"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "page_title" => "required",
            "page_image" => "mimes:jpeg,jpg,png,gif",
        ],[
            "page_title.required" => "Title is required",
            "page_image.mimes" =>
                    "Image must have following extension jpeg,jpg,png,gif",
        ]);

        $input = $request->all();

        if ($request->hasFile("page_image")) {
            $img_tmp    = $request->file("page_image");
            $extension  = $img_tmp->getClientOriginalExtension();
            $filename   = time() . "." . $extension;

            Image::make($img_tmp->getRealPath())
                ->resize($this->width, $this->height)
                ->save($this->upload_path.$filename);

            $input["page_image"] = $filename;
        }

        Pages::create($input);

        return redirect()
            ->back()
            ->with("success_msg", "Page added successfully.");
    }

    public function edit($id)
    {
        $title = "Edit Page";
        $page = Pages::findOrFail($id);
        return view("backend.pages.page.edit", compact("page","title"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "page_title" => "required",
            "page_image" => "nullable|mimes:jpeg,jpg,png,gif",
        ],[
            "page_title.required" => "Title is required",
            "page_image.mimes" =>
                    "Image must have following extension jpeg,jpg,png,gif",
        ]);

        $input = $request->all();

        $page = Pages::findOrFail($id);

        if ($request->hasFile("page_image")) {
            File::delete($this->upload_path.$page->page_image);

            if ($request->hasFile("page_image")) {
                $img_tmp    = $request->file("page_image");
                $extension  = $img_tmp->getClientOriginalExtension();
                $filename   = time() . "." . $extension;

                Image::make($img_tmp->getRealPath())
                    ->resize($this->width, $this->height)
                    ->save($this->upload_path . $filename);

                $input["page_image"] = $filename;
            }
        }
        $page->update($input);
        return redirect()
            ->back()
            ->with("success_msg", "Page updated successfully.");
    }

    public function destroy($id)
    {
        $page = Pages::findOrFail($id);
        if(!empty($page)){
            File::delete($this->upload_path.$page->page_image);
            $page->delete();
            return redirect()
                ->back()
                ->with("success_msg", "Page deleted successfully");
        } else {
            abort(404);
        }
    }
}
