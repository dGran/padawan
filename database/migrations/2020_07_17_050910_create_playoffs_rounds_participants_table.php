<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayoffsRoundsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playoffs_rounds_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('round_id')
                ->constrained('playoffs_rounds')
                ->onDelete('cascade');
            $table->foreignId('participant_id')
                ->constrained('groups_participants')
                ->on('groups_participants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playoffs_rounds_participants');
    }
}
