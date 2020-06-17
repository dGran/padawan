<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('roster_db_id')
                ->references('id')
                ->on('players_databases')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('img')->nullable();
            $table->string('team_name')->nullable();
            $table->string('nation_name')->nullable();
            $table->string('league_name')->nullable();
            $table->foreignId('position_id')
                ->references('id')
                ->on('games_positions')
                ->onDelete('cascade');
            $table->integer('height')->nullable();
            $table->integer('age')->nullable();
            $table->enum('foot', ['left', 'right'])->nullable();
            $table->integer('overall_rating')->nullable();
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
        Schema::dropIfExists('players');
    }
}
