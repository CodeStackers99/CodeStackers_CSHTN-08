<div class="d-flex flex-column align-items-center mt-5 reveal">
    <span class="my-underline-2"></span>
    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading" id="answers">Answers</h2>
</div>
@if($question->answers->count() > 0)
    <div class="col-md-16">
        @foreach ($question->answers as $answer)
        <div class="section card my-card p-0 reveal">
            <div class="card-body">
                <div class="row justify-content-between pb-2">
                    <div class="col-md-6 profile d-flex">
                        <div class="img m-1">
                            <img
                                src="{{ $answer->author->image_path }}"
                                alt="{{ $answer->author->name }}"
                                class="profile-img"
                                title="{{ $answer->author->name }}"
                                width="120px"
                                height="120px">
                        </div>
                        <div class="name d-flex flex-column">
                            <h3 class="m-0"><strong class="p-1">{{ $answer->author->name }}</strong></h3>
                            <strong class="text-muted p-1">Answered {{ $answer->created_date }}</strong>
                            <div class="d-flex flex-row ml-1">
                                <div class="d-flex flex-row">
                                    <div class="d-inline d-flex flex-column">
                                        <div>
                                            @auth
                                                <form action="{{ route('answers.vote', [$answer->id, 1]) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                            title="Up Vote"
                                                            class="btn btn-link p-0 {{ auth()->user()->hasAnswerUpVote($answer) ? 'text-dark' : 'text-black-50' }}"
                                                    >
                                                        <i class="fa fa-caret-up fa-2x"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('login') }}" title="Up Vote" class="vote-up text-center d-block text-black-50">
                                                    <i class="fa fa-caret-up fa-2x btn btn-link p-0"></i>
                                                </a>
                                            @endauth
                                            @auth
                                            <form action="{{ route('answers.vote', [$answer->id, -1]) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        title="Down Vote"
                                                        class=" {{ auth()->user()->hasAnswerDownVote($answer) ? 'text-dark' : 'text-black-50' }} btn btn-link p-0"
                                                >
                                                    <i class="fa fa-caret-down fa-2x"></i>
                                                </button>
                                            </form>
                                            @else
                                                <a href="{{ route('login') }}" title="Down Vote" class="vote-down text-center d-block text-black-50 btn btn-link p-0">
                                                    <i class="fa fa-caret-down fa-2x"></i>
                                                </a>
                                            @endauth
                                        </div>
                                    </div>
                                    <div class="d-inline mt-3">
                                        <h4 class="d-inline"><strong class="ml-1 font-weight-bold">{{$answer->votes_count}}</strong></h4>
                                        <h5 class="d-inline"><span class="text-muted"> votes</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="activity">
                        <div class="m-0 d-flex flex-row-reverse">
                            <div class="d-flex flex-column m-0 mr-3 ml-1">
                                @can('markAsBest', $answer)
                                <form action="{{route($answer->is_best_answer ? 'answers.unmarkBestAnswer': 'answers.markBestAnswer', $answer->id)}}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="btn p-0 {{ $answer->best_answer_style }}"
                                                title="{{$answer->is_best_answer ? 'Unmark from Best answer' : 'Mark as best answer' }}">
                                            <i class="fa fa-check fa-2x" ></i>
                                        </button>
                                    </form>
                                @else
                                    @if($answer->is_best_answer)
                                        <i class="fa fa-check fa-2x text-success d-block mb-2"></i>
                                    @endif
                                @endcan
                            </div>
                            @can('update', $answer)
                                <div class="d-block  m-0 mr-3">
                                    <a
                                        href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}"
                                        class="btn btn-sm btn-info"
                                        title="Edit your question">
                                        Edit <i class="fa fa-edit fa-lg" ></i>
                                    </a>
                                </div>
                            @endcan
                            @can('delete', $answer)
                                <button
                                    class="btn btn-sm btn-danger ml-1 mr-1"
                                    onclick="displayModalToDeleteAnswer({{ $question->id}}, {{$answer->id }})"
                                    data-toggle="modal"
                                    data-target="#deleteModalForAnswer"
                                    title="Delete your Answer">
                                    Delete <i class="fa fa-trash fa-lg" ></i>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="question-body pt-2 pb-2">
                    <strong class="text-muted">{!! $answer->body !!}</strong>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        @include('layouts.Q&A.Answer._no-answers-found')
    @endif
@include('layouts.Q&A.Answer._create')
