<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->string('client_id')->primary();
            $table->string('client_name');
            $table->string('client_phone')->default(NULL)->nullable();
            $table->string('client_email')->default(NULL)->nullable();
            $table->string('client_whatsapp')->default(NULL)->nullable();
            $table->string('client_account_person')->default(NULL)->nullable();
            $table->string('client_address')->default(NULL)->nullable();
            $table->string('client_gstin')->default(NULL)->nullable();
            $table->enum('client_type', array('Regular', 'Pseudo'))->default('Regular')->nullable();
            $table->string('client_debit')->default(NULL)->nullable();
            $table->string('client_credit')->default(NULL)->nullable();
            $table->string('client_receivable')->default(0);
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
        Schema::dropIfExists('client');
    }
}
