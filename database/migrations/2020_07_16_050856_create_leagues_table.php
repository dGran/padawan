<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained()
                ->onDelete('cascade');
            $table->boolean('allow_draws')->default(true);
            $table->float('win_points', 8, 2)->nullable()->default(3);
            $table->float('draw_points', 8, 2)->nullable()->default(1);
            $table->float('lose_points', 8, 2)->nullable()->default(0);
            $table->float('play_amount', 8, 2)->nullable();
            $table->float('play_ontime_amount', 8, 2)->nullable();
            $table->float('win_amount', 8, 2)->nullable();
            $table->float('draw_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('leagues');
    }
}
