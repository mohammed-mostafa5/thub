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
            $table->increments('id')->from(1000);
            $table->decimal('old_price');
            $table->decimal('price');
            $table->integer('stock');
            $table->unsignedTinyInteger('status')->default(1)->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('locale', 2)->index();

            $table->string('title');
            $table->string('brief');
            $table->text('description');

            $table->unique(['product_id', 'locale']);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });


        Schema::create('product_color', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('color_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_translations');
        Schema::drop('products');
    }
}
