<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEteamsPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eteams_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eteam_id')
                ->references('id')
                ->on('eteams')
                ->onDelete('cascade');
            $table->foreignId('eplayer_id')
                ->references('id')
                ->on('eplayers')
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
        Schema::dropIfExists('eteams_players');
    }
}
