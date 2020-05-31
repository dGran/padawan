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
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('short_name');
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
