<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provinces;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                "province_name" => "Province No. 1",
            ],
            [
                "province_name" => "Madesh",
            ],
            [
                "province_name" => "Bagmati",
            ],
            [
                "province_name" => "Gandaki",
            ],
            [
                "province_name" => "Lumbini",
            ],
            [
                "province_name" => "Karnali",
            ],
            [
                "province_name" => "Sudur Pashchim",
            ],
        ];
        foreach ($items as $item) {
            Provinces::updateOrCreate($item);
        }
    }
}
