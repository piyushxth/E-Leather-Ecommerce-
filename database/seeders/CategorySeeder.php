<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "category_name" => "Leather Wears",
            "slug" => "leather-wears",
            "order" => 1,
            "parent_id" => NULL,
            "status" => 1,
            "category_image" => "",
            "featured_category" => 0,
            "seo_title" => "",
            "seo_description" => "",
            "seo_keyword" => "",
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);
    }
}
