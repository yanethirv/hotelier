<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')->constrained('experiences');
            $table->foreignId('property_id')->constrained('properties');
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
        Schema::dropIfExists('experience_property');
    }
}
