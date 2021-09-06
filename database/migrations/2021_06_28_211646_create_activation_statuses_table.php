<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivationStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activation_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activation_service_transaction_id')->constrained('activation_service_transactions');
            $table->text('comment');
            $table->foreignId('request_status_id')->constrained('request_statuses');
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
        Schema::dropIfExists('activation_statuses');
    }
}
