<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageextrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepageextras', function (Blueprint $table) {
            $table->id();
            $table->string("homepageextra_bannerimage",255)->nullable();
            $table->string("homepageextra_bannerlink",255)->nullable();
            $table->text("homepageextra_shortdescription")->nullable();
            $table->string("homepageextra_shortdescriptionimg",255)->nullable();
            $table->string("homepageextra_shortdescriptionlink",255)->nullable();
            $table->string("homepageextra_mentileimg",255)->nullable();
            $table->string("homepageextra_mentilelink",255)->nullable();
            $table->string("homepageextra_womentileimg",255)->nullable();
            $table->string("homepageextra_womentilelink",255)->nullable();
            $table->string("homepageextra_kidtileimg",255)->nullable();
            $table->string("homepageextra_kidtilelink",255)->nullable();
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
        Schema::dropIfExists('homepageextras');
    }
}
