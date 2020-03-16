<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->String('record_id')->primary();
            $table->String('record_inward');
            $table->foreign('record_inward')->references('inward_id')->on('inwards');
            $table->String('record_test');
            $table->foreign('record_test')->references('test_id')->on('tests');
            $table->String('record_assign_to')->default(NULL)->nullable();
            $table->foreign('record_assign_to')->references('id')->on('users');
            $table->String('record_invoice')->default(NULL)->nullable();
            $table->foreign('record_invoice')->references('invoice_id')->on('invoices');
            $table->String('record_qty');
            $table->String('record_price');
            $table->boolean("record_phase_one")->default(0);
            $table->boolean("record_phase_two")->default(0);
            $table->boolean("record_phase_three")->default(0);
            $table->boolean("record_phase_four")->default(0);
            $table->string("record_report_number")->default(NULL)->nullable();
            $table->string("record_report_file")->default(NULL)->nullable();
            $table->boolean("record_report_collected")->default(0)->nullable();
            $table->enum("record_status", array('Enlisted','Tested','Paid','Completed'));
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
        Schema::dropIfExists('records');
    }
}
