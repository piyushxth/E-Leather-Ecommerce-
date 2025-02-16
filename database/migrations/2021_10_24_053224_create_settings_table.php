<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("settings", function (Blueprint $table) {
            $table->id();
            $table->string("email",255)->nullable();
            $table->string("phone_number",255)->nullable();
            $table->string("mobile_number",255)->nullable();
            $table->string("address",255)->nullable();
            $table->string("facebook_link",255)->nullable();
            $table->string("instagram_link",255)->nullable();
            $table->string("youtube_link",255)->nullable();
            $table->string("tiktok_link",255)->nullable();
            $table->longtext("google_map")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("settings");
    }
}
