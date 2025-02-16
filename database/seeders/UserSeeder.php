<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "E-leather nepal",
            "email" => "admin@eleather.com",
            "phone" => "9745948260",
            "address" => "Bouddha, Kathmandu",
            "photo" => NULL,
            "role" => "admin",
            "provider" => NULL,
            "provider_id" => NULL,
            "status" => "active",
            "email_verified_at" => NULL,
            "password" => bcrypt("Admin@321"),
            "remember_token" => NULL,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);
    }
}
