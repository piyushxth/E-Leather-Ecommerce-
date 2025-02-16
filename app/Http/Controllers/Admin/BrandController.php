<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\File;


class BrandController extends Controller
{
    use ImageUpload;

    protected $create_view = "backend.pages.brand.create";

    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $brand = Brand::get();
        $title = "Brands";
        return view("backend/pages/brand/index", compact("brand","title"));
    }

    public function create()
    {
        $title = "Create Brand";
        return view($this->create_view, compact("title"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $input = $request->all();
        $file = $request->logo;

        if ($request->hasFile("logo")) {
            $input["logo"] = $this->image_upload($request, "logo");
        }

        if (empty($input["order"])) {
            $order = Brand::max("order");
            $new_order = $order + 1;
            $input["order"] = $new_order;
        }

        $brand = Brand::create($input);

        return redirect()->route("admin.brand.index")->with("success_msg", "Brand created successfully");
    }

    public function edit($id)
    {
        $title = "Edit Brand";
        $editbrand = Brand::find($id);
        return view("backend/pages/brand/edit", compact("editbrand","title"));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            "name" => "required",
        ]);

        $input = $request->all();

        if ($request->hasFile("logo")) {
            $input["logo"] = $this->update_image($request, $brand->logo, "logo");
        }

        if (empty($input["order"])) {
            $order = Brand::max("order");
            $new_order = $order + 1;
            $input["order"] = $new_order;
        }
        $brand->update($input);

        return redirect()->route("admin.brand.index")->with("success_msg", "Brand updated successfully");
    }

    public function destroy(Brand $brand)
    {
        File::delete("images/" . $brand->logo);
        $brand->delete();
        return redirect()->route("admin.brand.index")->with("success_msg", "Brand deleted successfully.");
    }
}
