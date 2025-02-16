<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs,App\Models\Pages,App\Models\Brand,App\Models\Category, App\Models\Product;
use Carbon\Carbon;

class SitemapController extends Controller
{
    private $today;

    public function __construct()
    {
        $this->today = Carbon::now()->format("Y-m-d");
    }

    public function index()
    {
        $data_array = [
            "today"  => $this->today,
            "blogs"  => Blogs::where(["blog_status" => 1])->orderBy("created_at","DESC")->get(),
            "pages"  => Pages::orderBy("created_at","ASC")->get(),
            "brands" => Brand::orderBy("order","ASC")->get(),
            "categories" => Category::whereNull("parent_id")->where("status", "1")->orderBy("order", "ASC")->get(),
            "suitable_for_groups" => suitable_for_groups(),
            "products" => Product::orderBy("created_at", "ASC")->get(),
        ];

        $xml_content = view("frontend.sitemap.index", $data_array)->render();
        if (!file_exists(public_path("../sitemap.xml"))) {
            touch(public_path("../sitemap.xml"));
        }

        file_put_contents(public_path("../sitemap.xml"), $xml_content);

        return response()
            ->view("frontend.sitemap.index", $data_array)
            ->header("Content-Type", "text/xml");
    }
}