<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('img')->nullable();
            $table->boolean("stats_mvp")->default(false);
            $table->boolean("stats_goals")->default(false);
            $table->boolean("stats_assists")->default(false);
            $table->boolean("stats_yellow_cards")->default(false);
            $table->boolean("stats_red_cards")->default(false);
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
        Schema::dropIfExists('competitions');
    }
}
