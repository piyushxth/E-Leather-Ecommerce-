<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(DistrictsSeeder::class);
        $this->call(AboutusSeeder::class);
        $this->call(VideoSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(HomepageextraSeeder::class);
    }
}
