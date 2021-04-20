<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirFilterCleaningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_filter_cleanings', function (Blueprint $table) {
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
        Schema::dropIfExists('air_filter_cleanings');
    }
}
