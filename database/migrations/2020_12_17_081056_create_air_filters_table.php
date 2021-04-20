<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('carrier_id');
            $table->unsignedInteger('vehicle_id');
            $table->date('entry_date');
            $table->integer('meter_reading');
            $table->tinyInteger('quantity');
            $table->string('brand')->nullable();
            $table->double("amount");
            $table->double("additional_cost")->default(0.0);
            $table->double("total");
            $table->string("notes")->nullable();
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
        Schema::dropIfExists('air_filters');
    }
}
