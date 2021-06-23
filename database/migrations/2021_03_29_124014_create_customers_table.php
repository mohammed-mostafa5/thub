<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('housing_type')->nullable()->comment(' 1 => House, 2 => Apartment');
            $table->unsignedInteger('state_id')->nullable();
            $table->string('house_number')->nullable();
            $table->string('building_number')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('apartment_number')->nullable();

            $table->rememberToken();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });

        Schema::create('customer_donations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->dateTime('pickup_date')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0 => New, 1 => Active');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });

        Schema::create('donation_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('donation_id')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('donation_id')->references('id')->on('customer_donations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('donation_photos');
        Schema::drop('customer_donations');
        Schema::drop('customers');
    }
}
