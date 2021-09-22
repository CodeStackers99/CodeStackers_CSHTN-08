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

        <div class="section questions reveal">
            <div class="d-flex flex-column ">
                <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5  mr-5">
                    <h2 class="text-hblack font-weight-bold text-capitalize text-center sub-heading">Tap into the brainpower of thousands of experts worldwide</h2>
                    <span class="my-underline"></span>
                </div>
                <div class="d-flex justify-content-between section-divider align-items-center">
                    <div class="image col-md-6 mt-1">
                        <img src="{{asset('images/home/questions.png')}}" alt="" width="100%" class="">
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
                        <p class="font-italic">
                            <strong
                                class="text-hblack">
                                    Whether you get stuck on any coding question or facing any bug, here's the solution. We provide you a <span class="text-orange">Q&A</span> platform where you can ask your doubt and our instructors or students can <span class="text-orange">answer</span> your query.
                            </strong>
                        </p>
                        <div class="button">
                            <a
                                href="@auth{{route('questions.index')}} @else {{ route('login') }} @endauth"
                                class="styled-btn styled-rounded text-muted float-left border border-dark" style="text-decoration:none">
                                <span class="styled-button-text" id="my-btn">Explore Questions</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section testimonials reveal">
            <div class="d-flex flex-column">
                <div class="d-flex flex-row justify-content-center mt-3 mb-3 ml-5 mr-5">
                    <h2 class="text-hblack font-weight-bold text-capitalize text-center sub-heading">Testimonials</h2>
                    <span class="my-underline"></span>
                </div>
                <div class="d-flex justify-content-between section-divider">
                    <div class="content d-flex flex-column justify-content-center col-md-4">
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-orange">
                                    See What Our
                            </strong>
                        </h1>
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Students are
                            </strong>
                        </h1>
                        <h1 class="">
                            <strong
                                class="font-weight-bolder text-hblack">
                                    Saying About Us
                            </strong>
                        </h1>
                        <p><strong></strong></p>
                        <div class="button">
                            <a
                                href="@auth{{route('courses.index')}} @else {{ route('login') }} @endauth"
                                class="styled-btn styled-rounded text-muted border border-dark" style="text-decoration:none">
                                <span class="styled-button-text">Get Started</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-8 d-flex flex-row align-content-center justify-content-center align-items-center">
                        <div class="mr-2">
                            <button class=" owl_prev btn rounded-circle carousel-btn-prev " ><i class="fa fa-chevron-left  fa-lg"></i></button>
                        </div>
                        <div class="owl-carousel mt-3" >
                            @foreach($testimonials as $testimonial)
                                    <div
                                        class="card col-md-10 rounded shadow-sm bg-light p-4
                                                d-flex justify-content-center flex-column align-items-center align-content-center my-card-border-top my-card-border-radius ">
                                        <div class="image ">
                                            <img src="{{$testimonial->owner->image_path}}" class="rounded-circle" width="100px" height="100px">
                                        </div>
                                        <q class="text-center font-italic text-hblack font-weight-bold testimonial-description">{{$testimonial->description}}</q>
                                        <strong class="float-right text-orange testimonial-description">~{{$testimonial->owner->name}}</strong>
                                    </div>
                            @endforeach
                        </div>
                        <div>
                            <button class=" owl_next btn rounded-circle carousel-btn-next " >
                            <i class="fa fa-chevron-right fa-lg "></i>
                            </button>
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
        $(document).ready(function(){

            //Features
            let owl = $(".owl-carousel");
            owl.owlCarousel({
                    loop: true,
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
                            items:2,
                            nav:false
                        },
                    }
                });

                $('.owl_next').click(function() {
                    owl.trigger('next.owl.carousel');
                });
                $('.owl_prev').click(function() {
                    owl.trigger('prev.owl.carousel', [1000]);
                });
            });
    </script>
@endsection
