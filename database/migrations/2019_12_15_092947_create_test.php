<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->string('test_id')->primary();
            $table->string('test_iscode');
            $table->string("test_name");
            $table->string('test_material');
            $table->foreign("test_material")
            ->references('material_id')->on('materials');
            $table->string("test_rate");
            $table->string("test_rate_mes");;
            $table->string("test_worksheet");
            $table->string("test_report");
            $table->string("test_duration");
            $table->string('mode_amount')->nullable();
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
        Schema::dropIfExists('tests');
    }
}
