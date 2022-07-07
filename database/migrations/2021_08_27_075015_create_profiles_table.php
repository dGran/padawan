<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->date('birthdate')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('twitch')->nullable();
            $table->string('discord')->nullable();
            $table->string('xbox_id')->nullable();
            $table->string('ps_id')->nullable();
            $table->string('steam_id')->nullable();
            $table->boolean('notifications')->default(true);
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
        Schema::dropIfExists('profiles');
    }
}
