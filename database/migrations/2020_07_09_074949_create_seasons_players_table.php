<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsPlayersTable extends Migration
{
    public function up()
    {
        Schema::create('seasons_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('player_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('participant_id')
                ->default(0)
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('pack_id')
                ->nullable()
                ->constrained('players_packs')
                ->onDelete('cascade');
            $table->decimal("salary")->default(0.5);
            $table->integer("price")->default(5);
            $table->boolean('allow_clause_pay')->default(1);
            $table->boolean('untransferable')->default(0)->index();
            $table->boolean('transferable')->default(0)->index();
            $table->decimal('sale_price')->nullable()->default(0);
            $table->boolean('sale_auto_accept')->default(0);
            $table->boolean('player_on_loan')->default(0)->index();
            $table->string('market_phrase', 80)->nullable();
            $table->foreignId('owner_id')
                ->default(0)
                ->constrained('participants')
                ->onDelete('cascade');
            $table->boolean('active')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seasons_players');
    }
}
