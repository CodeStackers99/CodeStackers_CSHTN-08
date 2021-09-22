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
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
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
    </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

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
    @yield('scripts')
</body>
</html>
