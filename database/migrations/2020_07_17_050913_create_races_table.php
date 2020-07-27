<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('racing_id')
                ->references('id')
                ->on('racings')
                ->onDelete('cascade');
            $table->foreignId('circuit_id')
                ->nullable()
                ->references('id')
                ->on('games_circuits')
                ->onDelete('cascade');
            $table->integer('laps')->nullable();
            $table->boolean('pre_qualifying')->default(false);
            $table->boolean('qualifying')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('races');
    }
}
