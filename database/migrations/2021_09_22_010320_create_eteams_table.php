<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eteams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('short_name', 3);
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->onDelete('cascade');
            $table->string('location')->nullable();
            $table->text('presentation')->nullable();
            $table->string('presentation_video')->nullable();
            $table->string('website')->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitch')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('eteams');
    }
}
