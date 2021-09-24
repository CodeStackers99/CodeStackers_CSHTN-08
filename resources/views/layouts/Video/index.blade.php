@extends('layouts.app')

@section('title', 'videos | WebAcquire')

@section('content')

<div class="d-flex flex-row justify-content-between section-divider">

        <div class="d-flex flex-column col-md-3">
            @include('layouts.partials._sidebar')

            <div class="card my-card my-card-border-radius p-3">
                <h4><a href="{{$playlist->url}}" class="text-center text-capitalize nav-link text-hblack my-nav-link-hblack"><strong>{{$playlist->title}}</strong></a></h4>
                <img src="{{asset($playlist->image_path)}}" alt="{{$playlist->title}}">
                <p class="text-muted"><strong class="font-italic">{{$playlist->description}}</strong></p>
            </div>
        </div>

    <div class="container">

        <div class="section videos reveal">
            <div class="d-flex flex-column justify-content-center align-content-center">
                <div class="section d-flex flex-column align-items-center">
                    <span class="my-underline-2"></span>
                    <h2 class="text-hblack font-weight-bold text-capitalize mt-3 animate_animated animate__heartBeat animate_slow sub-heading">{{$playlist->title}} Videos <i class="fa fa-video-camera"></i></h2>
                </div>
                @if($videos->count() > 0)
                    <div class="d-flex flex-row align-items-center justify-content-center align-content-center videos col-md-10">
                        <div class="">
                            <button class="owl_prev btn rounded-circle carousel-btn-prev " ><i class="fa fa-chevron-left fa-lg"></i></button>
                        </div>
                            <div class="p-0 m-0 owl-carousel">
                                @foreach ($videos as $video)
                                    <div class="d-flex flex-column justify-content-center p-2 m-1 card my-card-border-radius">
                                        <div class="img text-center">
                                            <img src="{{asset($video->image_path)}}" alt="video-img"
                                                width="300px" height="220px">
                                        </div>
                                        <div class="content border-orange p-2">
                                            <a href="{{$video->url}}" class="text-orange font-weight-bold text-center border-orange-bottom nav-link my-nav-link-orange">{{$video->title}}</a>
                                            <p class="text-muted m-2 p-0 font-italic"><strong class="text-muted">{{Str::limit($video->description, 230, '....')}}</strong></p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <button class=" owl_next btn rounded-circle carousel-btn-next " >
                                <i class="fa fa-chevron-right fa-lg "></i>
                                </button>
                            </div>
                    </div>
                @else
                    @include('layouts.Video._no-video-found')
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function(){

        let owl = $(".owl-carousel");
        owl.owlCarousel({
                nav: false,
                dots: false,
                autoplay: true,
                smartSpeed: 1000,
                margin: 0,
                rewindNav : false,
                pagination : true,
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

<script>
    function mediaWatcherFunction(mediaWatcher) {
        if (mediaWatcher.matches) {
            // $(".videos").removeClass("col-md-11");
            // $(".videos").addClass("col-md-4");
        } else {

        }
    }
    var mediaWatcher = window.matchMedia("(max-width: 1000px)");
    mediaWatcherFunction(mediaWatcher);
    mediaWatcher.addListener(mediaWatcherFunction);
</script>


@endsection
