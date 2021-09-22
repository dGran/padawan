<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEteamsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eteams_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eteam_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('owner')->default(false);
            $table->boolean('captain')->default(false);
            $table->foreignId('game_position_id')
                ->nullable()
                ->constrained('games_positions')
                ->onDelete('cascade');
            $table->date('contract_from')->nullable();
            $table->date('contract_to')->nullable();
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
        Schema::dropIfExists('eteams_users');
    }
}
