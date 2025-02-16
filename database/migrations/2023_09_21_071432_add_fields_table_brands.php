<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('seo_title')->after("logo")->nullable();
            $table->string('seo_description')->after("seo_title")->nullable();
            $table->string('seo_keyword')->after("seo_description")->nullable();
            $table->string('schema')->after('seo_keyword')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
             $table->dropColumn(['seo_title', 'seo_description', 'seo_keyword']);
        });
    }
}
