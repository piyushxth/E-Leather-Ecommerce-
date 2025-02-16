<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\Review;
use App\Models\Brand;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        "cross_selling_product" => "array",
        "category_id" => "array",
    ];

    protected $fillable = [
        "product_name",
        "slug",
        "product_code",
        "regular_price",
        "special_price",
        "discount_percent",
        "description",
        "product_image",
        "weight",
        "status",
        "sale",
        "view_count",
        "cross_selling_product",
        "suitable_for",
        "brand_id",
        "seo_title",
        "seo_description",
        "seo_keyword",
        "schema"
    ];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function category()
    {
        return $this->belongsToMany(
            Category::class,
            "product_categories",
            "product_id",
            "category_id"
        );
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getReview()
    {
        return $this->hasMany("App\Models\Review", "product_id", "id")
            ->with("user_info")
            ->where("status", "active")
            ->orderBy("id", "DESC")
            ->take(10);
    }

    public static function getProductBySlug($slug)
    {
        return Product::with(["getReview", "category"])
            ->where("slug", $slug)
            ->first();

    }

    public static function getRelatedProducts($slug)
    {
        return Product::with(["category"])
            ->whereNotIn("slug", [$slug])->limit(12)
            ->get();

    }
}
