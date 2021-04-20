<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->date('registered_date');
            $table->unsignedInteger('carrier_id');
            $table->unsignedInteger('vehicle_brand_id');
            $table->unsignedInteger('vehicle_model_id');
            $table->unsignedInteger('vehicle_type_id');
            $table->unsignedInteger('weight_category_id');
            $table->double('body_length_ignore');
            $table->double('weight_taken_ignore');
            $table->unsignedInteger('address_id')->nullable();
            $table->smallInteger('service_cycle')->nullable();
            $table->string('service_cycle_unit')->nullable();
            $table->double('chamber_size')->nullable();
            $table->tinyInteger('oil_filter_required')->nullable();
            $table->tinyInteger('fuel_filter_required')->nullable();
            $table->tinyInteger('air_filter_required')->nullable();
            $table->smallInteger('meter_reading')->default(0);
            $table->double('mileage')->default(0);
            $table->string('brta_certificate_no')->nullable();
            $table->string('brta_certificate_photo');
            $table->string('road_permit_no')->nullable();
            $table->string('road_permit_photo');
            $table->string('tax_token_no')->nullable();
            $table->string('tax_token_photo');
            $table->string('fitness_certificate_no')->nullable();
            $table->string('fitness_certificate_photo');
            $table->string('insurance_no')->nullable();
            $table->string('insurance_photo');
            $table->string('registration_no')->unique();
            $table->string('owner_name')->nullable();
            $table->string('owner_nid_no');
            $table->string('owner_nid_front_photo');
            $table->string('owner_nid_back_photo');
            $table->date('owner_date_of_birth')->nullable();
            $table->boolean('onTrip')->default(false);
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
        Schema::dropIfExists('vehicles');
    }
}
