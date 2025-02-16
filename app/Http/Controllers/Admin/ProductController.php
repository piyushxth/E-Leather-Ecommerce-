<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\File;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ImageUpload;

    public function __construct()
    {
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $title = "Product List";
        $products = Product::orderBy("id", "desc")->get();
        return view(
            "backend/pages/product/index",
            compact("products", "title")
        );
    }

    public function create()
    {
        $title = "Create Product";
        $categories = Category::whereNull("parent_id")
            ->with("childrenCategories")
            ->get();
        $brand = Brand::orderBy("id", "asc")->get();
        $products = Product::orderBy("id", "asc")->get();
        return view(
            "backend/pages/product/create",
            compact("categories", "brand", "products", "title")
        );
    }

    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    "product_name" => "required|string|max:191",
                    "slug" => "required|unique:products,slug",
                    "regular_price" =>
                    "required|regex:/^\d{1,13}(\.\d{1,4})?$/",
                    "weight" => "nullable|regex:/^\d+(\.\d{1,2})?$/",
                    "special_price" =>
                    "nullable|lt:regular_price|regex:/^\d{1,13}(\.\d{1,4})?$/",
                    "brand_id" => "required",
                    "category_id" => "required",
                    "suitable_for" => "required",
                    //"description"=>"required|min:150",
                ],
                [
                    "product_name.required" => "Product name is required",
                    "product_name.string" => "Product name must be string",
                    "brand_id.required" => "brand  is required",
                    "product_name.max" =>
                    "Product name must not exceed more than 191 characters",
                    "slug.required" => "Slug is required",
                    "slug.unique" => "Slug must be unique",
                    "regular_price.required" => "Regular price is required",
                    "regular_price.regex" => "Regular price is must be number",
                    "weight.regex" => "weight  must be number",

                    "special_price.lt" =>
                    "Special price must be less than Regular Price",
                    "special_price.regex" => "Special price is must be number",
                    "category_id.required" => "Category is required",
                    "suitable_for.required" => "Suitable For is required"
                ]

            );

            $input = $request->all();

            if ($request->discount_percent > 0) {
                $input["special_price"] =
                    $request->regular_price -
                    ($request->regular_price * $request->discount_percent) /
                    100;
            } else {
                $input["special_price"] = 0;
            }

            if ($request->has("status") && $request->status == 1) {
                $input["status"] = 1;
            } else {
                $input["status"] = 0;
            }

            if ($request->has("sale") && $request->sale == 1) {
                $input["sale"] = 1;
            } else {
                $input["sale"] = 0;
            }
            if ($request->weight == ""||$request->weight == NULL) {
                $input["weight"] = 0;

            } else {
             $input["weight"] = $request->weight;
            }

            if ($request->hasFile("product_image")) {
                $input["product_image"] = $this->image_upload(
                    $request,
                    "product_image"
                );
            }
            $product = Product::create($input);

            foreach ($input["category_id"] as $key => $val) {
                $product_categories = new ProductCategories();
                $product_categories->category_id = $input["category_id"][$key];
                $product_categories->product_id = $product->id;
                $product_categories->save();
            }
            return redirect()
                ->route("admin.product.index")
                ->with("success_msg", "Product added successfully.");
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product.index")
                ->with("error_msg", "Product cannot be added.");
        }
    }

    public function edit(Product $product)
    {
        $title = "Edit Product";
        $product_id = $product->id;
        $categories = Category::whereNull("parent_id")
            ->with("childrenCategories")
            ->get();
        $brand = Brand::orderBy("id", "ASC")->get();
        $products = Product::with("category")
            ->whereNotIn('id', [$product_id])
            ->orderBy("id", "ASC")
            ->get();
        return view(
            "backend/pages/product/edit",
            compact("product", "categories", "brand", "products", "title")
        );
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate(
                [
                    "product_name" => "required|string|max:191",
                    "slug" => "required|unique:products,slug," . $product->id,
                    "regular_price" =>
                    "required|regex:/^\d{1,13}(\.\d{1,4})?$/",
                    "weight" => "nullable|regex:/^\d+(\.\d{1,2})?$/",

                    "brand_id" => "required",
                    "special_price" =>
                    "nullable|lt:regular_price|regex:/^\d{1,13}(\.\d{1,4})?$/",
                    "category_id" => "required",
                    "suitable_for" => "required",
                ],
                [
                    "product_name.required" => "Product name is required",
                    "product_name.string" => "Product name must be string",
                    "product_name.max" =>
                    "Product name must not exceed more than 191 characters",
                    "slug.required" => "Slug is required",
                    "slug.unique" => "Slug must be unique",
                    "regular_price.required" => "Regular price is required",
                    "regular_price.regex" => "Regular price is must be number",
                    "weight.regex" => "weight  must be number",

                    "special_price.lt" =>
                    "Special price must be less than Regular Price",
                    "special_price.regex" => "Special price is must be number",
                    "category_id.required" => "Category is required",
                    "suitable_for.required" => "Suitable For is required",
                    "brand_id.required" => "brand  is required",

                ]
            );

            $input = $request->all();
            if ($request->discount_percent > 0) {
                $input["special_price"] =
                    $request->regular_price -
                    ($request->regular_price * $request->discount_percent) /
                    100;
            } else {
                $input["special_price"] = 0;
            }

            if ($request->has("status") && $request->status == 1) {
                $input["status"] = 1;
            } else {
                $input["status"] = 0;
            }

            if ($request->has("sale") && $request->sale == 1) {
                $input["sale"] = 1;
            } else {
                $input["sale"] = 0;
            }
            if ($request->weight == ""||$request->weight == NULL) {
                $input["weight"] = 0;

            } else {
             $input["weight"] = $request->weight;
            }
            if ($request->hasFile("product_image")) {
                $input["product_image"] = $this->update_image(
                    $request,
                    $product->product_image,
                    "product_image"
                );
            }

            $product->category()->sync($input["category_id"]);
            // $product->sync($input["cross_selling_product"]);
            $product->update($input);
            return redirect()
                ->route("admin.product.index")
                ->with("success_msg", "Product updated successfully.");
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product.index")
                ->with("success_msg", "Product cannot be updated.");
        }
    }

    public function destroy(Product $product)
    {
        try {
            File::delete("images/" . $product->product_image);
            $product->delete();
            return redirect()
                ->route("admin.product.index")
                ->with("success_msg", "Product deleted successfully.");
        } catch (Exception $e) {
            return redirect()
                ->route("admin.product.index")
                ->with("error_msg", "Product cannot be deleted.");
        }
    }
}
