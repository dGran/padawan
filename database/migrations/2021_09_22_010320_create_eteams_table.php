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
                ->constrained()
                ->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('short_name', 3);
            $table->string('logo')->nullable();
            $table->foreignId('country_id')
                ->nullable()
                ->constrained('countries')
                ->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('slug');
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
