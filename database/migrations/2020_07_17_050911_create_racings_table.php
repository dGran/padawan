<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('racings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');
            $table->integer("num_races")->nullable()->default(1);
            $table->boolean('fastest_lap')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('racings');
    }
}
