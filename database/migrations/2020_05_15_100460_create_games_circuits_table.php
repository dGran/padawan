<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesCircuitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_circuits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('img')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
            $table->string('length')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_circuits');
    }
}
