<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedTinyInteger('status')->default(0)->comment('0=>Inactive, 1=>Active');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_translations', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('locale', 2)->index();

            $table->string('text');
            $table->string('brief');

            $table->unique(['category_id', 'locale']);

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
