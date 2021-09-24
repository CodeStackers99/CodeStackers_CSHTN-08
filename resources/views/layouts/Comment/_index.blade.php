<div class="d-flex flex-column align-items-center mt-5 reveal col-md-8">
    <span class="my-underline-2"></span>
    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading" id="comments">Comments</h2>
</div>
<div class="d-flex justify-content-start flex-row col-md-8">
    <div class="button ">
        <a
            href="#comment-now"
            class="scroll-to-comment-now styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
            <span class="styled-button-text">Comment Now</span>
        </a>
    </div>
</div>
@if($comments->count() > 0)
    <div class="col-md-8 card shadow section">
        @foreach ($comments as $comment)
            <div class="card-body border-bottom">
                <div class="row justify-content-between pb-2">
                    <div class="col-md-6 profile d-flex flex-row">
                        <div class="img m-1">
                            <img
                                src="{{ $comment->owner->image_path }}"
                                alt="{{ $comment->owner->name }}"
                                class="profile-img"
                                title="{{ $comment->owner->name }}"
                                width="120px"
                                height="120px">
                        </div>
                        <div class="name d-flex flex-column">
                            <p class="m-0"><strong class="p-1">{{ $comment->owner->name }}</strong></p>
                            <strong class="text-muted p-1">{{ $comment->description  }}</strong>
                            <p class="p-1 text-muted m-0">Commented {{ $comment->created_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    @include('layouts.Comment._no-comments-found')
@endif

@include('layouts.Comment._create')
