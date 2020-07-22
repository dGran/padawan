<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')
                ->references('id')
                ->on('seasons')
                ->onDelete('cascade');
            $table->enum('type', ['default', 'participation', 'transfer', 'result', 'champion', 'press'])->nullable();
            $table->string('img')->nullable();
            $table->string('title');
            $table->text('content');
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
        Schema::dropIfExists('seasons_posts');
    }
}
