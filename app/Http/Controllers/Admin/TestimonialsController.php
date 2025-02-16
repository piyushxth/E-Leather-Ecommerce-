<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use File, Image;

class TestimonialsController extends Controller
{
    private $testimonial_upload_path;
    private $testimonial_width;
    private $testimonial_height;

    public function __construct()
    { 
        $this->middleware(["XssSanitizer"]);
        $this->testimonial_upload_path = public_path("images/testimonials/");
        $this->testimonial_width = 341;
        $this->testimonial_height = 331;
        if (!File::isDirectory($this->testimonial_upload_path)) {
            File::makeDirectory($this->testimonial_upload_path, 0777, true, true);
        }
    }

    public function index()
    {
        $title = "Testimonials";
        $testimonials = Testimonials::orderBy("testimonial_order","ASC")->get();
        return view("backend.pages.testimonial.index", compact("testimonials","title"));
    }

    public function create()
    {
        $title = "Create Testimonials";
        return view("backend.pages.testimonial.create", compact("title"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "testimonial_author" => "required",
            "testimonial_description" => "required|max:255",
            "testimonial_image" => "mimes:jpeg,jpg,png,gif",
            "testimonial_order" => "nullable|integer"
        ],[
            "testimonial_author.required" => "Testimonial author is required",
            "testimonial_description.required" =>
                    "Testimonials description is required",
            "testimonial_description.max" => "Testimonial description must not exceed more than 255 characters",
            "testimonial_image.mimes" =>
                    "Testimonials image must have following extension jpeg,jpg,png,gif",
            "testimonial_order.integer" =>
                    "Testimonials order must be number",
        ]);

        $input = $request->all();

        if (empty($input["testimonial_order"])) {
            $order = Testimonials::max("testimonial_order");
            $new_order = $order + 1;
            $input["testimonial_order"] = $new_order;
        }

        if ($request->hasFile("testimonial_image")) {
            $img_tmp    = $request->file("testimonial_image");
            $extension  = $img_tmp->getClientOriginalExtension();
            $filename   = time() . "." . $extension;

            $image = Image::make($img_tmp)->save(
                $this->testimonial_upload_path.$filename
            );

            Image::make($img_tmp->getRealPath())
                ->resize($this->testimonial_width, $this->testimonial_height)
                ->save($this->testimonial_upload_path . $filename);

            $input["testimonial_image"] = $filename;
        }

        $testimonial = Testimonials::create($input);

        return redirect()
            ->back()
            ->with("success_msg", "Testimonial added successfully.");
    }

    public function edit($id)
    {
        $title = "Create Testimonials";
        $testimonial = Testimonials::findOrFail($id);
        return view("backend.pages.testimonial.edit", compact("testimonial","title"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "testimonial_author" => "required",
            "testimonial_description" => "required|max:255",
            "testimonial_image" => "mimes:jpeg,jpg,png,gif",
            "testimonial_order" => "nullable|integer"
        ],[
            "testimonial_author.required" => "Testimonial author is required",
            "testimonial_description.required" =>
                    "Testimonials description is required",
            "testimonial_description.max" => "Testimonial description must not exceed more than 255 characters",
            "testimonial_image.mimes" =>
                    "Testimonials image must have following extension jpeg,jpg,png,gif",
            "testimonial_order.integer" =>
                    "Testimonials order must be number",
        ]);
        
        $input = $request->all();
        $testimonal = Testimonials::findOrFail($id);

        if ($request->hasFile("testimonial_image")) {
            File::delete($this->testimonial_upload_path.$testimonal->testimonial_image);

            if ($request->hasFile("testimonial_image")) {
                $img_tmp    = $request->file("testimonial_image");
                $extension  = $img_tmp->getClientOriginalExtension();
                $filename   = time() . "." . $extension;

                $image = Image::make($img_tmp)->save(
                    $this->testimonial_upload_path.$filename
                );

                Image::make($img_tmp->getRealPath())
                    ->resize($this->testimonial_width, $this->testimonial_height)
                    ->save($this->testimonial_upload_path . $filename);

                $input["testimonial_image"] = $filename;
            }
        }
        $testimonal->update($input);
        return redirect()
            ->back()
            ->with("success_msg", "Testimonial updated successfully.");
    }

    public function destroy($id)
    {
        $testimonal = Testimonials::findOrFail($id);
        if(!empty($testimonal)){
            File::delete($this->testimonial_upload_path.$testimonal->testimonial_image);
            $testimonal->delete();
            return redirect()
                ->back()
                ->with("success_msg", "Testimonial deleted successfully");
        } else {
            abort(404);
        }
    }
}
