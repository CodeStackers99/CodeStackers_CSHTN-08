
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagVideoTable extends Migration
{
    public function up()
    {
        Schema::create('tag_video', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('video_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            $table->unique(['tag_id', 'video_id']);

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tag_video');
    }
}
