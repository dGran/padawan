<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');
            $table->foreignId('participant_id')
                ->references('id')
                ->on('participants')
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
        Schema::dropIfExists('groups_participants');
    }
}
