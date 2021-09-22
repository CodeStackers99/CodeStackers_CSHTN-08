<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\UpdateAnswerRequest;
use App\Http\Requests\Answer\CreateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Notifications\AnswerMarkedAsBest;

class AnswersController extends Controller
{
    public function store(Question $question, CreateAnswerRequest $request)
    {
        $body = $request->body;
        $body = explode("<div>", $body)[1];
        $body = explode("</div>", $body)[0];

        $question->answers()->create([
            'body' => $body,
            'user_id' => auth()->id()
        ]);
        session()->flash('success', 'Your answer submitted successfully!');
        return redirect(route('questions.show', $question->slug));
    }

    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('layouts.Q&A.Answer.edit', compact(['question', 'answer']));
    }

    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $body = $request->body;
        $body = explode("<div>", $body)[1];
        $body = explode("</div>", $body)[0];

        $answer->update([
            'body' => $body,
        ]);
        session()->flash('success', 'Your answer was updated successfully!');
        return redirect(route('questions.show', $question->slug));
    }

    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();

        session()->flash('success', 'Your answer was deleted successfully!');
        return redirect()->back();
    }

    public function markBestAnswer(Answer $answer)
    {
        $this->authorize('markAsBest', $answer);
        $answer->question->update([
            'best_answer_id' => $answer->id
        ]);
        $answer->author->notify(new AnswerMarkedAsBest($answer));
        session()->flash('success', 'Answer has been marked as BEST ANSWER.');
        return redirect()->back();
    }
    public function unmarkBestAnswer(Answer $answer)
    {
        $this->authorize('markAsBest', $answer);
        $answer->question->update([
            'best_answer_id' => null
        ]);
        session()->flash('success', 'Answer has been Unmarked from BEST ANSWER.');
        return redirect()->back();
    }
}
