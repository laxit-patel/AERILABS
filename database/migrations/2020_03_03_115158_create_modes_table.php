<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->string('mode_id')->primary();
            $table->enum('mode_type',array('Cash', 'Check', 'N.E.F.T', 'R.T.G.S'));
            $table->string('mode_bank')->nullable();
            $table->string('mode_date')->nullable();
            $table->string('mode_reference')->nullable();
            $table->string('mode_entity')->nullable();
            $table->string('mode_amount')->nullable();
            $table->string('mode_description')->nullable();
            $table->boolean('mode_reflected')->default(0);
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
        Schema::dropIfExists('modes');
    }
}
