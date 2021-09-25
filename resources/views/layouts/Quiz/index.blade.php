@extends('layouts.app')

@section('title', 'Quiz History | WebAcquire')

@section('content')

<div class="container">
    <div class="section d-flex flex-column align-items-center">
        <span class="my-underline-2"></span>
        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Quiz History</h2>
    </div>
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ route('dashboard') }}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa fa-chevron-circle-left" ></i> Back to Dashboard</span>
            </a>
        </div>
    </div>
    <div class="section">
        @if($quizUndertaken->count() > 0)
            <div>
                @foreach ($quizUndertaken as $quiz)
                    <div class="@if (! $loop->first) section @endif reveal">
                        <div class="card d-flex my-card p-0 m-0 mb-4 @if (! $loop->first) @endif">
                            <div class="card-body d-flex justify-content-between section-divider">
                                    <div>
                                        <h5 class="mt-2 text-hblack  faq-font">
                                            <strong class="text-orange">You </strong> Undertook A Quiz <strong class="text-orange">{{ $quiz->updated_at->diffForHumans() }}</strong>
                                        </h5>
                                    </div>

                                    <div>
                                        <a href="{{route('quiz.analyze', $quiz->id)}}"
                                            class="nav-link btn btn-outline-dark m-0 p-2 faq-font">
                                                Scored {{$quiz->marks_obtained}} / {{$quiz->total_questions}}
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @include('layouts.Quiz._no-quiz-found')
        @endif
    </div>
</div>
@endsection
