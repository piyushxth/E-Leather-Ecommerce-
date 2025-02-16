<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTablePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string("page_metatitle")->after("page_image")->nullable();
            $table->string("page_metakeyword")->after("page_metatitle")->nullable();
            $table->string("page_metadescription")->after("page_metakeyword")->nullable();
            $table->string("page_schema")->after("page_metadescription")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn(['page_metatitle', 'page_metakeyword', 'page_metadescription', 'page_schema']);
        });
    }
}
