@extends('layouts.app')

@section('title', 'Dashboard | WebAcquire')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        <div class="container d-flex">
            <div class="welcome d-flex">
                <div class="image">
                    <img src="{{auth()->user()->image_path}}" alt="{{ auth()->user()->name }}" class="rounded-circle" width="100px" height="100px">
                </div>
                <div class="name">
                    <h4 class="text-hblack p-0 m-0"><strong class="p-0">Hi, {{auth()->user()->name}} 👋</strong></h4>
                    <q class="text-muted font-italic d-block">{{$thought->description}}</q>
                    <p class="text-muted font-italic p-0 m-0 float-right">~{{$thought->name}}</p>
                </div>
            </div>
        </div>
    </div>

<div class="d-flex flex-row justify-content-between section-divider">

    @include('layouts.partials._sidebar')

    <div class="container">

        <div class="section recently-viewed reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Recently Viewed</h2>
                </div>
                @if($recentlyViewedVideo->count() > 0)
                    <div class="d-flex flex-row justify-content-around mt-3 mb-3 section-divider owl-carousel">
                        @foreach ($recentlyViewedVideo as $video)
                            <div
                                class="card p-2
                                rounded bg-light my-card-border my-card-border-radius
                                d-flex flex-column align-items-center ">
                                <img src="{{ asset($video->playlist->image_path) }}"
                                        alt="{{$video->playlist->title}}"
                                        class="p-2 my-card-border-radius" width="200px" height="220px">

                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">

                                    <div class="d-flex flex-column">
                                        <a  href="{{$video->playlist->url}}"
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-hblack">{{Str::limit($video->playlist->title, 30,'...')}}</strong>
                                            </a>

                                        <p class="text-muted p-0 m-0">
                                            <strong class="p-2 m-0 text-hblack"><i class="fa fa-user fa-lg" ></i> {{$video->playlist->owner->name}}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-4 ">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column ">
                                            <a  href="{{$video->playlist->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Playlist</strong>
                                            </a>
                                            <a  href="{{$video->playlist->subcourse->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Subcourse</strong>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a  href="{{$video->playlist->subcourse->course->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i>  Course</strong>
                                            </a>
                                            <a  class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-thumbs-o-up fa-lg text-hblack"></i> {{$video->likes_count}}</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">
                                    <div class="button pb-2">
                                        <a
                                            href="{{ $video->url}}"
                                            class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                            <span class="styled-button-text"><i class="fa fa-play fa-lg" ></i> Again</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @include('layouts.partials._no-results-found')
                @endif
            </div>
        </div>

        <div class="section enrolledCoursesAnalysis reveal">
            <div class="d-flex flex-column ">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Enrolled Playlist Analysis</h2>
                </div>
                <div class="d-flex justify-content-between section-divider align-items-center">
                    <div class="content d-flex flex-column col-md-6">
                        <h1>
                            <strong
                                class="font-weight-bolder text-orange">
                                    Analyze
                            </strong>
                        </h1>
                        <h1>
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Plan
                            </strong>
                        </h1>
                        <h1>
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Practice
                            </strong>
                        </h1>
                        <p class="font-italic">
                            <strong
                                class="text-hblack">
                                Analysis is the critical starting point of strategic thinking.
                            </strong>
                        </p>
                        <div class="font-weight-bolder text-hblack"> You have enrolled for a total of <h3 class="text-orange d-inline">{{$enrollAnalysis['total']}}</h3> playlists.</div>
                    </div>
                    <div class="col-md-6 m-auto">
                        <canvas id="enrolledCoursesAnanlysisChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="section watch-later reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Enrolled Playlist Due In Upcoming 7 Days</h2>
                </div>

                @if($enrolledInComplete->count() > 0)
                    <div class="d-flex flex-row justify-content-around mt-3 mb-3 section-divider owl-carousel">
                        @foreach ($enrolledInComplete as $playlist)

                            <div class="card p-2
                                    rounded bg-light
                                    my-card-border my-card-border-radius
                                    d-flex flex-column
                                    align-items-center ">

                                <img src="{{ asset($playlist->image_path) }}"
                                    alt="{{$playlist->title}}"
                                    class="p-2 my-card-border-radius" width="200px" height="220px">

                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">

                                    <div class="d-flex flex-column">
                                        <a  href="{{$playlist->url}}"
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-hblack">{{Str::limit($playlist->title, 30,'...')}}</strong>
                                            </a>

                                        <p class="text-muted p-0 m-0">
                                            <strong class="p-2 m-0 text-hblack"><i class="fa fa-user fa-lg" ></i> {{$playlist->owner->name}}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-1">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column ">
                                            <a  href="{{$playlist->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-video-camera fa-lg text-hblack"></i> {{$playlist->videos->count()}} Videos</strong>
                                            </a>
                                            <a  href="{{$playlist->subcourse->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Subcourse</strong>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a  href="{{$playlist->subcourse->course->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i>  Course</strong>
                                            </a>
                                            <a  class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-clock-o fa-lg text-hblack"></i> {{$playlist->hours}}</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">
                                    <div class="button pb-2">
                                        <a
                                            href="{{ $playlist->url}}"
                                            class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                            <span class="styled-button-text"><i class="fa fa-podcast fa-lg" ></i> View Playlist</span>
                                        </a>
                                    </div>
                                </div>
                            <div>
                        </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    @include('layouts.partials._no-results-found')
                @endif
            </div>
        </div>

        <div class="section top-playlists reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Top Playlists</h2>
                </div>
                <div class="d-flex flex-row justify-content-around mt-3 mb-3 section-divider owl-carousel">
                    @foreach ($topPlaylists as $playlist)
                        <div
                            class="card p-2
                            rounded bg-light my-card-border my-card-border-radius
                            d-flex flex-column align-items-center ">
                                <img src="{{ asset($playlist->image_path) }}"
                                    alt="{{$playlist->title}}"
                                    class="p-2 my-card-border-radius" width="200px" height="220px">

                            <div class="d-flex flex-row justify-content-between p-1 align-items-center">

                                <div class="d-flex flex-column">
                                    <a  href="{{$playlist->subcourse->url}}"
                                        class="nav-link p-2 m-0">
                                            <strong class="p-0 m-0 text-hblack">{{Str::limit($playlist->title, 30,'...')}}</strong>
                                        </a>

                                    <p class="text-muted p-0 m-0">
                                        <strong class="p-2 m-0 text-hblack"><i class="fa fa-user fa-lg" ></i> {{$playlist->owner->name}}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between p-1">
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="d-flex flex-column ">
                                        <p
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-muted"><i class="fa fa-video-camera fa-lg text-hblack"></i> {{$playlist->videos->count()}} Videos</strong>
                                        </p>
                                        <a  href="{{$playlist->subcourse->url}}"
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Subcourse</strong>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a  href="{{$playlist->subcourse->course->url}}"
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i>  Course</strong>
                                        </a>
                                        <a  class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-muted"><i class="fa fa-clock-o fa-lg text-hblack"></i> {{$playlist->hours}}</strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between p-1 align-items-center">
                                <div class="button pb-2">
                                    <a
                                        href="{{ $playlist->subcourse->url}}"
                                        class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                        <span class="styled-button-text"><i class="fa fa-podcast fa-lg" ></i> View Playlist</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section watch-later reveal">
            <div class="d-flex flex-column">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 sub-heading">Watch Later</h2>
                </div>
                @if ($watchLaterVideos->count() > 0)
                    <div class="d-flex flex-row justify-content-around mt-3 mb-3 section-divider owl-carousel">
                        @foreach ($watchLaterVideos as $video)
                            <div
                                class="card p-2
                                rounded bg-light my-card-border my-card-border-radius
                                d-flex flex-column align-items-center ">
                                <img src="{{ asset($video->playlist->image_path) }}"
                                        alt="{{$video->playlist->title}}"
                                        class="p-2 my-card-border-radius" width="200px" height="220px">

                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">

                                    <div class="d-flex flex-column">
                                        <a  href="{{$video->playlist->url}}"
                                            class="nav-link p-2 m-0">
                                                <strong class="p-0 m-0 text-hblack">{{Str::limit($video->playlist->title, 30,'...')}}</strong>
                                            </a>

                                        <p class="text-muted p-0 m-0">
                                            <strong class="p-2 m-0 text-hblack"><i class="fa fa-user fa-lg" ></i> {{$video->playlist->owner->name}}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-4 ">
                                    <div class="d-flex flex-row justify-content-between">
                                        <div class="d-flex flex-column ">
                                            <a  href="{{$video->playlist->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Playlist</strong>
                                            </a>
                                            <a  href="{{$video->playlist->subcourse->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i> Subcourse</strong>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <a  href="{{$video->playlist->subcourse->course->url}}"
                                                class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-external-link fa-lg text-hblack"></i>  Course</strong>
                                            </a>
                                            <a  class="nav-link p-2 m-0">
                                                    <strong class="p-0 m-0 text-muted"><i class="fa fa-star-half-o fa-lg text-hblack"></i> {{$video->likes_count}}</strong>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-between p-1 align-items-center">
                                    <div class="button pb-2">
                                        <a
                                            href="{{ $video->url}}"
                                            class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                            <span class="styled-button-text"><i class="fa fa-play fa-lg" ></i> Again</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @include('layouts.partials._no-results-found')
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')

<script>
    new RevealScroll($(".reveal"), "60%");
    $(document).ready(function(){

        //Features
        let owl = $(".owl-carousel");
        owl.owlCarousel({
                nav: false,
                dots: false,
                autoplay: true,
                smartSpeed: 1000,
                margin: 50,
                rewindNav : false,
                pagination : false,
                responsive:{
                    0:{
                        items:1,
                        nav:true,
                    },
                    600:{
                        items:1,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:false
                    },
                }
            });
        });
</script>

<script>

    var ctx = document.getElementById('enrolledCoursesAnanlysisChart');
    let completedPlaylistCourses = {{ $enrollAnalysis['completed'] }};
    let pastDuePlaylistCourses = {{ $enrollAnalysis['in_complete'] }};
    let pendingPlaylistCourses = {{ $enrollAnalysis['can_complete'] }};

var enrolledPlaylistAnanlysisChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Enrolled Playlist Past Due', 'Completed Enrolled Playlist', 'Pending Enrolled Playlist'],
        datasets: [{
            label: '# of Votes',
            data: [ pastDuePlaylistCourses, completedPlaylistCourses, pendingPlaylistCourses],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(0, 255, 0, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(0, 255, 0, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1,
            animateScale: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection
