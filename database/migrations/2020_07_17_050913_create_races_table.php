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
                ->references('id')
                ->on('racings')
                ->onDelete('cascade');
            $table->foreignId('circuit_id')
                ->references('id')
                ->on('games_circuits')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('short_name');
            $table->dateTime('date')->nullable();
            $table->integer('laps')->nullable();
            $table->string('twitch_video_id')->nullable();
            $table->string('youtube_video_id')->nullable();
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
