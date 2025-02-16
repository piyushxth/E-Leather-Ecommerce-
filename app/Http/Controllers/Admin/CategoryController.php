<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\Facades\Image;
use App\Traits\ImageUpload;

class CategoryController extends Controller
{
    use ImageUpload;

    public function __construct()
    {
        $this->middleware(["XssSanitizer"]);
    }

    public function index()
    {
        $categories = Category::whereNull("parent_id")
            ->with("categories")
            ->orderBy("id", "asc")
            ->get();
        $title = "Categories";
        return view("backend/pages/category/index", compact("categories", "title"));
    }

    public function create()
    {
        $categories = Category::whereNull("parent_id")
            ->with("childrenCategories")
            ->get();
        $title = "Create Category";
        return view("backend/pages/category/create", compact("categories", "title"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "category_name" => "required|string|max:191",
            "slug" => "required|string|max:191",
            "order" => "nullable|integer|max:1000",
            "category_image" => "nullable|image|mimes:jpg,png,jpeg",
        ]);

        $input = $request->all();
        $input["slug"] = random_int(1000, 9999) . "-" . $input["slug"];
        if (empty($input["order"])) {
            $order = Category::max("order");
            $new_order = $order + 1;
            $input["order"] = $new_order;
        }

        if ($request->hasFile("category_image")) {
            $input["category_image"] = $this->image_upload(
                $request,
                "category_image"
            );
        }

        if ($request->featured) {
            $input["featured_category"] = $request->featured;
        } else {
            $input["featured_category"] = 0;
        }

        $input['parent_id'] = ($input['parent_id'] == '') ? NULL : $input['parent_id'];

        Category::create($input);

        return redirect()
            ->route("admin.category.index")
            ->with("success_msg", "Category created successfully.");
    }

    public function edit($id)
    {
        $categories = Category::whereNull("parent_id")
            ->with("childrenCategories")
            ->get();

        $editcategory = Category::find($id);
        $title = "Edit Category";
        return view(
            "backend/pages/category/edit",
            compact("categories", "editcategory", "title")
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "category_name" => "required|string|max:191," . $id,

            "order" => "nullable|integer|max:1000",
        ]);

        $input = $request->all();

        $category = Category::find($id);

        if ($request->has("status") && $request->status == 1) {
            $input["status"] = 1;
        } else {
            $input["status"] = 0;
        }

        if ($request->featured == 1) {
            $input["featured_category"] = 1;
        } else {
            $input["featured_category"] = 0;
        }

        if (empty($input["order"])) {
            $order = Category::max("order");

            $new_order = $order + 1;

            $input["order"] = $new_order;
        }

        $input['parent_id'] = ($input['parent_id'] == '') ? NULL : $input['parent_id'];

        if ($request->hasFile("category_image")) {
            $input["category_image"] = $this->update_image(
                $request,
                $category->category_image,
                "category_image"
            );
        }
        $category->update($input);
        return redirect()
            ->route("admin.category.index")
            ->with("success_msg", "Category updated successfully.");
    }

    public function destroy(Category $category)
    {
        $image_path = "images";

        if (file_exists($image_path . $category->category_image)) {
            unlink($image_path . $category->category_image);
        }

        $category->delete();

        return redirect()
            ->route("admin.category.index")
            ->with("success_msg", "Category deleted successfully.");
    }
}
