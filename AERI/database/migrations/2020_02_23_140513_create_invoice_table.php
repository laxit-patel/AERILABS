<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('invoice_id')->primary();
            $table->string('invoice_inward');
            $table->foreign('invoice_inward')->references('inward_id')->on('inwards');
            $table->string('invoice_client');
            $table->foreign('invoice_client')->references('client_id')->on('clients');
            $table->string('invoice_amount');
            $table->string('invoice_tax');
            $table->string('invoice_qty');
            $table->string('invoice_total');
            $table->enum('invoice_type',array('GST', 'PAN','BILLOFSUPPLY'));
            $table->enum('invoice_status',array('Paid', 'Unpaid','Partial'));
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
        Schema::dropIfExists('invoice');
    }
}
