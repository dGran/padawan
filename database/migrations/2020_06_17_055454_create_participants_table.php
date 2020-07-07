<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->references('id')
                ->on('seasons')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('eteam_id')
                ->nullable()
                ->references('id')
                ->on('eteams')
                ->onDelete('cascade');
            $table->foreignId('team_id')
                ->nullable()
                ->references('id')
                ->on('teams')
                ->onDelete('cascade');
            $table->boolean('reserve')->default(false);
            $table->integer('clauses_paid')->nullable();
            $table->integer('clauses_received')->nullable();
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
        Schema::dropIfExists('participants');
    }
}
