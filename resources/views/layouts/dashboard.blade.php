@extends('layouts.app')

@section('title', 'Dashboard | WebAcquire')

@section('content')
    <div class="d-flex flex-row justify-content-between">
        <div style="width: 220px"></div>
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

        <div class="section enrolledCoursesAnalysis reveal">
            <div class="d-flex flex-column ">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">Enrolled Playlist Analysis</h2>
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
                                    Whether you get stuck on any coding question or facing any bug, here's the solution. We provide you a <span class="text-orange">Q&A</span> platform where you can ask your doubt and our instructors or students can <span class="text-orange">answer</span> your query.
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
    </div>

</div>

@endsection

@section('scripts')

<script>
    new RevealScroll($(".reveal"), "60%");
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
