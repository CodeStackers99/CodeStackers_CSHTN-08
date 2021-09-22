@extends('layouts.app')
@section('title', 'Questions | WebAcquire')

@section('content')
<div class="container">
    <div class="section d-flex flex-column align-items-center">
        <span class="my-underline-2"></span>
        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">All Questions</h2>
    </div>
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ route('qna') }}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa phpdebugbar-fa-chevron-circle-left" ></i> Back to Q&A</span>
            </a>
        </div>
        <div class="d-flex justify-content-end flex-row">
            <div class="button ">
                <a
                    href="@auth #ask-question @else {{ route('login') }}@endauth"
                    id="scroll-to-ask-question"
                    class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                    <span class="styled-button-text">Ask Question</span>
                </a>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="row justify-content-center">
            <div class="col-md-16">
                @foreach ($questions as $question)
                <div class="@if (! $loop->first) section @endif col-md-12 reveal">
                    <div class="card my-card p-0 m-0 mb-4 @if (! $loop->first) @endif">
                        <div class="card-body d-flex section-divider">
                            <div class="col-md-6 d-flex flex-row m-1 border-left-8 {{ $question->border_style }}">
                                <div class="img m-1 d-flex flex-column justify-content-center">
                                    <img
                                        src="{{ $question->owner->image_path }}"
                                        alt="{{ $question->owner->name }}"
                                        class="profile-img"
                                        title="{{ $question->owner->name }}"
                                        width="120px"
                                        height="120px">
                                </div>
                                <div class="content m-1">
                                    <div class="title m-1">
                                        <a href="{{ $question->url }}" class="nav-link m-0 p-0 faq-font"><strong>{{ $question->title }}</strong></a>
                                    </div>
                                    <div class="body m-1 ">
                                        <p class="text-muted m-0 faq-font">{!! $question->limited_question !!}</p>
                                    </div>
                                    <div class="action-buttons d-flex m-1">
                                        @can('update', $question)
                                            <a
                                                href="{{ route('questions.edit', $question->id) }}"
                                                class="btn btn-sm btn-info mr-1"
                                                title="Edit your question">
                                                Edit <i class="fa fa-edit" ></i>
                                            </a>
                                        @endcan
                                        @can('delete', $question)
                                            <button
                                                class="btn btn-sm btn-danger ml-1"
                                                onclick="displayModalToDeleteQuestion({{ $question->id }})"
                                                data-toggle="modal"
                                                data-target="#deleteModalForQuestion"
                                                title="Delete your question">
                                                Delete <i class="fa fa-trash" ></i>
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 border-left-2 d-flex flex-column">
                                <div class="statistics d-flex justify-content-around">
                                    <div class="votes mb-1 text-muted my-border pl-3 pr-3">
                                        {{Str::plural('Vote', $question->votes_count)}}
                                        <strong class="d-block text-dark">{{ $question->votes_count }}</strong>
                                    </div>
                                    <a href="{{$question->url}}" class="nav-link m-0 p-0">
                                        <div class="text-center mb-1 answers  {{ $question->answer_style }}">
                                            {{Str::plural('Answer', $question->answers_count)}}
                                                <strong class="d-block ">{{ $question->answers_count }}</strong>
                                        </div>
                                    </a>
                                    <div class="views text-center text-muted my-border pl-3 pr-3">
                                        {{Str::plural('View', $question->views_count)}}
                                        <strong class="d-block text-dark">{{ $question->views_count }}</strong>
                                    </div>
                                </div>
                                <hr style="height:2px;border-width:0;color:#999;background-color:#999; width:100%;">
                                <div class="d-flex justify-content-around">
                                    <div class="text-center mb-1 my-border pl-3 pr-3">
                                        <strong class="d-block text-muted">Asked</strong>
                                        <strong class="text-dark m-0 p-0">{{ $question->created_date }}</strong>
                                    </div>
                                    <div class="text-center mb-1 my-border pl-3 pr-3">
                                        <strong class="d-block text-muted">Favorites</strong>
                                        <strong class="text-dark m-0 p-0">{{ $question->favorites_count }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!--Delete Modal For Question-->
            @include('layouts.Q&A.Question._delete-modal')
        </div>
    </div>
   
    <div class=" d-flex justify-content-center my-shadow ">
        {{ $questions->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
