<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')
                ->references('id')
                ->on('competitions')
                ->onDelete('cascade');
            $table->foreignId('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');
            $table->foreignId('day_id')
                ->nullable()
                ->references('id')
                ->on('leagues_days')
                ->onDelete('cascade');
            $table->foreignId('clash_id')
                ->nullable()
                ->references('id')
                ->on('playoffs_rounds_clashes')
                ->onDelete('cascade');
            $table->foreignId('local_id')
                ->references('id')
                ->on('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('local_user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('local_eteam_id')
                ->nullable()
                ->references('id')
                ->on('eteams')
                ->onDelete('cascade');
            $table->foreignId('visitor_id')
                ->references('id')
                ->on('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('visitor_user_id')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreignId('visitor_eteam_id')
                ->nullable()
                ->references('id')
                ->on('eteams')
                ->onDelete('cascade');
            $table->integer("local_score")->nullable();
            $table->integer("visitor_score")->nullable();
            $table->integer("penalties_local_score")->nullable();
            $table->integer("penalties_visitor_score")->nullable();
            $table->dateTime('date_limit')->nullable();
            $table->integer("sanctioned_id")->unsigned()->nullable();
            $table->foreignId('user_update_result')
                ->nullable()
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->datetime("date_update_result")->nullable();
            $table->integer('order')->default(1);
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
