<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTirePressuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tire_pressures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('carrier_id');
            $table->unsignedInteger('vehicle_id');
            $table->date('entry_date');
            $table->double("amount");
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
        Schema::dropIfExists('tire_pressures');
    }
}
