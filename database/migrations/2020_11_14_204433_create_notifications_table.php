<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('eteam_request_id')
                ->nullable()
                ->constrained('eteams_requests')
                ->onDelete('cascade');
            // $table->foreignId('trade_id')
            //     ->nullable()
            //     ->constrained()
            //     ->onDelete('cascade');
            $table->foreignId('match_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->text('text');
            $table->boolean('read')->default(0);
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
        Schema::dropIfExists('notifications');
    }
}
