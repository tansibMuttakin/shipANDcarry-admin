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
            $table->increments('id');
            $table->unsignedInteger('shipper_id')->nullable();
            $table->unsignedInteger('preferred_route_id')->nullable();
            $table->unsignedInteger('booking_request_id')->nullable();
            $table->string('name');
            $table->integer('quantity')->nullable();
            $table->double('size')->nullable();
            $table->string('size_unit')->nullable();
            $table->double('total_size')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->double('total_weight')->nullable();
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
