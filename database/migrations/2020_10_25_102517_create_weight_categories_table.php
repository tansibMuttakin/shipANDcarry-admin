<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fare_id');
            $table->boolean('create_fare_id')->default(1);
            $table->string('name');
            $table->double('minWeight');
            $table->double('maxWeight');
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
        Schema::dropIfExists('weight_categories');
    }
}
