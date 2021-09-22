@extends('layouts.app')

@section('title', 'Notifications | WebAcquire')

@section('content')

<div class="container">
    <div class="section d-flex flex-column align-items-center">
        <span class="my-underline-2"></span>
        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Notifications</h2>
    </div>
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ route('qna') }}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa fa-chevron-circle-left" ></i> Back to Q&A</span>
            </a>
        </div>
    </div>
    <div class="section">
        @if($notifications->count() > 0)
            <div>
                @foreach ($notifications as $notification)
                    <div class="@if (! $loop->first) section @endif reveal">
                        <div class="card d-flex my-card p-0 m-0 mb-4 @if (! $loop->first) @endif">
                            <div class="card-body d-flex justify-content-between section-divider">
                                @if ($notification->type === \App\Notifications\AnswerMarkedAsBest::class)
                                    <div>
                                        <h5 class="mt-2 text-hblack  faq-font">
                                            Your <strong class="text-orange">Answer</strong> Was Marked As Best Out Of <strong class="text-orange">{{ $notification->data['answer']['answers_count'] }}</strong> Answers
                                        </h5>
                                    </div>

                                    <div>
                                        <a href="{{ route('questions.show', $notification->data['answer']['slug']) }}"
                                            class="nav-link btn btn-outline-dark m-0 p-2 faq-font">
                                                View Question And Its Answers
                                        </a>
                                    </div>
                                @elseif ($notification->type === \App\Notifications\TooManyFavorites::class)

                                    <div class="pl-3 pr-3 text-hblack ">
                                        <h5 class="mt-2">
                                            Your <strong class="text-orange">Question</strong> Have More Than <strong class="text-orange">10</strong> Favorites
                                        </h5>
                                    </div>

                                    <div class="pl-3 pr-3">
                                        <a href="{{ route('questions.show', $notification->data['question']['slug']) }}"
                                            class="nav-link btn btn-outline-dark m-0 p-2">
                                            <div class="text-center">
                                                View Question
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            @include('layouts.User._no-notifications-found')
        @endif
    </div>
    <div class=" d-flex justify-content-center my-shadow ">
        {{ $notifications->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
