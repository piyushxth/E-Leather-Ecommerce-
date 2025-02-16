<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Homepageextra;

class HomepageextraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Homepageextra::create([
            "homepageextra_bannerimage" => "",
            "homepageextra_bannerlink" => "",
            "homepageextra_shortdescription" => "",
            "homepageextra_shortdescriptionimg" => "",
            "homepageextra_shortdescriptionlink" => "",
            "homepageextra_mentileimg" => "",
            "homepageextra_mentilelink" => "",
            "homepageextra_womentileimg" => "",
            "homepageextra_womentilelink" => "",
            "homepageextra_kidtileimg" => "",
            "homepageextra_kidtilelink" => "",
        ]);
    }
}
