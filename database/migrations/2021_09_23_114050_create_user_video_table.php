<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVideoTable extends Migration
{
    public function up()
    {
        Schema::create('user_video', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_watch_later')->default(0);
            $table->tinyInteger('reactions')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('video_id');
            $table->timestamps();

            $table->unique(['user_id', 'video_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_video');
    }
}
