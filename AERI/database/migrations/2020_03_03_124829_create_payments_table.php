<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('payment_id');
            $table->string('payment_mode');
            $table->string('payment_invoice');
            $table->foreign('payment_invoice')->references('invoice_id')->on('invoices');
            $table->string('payment_transaction');
            $table->foreign('payment_transaction')->references('transaction_id')->on('transactions');
            $table->string('payment_date');
            $table->string('payment_client');
            $table->foreign('payment_client')->references('client_id')->on('clients');
            $table->boolean('exists')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
