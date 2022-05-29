<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEteamsInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eteams_invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eteam_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('captain_id')
                ->constrained('eteams_users')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->enum('state', ['pending', 'refused'])->nullable();
            $table->date('contract_from')->nullable();
            $table->date('contract_to')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('eteams_invitations');
    }
}
