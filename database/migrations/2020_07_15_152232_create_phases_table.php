<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')
                ->references('id')
                ->on('competitions')
                ->onDelete('cascade');
            $table->string('name');
            $table->enum('mode', ['league', 'playoff', 'race']);
            $table->integer('num_participants');
            $table->integer('order');
            $table->boolean('active');
            $table->string('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phases');
    }
}
