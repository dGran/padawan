<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('title');
            $table->enum('provider', array('youtube', 'twitch'));
            $table->string('video_id');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('races_videos');
    }
}
