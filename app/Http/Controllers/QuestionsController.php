<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index');
    }

    public function index()
    {
        $questions = Question::with('owner')->search()->latest()->paginate(10);
        return view('layouts.Q&A.Question.index', compact(['questions']));
    }

    public function store(CreateQuestionRequest $request)
    {
        $body = $request->body;
        $body = explode("<div>", $body)[1];
        $body = explode("</div>", $body)[0];

        auth()->user()->questions()->create([
            'title' => $request->title,
            'body' => $body
        ]);

        session()->flash('success', 'Question has been added successfully!');
        return redirect(route('questions.index'));
    }

    public function show(Question $question)
    {
        $question->viewsCountIncrement();
        return view('layouts.Q&A.Question.show', compact(['question']));
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);
        return view('layouts.Q&A.Question.edit', compact(['question']));
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $this->authorize('update', $question);
        $body = $request->body;
        $body = explode("<div>", $body)[1];
        $body = explode("</div>", $body)[0];
        $question->update([
            'title' => $request->title,
            'body' => $body
        ]);
        session()->flash('success', 'Question has been updated successfully!');
        return redirect(route('questions.show', $question->slug));
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        session()->flash('success', 'Question has been deleted successfully!');
        return redirect(route('questions.index'));
    }
}
