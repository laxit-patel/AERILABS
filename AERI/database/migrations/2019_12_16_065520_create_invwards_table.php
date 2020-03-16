<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inwards', function (Blueprint $table) {
            $table->string('inward_id')->primary();
            $table->string('inward_reference');
            $table->string('inward_client');
            $table->foreign("inward_client")->references('client_id')->on('clients');
            $table->string("inward_test"); 
            $table->string("inward_date");
            $table->string("inward_report_date");
            $table->string('inward_records', 1000);
            $table->string('inward_pending')->default(0);
            $table->string('inward_invoice_pending')->default(0);
            $table->string("inward_description");
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
        Schema::dropIfExists('invwards');
    }
}
