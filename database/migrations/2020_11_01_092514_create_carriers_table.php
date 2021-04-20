<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->nullable();
            $table->string('type');
            $table->string('userProfile_photo')->nullable();
            $table->string('phone')->unique();
            $table->string('name');
            $table->string('api_token');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('profile_id');
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('address_id');
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('nid_front_photo')->nullable();
            $table->string('nid_back_photo')->nullable();
            $table->string('trade_license_no')->nullable();
            $table->string('trade_license_front_photo')->nullable();
            $table->string('trade_license_back_photo')->nullable();
            $table->double('commission')->default(10.0);
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
        Schema::dropIfExists('carriers');
    }
}
