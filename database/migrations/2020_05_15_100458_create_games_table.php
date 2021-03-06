<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('platform_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name');
            $table->string('img')->nullable();
            $table->string('banner')->nullable();
            $table->boolean('mode_league')->default(false);
            $table->boolean('mode_playoffs')->default(false);
            $table->boolean('mode_races')->default(false);
            $table->boolean('rosters')->default(false);
            $table->boolean('positions')->default(false);
            $table->boolean('circuits')->default(false);
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
