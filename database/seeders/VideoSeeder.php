<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            "video_title" => "",
            "video_slug" => "",
            "video_fallbackimage" => "",
            "video_url" => "",
        ]);
    }
}
