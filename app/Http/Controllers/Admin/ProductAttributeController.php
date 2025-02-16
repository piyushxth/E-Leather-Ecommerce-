<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductAttribute;
use App\Models\ProductSizes;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Traits\ImageUpload;
use File;

class ProductAttributeController extends Controller
{
    use ImageUpload;

    public function __construct(){
        $this->middleware(["XssSanitizer"]);
    }

    public function index($id)
    {
        $title = "Product Attributes";
        $product = Product::find($id);
        $product_attribute = ProductAttribute::where("product_id", $id)->get();
        $product_sizes = ProductSizes::where("product_id", $id)->get();

        return view(
            "backend/pages/product_attribute/index",
            compact("product", "product_attribute","product_sizes", "title")
        );
    }

    public function create($id)
    {
        $title = "Create Product Attribute";
        $product = Product::find($id);
        return view(
            "backend/pages/product_attribute/create",
            compact("product", "title")
        );
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    "product_id" => "required",
                    "color_code" => "required",
                    "color_name" => "required",
                    "product_image.*" => "nullable|image|mimes:jpg,png,jpeg",
                    "size.*" => "required",
                    "price.*" => "nullable|numeric",
                    "stock.*" => "required|numeric|min:0",
                ],
                [
                    "product_id.required" => "Product is required",
                    "color_code.required" => "Color code is required",
                    "color_name.required" => "Color name is required",
                    "product_image.*.image" =>
                        "Product image must be valid image",
                    "product_image.*.mimes" =>
                        "Product image must have extension jpg,png,jpeg",
                    "size.*.required" => "Size is required",
                    "price.*.required" => "Price is required",
                    "price.*.numeric" => "Price must be number",
                    "price.*.min" => "Price must be minimum 0",
                    "stock.*.required" => "Stock is required",
                    "stock.*.numeric" => "Stock must be number",
                    "stock.*.min" => "Stock must be minimum 0",
                ]
            );

            $input = $request->all();

            // if ($request->has("status") && $request->status == 1) {
            //     $input["status"] = 1;
            // } else {
            //     $input["status"] = 0;
            // }

            if (isset($input["product_image"]) && (count($input["product_image"]) > 0)) {
                foreach ($input["product_image"] as $key => $iimage) {
                    $attribute = new ProductAttribute();
                    $attribute->product_id = $request->product_id;
                    $attribute->color_code = $request->color_code;
                    $attribute->color_name = strtoupper($request->color_name);
                    $file = $iimage;
                    $orgName = $file->getClientOriginalExtension();
                    $filename =
                        $key . round(microtime(true) * 1000) . "." . $orgName;

                    Image::make($file)->save(
                        public_path("images/") . $filename
                    );
                    $attribute->product_variation_image = $filename;
                    $attribute->save();
                }
            }

            if (isset($input["size"]) && (count($input["size"]) > 0)) {
                foreach ($input["size"] as $i => $size) {
                    $product_sizes = new ProductSizes();
                    $product_sizes->product_id = $request->product_id;
                    $product_sizes->size = $request->size[$i];
                    $product_sizes->price = isset($request->price[$i]) ? $request->price[$i] :  0;
                    $product_sizes->stock = $request->stock[$i];
                    $product_sizes->save();
                }
            }

            return redirect()
                ->route("admin.product_attribute.index", $request->product_id)
                ->with("success_msg", "Product attribute added successfully.");
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product_attribute.index", $request->product_id)
                ->with("error_msg", "Product attribute cannot be added.");
        }
    }

    public function edit($id, Request $request)
    {
        $title = "Edit Product Attribute";
        $product = Product::find($id);
        $images = ProductAttribute::select("product_variation_image")->where("product_id", $id)
            ->get();
        $product_sizes = ProductSizes::where("product_id", $id)->get();
        return view(
            "backend/pages/product_attribute/edit",
            compact("images", "title","product", "product_sizes")
        );
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate(
                [
                    "product_id" => "required",
                    "color_code" => "required",
                    "color_name" => "required",
                    "product_image.*" => "nullable|image|mimes:jpg,png,jpeg",
                ],
                [
                    "product_id.required" => "Product is required",
                    "color_code.required" => "Color code is required",
                    "color_name.required" => "Color name is required",
                    "product_image.*.image" =>
                        "Product image must be valid image",
                    "product_image.*.mimes" =>
                        "Product image must have extension jpg,png,jpeg",
                ]
            );

            $input = $request->all();

            if ((isset($input["product_image"])) && (count($input["product_image"]) > 0)){
                foreach ($input["product_image"] as $key => $iimage) {
                    $attribute = new ProductAttribute();
                    $attribute->product_id = $request->product_id;
                    $attribute->color_code = $request->color_code;
                    $attribute->color_name = strtoupper($request->color_name);
                    $file = $iimage;
                    $orgName = $file->getClientOriginalExtension();
                    $filename =
                        $key . round(microtime(true) * 1000) . "." . $orgName;

                    Image::make($file)->save(
                        public_path("images/") . $filename
                    );
                    $attribute->product_variation_image = $filename;
                    $attribute->save();
                }
            }

            if (isset($input["size"]) && (count($input["size"]) > 0)) {
                ProductSizes::truncate();
                foreach ($input["size"] as $i => $size) {
                    $product_sizes = new ProductSizes();
                    $product_sizes->product_id = $request->product_id;
                    $product_sizes->size = $request->size[$i];
                    $product_sizes->price = $request->price[$i];
                    $product_sizes->stock = $request->stock[$i];
                    $product_sizes->save();
                }
            }

            return redirect()
                ->route("admin.product_attribute.index", $request->product_id)
                ->with(
                    "success_msg",
                    "Product attribute updated successfully."
                );
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product_attribute.index", $request->product_id)
                ->with("error_msg", "Product attribute cannot be updated.");
        }
    }

    public function destroy($id)
    {
        try {
            $attribute = ProductAttribute::find($id);
            File::delete("images/" . $attribute->product_variation_image);
            $attribute->delete();
            return redirect()
                ->route("admin.product_attribute.index", $attribute->product_id)
                ->with(
                    "success_msg",
                    "Product attribute deleted successfully."
                );
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product_attribute.index", $request->product_id)
                ->with("error_msg", "Product attribute cannot be deleted.");
        }
    }
}
