<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('fastest_lap')->default(false);
            $table->integer('score_fastest_lap')->default(0);
            $table->boolean('pre_qualifying')->default(false);
            $table->boolean('qualifying')->default(false);
            $table->integer('score_pole')->default(0);
            $table->boolean('times')->default(false);
            $table->boolean('show_circuit_flags')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racings');
    }
}
