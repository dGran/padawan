<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTablezonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues_tablezones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('tablezone_id')
                ->nullable()
                ->constrained('tablezones')
                ->onDelete('cascade');
            $table->integer('position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leagues_tablezones');
    }
}
