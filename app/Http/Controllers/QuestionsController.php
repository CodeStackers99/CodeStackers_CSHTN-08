<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\CreateQuestionRequest;
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
        //
    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
