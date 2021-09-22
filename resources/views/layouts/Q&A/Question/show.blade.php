@extends('layouts.app')
@section('title', 'Answers | WebAcquire')
@section('content')
<div class="container">
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ route('questions.index') }}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa phpdebugbar-fa-chevron-circle-left" ></i> Back to Questions</span>
            </a>
        </div>
        <div class="button ">
            <a
                href="@auth #answer-question @else {{ route('login') }}@endauth"
                id="scroll-to-answer-question"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text">Answer Now</span>
            </a>
        </div>
    </div>
    <div class="section">
        <div class="card my-card p-0 m-0 mb-4 mt-3">
            <div class="card-body">
                <div class="row justify-content-between pb-2">
                    <div class="col-md-6 profile d-flex">
                        <div class="img m-1">
                            <img
                                src="{{ $question->owner->image_path }}"
                                alt="{{ $question->owner->name }}"
                                class="profile-img"
                                title="{{ $question->owner->name }}"
                                width="120px"
                                height="120px">
                        </div>
                        <div class="name d-flex flex-column">
                            <h3 class="m-0 text-hblack"><strong class="p-1 text-hblack">{{ $question->owner->name }}</strong></h3>
                            <strong class="text-muted p-1">Asked {{ $question->created_date }}</strong>
                            <a href="#answers" class="p-1 mt-4 nav-link text-hblack" id="scroll-to-answers">{{$question->answers_count}} Answers <i class="fa fa-reply-all"></i></a>
                        </div>
                    </div>
                    <div class="activity">
                        <div class="m-0 d-flex flex-row-reverse">
                            <div class="d-flex flex-column m-0 mr-3 ml-1">
                                @can('markAsFavorite', $question)
                                    <form method="POST"
                                        action="{{route($question->is_favorite ? 'questions.unfavorite' : 'questions.favorite', $question->id)}}" class="m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="btn p-0 {{$question->favorite_style}}"
                                                title="{{$question->is_favorite ? 'Mark as unfavorite' : 'Mark as favorite'}}">
                                            <i class="fa fa-heart fa-2x {{$question->favorite_style}}" ></i>
                                        </button>
                                    </form>
                                @else
                                    <i class="fa fa-heart-o fa-2x text-danger d-block" ></i>
                                @endcan
                            </div>
                            @can('update', $question)
                                <div class="d-block mr-1 ml-1">
                                    <a
                                        href="{{ route('questions.edit', $question->id) }}"
                                        class="btn btn-sm btn-info"
                                        title="Edit your question">
                                        Edit <i class="fa fa-edit fa-lg" ></i>
                                    </a>
                                </div>
                            @endcan
                            @can('delete', $question)
                                <button
                                    class="btn btn-sm btn-danger mr-1 ml-1"
                                    onclick="displayModalToDeleteQuestion({{ $question->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteModalForQuestion"
                                    title="Delete your question">
                                    Delete <i class="fa fa-trash fa-lg" ></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="question-title pt-2 pb-2">
                    <h4 class="m-0"><strong class="text-primary" >{{ $question->title }}</strong></h4>
                </div>
                <div class="question-body pt-2 pb-2">
                    <strong class="text-muted">{!! $question->body !!}</strong>
                </div>
                <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                <div class="d-flex flex-row justify-content-around">
                    <div class="d-flex flex-row">
                        <div class="d-inline d-flex flex-column">
                            <div>
                                @auth
                                    <form action="{{ route('questions.vote', [$question->id, 1]) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                title="Up Vote"
                                                class="btn btn-link p-0 {{ auth()->user()->hasQuestionUpVote($question) ? 'text-dark' : 'text-black-50' }} "
                                        >
                                            <i class="fa fa-caret-up fa-2x "></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" title="Up Vote" class="vote-up text-center d-block text-black-50 btn btn-link p-0">
                                        <i class="fa fa-caret-up fa-2x "></i>
                                    </a>
                                @endauth
                            </div>
                            <div>
                                @auth
                                <form action="{{ route('questions.vote', [$question->id, -1]) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            title="Down Vote"
                                            class=" {{ auth()->user()->hasQuestionDownVote($question) ? 'text-dark' : 'text-black-50' }} btn btn-link p-0"
                                    >
                                        <i class="fa fa-caret-down fa-2x "></i>
                                    </button>
                                </form>
                                @else
                                    <a href="{{ route('login') }}" title="Down Vote" class="vote-down text-center d-block text-black-50 btn btn-link p-0">
                                        <i class="fa fa-caret-down fa-2x "></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
                        <div class="d-inline mt-3">
                            <h4 class="d-inline"><strong class="ml-1 font-weight-bold">{{$question->votes_count}}</strong></h4>
                            <h5 class="d-inline"><span class="text-muted"> votes</span></h5>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h4 class="d-inline"><strong class="mr-1 {{$question->favorite_style}}">{{$question->favorites_count}}</strong></h4>
                        <h5 class="d-inline"><span class="text-muted"> favourites</span></h5>
                    </div>
                    <div class="mt-3">
                        <h4 class="d-inline"><strong class="mr-1">{{$question->views_count}}</strong></h4>
                        <h5 class="d-inline"><span class="text-muted"> views</span></h5>
                    </div>
                </div>
            </div>
            <!--Delete Modal For Question-->
            @include('layouts.Q&A.Question._delete-modal')
        </div>
    </div>


</div>
@endsection
