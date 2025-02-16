<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug')->unique();
            $table->string('product_code');
            $table->float('regular_price');
            $table->float('special_price')->nullable();
            $table->integer('discount_percent')->nullable()->default(0);
            $table->longText('description')->nullable();
            $table->longText('product_image')->nullable();
            $table->boolean('status');
            $table->boolean('sale');
            $table->integer('view_count')->default(0);
            $table->json('cross_selling_product')->nullable();
            $table->json('category_id')->nullable();
            $table->integer('suitable_for')->default(1)->comment('1 > Male. 2 > Female, 3 > Kid');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')
            ->references('id')
            ->on('brands')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_keyword')->nullable();
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
        Schema::dropIfExists('products');
    }
}
