<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->text('description');
            $table->foreignId('user_id')->constrained('users');
            $table->string('stripe_id');
            $table->string('customer');
            $table->string('customer_email');
            $table->string('hosted_invoice_url')->nullable();
            $table->string('invoice_pdf')->nullable();
            $table->string('total');
            $table->string('details')->nullable();
            $table->string('trans_number')->nullable();
            $table->string('trans_date')->nullable();
            $table->string('trans_bank')->nullable();
            $table->text('note')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('fee_invoices');
    }
}
