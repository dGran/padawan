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
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('day_id')
                ->nullable()
                ->constrained('leagues_days')
                ->onDelete('cascade');
            $table->foreignId('clash_id')
                ->nullable()
                ->constrained('playoffs_rounds_clashes')
                ->onDelete('cascade');
            $table->foreignId('local_id')
                ->constrained('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('local_user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('local_eteam_id')
                ->nullable()
                ->constrained('eteams')
                ->onDelete('cascade');
            $table->foreignId('visitor_id')
                ->constrained('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('visitor_user_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('cascade');
            $table->foreignId('visitor_eteam_id')
                ->nullable()
                ->constrained('eteams')
                ->onDelete('cascade');
            $table->integer("local_score")->nullable();
            $table->integer("visitor_score")->nullable();
            $table->integer("penalties_local_score")->nullable();
            $table->integer("penalties_visitor_score")->nullable();
            $table->dateTime('date_limit')->nullable();
            $table->integer("sanctioned_id")->unsigned()->nullable();
            $table->foreignId('user_update_result')
                ->nullable()
                ->constrained('users')
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
