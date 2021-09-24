@extends('layouts.app')

@section('title', 'Playlists | WebAcquire')

@section('content')

<div class="d-flex flex-row justify-content-between section-divider">

        <div class="d-flex flex-column col-md-3">
            @include('layouts.partials._sidebar')

            <div class="card my-card my-card-border-radius p-3">
                <h4 class="text-center text-capitalize"><strong>{{$subCourse->name}}</strong></h4>
                <img src="{{asset($subCourse->image_path)}}" alt="{{$subCourse->name}}">
                <p class="text-muted"><strong class="font-italic">{{$subCourse->description}}</strong></p>
            </div>
        </div>

    <div class="container">

        <div class="section recently-viewed reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Playlists <i class="fa fa-podcast"></i></h2>
                </div>
                <div class="section d-flex mb-2 justify-content-between reveal col-md-10">
                @auth
                    @if (auth()->user()->isAdmin() || auth()->user()->isTeacher())
                        <div class="d-flex justify-content-end flex-row">
                            <div class="button ">
                                <a
                                    href="{{ route('courses.subcourses.playlists.create', [$course->slug, $subCourse->slug])}}"
                                    id="scroll-to-ask-question"
                                    class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                    <span class="styled-button-text">Create Playlist</span>
                                </a>
                            </div>
                        </div>
                    @endif
                @endauth
                </div>
                @if($playlists->count() > 0)
                    <div class="d-flex flex-column">
                        @foreach ($playlists as $playlist)
                            <div class="card my-card my-card-border-radius col-md-10 p-3 m-3">
                                <div class="d-flex flex-row ">
                                    <div class="img m-1">
                                        <img src="{{asset($playlist->image_path)}}" alt="{{$playlist->title}}" width="320px" height="240px">
                                    </div>
                                    <div class="content m-1">
                                        <div class="title-and-author d-flex flex-column">
                                            <h5>
                                                @if ($playlist->enrolledUsers->find(auth()->id()))
                                                    <a href="{{$playlist->url}}" class="text-hblack nav-link p-1 my-nav-link-hblack">
                                                        <strong class="text-hblack">{{$playlist->title}}</strong>
                                                    </a>
                                                @else
                                                        <strong class="text-hblack">{{$playlist->title}}</strong>
                                                @endif
                                            </h5>
                                            <div>
                                                <img src="{{$playlist->owner->image_path}}" alt="{{$playlist->owner->name}}" width="50px" height="50px" class="rounded-circle ">

                                                <strong class="text-muted ">By {{$playlist->owner->name}}</strong>
                                            </div>
                                            <div class="description">
                                                <p>{{ $playlist->description}}</p>
                                            </div>
                                            <div class="actions d-flex flex-row">
                                                <h6 class="text-hblack m-2"><span class="text-orange"><i class="fa fa-video-camera fa-lg"></i></span> {{ $playlist->videos->count()}} Videos</h6>
                                                <h6 class="text-hblack m-2"><span class="text-orange"><i class="fa fa-clock-o fa-lg"></i></span> {{ $playlist->hours}} Hours</h6>

                                                @if ($playlist->enrolledUsers->find(auth()->id()))
                                                    <a
                                                        href="{{$playlist->url}}"
                                                        class="nav-link btn btn-orange">
                                                            <i class="fa fa-bookmark fa-lg"></i>
                                                            Enrolled</h6>
                                                    </a>
                                                @else
                                                <button
                                                        onclick="displayModalToEnrollPlaylist('{{ $playlist->url }}')"
                                                        data-toggle="modal"
                                                        data-target="#enrollModalForm"
                                                        class="nav-link btn btn-orange">
                                                        <i class="fa fa-bookmark-o fa-lg"></i>
                                                            Enroll for free</h6>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @include('layouts.Playlist._enroll-modal')
                @else
                    @include('layouts.Playlist._no-playlist-found')
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
    <script>
        flatpickr("#completion_deadline", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
        });

    </script>

<script>
    $("#enrollCourseForm").validate({
        rules: {
            completion_deadline: {
                required: true,
            },
        },
        errorElement: 'p',
        errorPlacement: function(error, element) {
            if (error) {
                error.insertAfter(element);
                error.addClass('text-danger');
            }
        }
    });

</script>

    <script>
        function displayModalToEnrollPlaylist(playlistUrl) {
            url = playlistUrl + "/enroll";
            $("#enrollCourseForm").attr('action', url);
        }
    </script>
@endsection
