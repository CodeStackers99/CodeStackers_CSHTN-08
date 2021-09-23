<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_user', function (Blueprint $table) {
            $table->id();
            $table->timestamp('completion_deadline')->nullable();
            $table->tinyInteger('is_completed')->default(0);
            $table->unsignedBigInteger('playlist_id');
            $table->unsignedBigInteger('user_id');

            $table->unique(['playlist_id', 'user_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('playlist_id')
                ->references('id')
                ->on('playlists')
                ->onDelete('cascade');

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
        Schema::dropIfExists('playlist_user');
    }
}
