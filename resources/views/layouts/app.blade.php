<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favico.ico') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--VIDEO.JS CSS -->
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app" style="overflow: hidden">
        @include('layouts.partials._navbar')
        <main class="p-5">
            @include('layouts.partials._message')
            @yield('content')
            <a  href="#app"
                title="GO TO TOP"
                class="btn btn-orange mb-5 mr-3 rounded-circle animate__animated  animate__bounceInDown animate__slow "
                id="back-to-top">
                <i class="fa fa-arrow-up"></i>
            </a>
        </main>
        @include('layouts.partials._footer')
    </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>


        <!-- VIDEO.JS CDN -->
        <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
        <script src="https://cdn.sc.gl/videojs-hotkeys/0.2/videojs.hotkeys.min.js"></script>

        <!-- JQUERY VALIDATOR-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="{{ asset('js/MySmoothScroll.js') }}"></script>
        <script src="{{ asset('js/RevealOnScroll.js') }}"></script>
        <script>
            $('#back-to-top').hide();
            new MySmoothScroll("#back-to-top");
            $(window).scroll(function () {
                if ($(this).scrollTop() > 60) {
                    $('#back-to-top').fadeIn('2000');
                    $('.navbar').addClass('shadow-sm');
                    $('#back-to-top').removeClass('animate__bounceOutUp');
                } else {
                    $('#back-to-top').addClass('animate__bounceOutUp');
                    $('.navbar').removeClass('shadow-sm');
                }
            });
        </script>

        <script>
            function mediaWatcherFunction(mediaWatcher) {
                if (mediaWatcher.matches) {
                    $(".about-us").removeClass("col-5");
                    $(".navigations").removeClass("col-4");
                    $(".navigations").addClass("pb-4");
                    $(".contact-us").removeClass("col-4");
                    $(".contact-us").addClass("d-flex flex-row justify-content-between");
                    $(".number").addClass("m-1");
                    $(".email").addClass("m-1");
                } else {
                    $(".about-us").addClass("col-5");
                    $(".navigations").addClass("col-4");
                    $(".navigations").removeClass("pb-4");
                    $(".contact-us").addClass("col-4");
                    $(".contact-us").removeClass("d-flex flex-row justify-content-between");
                    $(".number").removeClass("m-1");
                    $(".email").removeClass("m-1");
                }
            }
            var mediaWatcher = window.matchMedia("(max-width: 1200px)");
            mediaWatcherFunction(mediaWatcher);
            mediaWatcher.addListener(mediaWatcherFunction);
        </script>

        <script>
            var player = videojs('my-player', {
            controls: true,
            fluid:true,
            loop: false,
            playbackRates: [0.25, 0.5, 1, 1.5, 2, 2.5, 3],
            plugins: {
                hotkeys: {
                    enableModifiersForNumbers: false,
                    seekStep: 30
                }
            }
        });

        </script>
    @yield('scripts')
</body>
</html>
