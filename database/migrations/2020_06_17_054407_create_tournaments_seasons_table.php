<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments_seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onDelete('cascade');
            $table->string('name')->unique();
            $table->enum('state', ['inscriptions', 'active', 'finished']);
            $table->integer('num_participants');
            $table->decimal('inscription_price', 5, 2)->nullable();
            $table->boolean('free_inscription')->default(false);
            $table->foreignId('db_rosters_id')
                ->references('id')
                ->on('db_rosters')
                ->onDelete('cascade');
            $table->integer('min_players')->nullable();
            $table->integer('max_players')->nullable();
            $table->decimal('initial_budget', 5, 2)->nullable();
            $table->integer('salary_cap')->nullable();
            $table->decimal('free_agents_salary', 5, 2)->nullable();
            $table->decimal('free_agents_new_salary', 5, 2)->nullable();
            $table->decimal('free_agents_new_cost', 5, 2)->nullable();
            $table->decimal('free_agents_new_remuneration', 5, 2)->nullable();
            $table->integer('clauses_max_paid')->nullable();
            $table->integer('clauses_max_received')->nullable();
            $table->boolean('clause_tax')->default(false);
            $table->boolean('period_salaries')->nullable();
            $table->boolean('period_transfers')->nullable();
            $table->boolean('period_free_players')->nullable();
            $table->boolean('period_clauses')->nullable();
            $table->boolean('allow_cessions')->nullable();
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
        Schema::dropIfExists('tournaments_seasons');
    }
}
