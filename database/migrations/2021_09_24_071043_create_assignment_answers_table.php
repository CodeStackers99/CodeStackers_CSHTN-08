<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_answers', function (Blueprint $table) {
            $table->id();
            $table->text('answer_text');
            $table->tinyInteger('is_correct')->default(0);
            $table->unsignedBigInteger('assignment_question_id')->nullable();

            $table->foreign('assignment_question_id')->references('id')->on('assignment_questions')->onDelete('cascade');
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
        Schema::dropIfExists('assignment_answers');
    }
}
