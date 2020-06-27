<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('img')->nullable();
            $table->enum('participant_type', ['individual', 'eteam']);
            $table->boolean('use_teams')->default(false);
            $table->boolean('use_rosters')->default(false);
            $table->boolean('use_economy')->default(false);
            $table->boolean('use_salaries')->default(false);
            $table->boolean('use_transfers')->default(false);
            $table->boolean('use_clauses')->default(false);
            $table->boolean('use_free_agents')->default(false);
            $table->text('rules')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
}
