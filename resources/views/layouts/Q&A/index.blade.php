@extends('layouts.app')

@section('title', 'Questions and Answers | WebAcquire')

@section('content')

<div class="container">
    <div class="section questions reveal">
        <div class="d-flex flex-column align-items-center">
            <span class="my-underline-2"></span>
            <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Tap into the brainpower of thousands of experts worldwide</h2>
        </div>
            <div class="d-flex justify-content-between section-divider align-items-center">
                <div class="image col-md-6 mt-1">
                    <img src="{{asset('images/others/qna.png')}}" alt="qna" width="100%" class="">
                </div>
                <div class="content d-flex flex-column col-md-6">
                    <h1>
                        <strong
                            class="font-weight-bolder text-orange">
                                Ask Questions
                        </strong>
                    </h1>
                    <h1>
                        <strong
                            class="font-weight-bolder text-hblack">
                                Get Help
                        </strong>
                    </h1>
                    <h1>
                        <strong
                            class="font-weight-bolder text-hblack">
                                Go Beyond
                        </strong>
                    </h1>
                    <ul class="nav nav-pills nav-fill m-1">
                            <li class="nav-item m-1 my-list my-list-border">
                                <a
                                    href="{{ route('questions.index') }}"
                                    class="nav-link  p-1 ">All Questions <i class="fa fa-globe fa-lg"></i>
                                    @if ($questions->count() > 1000)
                                        (1000+)
                                    @else
                                        ({{$questions->count()}})
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item m-1 my-list my-list-border">
                                <a  href="{{ route('qna.yourQuestions') }}"
                                    class="nav-link  p-1 ">
                                    Your Questions <i class="fa fa-question-circle fa-lg"></i>
                                    @auth
                                        @if ($yourQuestions->count() > 1000)
                                            (1000+)
                                        @else
                                            ({{$yourQuestions->count()}})
                                        @endif
                                    @endauth
                                </a>
                            </li>
                      </ul>

                    <ul class="nav nav-pills nav-fill m-1">
                        <li class="nav-item m-1 my-list my-list-border">
                            <a
                                href="{{ route('qna.favorites') }}"
                                class="nav-link  p-1 ">
                                    Favorite Questions  <i class="fa fa-heart fa-lg"></i>
                                @auth
                                    @if ($favoriteQuestions->count() > 1000)
                                        (1000+)
                                    @else
                                        ({{$favoriteQuestions->count()}})
                                    @endif
                                @endauth
                            </a>
                        </li>
                        <li class="nav-item m-1 my-list my-list-border">
                            <a
                                href="{{ route('qna.notifications') }}"
                                class="nav-link  p-1 ">
                                    Notifications <i class="fa fa-bell fa-lg"></i>
                                    @auth
                                        @if($notificationsCount > 1000)
                                            (1000+)
                                        @else
                                            ({{ $notificationsCount }})
                                        @endif
                                    @endauth
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills nav-fill m-1">
                        <li class="nav-item m-1 my-list my-list-border">
                            <a
                                href="{{ route('qna.questionsYouAnswerd') }}"
                                class="nav-link  p-1 ">
                                    Questions you answered <i class="fa fa-trophy fa-lg"></i>
                                    @auth
                                    @if ($questionsYouAnswered->count() > 1000)
                                        (1000+)
                                    @else
                                        ({{$questionsYouAnswered->count()}})
                                    @endif
                                @endauth
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
