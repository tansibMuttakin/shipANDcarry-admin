<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('vehicle_brand_id');
            $table->unsignedInteger('weight_category_id');
            $table->double('body_length')->default(0.0);
            $table->double('body_width')->default(0.0);
            $table->double('body_height')->default(0.0);
            $table->double('vehicle_length')->default(0.0);
            $table->double('vehicle_width')->default(0.0);
            $table->double('vehicle_height')->default(0.0);
            $table->double('gross_weight')->default(0.0);
            $table->double('kerb_weight')->default(0.0);
            $table->double('permissible_weight')->default(0.0);
            $table->double('taken_weight')->default(0.0);
            $table->double('scale_limit')->default(0.0);
            $table->double('registered_weight')->default(0.0);
            $table->double('weight_capacity')->default(0.0);
            $table->double('body_cft')->default(0.0);
            $table->double('body_cbm')->default(0.0);
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
        Schema::dropIfExists('vehicle_models');
    }
}
