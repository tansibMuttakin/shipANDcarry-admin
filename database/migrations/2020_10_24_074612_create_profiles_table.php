<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->double('balance')->default(0.0);
            $table->boolean('first_login')->default(true);
            $table->dateTime('last_active_datetime')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('profile_completed')->default(false);
            $table->boolean('profile_reviewed')->default(false);
            $table->boolean('profile_verified')->default(false);
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
        Schema::dropIfExists('profiles');
    }
}
