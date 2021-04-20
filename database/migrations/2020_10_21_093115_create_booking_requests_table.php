<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('trip_no')->unique();
            $table->unsignedInteger('shipper_id');
            $table->unsignedInteger('carrier_id')->nullable();
            $table->unsignedInteger('driver_id')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->unsignedInteger('trip_status_id_status')->nullable();
            $table->unsignedInteger('request_status_id_status')->nullable();
            $table->unsignedInteger('goods_type_id')->nullable();
            $table->string('goods_photo')->nullable();
            $table->unsignedInteger('packaging_type_id')->nullable();
            $table->unsignedInteger('trip_type_id');
            $table->unsignedInteger('route_id');
            $table->unsignedInteger('pickup_address_id_address');
            $table->boolean('create_pickup_address_id_address')->default(1);
            $table->dateTime('pickup_datetime');
            $table->unsignedInteger('dropoff_address_id_address');
            $table->dateTime('dropoff_datetime');
            $table->unsignedInteger('weight_category_id')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('size')->nullable();
            $table->string('size_unit')->nullable();
            $table->string('trip_code');
            $table->double('estimateDistance')->default(0.0);
            $table->bigInteger('estimateTime')->default(0);
            $table->string('assistant_name')->nullable();
            $table->string('assistant_phone')->nullable();
            $table->string('assistant_nid')->nullable();
            $table->string('notes')->nullable();
            $table->unsignedInteger('fare_id')->nullable();
            $table->json('recipient_ids')->nullable();
            $table->json('trip_driver_ids')->nullable();
            $table->json('trip_vehicle_ids')->nullable();
            $table->json('trip_vehicle_type_ids')->nullable();
            $table->json('product_ids')->nullable();
            $table->json('timeline_ids')->nullable();
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
        Schema::dropIfExists('booking_requests');
    }
}
