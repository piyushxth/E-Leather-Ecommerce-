<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableAboutUs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->string("about_us_metatitle")->after("about_us_image")->nullable();
            $table->string("about_us_metakeyword")->after("about_us_metatitle")->nullable();
            $table->string("about_us_metadescription")->after("about_us_metakeyword")->nullable();
            $table->string("about_us_schema")->after("about_us_metadescription")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['about_us_metatitle', 'about_us_metakeyword', 'about_us_metadescription', 'about_us_schema']);
        });
    }
}
