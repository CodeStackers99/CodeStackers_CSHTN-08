@extends('layouts.app')

@section('title', 'Home | WebAcquire')

@section('content')
    <div class="container">
        <div class="section">
            <div class="d-flex justify-content-between section-divider align-items-center">
                <div class="content d-flex flex-column justify-content-center col-md-6">
                    <h1 class="animate__animated animate__shakeX animate__slow">
                        <strong
                            class="font-weight-bolder text-orange">
                                Acquire
                        </strong>
                    </h1>
                    <h1 class="animate__animated animate__shakeX">
                        <strong
                            class="font-weight-bolder text-hblack">
                                The Web &lt;/&gt;
                        </strong>
                    </h1>
                    <p class="font-italic">
                        <strong
                            class="text-hblack">
                                Let's Grow Your <span class="text-orange">Web-Development</span> skills Level up with <span class="text-orange">WebAcquire</span>
                        </strong>
                    </p>
                    <div class="button">
                        <a
                            href="@auth{{route('courses.index')}} @else {{ route('login') }} @endauth"
                            class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                            <span class="styled-button-text">Get Started</span>
                        </a>
                    </div>
                </div>
                <div class="image col-md-6 mt-2">
                    <img src="{{asset('images/home/acquire_the_web.png')}}" alt="" width="100%" class="mt-2">
                </div>
            </div>
        </div>

        <div class="section features reveal">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                    <h2 class="text-hblack font-weight-bold text-capitalize sub-heading">Smartly comes with amazing features</h2>
                    <span class="my-underline"></span>
                </div>
                <div class="d-flex flex-row justify-content-around mt-3 mb-3 section-divider">
                    <div
                        class="card pt-4 pb-4
                                col-md-2 rounded shadow-sm bg-light card-hover my-card-border my-card-border-radius
                                d-flex justify-content-center flex-column align-items-center mt-2 mb-2">
                        <h4><i class="fa fa-file-video-o fa-2x text-orange"></i></h4>
                        <h6 class="mt-3 text-hblack font-weight-bold text-center text-capitalize">Video Lectures from various Intructors.</h6>
                    </div>
                    <div
                        class="card pt-4 pb-4
                        col-md-2 rounded shadow-sm bg-light card-hover my-card-border my-card-border-radius
                        d-flex justify-content-center flex-column align-items-center mt-2 mb-2">

                        <h4><i class="fa fa-list-ol fa-2x text-orange"></i></h4>
                        <h6 class="mt-3 text-hblack font-weight-bold text-center text-capitalize">Practice questions after each video.</h6>
                    </div>

                    <div
                        class="card pt-4 pb-4
                        col-md-2 rounded shadow-sm bg-light card-hover my-card-border my-card-border-radius
                        d-flex justify-content-center flex-column align-items-center mt-2 mb-2">

                        <h4><i class="fa fa-book fa-2x text-orange"></i></h4>
                        <h6 class="mt-3 text-hblack font-weight-bold text-center text-capitalize">Video to video notes.</h6>
                    </div>

                    <div
                        class="card pt-4 pb-4
                        col-md-2 rounded shadow-sm bg-light card-hover my-card-border my-card-border-radius
                        d-flex justify-content-center flex-column align-items-center mt-2 mb-2">

                        <h4><i class="fa fa-comments-o fa-2x text-orange"></i></h4>
                        <h6 class="mt-3 text-hblack font-weight-bold text-center text-capitalize">Discussion forum on each video</h6>
                    </div>
                    <div
                        class="card pt-4 pb-4
                        col-md-2 rounded shadow-sm bg-light card-hover my-card-border my-card-border-radius
                        d-flex justify-content-center flex-column align-items-center mt-2 mb-2">

                        <h4><i class="fa fa-trophy fa-2x text-orange"></i></h4>
                        <h6 class="mt-3 text-hblack font-weight-bold text-center text-capitalize">Quiz section to test yourself.</h6>
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
@endsection
