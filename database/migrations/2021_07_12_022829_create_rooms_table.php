<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('room_type_id')->constrained('room_types');
            $table->foreignId('occupancy_id')->constrained('occupancies');
            $table->foreignId('rate_plan_id')->constrained('rate_plans')->nullable();
            $table->string('rate');
            $table->string('floor')->nullable();
            $table->string('number')->nullable();
            $table->longText('description')->nullable();
            $table->string('amount_extra_person')->nullable();
            $table->string('late_check_out')->nullable();
            $table->string('early_check_in')->nullable();
            $table->string('roll_away_bed')->nullable();
            $table->string('pet_fee')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
