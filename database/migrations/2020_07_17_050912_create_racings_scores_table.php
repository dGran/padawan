<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacingsScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racings_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('racing_id')
                ->references('id')
                ->on('racings')
                ->onDelete('cascade');
            $table->integer('position');
            $table->integer('score')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racings_scores');
    }
}
