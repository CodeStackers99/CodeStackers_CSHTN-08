@extends('layouts.app')
@section('title',  $video->title.' | WebAcquire')

@section('content')
<div class="container-fluid">
    <div class="section d-flex flex-column align-items-center">
        <span class="my-underline-2"></span>
        <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">{{ $video->title }}</h2>
    </div>
    <div class="section d-flex mb-2 justify-content-between reveal">
        <div class="button ">
            <a
                href="{{ $playlist->url}}"
                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                <span class="styled-button-text"><i class="fa fa-chevron-circle-left" ></i> Back to All Videos</span>
            </a>
        </div>
    </div>

    <div class="section d-flex reveal flex-row align-items-center">
            <img src="{{$video->playlist->owner->image_path}}" alt="{{ $video->playlist->owner->name }}" class="rounded-circle" width="100px" height="100px">
            <h5 class="text-hblack p-1 m-1"><strong class="p-0">{{$video->playlist->owner->name}}</strong></h5>
    </div>

    <div class="section d-flex flex-row justify-content-between section-divider">
        <div class="col-md-8 d-flex flex-column">
            <video
                id="my-player"
                class="video-js vjs-big-play-centered"
                controls
                poster="{{asset($video->image_path)}}">
                    <source src="{{asset($video->video_path)}}" type="video/mp4"></source>
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">
                    supports HTML5 video
                    </a>
                </p>
            </video>
            <div class="p-2 " style="background: #d4895a;">
                <div class="d-flex flex-row justify-content-between border-bottom mb-1 pb-1">
                    <h4 class="text-hblack"><strong>{{ $video->title }}</strong></h4>
                    <div>
                        <h4 class="d-inline text-white"><strong>{{ $video->likes_count }}</strong></h4>
                        @if ($video->users()->find(auth()->id())->pivot->reactions)
                            <a  href="{{$video->url .'/dislike'}}"
                                class="nav-link my-nav-link-hblack d-inline p-1 text-hblack"
                                title="Dislike">
                                <i class="fa fa-2x fa-thumbs-up text-white"></i>
                            </a>
                        @else
                            <a  href="{{$video->url .'/like'}}"
                                class="nav-link my-nav-link-hblack d-inline p-1 text-white"
                                title="Like">
                                <i class="fa fa-2x fa-thumbs-o-up"></i>
                            </a>
                        @endif
                        <a  href="{{$video->url .'/watch-later'}}"
                            class="nav-link my-nav-link-hblack d-inline p-1 text-white"
                            title="Add video to watch later">
                            <i class="fa fa-2x fa-clock-o"></i>
                        </a>
                    </div>
                </div>
                <div class="description">
                    <p class="text-light">{{ $video->description }}</p>
                </div>
            </div>
            <div class="bg-white border-orange mt-2 mb-2 p-2">
                <h4 class="text-hblack mb-3">Tags <i class="fa fa-tag"></i></h4>
                @foreach ($video->tags as $tag)
                    <li class="d-inline p-1 text-hblack font-weight-bold border border-dark rounded">&num;{{$tag->name}}</li>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex flex-column">
                <div class="card p-3 shadow-lg mb-2 border-orange">
                    <h4 class="text-center text-hblack text-capitalize font-weight-bold border-bottom">Recommended Videos</h4>
                    <div style="height: 600px; overflow: auto; text-align: justify; padding: 20px;">
                        @foreach ($video->tags()->get() as $tag)
                            @foreach ($tag->videos as $video)
                                <a class="nav-link my-nav-link-hblack text-hblack" href="{{$video->playlist->subcourse->url}}">
                                <div class="d-flex flex-row border-top border-bottom">
                                        <img src="{{asset($video->image_path)}}" alt="img" width="100px" height="100px" class="m-1">
                                        <div>
                                            <strong class="text-hblack m-1">{{$video->title}}</strong>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                @if ($video->assignment->usersAttempted()->find(auth()->id()))
                    <p  class="border-orange p-4 text-orange" style="font-size: 25px;">
                    Assignment Submitted. You scored {{$video->assignment->usersAttempted()->find(auth()->id())->pivot->marks_obtained }} out of {{$video->assignment->questions->count()}}</p>
                @else
                    <a href="{{route('courses.subcourses.playlists.videos.assignment.show', [$course->slug,
                        $subCourse->slug, $playlist->slug, $video->slug, $video->assignment->id])}}" class="btn btn-orange p-4" style="font-size: 25px;">
                    Attempt Assignment</a>
                @endif
            </div>
        </div>
    </div>

</div>

@include('layouts.Comment._index')

@endsection
