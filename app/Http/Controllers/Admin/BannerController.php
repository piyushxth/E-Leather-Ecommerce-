<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    use ImageUpload;

    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }
    
    public function index()
    {
        $banners = Banner::get();
        $title = "Banner List";
        return view("backend.pages.banner.index", compact("banners", "title"));
    }

    public function create()
    {
        $title = "Banner Create";
        return view("backend.pages.banner.create", compact("title"));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $file = $request->image;

        $this->validate(
            $request,[
                "name" => "required",
                "image" => "required|mimes:jpeg,jpg,png,gif",
                "order" => "nullable|numeric"
            ],
            [   "name.required" => "Banner Title is required",
                "image.required" => "Banner image is required",
                "image.mimes" => "Banner image is must be image",
                "order.numeric" => "Order must be number"
            ]
        );

        if ($request->hasFile("image")) {
            $input["image"] = $this->image_upload($request, "image");
        }

        if (empty($input["order"])) {
            $order = Banner::max("order");
            $new_order = $order + 1;
            $input["order"] = $new_order;
        }

        if ($request->has("status") && $request->status == 1) {
            $input["status"] = 1;
        } else {
            $input["status"] = 0;
        }

        $banner = Banner::create($input);

        return redirect()
            ->route("admin.banner.index")
            ->with("success_msg", "Banner created");
    }

    public function edit(Banner $banner)
    {
        $title = "Banner Edit";
        return view("backend.pages.banner.edit", compact("banner","title"));
    }

    public function update(Request $request, Banner $banner)
    {
        try{
            $input = $request->all();
        $this->validate(
            $request,[
                "name" => "required",
                "image" => "nullable|mimes:jpeg,jpg,png,gif",
                "order" => "nullable|numeric"
            ],
            [   "name.required" => "Banner Title is required",
                "image.required" => "Banner image is required",
                "image.mimes" => "Banner image is must be image",
                "order.numeric" => "Order must be number"
            ]
        );

        if ($request->hasFile("image")) {
            $input["image"] = $this->update_image(
                $request,
                $banner->image,
                "image"
            );
        }

        if (empty($input["order"])) {
            $order = Banner::max("order");
            $new_order = $order + 1;
            $input["order"] = $new_order;
        }

        if ($request->has("status") && $request->status == 1) {
            $input["status"] = 1;
        } else {
            $input["status"] = 0;
        }

        $banner->update($input);

        return redirect()
            ->route("admin.banner.index")
            ->with("success_msg", "Banner updated successfully");
        } catch(Exception $e){
             return redirect()
            ->route("admin.banner.index")
            ->with("success_msg", "Banner cannot be updated".$e->getMessage());
        }
    }

    public function destroy(Banner $banner)
    {
        File::delete("images/".$banner->image);
        $banner->delete();
        return redirect()
            ->route("admin.banner.index")
            ->with("success_msg", "Banner deleted successfully.");
    }
}