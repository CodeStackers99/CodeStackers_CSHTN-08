@extends('layouts.app')
@section('title',  'Analyze Your Answers' | 'WebAcquire')

@section('content')
    <div class="container">
        <div class="section d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Questions You Answered Analysis</h2>
        </div>
        <div class="section card">
                <div class="card-body">
                    @foreach ($questionAnswers as $question)
                        <div class="card p-3 shadow mt-3 mb-3">
                            <h5 class="m-0 text-hblack font-weight-bold">Q{{$loop->iteration}}. <strong class="text-orange">{{App\Models\AssignmentQuestion::where('id', $question->assignment_question_id)->get()[0]->question_text}}</strong></h5>
                            @foreach (App\Models\AssignmentAnswer::where('assignment_question_id', $question->assignment_question_id)->get() as $answer)
                                <div class="input-group">
                                    <label for="" class="m-2 text-muted font-weight-bold">
                                        <input type="radio" name="answer_id{{$loop->parent->iteration}}" style="transform:scale(2);" class="mr-3" {{$answer->id == $question->assignment_answer_id ? 'checked' : ''}} disabled>{{$answer->answer_text}} <i class="fa {{$answer->is_correct ? 'fa-check fa-2x' : 'fa-cross'}}"></i>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <a href="{{route('quiz')}}"  class="btn btn-hblack">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection


