<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')
                ->references('id')
                ->on('races')
                ->onDelete('cascade');
            $table->foreignId('group_participant_id')
                ->references('id')
                ->on('groups_participants')
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
            $table->integer('position');
            $table->time('time')->nullable();
            $table->boolean('lastest_lap')->default(false);
            $table->boolean('pre_qualifying')->default(false);
            $table->boolean('qualifying')->default(false);
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
        Schema::dropIfExists('races_results');
    }
}
