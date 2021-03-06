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
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('circuit_id')
                ->constrained('games_circuits')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->dateTime('date')->nullable();
            $table->integer('laps')->nullable();
            $table->boolean('pre_qualifying')->default(false);
            $table->boolean('qualifying')->default(false);
            $table->string('slug');
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
