@extends('layouts.app')
@section('title',  $assignment->title.' | WebAcquire')

@section('content')
    <div class="container">
        <div class="section d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Quiz Based On Full Stack Web Development</h2>
        </div>
        <div class="section card">
            <form action="{{route('quiz.check')}}" method="POST" id="solve-assignemnt">
                @csrf
                <div class="card-body">
                    @foreach ($assignmentQuestions as $question)
                        <div class="card p-3 shadow mt-3 mb-3">
                            <h5 class="m-0 text-hblack font-weight-bold">Q{{$loop->iteration}}. <strong class="text-orange">{{$question->question_text}}</strong></h5>
                            <input type="hidden" value="{{$question->id}}" name="question_id{{$loop->iteration}}">
                            @foreach ($question->assignmentAnswers as $answer)
                                <div class="input-group">
                                    <label for="" class="m-2 text-muted font-weight-bold">
                                        <input type="radio" name="answer_id{{$loop->parent->iteration}}" value="{{$answer->id}}" style="transform:scale(2);" class="mr-3">{{$answer->answer_text}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-hblack">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
