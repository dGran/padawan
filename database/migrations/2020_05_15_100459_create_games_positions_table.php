<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('category');
            $table->smallInteger('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_positions');
    }
}