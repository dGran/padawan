<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')
                ->references('id')
                ->on('tournaments')
                ->onDelete('cascade');
            $table->string('name');
            $table->enum('state', ['inscriptions', 'active', 'finished']);
            $table->integer('num_participants');
            $table->decimal('inscription_price', 5, 2)->nullable();
            $table->boolean('free_inscription')->default(false);
            $table->foreignId('players_databases_id')
                ->nullable()
                ->references('id')
                ->on('players_databases')
                ->onDelete('cascade');
            $table->integer('min_players')->nullable();
            $table->integer('max_players')->nullable();
            $table->decimal('initial_budget', 5, 2)->nullable();
            $table->integer('salary_cap')->nullable();
            $table->decimal('free_agents_default_salary', 5, 2)->nullable();
            $table->decimal('free_agents_default_price', 5, 2)->nullable();
            $table->decimal('free_agents_new_salary', 5, 2)->nullable();
            $table->decimal('free_agents_new_price', 5, 2)->nullable();
            $table->decimal('dismiss_remuneration', 5, 2)->nullable();
            $table->integer('clauses_max_paid')->nullable();
            $table->integer('clauses_max_received')->nullable();
            $table->decimal('clause_tax', 5, 2)->nullable();
            $table->boolean('period_salaries')->default(false);
            $table->boolean('period_transfers')->default(false);
            $table->boolean('period_free_players')->default(false);
            $table->boolean('period_clauses')->default(false);
            $table->boolean('allow_cessions')->default(false);
            $table->string('slug');
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
        Schema::dropIfExists('seasons');
    }
}
