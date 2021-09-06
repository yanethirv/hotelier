<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('restaurant_theme_id')->constrained('restaurant_themes');
            $table->foreignId('restaurant_type_id')->constrained('restaurant_types');
            $table->foreignId('restaurant_location_id')->constrained('restaurant_locations');
            $table->string('how_many_pax')->nullable();
            $table->string('open_time')->nullable();
            $table->longText('closing_time')->nullable();
            $table->string('included')->nullable();
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
        Schema::dropIfExists('restaurants');
    }
}
