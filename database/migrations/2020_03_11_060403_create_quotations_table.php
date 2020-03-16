<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->string('quotation_id')->primary();
            $table->string('quotation_client');
            $table->foreign('quotation_client')->references('client_id')->on('clients');
            $table->string('quotation_items', 1000);
            $table->string('quotation_qty')->default(NULL)->nullable();
            $table->string('quotation_total')->default(NULL)->nullable();
            $table->enum('quotation_type',array('Draft','Initial','Revised'));
            $table->string('quotation_stack')->default(NULL)->nullable();
            $table->string('quotation_predecessor')->default(NULL)->nullable();
            $table->string('quotation_successor')->default(NULL)->nullable();
            $table->mediumText('quotation_terms')->default(NULL);
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
        Schema::dropIfExists('quotations');
    }
}
