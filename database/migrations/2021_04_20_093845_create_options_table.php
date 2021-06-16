<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('min_model_year')->default(2010);
            $table->integer('cap_max_free_cancellation')->default(2)->comment('By minutes');
            $table->integer('towing_max_free_cancellation')->default(5)->comment('By minutes');
            $table->integer('cap_request_fees')->default(5)->comment('By minutes');
            $table->integer('towing_request_fees')->default(5);
            $table->integer('towing_min_balance')->default(8);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('options');
    }
}
