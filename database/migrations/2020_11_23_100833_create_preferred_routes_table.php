<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferredRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferred_routes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shipper_id');
            $table->unsignedInteger('goods_type_id')->nullable();
            $table->string('goods_photo')->nullable();
            $table->unsignedInteger('packaging_type_id')->nullable();
            $table->unsignedInteger('trip_type_id')->nullable();
            $table->unsignedInteger('route_id')->nullable();
            $table->unsignedInteger('pickup_address_id_address')->nullable();
            $table->unsignedInteger('dropoff_address_id_address')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->double('length')->nullable();
            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('size')->nullable();
            $table->string('size_unit')->nullable();
            $table->string('notes')->nullable();
            $table->string('recipient_ids')->nullable();
            $table->string('product_ids')->nullable();
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
        Schema::dropIfExists('preferred_routes');
    }
}
