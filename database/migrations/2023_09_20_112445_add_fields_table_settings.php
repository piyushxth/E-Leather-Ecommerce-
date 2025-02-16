<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string("metatitle")->after("google_map")->nullable();
            $table->string("metakeyword")->after("metatitle")->nullable();
            $table->string("metadescription")->after("metakeyword")->nullable();
            $table->string("schema")->after("metadescription")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['metatitle', 'metakeyword', 'metadescription', 'schema']);
        });
    }
}
