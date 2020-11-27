<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayoffsRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playoff_id')
                ->constrained()
                ->onDelete('cascade');
            $table->string("name");
            $table->integer("num_participants")->nullable();
            $table->boolean("round_trip")->default(false);
            $table->boolean("double_value")->default(false);
            $table->dateTime('date_limit')->nullable();
            $table->integer("order")->default(1);
            $table->float('play_amount', 8, 2)->nullable();
            $table->float('play_ontime_amount', 8, 2)->nullable();
            $table->float('win_amount', 8, 2)->nullable();
            $table->float('lose_amount', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds');
    }
}
