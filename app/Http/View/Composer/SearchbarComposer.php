<?php

namespace App\Http\View\Composer;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductSizes;
use App\Models\Category;

class SearchbarComposer
{
    public function compose(View $view)
    {
        $suitable_for_groups = suitable_for_groups();

        $group_slug = request()->segment(2);
        $categorySlug = request()->segment(3);
        $suitable_for_group_id = getGroupIdFromSlug($group_slug);
        $category_details      = Category::where(["slug" => $categorySlug])->first();

        $search_arr = [
            "status" => 1
        ];

        if($suitable_for_group_id == '' || $suitable_for_group_id == NULL)
        {
            $min_value = formatinr(Product::where($search_arr)->min('regular_price'));
            $max_value = formatinr(Product::where($search_arr)->max('regular_price'));

            $sizes_arr = ProductSizes::select("product_sizes.size")->join("products","products.id","=","product_sizes.product_id")->where($search_arr)->distinct()->get();
            $sizes = $sizes_arr;
            $categories = Category::select(["category_name","slug","status"])->whereNotNull('parent_id')->where(["status" => 1])->orderBy("order","ASC")->distinct('category_name')->get();

            //price with product sizes 
            //     "min_value" => ($suitable_for_group_id != '') ? formatinr(ProductSizes::join("products","products.id","=","product_sizes.product_id")->where(["products.suitable_for" => $suitable_for_group_id, "products.status" => 1])->min('product_sizes.price')) : formatinr(0),
            //     "max_value" => ($suitable_for_group_id != '') ? formatinr(ProductSizes::join("products","products.id","=","product_sizes.product_id")->where(["products.suitable_for" => $suitable_for_group_id, "products.status" => 1])->max('product_sizes.price')) : formatinr(0)
            
        }

        if($suitable_for_group_id != '' || $suitable_for_group_id != NULL)
        {
            
            $search_arr["suitable_for"] = $suitable_for_group_id;
            $min_value = ($suitable_for_group_id != '') ? formatinr(Product::where($search_arr)->min('regular_price')) : formatinr(0);
            $max_value = ($suitable_for_group_id != '') ? formatinr(Product::where($search_arr)->max('regular_price')) : formatinr(0);

            $sizes_arr = ProductSizes::select("product_sizes.size")->join("products","products.id","=","product_sizes.product_id")->where(["products.suitable_for" => $suitable_for_group_id, "products.status" => 1])->get();

            $sizes = $sizes_arr->unique();
            $categories = Category::select(["category_name","slug","status"])->whereNotNull('parent_id')->where(["status" => 1])->orderBy("order","ASC")->distinct('category_name')->get();

            //price with product sizes 
            //     "min_value" => ($suitable_for_group_id != '') ? formatinr(ProductSizes::join("products","products.id","=","product_sizes.product_id")->where(["products.suitable_for" => $suitable_for_group_id, "products.status" => 1])->min('product_sizes.price')) : formatinr(0),
            //     "max_value" => ($suitable_for_group_id != '') ? formatinr(ProductSizes::join("products","products.id","=","product_sizes.product_id")->where(["products.suitable_for" => $suitable_for_group_id, "products.status" => 1])->max('product_sizes.price')) : formatinr(0)
            
        }

        if($category_details != NULL){

            echo 'here2';exit;
            $search_arr["product_categories.category_id"] = $category_details->id;
            $min_value =  ($category_details != NULL) ? formatinr(Product::join("product_categories","product_categories.product_id","=","products.id")->where($search_arr)->min('products.regular_price')) : formatinr(0);
            $max_value =  ($category_details != NULL) ? formatinr(Product::join("product_categories","product_categories.product_id","=","products.id")->where($search_arr)->max('products.regular_price')) : formatinr(0);

            $sizes_arr = ProductSizes::select("product_sizes.size")
                ->join("products","products.id","=","product_sizes.product_id")
                ->join("product_categories","product_categories.product_id","=","product_sizes.product_id")
                ->where($search_arr)
                ->get();
             $sizes = $sizes_arr->unique();
             $categories = collect();
        }

        $pricesArray = [
            [
                "min_value" => $min_value,
                "max_value" => $max_value
            ],
        ];
        
        $view->with(
            [
                "search_suitable_for_groups" => $suitable_for_groups,
                "min_price" => min(array_column($pricesArray, 'min_value')),
                "max_price" => max(array_column($pricesArray, 'max_value')),
                "sizes" => $sizes,
                "categories" => $categories,
                "group_slug" => $group_slug,
                "categorySlug" => $categorySlug,
            ] 
        );
    }
}
