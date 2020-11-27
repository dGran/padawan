<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayoffsRoundsClashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds_clashes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('round_id')
                ->constrained('playoffs_rounds')
                ->onDelete('cascade');
            $table->integer("order")->default(1);
            $table->foreignId('local_id')
                ->constrained('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('visitor_id')
                ->constrained('groups_participants')
                ->onDelete('cascade');
            $table->integer("clash_destiny_id")->nullable();
            $table->dateTime('date_limit')->nullable();
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
        Schema::dropIfExists('playoffs_rounds_clashes');
    }
}
