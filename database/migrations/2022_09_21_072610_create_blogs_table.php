<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("blog_title");
            $table->string("blog_slug");
            $table->longtext("blog_description");
            $table->string("blog_image");
            $table->string("blog_meta_title")->nullable();
            $table->text("blog_meta_description")->nullable();
            $table->integer("blog_status")->default(1)->comment('0=>unpublished,1=>published');
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
        Schema::dropIfExists('blogs');
    }
}
