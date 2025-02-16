<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pages;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                "page_title" => "Leather Maintanance",
                "page_slug" => "leather-maintanance",
                "page_description" => "",
                "page_image" => "",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                "page_title" => "Return & Refunds",
                "page_slug" => "return-refunds",
                "page_description" => "",
                "page_image" => "",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                "page_title" => "Terms & Condition",
                "page_slug" => "terms-condition",
                "page_description" => "",
                "page_image" => "",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ],
            [
                "page_title" => "Privacy Policy",
                "page_slug" => "privacy-policy",
                "page_description" => "",
                "page_image" => "",
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]
        ];
        foreach ($pages as $page) {
            Pages::updateOrCreate($page);
        }
    }
}
