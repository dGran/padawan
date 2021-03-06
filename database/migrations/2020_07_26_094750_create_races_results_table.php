<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('group_participant_id')
                ->constrained('groups_participants')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('eteam_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->enum('type', array('pre-qualy', 'qualy', 'race'));
            $table->integer('position')->nullable();
            $table->time('time', 3)->nullable();
            $table->time('fastest_lap', 3)->nullable();
            $table->integer('sanction')->default(0);
            $table->enum('state', array('finished', 'retired', 'disqualified', 'not_shown'))->default('not_shown');
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
        Schema::dropIfExists('races_results');
    }
}
